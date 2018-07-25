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

	public function get_all_dasar_hukum()
	{
		$this->db->select('dasar_hukum.*, menu2.nama_menu2, pegawai.nama_lengkap_pegawai');
		$this->db->join('menu2', 'menu2.id_menu2 = dasar_hukum.id_menu2', 'inner');
		$this->db->join('pegawai', 'pegawai.id_pegawai = dasar_hukum.dibuat_oleh', 'inner');
		$query = $this->db->get('dasar_hukum');

		return $query->result_array();
	}

	public function get_all_dasar_hukum_group_by_sertifikat()
	{
		$this->db->order_by('dasar_hukum.id_menu2', 'ASC');
		$query = $this->db->get('dasar_hukum')->result_array();
		
		$newdata = array();
		$distinction = 0;

		foreach ($query as $key => $one_data) {
			if ($distinction != $one_data['id_menu2'])
			{
				$distinction = $one_data['id_menu2'];
				$newdata[$distinction] = array();
				$inner_count = 0;
			}

			$newdata[$distinction][$inner_count] = $one_data;
			$inner_count += 1;
		}

		return $newdata;
	}

	public function get_dasar_hukum_by_id($id_dasar_hukum)
	{
		$this->db->where('id_dasar_hukum', $id_dasar_hukum);
		$query = $this->db->get('dasar_hukum');

		return $query->row_array();
	}

	public function get_latest_id_dasar_hukum_by_pembuat($id_pegawai)
	{
		$this->db->where('dibuat_oleh', $id_pegawai);
		$this->db->order_by('id_dasar_hukum', 'DESC');
		$this->db->limit(1);
		$result = $this->db->get('dasar_hukum');

		return $result->row_array()['id_dasar_hukum'];
	}

	public function insert_dasar_hukum($data)
	{
		$query = $this->db->insert('dasar_hukum', $data);

		return $query;
	}

	public function update_dasar_hukum($data)
	{
		$this->db->where('id_dasar_hukum', $data['id_dasar_hukum']);
		$this->db->set($data);
		$query = $this->db->update('dasar_hukum');

		return $query;
	}

	public function delete_dasar_hukum($id_dasar_hukum)
	{
		$this->db->where('id_dasar_hukum', $id_dasar_hukum);
		$query = $this->db->delete('dasar_hukum');

		return $query;
	}

}
