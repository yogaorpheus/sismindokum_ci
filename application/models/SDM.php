<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class SDM extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_data_sdm($kode_distrik, $nama_status = null)
	{
		if (!is_null($nama_status))
		{
			$this->db->where('nama_status', $nama_status);
			$this->db->where('penggunaan_tabel_status', "sertifikat");
			$id_status = $this->db->get('status')->row_array()['id_status'];	
		}

		if ($kode_distrik != 'ALL')
		{
			$this->db->where('kode_distrik', $kode_distrik);
			$id_distrik = $this->db->get('distrik')->row_array()['id_distrik'];
		}

		$this->db->select('sdm.*, distrik.nama_distrik, pegawai.nama_lengkap_pegawai, status.nama_status, lembaga.nama_lembaga');
		if (isset($id_status))
		{
			$this->db->where('sdm.status_sdm', $id_status);
		}

		if (isset($id_distrik))
		{
			$this->db->where('sdm.id_distrik', $id_distrik);
		}

		$this->db->join('distrik', 'distrik.id_distrik = sdm.id_distrik', 'left');
		$this->db->join('pegawai', 'pegawai.id_pegawai = sdm.id_pegawai', 'left');
		$this->db->join('lembaga', 'lembaga.id_lembaga = sdm.id_lembaga', 'left');
		$this->db->join('status', 'status.id_status = sdm.status_sdm', 'inner');

		$query = $this->db->get('sdm');

		return $query->result_array();
	}

	public function get_data_sdm($id_sdm)
	{
		$this->db->where('id_sdm', $id_sdm);
		$query = $this->db->get('sdm');

		return $query->row_array();
	}

	public function update_lembaga_sdm($data)
	{
		$this->db->where('id_pegawai', $data['id_pegawai']);
		$this->db->where('kode_sertifikasi', $data['kode_sertifikasi']);
		$this->db->set($data);
		$query = $this->db->update('sdm');

		return $query;
	}

	public function get_old_data_lembaga_sdm()
	{
		$query = $this->db->query(
			"SELECT sdm_old.`nid`, sdm_old.`nama_lengkap`, sdm_old.`kode_sertifikasi`, sdm_old.`nama_lembaga`, lembaga.`id_lembaga`
			FROM sdm_old
			LEFT JOIN lembaga ON lembaga.`nama_lembaga` = sdm_old.`nama_lembaga`
			WHERE sdm_old.`nama_lembaga` IS NOT NULL;"
			);

		return $query->result_array();
	}
}
