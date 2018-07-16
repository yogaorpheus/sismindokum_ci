<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Administrator extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		
		$this->load->library('template');

		$this->load->model('hak_akses');
		$this->load->model('pegawai');
		$this->load->model('status');
	}

	// NOT FOR PUBLIC MENU -> ONLY ACCESS THROUGH ROUTES ONLY
	public function tambah_hak_akses()
	{
		$result = array_filter($_POST);

		if ($result['distrik'] == '0') {
			$result['distrik'] = null;
		}

		$data = array(
			'id_menu1' => $result['menu1'],
			'id_menu2' => $result['menu2'],
			'id_menu_crud' => $result['menu_crud'],
			'id_posisi_subdit' => $result['posisi_subdit'],
			'id_distrik' => $result['distrik']
			);

		$check_entry = $this->hak_akses->tambah_hak_akses($data);
		$this->session->set_flashdata('entry', $check_entry);
		redirect('administrator/load_hak_akses_menu');
	}

	public function load_data_hak_akses()
	{
		$hak_akses = $this->hak_akses->get_data_hak_akses();

		$data = array(
			'hak_akses'	=> $hak_akses
			);

		return $this->template->load_view('data', 'data_hak_akses', $data);
	}

	public function load_hak_akses_menu()
	{
		$menu1 = $this->hak_akses->get_all_menu_utama();
		$menu2 = $this->hak_akses->get_all_sub_menu_utama();
		$menu_crud = $this->hak_akses->get_all_menu_crud();
		$posisi_subdit = $this->hak_akses->get_all_posisi_subdit();
		$distrik = $this->hak_akses->get_all_distrik();
		$posisi_subdit_distrik = $this->hak_akses->get_all_posisi_subdit_distrik();

		$data = array(
			'menu1'			=> $menu1,
			'menu2'			=> $menu2,
			'menu_crud'		=> $menu_crud,
			'posisi_subdit'	=> $posisi_subdit,
			'distrik'		=> $distrik,
			'posisi_subdit_distrik'	=> $posisi_subdit_distrik,
			);

		$this->template->load_view('form', 'form_hak_akses', $data);
	}

	public function buat_menu()
	{
		$menu1 = $this->hak_akses->get_all_menu_utama();
		$menu2 = $this->hak_akses->get_all_sub_menu_utama();
		$menu_crud = $this->hak_akses->get_all_menu_crud();
		
		$data = array(
			'menu1'			=> $menu1,
			'menu2'			=> $menu2,
			'menu_crud'		=> $menu_crud
			);

		$this->template->load_view('form', 'form_buat_menu', $data);
	}

	public function load_list_menu()
	{
		$menu_tampil = $this->hak_akses->get_all_menu_tampil();

		$data = array(
			'menu_tersedia'	=> $menu_tampil
			);

		$this->template->load_view('data', 'data_menu_tampil', $data);
	}

	public function tambah_menu()
	{
		$result = array_filter($_POST);

		$data = array(
			'id_menu1'		=> $result['menu1'],
			'id_menu2'		=> $result['menu2'],
			'id_menu_crud'	=> $result['menu_crud']
			);

		if ($data['id_menu2'] == 'ALL')
		{
			$data['id_menu2'] = $this->hak_akses->get_all_sub_menu_utama();
		}

		if ($data['id_menu_crud'] == 'ALL')
		{
			$data['id_menu_crud'] = $this->hak_akses->get_all_menu_crud();
		}

		$check_entry = $this->hak_akses->tambah_akses_menu($data);
		$this->session->set_flashdata('entry', $check_entry);
		redirect('administrator/buat_menu');
	}

	public function test_form($nid)
	{
		$this->load->model('pegawai');

		$detail = $this->pegawai->get_pegawai($nid);
		print_r($detail);
		die();
	}

	public function load_data_pegawai()
	{
		$all_pegawai = file_get_contents('http://192.168.3.133/sync_ellipse/all_data_karyawan');
		$all_pegawai = json_decode($all_pegawai);

		// $converted = $this->pegawai->salin_data_pegawai_from_ellipse($all_pegawai);
		// $converted = json_encode($converted);
		$jumlah_pegawai_dibaca = $this->pegawai->salin_data_pegawai_from_ellipse($all_pegawai);
		
		echo 'Jumlah pegawai yang dibaca';
		print_r($jumlah_pegawai_dibaca) or die();
	}

	public function import_data_subdit()
	{
		$total_subdit = $this->pegawai->import_subdit();

		echo 'Total subdit yang diimport\n';
		print_r($total_subdit) or die();
	}

	public function import_data_distrik()
	{
		$total_distrik = $this->pegawai->import_distrik();

		echo 'Total distrik yang diimport : ';
		print_r($total_distrik) or die();
	}

	public function update_id_distrik_pegawai()
	{
		$check = $this->pegawai->update_data_distrik();
		echo $check;
	}

	public function import_posisi_subdit_distrik()
	{
		$total_data = $this->hak_akses->update_posisi_subdit_distrik();
		print_r($total_data);
		die();
	}

}
