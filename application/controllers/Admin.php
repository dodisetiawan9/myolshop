<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('template', 'form_validation'));
		$this->load->model('m_admin');
	}
	public function index()
	{
		$this->cek_login();
		$this->template->admin('admin/home');
	}

	public function edit_profile()
	{
		$this->cek_login();

		if($this->input->post('submit', TRUE) == 'Submit')
		{
			$this->form_validation->set_rules('username', 'Username', 'required|trim|min_length[4]');
			$this->form_validation->set_rules('username', 'Username', "required|trim|min_length[4]|regex_match[/^[a-z A-Z.']+$/]");
			$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email');
			$this->form_validation->set_rules('password', 'Password', 'required');

			if($this->form_validation->run() == TRUE)
			{
				$get_data = $this->m_admin->get_where('t_admin', array('id_admin' => $this->session->userdata('admin')))->row();

				if(!password_verify($this->input->post('password', TRUE), $get_data->password))
				{
					echo '<script type="text/javascript">alert("Password yang anda masukan salah");window.location.replace("'.base_url().'login/logout")</script>';
				}

				$data = array(
					'username' => $this->input->post('username', TRUE),
					'fullname' => $this->input->post('fullname', TRUE),
					'email'		 => $this->input->post('email', TRUE),
				);

				$cond = array('id_admin' => $this->session->userdata('admin'));

				$this->m_admin->update('t_admin', $data, $cond);
			}
		}

		$get = $this->m_admin->get_where('t_admin', array('id_admin' => $this->session->userdata('admin')))->row();

		$data['username'] = $get->username;
		$data['fullname']	= $get->fullname;
		$data['email']		= $get->email;
		$this->template->admin('admin/edit_profile', $data);
	}

	function cek_login()
	{
		if(!$this->session->userdata('admin'))
		{
			redirect('login');
		}
	}

}

/* End of file Admin.php */
/* Location: ./application/controllers/Admin.php */