<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hak_akses extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	public function get_all_menu_hak_akses()
	{
		$query = $this->db->get('hak_akses_menu')->result_array();

		return $query;
	}

	public function get_hak_akses_pegawai($kode_posisi_subdit, $kode_distrik)
	{
		$query = $this->db->query("
			SELECT menu.id_menu1, menu.id_menu2, menu.id_menu_crud
			FROM hak_akses_menu pengakses
			INNER JOIN menu_tampil menu ON menu.id_menu_tampil = pengakses.id_menu_tampil
			WHERE pengakses.id_posisi_subdit = ".$kode_posisi_subdit." AND pengakses.id_distrik = ".$kode_distrik
			);

		if (empty($query) || is_null($query))
		{
			return null;
		}

		return $query->result_array();
	}

	public function tambah_hak_akses($data)
	{
		if ($data['id_menu2'] == 0) {
			$data['id_menu2'] = null;
		}
		
		if ($data['id_menu_crud'] == 0) {
			$data['id_menu_crud'] = null;
		}
		
		$newdata = array(
			'id_menu1'			=> $data['id_menu1'],
			'id_posisi_subdit'	=> $data['id_posisi_subdit'],
			'id_distrik'		=> $data['id_distrik']
			);

		if (is_array($data['id_menu2']) && !is_array($data['id_menu_crud']))
		{
			foreach ($data['id_menu2'] as $key => $value) {
				$newdata['id_menu2'] = $key;
				$newdata['id_menu_crud'] = $data['id_menu_crud'];
				
				$check_existence = $this->db->query("
					SELECT * FROM menu_tampil WHERE id_menu1 = ".$newdata['id_menu1']." AND id_menu2 = ".$newdata['id_menu2']." AND id_menu_crud = ".$newdata['id_menu_crud']
					)->row_array();

				if (empty($check_existence))
				{
					$alert = 3;
					return $alert;
				}

				$insertdata = array(
					'id_menu_tampil'	=> $check_existence['id_menu_tampil'],
					'id_posisi_subdit'	=> $newdata['id_posisi_subdit'],
					'id_distrik'		=> $newdata['id_distrik']
					);

				$query = $this->db->insert('hak_akses_menu', $insertdata);
			}
		}
		else if (!is_array($data['id_menu2']) && is_array($data['id_menu_crud']))
		{
			foreach ($data['id_menu_crud'] as $key => $value) {
				$newdata['id_menu2'] = $data['id_menu2'];
				$newdata['id_menu_crud'] = $key;
				
				$check_existence = $this->db->query("
					SELECT * FROM menu_tampil WHERE id_menu1 = ".$newdata['id_menu1']." AND id_menu2 = ".$newdata['id_menu2']." AND id_menu_crud = ".$newdata['id_menu_crud']
					)->row_array();

				if (empty($check_existence))
				{
					$alert = 3;
					return $alert;
				}

				$insertdata = array(
					'id_menu_tampil'	=> $check_existence['id_menu_tampil'],
					'id_posisi_subdit'	=> $newdata['id_posisi_subdit'],
					'id_distrik'		=> $newdata['id_distrik']
					);

				$query = $this->db->insert('hak_akses_menu', $insertdata);
			}
		}
		else if (is_array($data['id_menu2']) && is_array($data['id_menu_crud']))
		{
			foreach ($data['id_menu2'] as $key1 => $outer_value) {
				
				foreach ($data['id_menu_crud'] as $key2 => $inner_value) {
					$newdata['id_menu2'] = $key1;
					$newdata['id_menu_crud'] = $key2;

					$check_existence = $this->db->query("
						SELECT * FROM menu_tampil WHERE id_menu1 = ".$newdata['id_menu1']." AND id_menu2 = ".$newdata['id_menu2']." AND id_menu_crud = ".$newdata['id_menu_crud']
						)->row_array();

					if (empty($check_existence))
					{
						$alert = 3;
						return $alert;
					}

					$insertdata = array(
						'id_menu_tampil'	=> $check_existence['id_menu_tampil'],
						'id_posisi_subdit'	=> $newdata['id_posisi_subdit'],
						'id_distrik'		=> $newdata['id_distrik']
						);

					$query = $this->db->insert('hak_akses_menu', $insertdata);
				}
			}
		}
		else {
			$check_existence = $this->db->query("
				SELECT * FROM menu_tampil WHERE id_menu1 = ".$data['id_menu1']." AND id_menu2 = ".$data['id_menu2']." AND id_menu_crud = ".$data['id_menu_crud']
				)->row_array();

			if (empty($check_existence))
			{
				$alert = 3;
				return $alert;
			}

			$insertdata = array(
				'id_menu_tampil'	=> $check_existence['id_menu_tampil'],
				'id_posisi_subdit'	=> $newdata['id_posisi_subdit'],
				'id_distrik'		=> $newdata['id_distrik']
				);

			$query = $this->db->insert('hak_akses_menu', $insertdata);
		}

		if ($query)
		{
			$alert = 1;		// Berhasil menambah hak akses
		}
		else
		{
			$alert = 2;		// Gagal menambah hak akses
		}

		return $alert;
	}

	public function tambah_akses_menu($data)
	{
		if ($data['id_menu2'] == 0) {
			$data['id_menu2'] = null;
		}
		
		if ($data['id_menu_crud'] == 0) {
			$data['id_menu_crud'] = null;
		}
		
		$newdata = array(
			'id_menu1'			=> $data['id_menu1']
			);

		if (is_array($data['id_menu2']) && !is_array($data['id_menu_crud']))
		{
			foreach ($data['id_menu2'] as $key => $value) {
				$newdata['id_menu2'] = $value['id_menu2'];
				$newdata['id_menu_crud'] = $data['id_menu_crud'];

				$test_query = $this->db->query("
					SELECT * FROM menu_tampil WHERE id_menu1 = ".$newdata['id_menu1']." AND id_menu2 = ".$newdata['id_menu2']." AND id_menu_crud = ".$newdata['id_menu_crud']
					);

				if ($test_query->num_rows() >= 1) 
				{
					$alert = 3;
					return $alert;
				}
				
				$query = $this->db->insert('menu_tampil', $newdata);
			}
		}
		else if (!is_array($data['id_menu2']) && is_array($data['id_menu_crud']))
		{
			foreach ($data['id_menu_crud'] as $key => $value) {
				$newdata['id_menu2'] = $data['id_menu2'];
				$newdata['id_menu_crud'] = $value['id_menu_crud'];
				
				$test_query = $this->db->query("
					SELECT * FROM menu_tampil WHERE id_menu1 = ".$newdata['id_menu1']." AND id_menu2 = ".$newdata['id_menu2']." AND id_menu_crud = ".$newdata['id_menu_crud']
					);

				if ($test_query->num_rows() >= 1) 
				{
					$alert = 3;
					return $alert;
				}

				$query = $this->db->insert('menu_tampil', $newdata);
			}
		}
		else if (is_array($data['id_menu2']) && is_array($data['id_menu_crud']))
		{
			foreach ($data['id_menu2'] as $key1 => $outer_value) {
				
				foreach ($data['id_menu_crud'] as $key2 => $inner_value) {
					$newdata['id_menu2'] = $outer_value['id_menu2'];
					$newdata['id_menu_crud'] = $inner_value['id_menu_crud'];

					$test_query = $this->db->query("
						SELECT * FROM menu_tampil WHERE id_menu1 = ".$newdata['id_menu1']." AND id_menu2 = ".$newdata['id_menu2']." AND id_menu_crud = ".$newdata['id_menu_crud']
						);

					if ($test_query->num_rows() >= 1) 
					{
						$alert = 3;
						return $alert;
					}

					$query = $this->db->insert('menu_tampil', $newdata);
				}
			}
		}
		else {
			$test_query = $this->db->query("
				SELECT * FROM menu_tampil WHERE id_menu1 = ".$data['id_menu1']." AND id_menu2 = ".$data['id_menu2']." AND id_menu_crud = ".$data['id_menu_crud']
				);

			if ($test_query->num_rows() >= 1) 
			{
				$alert = 3;
				return $alert;
			}

			$query = $this->db->insert('menu_tampil', $data);
		}

		if ($query)
		{
			$alert = 1;		// Berhasil menambah hak akses
		}
		else
		{
			$alert = 2;		// Gagal menambah hak akses
		}

		return $alert;
	}

	public function update_posisi_subdit_distrik()
	{
		$query = $this->db->query("
			SELECT DISTINCT(a.`kode_posisi_subdit_pegawai`), b.`id_posisi_subdit`, a.`kode_distrik_pegawai`, c.`id_distrik` FROM pegawai a
			INNER JOIN posisi_subdit b ON a.`kode_posisi_subdit_pegawai` = b.`kode_posisi_subdit`
			INNER JOIN distrik c ON a.`kode_distrik_pegawai` = c.`kode_distrik`;
			")->result_array();

		$insert_data = array();
		$count = 0;
		foreach ($query as $key => $value) {
			$insert_data[$key]['id_posisi_subdit'] = $value['id_posisi_subdit'];
			$insert_data[$key]['id_distrik'] = $value['id_distrik'];

			$check_insert = $this->db->insert('posisi_subdit_distrik', $insert_data[$key]);
			if ($check_insert)
			{
				$count += 1;
			}
		}

		return $count;
	}

	public function get_all_menu_utama()
	{
		$query = $this->db->get('menu1')->result_array();

		$new_result = array();
		foreach ($query as $key => $value) {
			$new_result[$value['id_menu1']] = array(
				'nama_menu1'		=> $value['nama_menu1'],
				'nama_controller'	=> $value['nama_controller']
				);
		}

		return $new_result;
	}

	public function get_all_sub_menu_utama()
	{
		$query = $this->db->get('menu2')->result_array();

		$new_result = array();
		foreach ($query as $key => $value) {
			$new_result[$value['id_menu2']] = array(
				'nama_menu2'	=> $value['nama_menu2'],
				'nama_method'	=> $value['nama_method']
				);
		}
		return $new_result;
	}

	public function get_all_menu_crud()
	{
		$query = $this->db->get('menu_crud')->result_array();
		
		$new_result = array();
		foreach ($query as $key => $value) {
			$new_result[$value['id_menu_crud']] = array(
				'nama_menu_crud'		=> $value['nama_menu_crud'],
				'nama_concat_method'	=> $value['nama_concat_method'],
				'html'					=> $value['tag_html'],
				'is_crud'				=> $value['is_crud']
				);
		}
		return $new_result;
	}

	public function get_all_posisi_subdit()
	{
		$query = $this->db->get('posisi_subdit')->result_array();
		return $query;
	}

	public function get_all_distrik()
	{
		$query = $this->db->get('distrik')->result_array();
		return $query;
	}

	public function get_all_posisi_subdit_distrik()
	{
		$query = $this->db->get('posisi_subdit_distrik')->result_array();
		return $query;
	}
}
