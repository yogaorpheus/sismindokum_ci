<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
		$this->load->database();
	}

	public function get_all_anggaran()
	{
		$query = $this->db->query("
			SELECT a.`tahun_anggaran`, a.`tanggal_rups_sirkuler`, a.`no_akta_anggaran`, a.`tanggal_akta_anggaran`, a.`no_penerimaan_anggaran`, a.`jabatan_pic`, s.`nama_status`
			FROM anggaran a
			INNER JOIN new_sismindokum.`status` s ON s.`id_status` = a.`status_anggaran`;
			");

		return $query->result_array();
	}

	public function get_all_anggaran_by_status($nama_status)
	{
		$this->db->where('nama_status', $nama_status);
		$this->db->where('penggunaan_tabel_status', "anggaran");
		$id_status = $this->db->get('status')->row_array()['id_status'];

		$this->db->where('status_anggaran', $id_status);
		$this->db->join('status', 'status.id_status = anggaran.status_anggaran', 'inner');
		$query = $this->db->get('anggaran');

		return $query->result_array();
	}

	public function get_anggaran_by_id($id)
	{
		$this->db->where('id_anggaran', $id);
		$this->db->join('status', 'status.id_status = anggaran.status_anggaran', 'inner');
		$query = $this->db->get('anggaran');

		return $query->row_array();
	}

	public function get_id_anggaran_latest_by_user($id_pegawai)
	{
		$this->db->where('dibuat_oleh', $id_pegawai);
		$this->db->order_by('id_anggaran', 'DESC');
		$this->db->limit(1);
		$id_anggaran = $this->db->get('anggaran')->row_array()['id_anggaran'];

		return $id_anggaran;
	}

	public function get_jumlah_anggaran_group_by_status()
	{
		$this->db->select('status.nama_status AS label, count(1) AS value');
		$this->db->join('status', 'status.id_status = anggaran.status_anggaran', 'inner');
		$this->db->group_by('status.nama_status');
		$query = $this->db->get('anggaran');

		return $query->result_array();
	}

	public function insert_anggaran_dasar($data)
	{
		$query = $this->db->insert('anggaran', $data);

		return $query;
	}

	public function update_anggaran_dasar($data)
	{
		$this->db->where('id_anggaran', $data['id_anggaran']);
		$this->db->set($data);
		$query = $this->db->update('anggaran');

		return $query;
	}

	public function delete_anggaran_by_id($id)
	{
		$this->db->where('nama_status', "Tidak Aktif");
		$this->db->where('penggunaan_tabel_status', "anggaran");
		$id_status_dihapus = $this->db->get('status')->row_array()['id_status'];

		$data = array(
			'status_anggaran'	=> $id_status_dihapus
			);
		$this->db->where('id_anggaran', $id);
		$this->db->set($data);
		$query = $this->db->update('anggaran');

		return $query;
	}
}
