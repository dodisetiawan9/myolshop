<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('template');
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

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */