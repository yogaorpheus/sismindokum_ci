<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remainder extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_remainder()
	{
		$query = $this->db->get('remainder');

		return $query->result_array();
	}

	public function get_durasi_remainder_by_id ($id_remainder)
	{
		$this->db->where('id_remainder', $id_remainder);
		$query = $this->db->get('remainder');

		$durasi_remainder = $query->row_array()['durasi_remainder'];
		return $durasi_remainder;
	}

}
