<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasar_hukum extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_dasar_hukum_by_menu($id_menu2)
	{
		$this->db->where('id_menu2', $id_menu2);
		$query = $this->db->get('dasar_hukum')->result_array();

		$new_array = array();
		foreach ($query as $key => $value) {
			$new_array[$value['id_dasar_hukum']] = array(
				'id_dasar_hukum'			=> $value['id_dasar_hukum'],
				'kode_dasar_hukum'			=> $value['kode_dasar_hukum'],
				'keterangan_dasar_hukum'	=> $value['keterangan_dasar_hukum']
				);
		}

		return $new_array;
	}

}
