<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Report extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_jumlah_sertifikat_by_kode_dasar_hukum($id_distrik, $kode_dasar_hukum, $nama_status, $not_kode_dasar_hukum = null)
	{
		$inner_query = "SELECT sertifikat.id_sertifikat, sertifikat.status_sertifikat, dasar_hukum.kode_dasar_hukum\n";
		$inner_query .= "FROM sertifikat\n";
		$inner_query .= "INNER JOIN dasar_hukum ON dasar_hukum.id_dasar_hukum = sertifikat.id_dasar_hukum_sertifikat\n";
		$inner_query .= "WHERE sertifikat.id_distrik_sertifikat = '".$id_distrik."'";
		
		$where_dasar_hukum = array();
		foreach ($kode_dasar_hukum as $key => $one_kode) {
			$where_dasar_hukum[] = "dasar_hukum.kode_dasar_hukum LIKE '%".$one_kode."%'";
		}

		if (!empty($where_dasar_hukum))
			$inner_query .= " AND (" .implode(" OR ", $where_dasar_hukum). ")";

		if (!is_null($not_kode_dasar_hukum))
			$inner_query = " AND (dasar_hukum.kode_dasar_hukum NOT LIKE '%".$not_kode_dasar_hukum."%')";

		$main_query = "SELECT COUNT(inner_table.id_sertifikat) AS jumlah_sertifikat, status.nama_status AS nama_status\n";
		$main_query .= "FROM (".$inner_query.") AS inner_table\n";
		$main_query .= "RIGHT JOIN status ON status.id_status = inner_table.status_sertifikat\n";
		$main_query .= "WHERE status.penggunaan_tabel_status = 'sertifikat'";

		$where_nama_status = array();
		foreach ($nama_status as $key => $one_nama) {
			$where_nama_status[] = "status.nama_status LIKE '".$one_nama."'";
		}

		if (!empty($where_nama_status))
			$main_query .= " AND (" .implode(" OR ", $where_nama_status). ")";

		$main_query .= "\n";
		$main_query .= "GROUP BY status.id_status\n";
		$main_query .= "ORDER BY status.id_status";

		$query = $this->db->query($main_query)->result_array();

		$new_data = array();
		foreach ($query as $key => $one_data) {
			$new_data[$one_data['nama_status']] = $one_data;
		}

		return $new_data;
	}

}
