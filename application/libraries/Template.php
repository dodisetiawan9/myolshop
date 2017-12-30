<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template
{
	protected $ci;

	public function __construct()
	{
        $this->ci =& get_instance();
	}

	public function admin($template, $data='')
	{
		$data['content'] 	= $this->ci->load->view($template, $data, TRUE);
		$data['nav']	 		= $this->ci->load->view('admin/nav', $data, TRUE);

		$this->ci->load->view('admin/dashboard', $data);
	}
}

/* End of file Template.php */
/* Location: ./application/libraries/Template.php */
