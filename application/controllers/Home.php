<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('template', 'cart', 'form_validation'));
		$this->load->model('m_home');
	}
	public function index()
	{
		$data['data'] = $this->m_home->get_where('t_items', ['status' => 1]);
		$this->template->home('home/content', $data);
	}

	public function detail()
	{
		if(is_numeric($this->uri->segment(3)))
		{
			$id = $this->uri->segment(3);
			$data['data'] = $this->m_home->get_where('t_items', array('id_item' => $id));
			$this->template->home('home/item_detail', $data);
		}
		else{
			redirect('home');
		}


		
	}

	public function register()
	{
		if($this->input->post('submit', TRUE) == 'Submit')
		{

			$this->form_validation->set_rules('nama1', 'Nama Depan', "required|min_length[3]|regex_match[/^[a-zA-Z'.]+$/]");
			$this->form_validation->set_rules('nama2', 'Nama Belakang', "regex_match[/^[a-zA-Z'.]+$/]");
			$this->form_validation->set_rules('username', 'Username', "required|min_length[5]|regex_match[/^[a-zA-Z0-9]+$/]");
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
			$this->form_validation->set_rules('password1', 'Password', 'required|min_length[5]');
			$this->form_validation->set_rules('password2', 'Re-Password', 'required|matches[password1]');
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('tlp', 'Telepon', 'required|min_length[8]|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[10]');

			if($this->form_validation->run() == TRUE)
			{
				$data = array(
					'username'		=> $this->input->post('username', TRUE),
					'fullname'		=> $this->input->post('nama1', TRUE).' '.$this->input->post('nama2', TRUE),
					'email'				=> $this->input->post('email', TRUE),
					'password'		=> password_hash($this->input->post('password1', TRUE), PASSWORD_DEFAULT, ['cost' => 10]),
					'jk'					=> $this->input->post('jk', TRUE),
					'tlp'					=> $this->input->post('tlp', TRUE),
					'alamat'			=> $this->input->post('alamat', TRUE),
					'status'			=> 1

				);

				if($this->m_home->insert('t_users', $data))
				{
					$this->template->home('reg_success');
				}
				else{
					echo '<script type="text/javascript">alert("Username / Email tidak tersedia");</script>';
				}
			}

		}

		if($this->session->userdata('user_login') == TRUE)
		{
			redirect('home');
		}

		$data = array(
					'username'				=> $this->input->post('username', TRUE),
					'nama1'				=> $this->input->post('nama1', TRUE),
					'nama2'				=> $this->input->post('nama2', TRUE),
					'email'				=> $this->input->post('email', TRUE),
					'jk'					=> $this->input->post('jk', TRUE),
					'tlp'					=> $this->input->post('tlp', TRUE),
					'alamat'			=> $this->input->post('alamat', TRUE),
				);

		$this->template->home('register', $data);
	}

	public function login()
	{
		if($this->input->post('submit') == 'Submit')
		{
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);

			$cek = $this->m_home->get_where('t_users', "username = '$username' || email = '$username'");

			if ($cek->num_rows() > 0) {
				$data = $cek->row();

				if (password_verify($password, $data->password)) 
				{
					$datauser = array(
						'user_id'	=> $data->id_user,
						'name'	=> $data->fullname,
						'user_login'	=> TRUE
					);

					$this->session->set_userdata($datauser);
					redirect('home');
				} 
				else 
				{
					$this->session->set_flashdata('alert', 'Password yang anda masukan salah!');
				}
			} 
			
			else 
			{
				$this->session->set_flashdata('alert', 'Username ditolak!');
			}
		}
				
		if($this->session->userdata('user_login') == TRUE)
		{
			redirect('home');
		}

		$this->load->view('login'); 
	}

	public function profile()
	{
		if(!$this->session->userdata('user_login'))
		{
			redirect('home/login');
		}

		$get = $this->m_home->get_where('t_users', array('id_user' => $this->session->userdata('user_id')))->row();

		if($this->input->post('submit', TRUE) == 'Submit')
		{

			$this->form_validation->set_rules('nama1', 'Nama Depan', "required|min_length[3]|regex_match[/^[a-zA-Z'.]+$/]");
			$this->form_validation->set_rules('nama2', 'Nama Belakang', "regex_match[/^[a-zA-Z'.]+$/]");
			$this->form_validation->set_rules('username', 'Username', "required|min_length[5]|regex_match[/^[a-zA-Z0-9]+$/]");
			$this->form_validation->set_rules('password', 'Masukan password anda', 'required|min_length[5]');
			$this->form_validation->set_rules('jk', 'Jenis Kelamin', 'required');
			$this->form_validation->set_rules('tlp', 'Telepon', 'required|min_length[8]|numeric');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[10]');

			if($this->form_validation->run() == TRUE)
			{

				if(password_verify($this->input->post('password', TRUE), $get->password))
				{
					$data = array(
						'username'		=> $this->input->post('username', TRUE),
						'fullname'		=> $this->input->post('nama1', TRUE).' '.$this->input->post('nama2', TRUE),
						'jk'					=> $this->input->post('jk', TRUE),
						'tlp'					=> $this->input->post('tlp', TRUE),
						'alamat'			=> $this->input->post('alamat', TRUE),

					);

					if($this->m_home->update('t_users', $data, array('id_user' => $this->session->userdata('user_id'))))
					{
						$this->session->set_userdata(array('name' => $this->input->post('nama1', TRUE).' '.$this->input->post('nama2', TRUE)));
						
						redirect('home');
					}
					else{
						echo '<script type="text/javascript">alert("Username / Email tidak tersedia");</script>';
					}
				}
				else{
					echo '<script type="text/javascript">alert("Password salah");window.location.replace("'.base_url().'home/logout")</script>';
				}
			}

		}

		$name = explode(' ', $get->fullname);
		$data['nama1']		= $name[0];
		$data['nama2']		= $name[1];
		$data['username']	= $get->username;
		$data['email']		= $get->email;
		$data['jk']				= $get->jk;
		$data['tlp']			= $get->tlp;
		$data['alamat']		= $get->alamat;

		$this->template->home('user_profile', $data);
	}


	public function password()
	{
		if(!$this->session->userdata('user_login'))
		{
			redirect('home/login'); 
		}

		if($this->input->post('submit', TRUE) == 'Submit')
		{
			$this->form_validation->set_rules('password1', 'Password Baru', 'required|min_length[5]');	
			$this->form_validation->set_rules('password2', 'Re-Password', 'required|matches[password1]');	
			$this->form_validation->set_rules('password', 'Password Lama', 'required');
			
			if($this->form_validation->run() == TRUE)
			{
				$get_data = $this->m_home->get_where('t_users', array('id_user' => $this->session->userdata('user_id')))->row();

				if(!password_verify($this->input->post('password', TRUE), $get_data->password))
				{
					echo '<script type="text/javascript">alert("Password yang anda masukan salah");window.location.replace("'.base_url().'home/logout")</script>';
				}
				else
				{
					$pass = $this->input->post('password1', TRUE);
					$data['password'] = password_hash($pass, PASSWORD_DEFAULT, ['cost' => 10]);
					$cond = array('id_user' => $this->session->userdata('user_id'));

					$this->m_home->update('t_users', $data, $cond);
					redirect('home/logout');
				}
			}
		}



		$this->template->home('pass');
	}

	public function transaksi()
	{
		if(!$this->session->userdata('user_id'))
		{
			redirect('home');
		}

		$data['get'] = $this->m_home->get_where('t_order', ['id_user' => $this->session->userdata('user_id')]);

		$this->template->home('transaksi', $data);
	}

	public function detail_transaksi()
	{
		if(!is_numeric($this->uri->segment(3)))
		{
			redirect('home');
		}

		$table = "t_order o JOIN t_detail_order do ON (o.id_order = do.id_order) JOIN t_items i ON (do.id_item = i.id_item) JOIN t_users u ON (o.id_user = u.id_user)";

		$data['get'] = $this->m_home->get_where($table, ['o.id_order' => $this->uri->segment(3)]);

		$this->template->home('detail_transaksi', $data);
	}

	public function hapus_transaksi()
	{
		if(!is_numeric($this->uri->segment(3)))
		{
			redirect('home');
		}

		$table = array('t_order', 't_detail_order');

		$this->m_home->delete($table, ['id_order' => $this->uri->segment(3)]);

		redirect('home/transaksi');
	}


	public function logout()
	{
		$this->session->sess_destroy();
		redirect('home');
	}
}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */