<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remark extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_remark_by_id_sertifikat($id)
	{
		$this->db->select('remark.*, status.nama_status, pegawai.nama_lengkap_pegawai');
		$this->db->where('tabel_data', "sertifikat");
		$this->db->where('id_data', $id);
		$this->db->join('status', 'status.id_status = remark.status_remark', 'inner');
		$this->db->join('pegawai', 'pegawai.id_pegawai = remark.dibuat_oleh', 'inner');

		$query = $this->db->get('remark');

		return $query->result_array();
	}

	public function get_remark_by_id_anggaran($id)
	{
		$this->db->select('remark.*, status.nama_status, pegawai.nama_lengkap_pegawai');
		$this->db->where('tabel_data', "anggaran");
		$this->db->where('id_data', $id);
		$this->db->join('status', 'status.id_status = remark.status_remark', 'inner');
		$this->db->join('pegawai', 'pegawai.id_pegawai = remark.dibuat_oleh', 'inner');

		$query = $this->db->get('remark');

		return $query->result_array();
	}

	public function get_all_status_remark()
	{
		$this->db->where('penggunaan_tabel_status', "remark");
		$query = $this->db->get('status');

		return $query->result_array();
	}
}
