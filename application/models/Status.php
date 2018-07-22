<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Status extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
		$this->load->database();
	}

	public function get_all_status()
	{
		$query = $this->db->get('status');
		return $query->result_array();
	}

	public function get_status_by_nama_tabel($tabelname)
	{
		$this->db->where('penggunaan_tabel_status', $tabelname);
		$query = $this->db->get('status');

		return $query->result_array();
	}

	public function get_id_status_by_nama($nama_status)
	{
		$this->db->where('nama_status', $nama_status);
		$query = $this->db->get('status');

		$result = $query->row_array()['id_status'];
		return $result;
	}

	public function get_id_status_by_nama_status_dan_nama_tabel($nama_status, $nama_tabel)
	{
		$this->db->where('nama_status', $nama_status);
		$this->db->where('penggunaan_tabel_status', $nama_tabel);
		$query = $this->db->get('status');

		$id_status = $query->row_array()['id_status'];
		return $id_status;
	}

}
