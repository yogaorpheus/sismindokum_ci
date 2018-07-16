<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	// METHOD BERIKUT DIGUNAKAN UNTUK MENGAMBIL DATA SEMUA SERTIFIKAT TERGANTUNG PADA JENISNYA
	public function get_data_sertifikat($nama_jenis_sertif)
	{
		$this->db->where('nama_jenis_sertifikat', $nama_jenis_sertif);
		$id_jenis_sertifikat = $this->db->get('jenis_sertifikat')->row_array()['id_jenis_sertifikat'];

		$this->db->where('nama_status', 'Selesai');
		$this->db->where('penggunaan_tabel_status', 'sertifikat');
		$id_status = $this->db->get('status')->row_array()['id_status'];

		//$this->db->select('sertifikat.*, status.nama_status');
		$this->db->where('status_sertifikat !=', $id_status);
		$this->db->where('id_jenis_sertifikat', $id_jenis_sertifikat);
		$this->db->join('status', 'status.id_status = sertifikat.status_sertifikat', 'inner');
		
		if ($id_jenis_sertifikat == 1 || $id_jenis_sertifikat == 3 || $id_jenis_sertifikat == 4)
		{
			$this->db->join('sub_jenis_sertifikat', 'sub_jenis_sertifikat.id_sub_jenis_sertifikat = sertifikat.id_sub_jenis_sertifikat', 'left');
		}
		
		$query = $this->db->get('sertifikat');

		return $query->result_array();
	}

	public function tambah_data_pertanahan($data)
	{
		$query = $this->db->insert('sertifikat', $data);

		return $query;
	}

	public function tambah_data_lisensi($data)
	{
		$query = $this->db->insert('sertifikat', $data);

		return $query;
	}

	public function tambah_data_pengujian_alat_k3($data)
	{
		$query = $this->db->insert('sertifikat', $data);

		return $query;
	}

	public function tambah_data_perizinan($data)
	{
		$query = $this->db->insert('sertifikat', $data);

		return $query;
	}

	public function tambah_data_slo($data)
	{
		$query = $this->db->insert('sertifikat', $data);

		return $query;
	}

}
