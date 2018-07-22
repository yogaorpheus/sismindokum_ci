<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_sertifikat extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function buka_sertifikat($kode = 0)
	{
		$query = $this->db->get('jenis_sertifikat');
		return $query->result_array();
	}

	public function get_id_jenis_sertifikat($nama_jenis_sertifikat)
	{
		$this->db->where('nama_jenis_sertifikat', $nama_jenis_sertifikat);
		$id_jenis_sertifikat = $this->db->get('jenis_sertifikat')->row_array()['id_jenis_sertifikat'];

		return $id_jenis_sertifikat;
	}

	public function get_nama_jenis_sertifikat_by_id_sertifikat($id)
	{
		$this->db->select('jenis_sertifikat.nama_jenis_sertifikat');
		$this->db->where('id_sertifikat', $id);
		$this->db->join('jenis_sertifikat', 'jenis_sertifikat.id_jenis_sertifikat = sertifikat.id_jenis_sertifikat', 'inner');
		$buff = $this->db->get('sertifikat');

		$nama_jenis_sertifikat = $buff->row_array()['nama_jenis_sertifikat'];
		return $nama_jenis_sertifikat;
	}

	public function get_all_jenis_sertifikat()
	{
		$query = $this->db->get('jenis_sertifikat');

		return $query->result_array();
	}

}
