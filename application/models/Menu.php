<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_id_menu2 ($nama_menu)
	{
		$this->db->where('nama_menu2', $nama_menu);
		$id_menu2 = $this->db->get('menu2')->row_array()['id_menu2'];

		return $id_menu2;
	}

	public function get_all_menu2()
	{
		$query = $this->db->get('menu2');

		return $query->result_array();
	}

	public function get_menu2_dasar_hukum()
	{
		$this->db->where('punya_dasar_hukum', 1);
		$query = $this->db->get('menu2');

		return $query->result_array();
	}

}
