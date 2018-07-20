<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Distrik extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_distrik()
	{
		$query = $this->db->get('distrik');
		return $query->result_array();
	}

	public function get_distrik_by_kode_distrik($kode_distrik)
	{
		$this->db->where('kode_distrik', $kode_distrik);
		$query = $this->db->get('distrik');

		return $query->result_array();
	}

	public function get_distrik_by_id_distrik($id)
	{
		$this->db->where('id_distrik', $id);
		$query = $this->db->get('distrik');

		return $query->result_array();
	}

	public function get_id_distrik_by_kode ($kode)
	{
		$this->db->where('kode_distrik', $kode);
		$query = $this->db->get('distrik');

		$id_distrik = $query->row_array()['id_distrik'];
		return $id_distrik;
	}

}
