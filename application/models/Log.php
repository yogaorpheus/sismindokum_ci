<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function write_log($data)
	{
		$query = $this->db->insert('log', $data);

		if ($query)
		{
			$id_log = $this->db->query("SELECT log.id_log FROM log WHERE log.id_pegawai = ".$data['id_pegawai']."
				ORDER BY id_log DESC LIMIT 1;
				")->row_array();

			return $id_log['id_log'];
		}

		return null;
	}

	public function delete_log_by_id ($id)
	{
		$this->db->where('id_log', $id);
		$query = $this->db->delete('log');

		return $query;
	}

}
