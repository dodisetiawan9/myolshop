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
		$this->cek_login();
		$data['data']	= $this->m_admin->get_all('t_items');
		$this->template->admin('admin/manage_items', $data);
	}


	public function add_item()
	{
		$this->cek_login();
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
							$this->session->set_flashdata('alert', "Data berhasil disimpan");
							redirect('item');
					}
					else
					{
						$this->session->set_flashdata('alert', 'Anda belum memilih gambar');
					}

					
				}
		}
		$data['nama']				= $this->input->post('nama');
		$data['harga']			= $this->input->post('harga');
		$data['berat']			= $this->input->post('berat');
		$data['status']			= $this->input->post('status');
		$data['deskripsi']	= $this->input->post('deskripsi');
		$data['header'] 		= "Add New Data";
		$this->template->admin('admin/item_form', $data);
	}

	public function detail()
	{
		$this->cek_login();
		$id_item = $this->uri->segment(3);
		$item	= $this->m_admin->get_where('t_items', array('id_item' => $id_item)); 
		
		foreach ($item->result() as $key) {
			$data['id_item']		= $key->id_item;
			$data['nama_item']	= $key->nama_item;
			$data['harga']			= $key->harga;
			$data['berat']			= $key->berat;
			$data['status']			= $key->status;
			$data['gambar']			= $key->gambar;
			$data['deskripsi']	= $key->deskripsi;
		}

		$this->template->admin('admin/detail_item', $data); 
	}

	public function update_item()
	{
		$this->cek_login();
		$id_item = $this->uri->segment(3);
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
					$alert = $this->session->set_flashdata('alert', "Data Berhasil di update!");
					$config['upload_path']		= './assets/upload/';
					$config['allowed_types']	= 'jpg|png|jpeg';
					$config['max_size']				= '2048';
					$config['file_name']			= 'gambar'.time();

					$this->load->library('upload', $config);


					$items = array(
								'nama_item' => $this->input->post('nama', TRUE),
								'harga'			=> $this->input->post('harga', TRUE),
								'berat'			=> $this->input->post('berat', TRUE),
								'status'		=> $this->input->post('status', TRUE),
								'deskripsi'	=> $this->input->post('deskripsi', TRUE)
							);


					if($this->upload->do_upload('gambar'))
					{
							$gbr = $this->upload->data();
							
							//update process
							unlink('assets/upload/'.$this->input->post('old_pic', TRUE));
							$items['gambar']	= $gbr['file_name'];

							$this->m_admin->update('t_items', $items, array('id_item' => $id_item));
							$alert;
					}
					else
					{
						$this->m_admin->update('t_items', $items, array('id_item' => $id_item));
						$alert;
					}
					
				}

				redirect('item');
		}

		$item = $this->m_admin->get_where('t_items', array('id_item' => $id_item));

		foreach ($item->result() as $key) {
			$data['nama']				= $key->nama_item;
			$data['harga']			= $key->harga;
			$data['berat']			= $key->berat;
			$data['status']			= $key->status;
			$data['gambar']			= $key->gambar;
			$data['deskripsi']	= $key->deskripsi;
			$data['header'] 		= "Edit Data";
		}
			
		$this->template->admin('admin/item_form', $data);
	}


	function cek_login()
	{
		if(!$this->session->userdata('admin'))
		{
			redirect('login');
		}
	}
}

/* End of file Item.php */
/* Location: ./application/controllers/Item.php */