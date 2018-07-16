<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Authentifier
{
	var $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('session');
	}

	public function login($nid)
	{
		if ($this->is_logged_in())
		{
			// var_dump($this->get_user_detail());
			// die();
			redirect('dashboard');
		}

		$this->ci->load->model('pegawai');
		$this->ci->load->model('hak_akses');

		$detail_pegawai = $this->ci->pegawai->get_pegawai($nid);
		$id_posisi_subdit = $this->ci->pegawai->get_id_posisi_subdit($detail_pegawai['kode_posisi_subdit_pegawai']);

		$menu1 = $this->ci->hak_akses->get_all_menu_utama();
		$menu2 = $this->ci->hak_akses->get_all_sub_menu_utama();
		$menu_crud = $this->ci->hak_akses->get_all_menu_crud();

		$hak_akses = $this->ci->hak_akses->get_hak_akses_pegawai($id_posisi_subdit["id_posisi_subdit"], $detail_pegawai['id_distrik_pegawai']);
		$detail_pegawai['id_posisi_subdit'] = $id_posisi_subdit["id_posisi_subdit"];

		$menu_tampil = array();
		if (!is_null($hak_akses))
		{
			foreach ($hak_akses as $key => $value) {
				$menu_tampil[$value['id_menu1']][$value['id_menu2']][$value['id_menu_crud']] = array('berhak' => true);
			}

			// foreach ($menu_tampil as $key => $one_menu_utama) {
			// 	$menu_tampil[$key]['nama_menu1'] = $menu1[$key]['nama_menu1'];
			// 	$menu_tampil[$key]['nama_controller'] = $menu1[$key]['nama_controller'];

			// 	foreach ($one_menu_utama as $key1 => $one_sub_menu) {
			// 		$menu_tampil[$key][$key1]['nama_menu2'] = $menu2[$key1]['nama_menu2'];
			// 		$menu_tampil[$key][$key1]['nama_method'] = $menu2[$key1]['nama_method'];

			// 		foreach ($one_sub_menu as $key2 => $one_crud) {
			// 			$menu_tampil[$key][$key1][$key2]['nama_menu_crud'] = $menu_crud[$key2]['nama_menu_crud'];
			// 			$menu_tampil[$key][$key1][$key2]['nama_concat_method'] = $menu_crud[$key2]['nama_concat_method'];
			// 		}
			// 	}
			// }

			$menu = array(
				'menu_tampil'	=> $menu_tampil,
				'menu_utama'	=> $menu1,
				'sub_menu'		=> $menu2,
				'menu_crud'		=> $menu_crud
				);

			$this->ci->session->set_userdata('staff_pjb', $detail_pegawai);
			$this->ci->session->set_userdata('menu_aktif', $menu);

			return $this->is_logged_in();
		}
		else
		{
			return false;
		}

	}

	public function get_user_detail()
	{
		if ($this->is_logged_in())
		{
			return $this->ci->session->userdata('staff_pjb');
		}

		return null;
	}

	public function get_menu_aktif()
	{
		if ($this->is_logged_in())
		{
			return $this->ci->session->userdata('menu_aktif');
		}

		return null;
	}

	public function is_logged_in()
	{
		return $this->ci->session->has_userdata('staff_pjb');
		// Mengembalikan nilai boolean apakah user sudah melakukan log in dan memiliki session atau belum
	}

	// session_check() digunakan sebagai guard pada tiap2 controller yang membutuhkan user login ketika mengakses.
	// Apabila pengakses tidak memiliki session login, maka pengakses tidak akan bisa mengakses controller tersebut walaupun melalui alamat web sekalipun.
	public function session_check()
	{
		if (! $this->is_logged_in())
		{
			redirect ('home');
		}
	}

	public function set_flashdata($flashdata_name, $flashdata_code)
	{
		$this->ci->session->set_flashdata($flashdata_name, $flashdata_code);
		return;
	}

	public function logout()
	{
		$this->ci->session->sess_destroy('staff_pjb');
		$this->ci->session->sess_destroy('menu_aktif');
	}

}
?>