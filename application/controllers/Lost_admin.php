<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lost_admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('template', 'form_validation'));
		$this->load->model('m_admin');
	}
	public function index()
	{
		if($this->input->post('submit', TRUE) == 'Submit')
		{
			$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

			if($this->form_validation->run() == TRUE)
			{
				$get = $this->m_admin->get_where('t_admin', array('email' => $this->input->post('email', TRUE)));

				if($get->num_rows() > 0)
				{
					//proses
					$this->load->library('email');

					$config['charset']			= 'utf-8';
					$config['useragent']		= 'Myolshop';
					$config['protocol']			= 'smtp';
					$config['mailtype']			= 'html';
					$config['smtp_host']		= 'ssl://smtp.gmail.com';
					$config['smtp_port']		= '465';
					$config['smtp_timeout']	= '5';
					$config['smtp_user']		= 'setiawan.youngin@gmail.com';
					$config['smtp_pass']		= 'bismillah77';
					$config['crlf']					= "\r\n";
					$config['newline']			= "\r\n";
					$config['wordwrap']			= TRUE;

					$this->email->initialize($config);

					$key = md5(md5(time())); 

					$this->email->from('setiawan.youngin@gmail.com', "Myolshop");
					$this->email->to($this->input->post('email', TRUE)); 
					$this->email->subject('Reset Password');
					$this->email->message(
						'Apakah anda lupa password? silahkan klik <a href="'.base_url().'lost_admin/reset/'.$key.'">disini</a>. jika anda tidak merasa request fitur ini silahkan abaikan pesan ini'
					);

					if($this->email->send())
					{
						$data['reset'] = $key;
						$cond['email'] = $this->input->post('email', TRUE);
						$this->m_admin->update('t_admin', $data, $cond);

						$this->session->set_flashdata('success', 'Email berhasil dikirim.. Silahkan cek email anda');
					}

					else{
						$this->session->set_flashdata('alert', 'Email gagal dikirim.. Silahkan coba kembali');
					}
				}
				else
				{
					//pesan error
					$this->session->set_flashdata('alert', 'Email yang anda masukan tidak terdaftar');
				}
			}
		}

		$this->load->view('lost_password');
	}

}

/* End of file Lost_admin.php */
/* Location: ./application/controllers/Lost_admin.php */