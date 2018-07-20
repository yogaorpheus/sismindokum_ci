<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lembaga extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_lembaga()
	{
		$query = $this->db->get('lembaga');
		return $query->result_array();
	}

	public function get_all_detailed_lembaga()
	{
		$this->db->select('lembaga.*, pegawai.nama_lengkap_pegawai');
		$this->db->join('pegawai', 'pegawai.id_pegawai = lembaga.dibuat_oleh', 'inner');
		$query = $this->db->get('lembaga');
		return $query->result_array();
	}

	public function get_lembaga_by_id_status($id)
	{
		$this->db->where('status_lembaga', $id);
		$query = $this->db->get('lembaga');

		return $query->result_array();
	}

	public function get_lembaga_by_id_lembaga($id_lembaga)
	{
		$this->db->where('id_lembaga', $id_lembaga);
		$query = $this->db->get('lembaga');

		return $query->row_array();
	}

	public function get_id_lembaga_terbaru_by_pembuat($id_pegawai)
	{
		$this->db->where('dibuat_oleh', $id_pegawai);
		$this->db->order_by('id_lembaga', 'DESC');
		$this->db->limit(1);
		$query = $this->db->get('lembaga');

		$id_lembaga = $query->row_array()['id_lembaga'];
		return $id_lembaga;
	}

	public function insert_new_lembaga($data)
	{
		$query = $this->db->insert('lembaga', $data);

		return $query;
	}

	public function update_lembaga($data)
	{
		$this->db->where('id_lembaga', $data['id_lembaga']);
		$this->db->set($data);
		$query = $this->db->update('lembaga');

		return $query;
	}

	public function delete_lembaga($id_lembaga)
	{
		$this->db->where('id_lembaga', $id_lembaga);
		$query = $this->db->delete('lembaga');

		return $query;
	}

}
