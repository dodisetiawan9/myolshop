<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function index()
	{
		//echo password_hash('admin', PASSWORD_DEFAULT, ['cost' => 10]);
		if($this->input->post('submit') == 'Submit')
		{
			$username = $this->input->post('username', TRUE);
			$password = $this->input->post('password', TRUE);

			$cek = $this->m_admin->get_where('t_admin', array('username' => $username));

			if ($cek->num_rows() > 0) {
				$data = $cek->row();

				if (password_verify($password, $data->password)) 
				{
					$datauser = array(
						'user'	=> $data->fullname,
						'level' => $data->level,
						'login'	=> TRUE
					);

					$this->session->set_userdata($datauser);
					redirect('admin');
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
				
		if($this->session->userdata('login') == TRUE)
		{
			redirect('admin');
		}
		$this->load->view('admin/login_form');
	}

	public function logout()
	{
		$this->session->sess_destroy();
		redirect('login');
	}
}

/* End of file Login.php */
/* Location: ./application/controllers/Login.php */