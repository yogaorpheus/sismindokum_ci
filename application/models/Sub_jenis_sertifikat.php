<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sub_jenis_sertifikat extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_id_sub_jenis_sertifikat($id_jenis_sertifikat)
	{
		$this->db->select('id_sub_jenis_sertifikat');
		$this->db->where('id_jenis_sertifikat', $id_jenis_sertifikat);
		$query = $this->db->get('sub_jenis_sertifikat');

		$result = $query->row_array()['id_sub_jenis_sertifikat'];
		return $result;
	}

	public function get_sub_jenis_by_id_jenis_sertifikat($id_jenis_sertifikat)
	{
		$this->db->select('id_sub_jenis_sertifikat, nama_sub_jenis_sertifikat');
		$this->db->where('id_jenis_sertifikat', $id_jenis_sertifikat);
		$query = $this->db->get('sub_jenis_sertifikat');

		return $query->result_array();
	}

}
