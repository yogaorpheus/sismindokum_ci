<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
		$this->load->database();
	}

	public function get_data_sertifikat($nama_jenis_sertif)
	{
		$this->db->where('nama_jenis_sertifikat', $nama_jenis_sertif);
		$id_jenis_sertifikat = $this->db->get('jenis_sertifikat')->row_array()['id_jenis_sertifikat'];

		$this->db->where('nama_status', 'Selesai');
		$this->db->where('penggunaan_tabel_status', 'sertifikat');
		$id_status = $this->db->get('status')->row_array()['id_status'];

		$this->db->select('sertifikat.*, status.nama_status');
		$this->db->where('status_sertifikat !=', $id_status);
		$this->db->where('id_jenis_sertifikat', $id_jenis_sertifikat);
		$this->db->join('status', 'status.id_status = sertifikat.status_sertifikat', 'inner');
		$query = $this->db->get('sertifikat');

		return $query->result_array();
	}

}
