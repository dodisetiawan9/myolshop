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

}

/* End of file Checkout.php */
/* Location: ./application/controllers/Checkout.php */