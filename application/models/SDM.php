<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sdm extends CI_Model {

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
			$this->db->where('penggunaan_tabel_status', "sdm");
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
		$this->db->where_in('LEFT(kode_sertifikasi, 2)', array('C1', 'C2', 'C3'));

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

	public function get_jumlah_sdm_group_by_status($kode_distrik_pegawai)
	{
		$this->db->where('kode_distrik', $kode_distrik_pegawai);
		$id_distrik = $this->db->get('distrik')->row_array()['id_distrik'];

		$main_query = "";
		$main_query .= "SELECT COUNT(s.id_sdm) AS y, status.nama_status AS name\n";
		
		$inner_query = "SELECT id_sdm, status_sdm\n";
		$inner_query .= "FROM sdm";
		if ($kode_distrik_pegawai != 'ALL')
			$inner_query .= " WHERE id_distrik = ".$id_distrik;

		$main_query .= "FROM (".$inner_query.")s\n";
		$main_query .= "RIGHT JOIN status ON s.status_sdm = status.id_status\n";
		$main_query .= "WHERE status.penggunaan_tabel_status = 'sdm'\n";
		$main_query .= "GROUP BY status.id_status\n";
		$main_query .= "ORDER BY status.id_status";

		$query = $this->db->query($main_query);

		return $query->result_array();
	}

	public function get_jumlah_data_sdm($kode_distrik_pegawai)
	{
		$this->db->where('kode_distrik', $kode_distrik_pegawai);
		$id_distrik = $this->db->get('distrik')->row_array()['id_distrik'];

		$main_query = "";
		$main_query .= "SELECT COUNT(1) as jumlah\n";
		$main_query .= "FROM sdm";
		
		if ($kode_distrik_pegawai != "ALL")
			$main_query .= " WHERE id_distrik = ".$id_distrik;

		$query = $this->db->query($main_query);

		return $query->row_array()['jumlah'];
	}
}
