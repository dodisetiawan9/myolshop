<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_home extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

	public function insert($table = '', $data = '')
	{
		return $this->db->insert($table, $data);
	}	

	public function get_all($table)
	{
		$this->db->from($table);

		return $this->db->get();
	}

	public function get_where($table = null, $where = null)
	{
		$this->db->from($table);
		$this->db->where($where);

		return $this->db->get();
	}

	public function update($table = null, $data = null, $where = null)
	{
		return $this->db->update($table, $data, $where);
	}
}

/* End of file m_admin.php */
/* Location: ./application/models/m_admin.php */