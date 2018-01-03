<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Checkout extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library(array('template', 'cart', 'form_validation'));
		$this->load->model('m_home');
	}

	public function index()
	{
		if(!$this->session->userdata('user_login') || !$this->cart->contents())
		{
			redirect('home');
		}

		if($this->input->post('submit', TRUE) == 'Submit')
		{
			$this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
			$this->form_validation->set_rules('kota', 'Kota / Kabupaten', 'required');
			$this->form_validation->set_rules('alamat', 'Alamat', 'required|min_length[10]');
			$this->form_validation->set_rules('kd_pos', 'Kode Pos', 'required|numeric|min_length[5]');
			$this->form_validation->set_rules('kurir', 'Kurir', 'required');
			$this->form_validation->set_rules('layanan', 'Layanan', 'required');
			$this->form_validation->set_rules('ongkir', 'Ongkir', 'required|numeric');
			$this->form_validation->set_rules('total', 'Total', 'required|numeric');

			if($this->form_validation->run() == TRUE)
			{
				$get = $this->m_home->get_where('t_users', ['id_user' => $this->session->userdata('user_id')]);

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

					$user 		= $get->row();
					$id_order = time(); 
					$prov 		= $this->input->post('provinsi', TRUE);
					$kota 		= explode(',',$this->input->post('kota', TRUE));
					$alamat 	= $this->input->post('alamat', TRUE);
					$kd_pos 	= $this->input->post('kd_pos', TRUE);
					$kurir 		= $this->input->post('kurir', TRUE);
					$layanan 	= explode(',',$this->input->post('layanan', TRUE));
					$ongkir 	= $this->input->post('ongkir', TRUE);
					$total 		= $this->input->post('total', TRUE);
					$tgl_pesan= date("Y-m-d");
					$bts			= date("Y-m-d", mktime(0,0,0, date("m"), date("d") + 3, date("Y")));

					$table = '';
					$no = 1;

					foreach ($this->cart->contents() as $carts) {
						$table .=
						'<tr><td>'.$no++.'</td><td>'.$carts['name'].'</td><td>'.$carts['qty'].'</td><td style="text-align:right">'.number_format($carts['subtotal'], 0, ',','.').'</td></tr>';
					}

					$tbl_start 	= '<table border="" style="border: 1px solid blue; width:100%">';
					$tbl_end	 	= '</table>';
					$tbl_header	= '<tr style="background: #ccc">
														<th>#</th>
														<th>Nama Barang</th>
														<th>Jumlah</th>
														<th>Harga</th>
												 </tr>';

					$this->email->from('setiawan.youngin@gmail.com', "Myolshop");
					$this->email->to($user->email); 
					$this->email->subject('Pembayaran Order');
					$this->email->message(
						'Terima kasih telah melakukan pemesanan ditoko kami, selanjutnya silahkan melakukan pembayaran melalui transfer bank, senilai <b>Rp. '.number_format($total, 0, ',','.').',-</b> ke no. rekening <b>98xxxxxxx</b> paling lambat '.$bts.' agar pesanan anda bisa segera kami proses. <br/>
						 Detail Pesanan : <br/>
							'.$tbl_start.'
								'.$tbl_header.'
								'.$table.'
							

						<tr>
							<td colspan="3">Ongkos Kirim</td>
							<td style="text-align:right">'.number_format($ongkir, 0, ',','.').'</td>
						</tr>	

						<tr>
							<td colspan="3">Total</td>
							<td style="text-align:right">'.number_format($total, 0, ',','.').'</td>
						</tr>'.$tbl_end.''
					);

					if($this->email->send())
					{
							$data = array(
								'id_order'	=> $id_order,
								'id_user'		=> $user->id_user,
								'total'			=> $total,
								'tujuan'		=> $alamat,
								'pos'				=> $kd_pos,
								'kota'			=> $kota[1],
								'kurir'			=> $kurir,
								'service'		=> $layanan[1],
								'tgl_pesan'	=> $tgl_pesan,
								'bts_bayar'	=> $bts,
								'status'		=> 'belum'

							);

							if($this->m_home->insert('t_order', $data))
							{
								foreach ($this->cart->contents() as $key) {
									
								$detail = array(
									'id_order'	=> $id_order,
									'id_item'		=> $key['id'],
									'qty'				=> $key['qty'],
									'biaya'			=> $key['subtotal']
								);

								$this->m_home->insert('t_detail_order', $detail);

								$this->cart->destroy();

								echo '<script>alert("Silahkan cek email anda untuk detail pembayaran");window.location.replace("'.base_url().'")</script>';
								}
							}
					}

					else{
						echo '<script>alert("Email gagal dikirim");</script>';
					}
				}
				else
				{
					//pesan error
					echo '<script>alert("User tidak dikenal");</script>';
				}
			}
		}

		$this->template->home('checkout');
	}
	public function city()
	{
			$prov = $this->input->post('prov', TRUE);
			$curl = curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://api.rajaongkir.com/starter/city?province=$prov",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "key: 4998fe8cb8cd1eca09381884feac369c"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);

			curl_close($curl);

			if ($err) {
			  echo "cURL Error #:" . $err;
			} 
			else {
			  $data = json_decode($response, TRUE);

			  echo '<option value="" selected disabled>Kota / Kabupaten</option>';
			  for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {
			    echo '<option value="'.$data['rajaongkir']['results'][$i]['city_id'].','.$data['rajaongkir']['results'][$i]['city_name'].'">'.$data['rajaongkir']['results'][$i]['city_name'].'</option>';
			  }
			}
	}

	public function getcost()
	{
		$asal = 22;
		$dest = $this->input->post('dest', TRUE);
		$kurir = $this->input->post('kurir', TRUE);
		$berat = 0;

		foreach ($this->cart->contents() as $key) {
			$berat += ($key['weight'] * $key['qty']); 
		}

		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_URL => "https://api.rajaongkir.com/starter/cost",
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 30,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "POST",
		  CURLOPT_POSTFIELDS => "origin=$asal&destination=$dest&weight=$berat&courier=$kurir",
		  CURLOPT_HTTPHEADER => array(
		    "content-type: application/x-www-form-urlencoded",
		    "key: 4998fe8cb8cd1eca09381884feac369c"
		  ),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
		  echo "cURL Error #:" . $err;
		} else {
		  $data = json_decode($response, TRUE);

		  echo '<option value="" disabled selected>Layanan yang tersedia</option>';

		  for ($i = 0; $i < count($data['rajaongkir']['results']); $i++) {

		  	for ($l = 0; $l < count($data['rajaongkir']['results'][$i]['costs']); $l++) {

		  		echo '<option 
		  			value="'.$data['rajaongkir']['results'][$i]['costs'][$l]['cost'][0]['value'].','.$data['rajaongkir']['results'][$i]['costs'][$l]['service'].'('.$data['rajaongkir']['results'][$i]['costs'][$l]['description'].')">';

		  		echo $data['rajaongkir']['results'][$i]['costs'][$l]['service'].'('.$data['rajaongkir']['results'][$i]['costs'][$l]['description'].')</option>';
		  	}
		  }
		}
	}

	public function cost()
	{
		$biaya = explode(',',$this->input->post('layanan', TRUE));
		$total = $this->cart->total() + $biaya[0];

		echo $biaya[0].','.$total;
	}

}

/* End of file Checkout.php */
/* Location: ./application/controllers/Checkout.php */