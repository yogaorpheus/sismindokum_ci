<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jenis_sertifikat extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
		$this->load->database();
	}

	public function buka_sertifikat($kode = 0)
	{
		$query = $this->db->get('jenis_sertifikat');
		return $query->result_array();
	}

}
