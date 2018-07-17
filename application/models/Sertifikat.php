<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	// METHOD BERIKUT DIGUNAKAN UNTUK MENGAMBIL DATA SEMUA SERTIFIKAT TERGANTUNG PADA JENISNYA
	public function get_data_sertifikat($nama_jenis_sertif, $kode_distrik)
	{
		$this->db->where('nama_jenis_sertifikat', $nama_jenis_sertif);
		$id_jenis_sertifikat = $this->db->get('jenis_sertifikat')->row_array()['id_jenis_sertifikat'];

		$this->db->where('nama_status', 'Selesai');
		$this->db->where('penggunaan_tabel_status', 'sertifikat');
		$id_status = $this->db->get('status')->row_array()['id_status'];

		$this->db->where('kode_distrik', $kode_distrik);
		$id_distrik = $this->db->get('distrik')->row_array()['id_distrik'];

		//$this->db->select('sertifikat.*, status.nama_status');
		$this->db->where('status_sertifikat !=', $id_status);
		$this->db->where('sertifikat.id_jenis_sertifikat', $id_jenis_sertifikat);
		$this->db->join('status', 'status.id_status = sertifikat.status_sertifikat', 'inner');
		
		if ($id_jenis_sertifikat == 1 || $id_jenis_sertifikat == 3 || $id_jenis_sertifikat == 4)
		{
			$this->db->join('sub_jenis_sertifikat', 'sub_jenis_sertifikat.id_sub_jenis_sertifikat = sertifikat.id_sub_jenis_sertifikat', 'left');
		}
		else if ($id_jenis_sertifikat == 2)
		{
			$this->db->join('unit', 'unit.id_unit = sertifikat.id_unit_sertifikat', 'left');
		}

		if ($kode_distrik != 'Z')
		{
			$this->db->where('sertifikat.id_distrik_sertifikat', $id_distrik);
		}

		$this->db->join('distrik', 'distrik.id_distrik = sertifikat.id_distrik_sertifikat', 'inner');
		$query = $this->db->get('sertifikat');

		return $query->result_array();
	}

	public function get_sertifikat_by_id($id, $nama_jenis_sertif)
	{
		$this->db->where('nama_jenis_sertifikat', $nama_jenis_sertif);
		$id_jenis_sertifikat = $this->db->get('jenis_sertifikat')->row_array()['id_jenis_sertifikat'];

		$this->db->where('nama_status', 'Selesai');
		$this->db->where('penggunaan_tabel_status', 'sertifikat');
		$id_status = $this->db->get('status')->row_array()['id_status'];

		$this->db->where('id_sertifikat', $id);
		$this->db->where('id_jenis_sertifikat', $id_jenis_sertifikat);
		$this->db->where('status_sertifikat !=', $id_status);
		$this->db->join('status', 'status.id_status = sertifikat.status_sertifikat', 'inner');
		$query = $this->db->get('sertifikat');

		return $query->row_array();
	}

	public function get_all_sertifikat_lama($nama_sertifikat)
	{
		$this->db->where('nama_jenis_sertifikat', $nama_sertifikat);
		$id_jenis_sertifikat = $this->db->get('jenis_sertifikat')->row_array()['id_jenis_sertifikat'];

		$this->db->where('nama_status', 'Selesai');
		$this->db->where('penggunaan_tabel_status', 'sertifikat');
		$id_status = $this->db->get('status')->row_array()['id_status'];

		$this->db->where('id_jenis_sertifikat', $id_jenis_sertifikat);
		$this->db->where('status_sertifikat', $id_status);
		$query = $this->db->get('sertifikat');

		return $query->result_array();
	}

	public function delete_sertifikat_by_id($id_sertif, $id_jenis_sertif)
	{
		$this->db->where('id_sertifikat', $id_sertif);
		$this->db->where('id_jenis_sertifikat', $id_jenis_sertif);
		$query = $this->db->delete('sertifikat');

		return $query;
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
