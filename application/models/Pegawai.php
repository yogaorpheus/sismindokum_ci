<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function salin_data_pegawai_from_ellipse($data)
	{
		$data_pegawai = array();
		$count = 0;

		foreach ($data as $key => $value) {
			$data_pegawai[$key]['nid_pegawai'] = $value->NID;
			$data_pegawai[$key]['nama_lengkap_pegawai'] = $value->NAMA_LENGKAP;
			$data_pegawai[$key]['email_pegawai'] = $value->EMAIL;
			$data_pegawai[$key]['kode_distrik_pegawai'] = $value->KODE_UNIT;
			$data_pegawai[$key]['lokasi_distrik_pegawai'] = $value->LOKASI_UNIT;
			$data_pegawai[$key]['kode_subdit_pegawai'] = $value->KODE_SUBDIT;
			$data_pegawai[$key]['subdit_pegawai'] = $value->SUBDIT;
			$data_pegawai[$key]['posisi_pegawai'] = $value->POSISI;
			$data_pegawai[$key]['posisi_unit_pegawai'] = $value->POSISI_UNIT;
			$data_pegawai[$key]['kode_posisi_ditbid_pegawai'] = $value->KODE_POSISI_DITBID;
			$data_pegawai[$key]['posisi_ditbid_pegawai'] = $value->POSISI_DITBID;
			$data_pegawai[$key]['kode_posisi_subdit_pegawai'] = $value->KODE_POSISI_SUBDIT;
			$data_pegawai[$key]['posisi_subdit_pegawai'] = $value->POSISI_SUBDIT;
			$data_pegawai[$key]['no_hp_pegawai'] = $value->TELP_HP;

			$query = $this->insert_or_update_data_pegawai($data_pegawai[$key]['nid_pegawai'], $data_pegawai[$key]);
			if ($query)
			{
				$count += 1;
			}
		}

		return $count;
	}

	private function insert_or_update_data_pegawai($nid, $data)
	{
		$this->db->where('nid_pegawai', $nid);
		$check_existence = $this->db->get('pegawai')->result_array();
		$check_existence = array_filter($check_existence);

		if (empty($check_existence))
		{
			$query = $this->db->insert('pegawai', $data);
		}
		else
		{
			$this->db->where('nid_pegawai', $nid);
			$this->db->set($data);
			$query = $this->db->update('pegawai');
		}

		return $query;
	}

	public function get_all_pegawai ($kode_distrik = null)
	{
		$this->db->select('nid_pegawai, nama_lengkap_pegawai, email_pegawai, no_hp_pegawai, posisi_pegawai, distrik.nama_distrik');
		
		if (!is_null($kode_distrik))
			$this->db->where('kode_distrik_pegawai', $kode_distrik);

		$this->db->join('distrik', 'distrik.kode_distrik = pegawai.kode_distrik_pegawai');
		$query = $this->db->get('pegawai');

		return $query->result_array();
	}

	public function get_pegawai($nid)
	{
		$this->db->where('nid_pegawai', $nid);
		$query = $this->db->get('pegawai');

		if ($query->num_rows() == 1)
			return $query->row_array();
		else
			return null;
	}

	public function get_id_posisi_subdit($kode_posisi_subdit)
	{
		$this->db->where('kode_posisi_subdit', $kode_posisi_subdit);
		$this->db->limit(1);
		$query = $this->db->get('posisi_subdit')->row_array();

		return $query;
	}

	public function import_subdit()
	{
		$query = $this->db->query("
			SELECT DISTINCT(a.`kode_posisi_subdit_pegawai`), b.`posisi_subdit_pegawai` FROM pegawai a
			INNER JOIN pegawai b ON a.`kode_posisi_subdit_pegawai` = b.`kode_posisi_subdit_pegawai`;")->result_array();

		$data_subdit = array();
		$count = 0;

		foreach ($query as $key => $value) {
			$data_subdit[$key]['kode_posisi_subdit'] = $value['kode_posisi_subdit_pegawai'];
			$data_subdit[$key]['nama_posisi_subdit'] = $value['posisi_subdit_pegawai'];

			$ins_query = $this->db->insert('posisi_subdit', $data_subdit[$key]);
			if ($ins_query)
			{
				$count += 1;
			}
		}

		return $count;
	}

	public function import_distrik()
	{
		$query = $this->db->query("
			SELECT DISTINCT(a.`kode_distrik_pegawai`), a.`lokasi_distrik_pegawai` FROM pegawai a;")->result_array();

		$data_distrik = array();
		$count = 0;

		foreach ($query as $key => $value) {
			$data_distrik[$key]['kode_distrik'] = $value['kode_distrik_pegawai'];
			$data_distrik[$key]['nama_distrik'] = $value['lokasi_distrik_pegawai'];

			$ins_query = $this->db->insert('distrik', $data_distrik[$key]);
			if ($ins_query)
			{
				$count += 1;
			}
		}

		return $count;
	}

	public function update_data_distrik()
	{
		$distrik = $this->db->get('distrik')->result_array();
		$check = true;

		foreach ($distrik as $key => $value) {
			$this->db->where('kode_distrik_pegawai', $value['kode_distrik']);
			$this->db->set(array('id_distrik_pegawai' => $value['id_distrik']));
			$check = $this->db->update('pegawai');

			if (!$check)
			{
				break;
			}
		}

		return $check;
	}

	public function get_id_pegawai_by_nid($nid)
	{
		$this->db->where('nid_pegawai', $nid);
		$id_pegawai = $this->db->get('pegawai')->row_array()['id_pegawai'];

		return $id_pegawai;
	}
}
