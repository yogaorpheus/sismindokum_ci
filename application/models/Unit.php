<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_unit($nama_status = null)
	{
		if (is_null($nama_status))
		{
			$nama_status = "Aktif";
		}
		$this->db->where('nama_status', $nama_status);
		$this->db->where('penggunaan_tabel_status', "unit");
		$id_status = $this->db->get('status')->row_array()['id_status'];

		$this->db->where('status_unit', $id_status);
		$query = $this->db->get('unit');

		return $query->result_array();
	}

	public function get_all_unit_by_kode_distrik($kode_distrik, $nama_status = null)
	{
		if (is_null($nama_status))
		{
			$nama_status = "Aktif";
		}
		$this->db->where('nama_status', $nama_status);
		$this->db->where('penggunaan_tabel_status', "unit");
		$id_status = $this->db->get('status')->row_array()['id_status'];

		if ($kode_distrik != 'Z')
		{
			$this->db->where('kode_distrik', $kode_distrik);
			$id_distrik = $this->db->get('distrik')->row_array()['id_distrik'];
		}

		if (isset($id_distrik))
			$this->db->where('id_distrik_unit', $id_distrik);

		$this->db->where('status_unit', $id_status);
		$query = $this->db->get('unit');

		return $query->result_array();
	}

	public function get_all_detailed_unit ($id_distrik = null, $nama_status = null)
	{
		if (is_null($nama_status))
		{
			$nama_status = "Aktif";
		}
		$this->db->where('nama_status', $nama_status);
		$this->db->where('penggunaan_tabel_status', "unit");
		$id_status = $this->db->get('status')->row_array()['id_status'];

		$this->db->select('unit.*, distrik.nama_distrik, pegawai.nama_lengkap_pegawai');
		if (!is_null($id_distrik))
		{
			$this->db->where('id_distrik_unit', $id_distrik);
		}
		$this->db->where('status_unit', $id_status);
		$this->db->join('distrik', 'distrik.id_distrik = unit.id_distrik_unit', 'inner');
		$this->db->join('pegawai', 'pegawai.id_pegawai = unit.dibuat_oleh', 'inner');
		$query = $this->db->get('unit');

		return $query->result_array();
	}

	public function get_unit_by_id_unit ($id_unit)
	{
		$this->db->where('id_unit', $id_unit);
		$query = $this->db->get('unit');

		return $query->row_array();
	}

	public function get_unit_detailed_by_id_unit($id_unit)
	{
		$this->db->select('unit.*, distrik.nama_distrik, pegawai.nama_lengkap_pegawai');
		$this->db->where('id_unit', $id_unit);
		$this->db->join('distrik', 'distrik.id_distrik = unit.id_distrik_unit', 'inner');
		$this->db->join('pegawai', 'pegawai.id_pegawai = unit.dibuat_oleh', 'inner');
		$query = $this->db->get('unit');

		return $query->row_array();
	}

	public function get_id_unit_terbaru_by_pembuat($id_pegawai)
	{
		$this->db->where('dibuat_oleh', $id_pegawai);
		$this->db->order_by('id_unit', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('unit');

		$id_unit = $query->row_array()['id_unit'];
		return $id_unit;
	}

	public function insert_new_unit($data)
	{
		$this->db->where('nama_status', "Aktif");
		$this->db->where('penggunaan_tabel_status', "unit");
		$id_status = $this->db->get('status')->row_array()['id_status'];

		$data['status_unit'] = $id_status;
		$query = $this->db->insert('unit', $data);

		return $query;
	}

	public function update_unit($data)
	{
		$this->db->where('id_unit', $data['id_unit']);
		$this->db->set($data);
		$query = $this->db->update('unit');

		return $query;
	}

	public function delete_unit($id_unit)
	{
		$this->db->where('nama_status', "Dihapus");
		$this->db->where('penggunaan_tabel_status', "unit");
		$id_status_dihapus = $this->db->get('status')->row_array()['id_status'];

		$data = array(
			'status_unit'	=> $id_status_dihapus
			);
		$this->db->where('id_unit',$id_unit);
		$this->db->set($data);
		$query = $this->db->update('unit');

		return $query;
	}

}
