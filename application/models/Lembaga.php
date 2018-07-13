<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembaga extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_lembaga()
	{
		$query = $this->db->get('lembaga');
		return $query->result_array();
	}

	public function get_lembaga_by_id_status($id)
	{
		$this->db->where('status_lembaga', $id);
		$query = $this->db->get('lembaga');

		return $query->result_array();
	}

}
