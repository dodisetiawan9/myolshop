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