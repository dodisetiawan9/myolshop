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
		$data['data'] = $this->m_home->get_all('t_items');
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

		$data = array(
					'user'				=> $this->input->post('username', TRUE),
					'nama1'				=> $this->input->post('nama1', TRUE),
					'nama2'				=> $this->input->post('nama2', TRUE),
					'email'				=> $this->input->post('email', TRUE),
					'jk'					=> $this->input->post('jk', TRUE),
					'tlp'					=> $this->input->post('tlp', TRUE),
					'alamat'			=> $this->input->post('alamat', TRUE),
				);

		$this->template->home('register', $data);
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */