<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_unit()
	{
		$query = $this->db->get('unit');

		return $query->result_array();
	}

}
