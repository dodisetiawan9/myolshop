<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('template', 'cart'));
		$this->load->model('m_home');
	}
	public function index()
	{
		$this->template->home('home/cart');
	}

	public function add()
	{
		if(is_numeric($this->uri->segment(3)))
		{
			$id = $this->uri->segment(3);
			$get = $this->m_home->get_where('t_items', array('id_item' => $id))->row();

			$data = array(
				'id'			=> $get->id_item,
				'name'		=> $get->nama_item,
				'price'		=> $get->harga,
				'weight'	=> $get->berat,
				'qty'			=> 1
			);

			$this->cart->insert($data);

			echo '<script type="text/javascript">window.history.go(-1)</script>';
		}	
		else{
			redirect('home');
		}


		
	}

}

/* End of file Home.php */
/* Location: ./application/controllers/Home.php */