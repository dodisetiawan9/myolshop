<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

	public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}

	public function insert($table = '', $data = '')
		{
			$this->db->insert($table, $data);
		}	

}

/* End of file m_admin.php */
/* Location: ./application/models/m_admin.php */