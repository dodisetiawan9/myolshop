<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Item extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('template', 'form_validation'));
		$this->load->model('m_admin');
	}

	public function index()
	{
		
	}


	public function add_item()
	{
		if($this->input->post('submit', TRUE) == "Submit")
		{
			//validation
			$this->form_validation->set_rules('nama', 		'Nama Item', 'required|min_length[4]');
			$this->form_validation->set_rules('harga', 		'Harga Item', 'required|numeric');
			$this->form_validation->set_rules('berat', 		'Berat Item', 'required|numeric');
			$this->form_validation->set_rules('status', 	'Status Item', 'required|numeric');
			$this->form_validation->set_rules('deskripsi', 	'Deskripsi Item', 'required|min_length[4]');

			if($this->form_validation->run() == TRUE)
				{
					$config['upload_path']		= './assets/upload/';
					$config['allowed_types']	= 'jpg|png|jpeg';
					$config['max_size']				= '2048';
					$config['file_name']			= 'gambar'.time();

					$this->load->library('upload', $config);

					if($this->upload->do_upload('gambar'))
					{
							$gbr = $this->upload->data();
							$items = array(
								'nama_item' => $this->input->post('nama', TRUE),
								'harga'			=> $this->input->post('harga', TRUE),
								'berat'			=> $this->input->post('berat', TRUE),
								'status'		=> $this->input->post('status', TRUE),
								'gambar'		=> $gbr['file_name'],
								'deskripsi'	=> $this->input->post('deskripsi', TRUE)
							);

							$this->m_admin->insert('t_items', $items);
					}
					else
					{
						$this->session->set_flashdata('alert', 'Anda belum memilih gambar');
					}

					
				}
		}
		$data['nama']		= $this->input->post('nama');
		$data['harga']		= $this->input->post('harga');
		$data['berat']		= $this->input->post('berat');
		$data['status']		= $this->input->post('status');
		$data['deskripsi']	= $this->input->post('deskripsi');
		$data['header'] = "Add New Data";
		$this->template->admin('admin/item_form', $data);
	}
}

/* End of file Item.php */
/* Location: ./application/controllers/Item.php */