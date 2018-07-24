<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
		$this->load->library('template');
		$this->load->library('authentifier');
		$this->authentifier->session_check();

		$this->load->model('anggaran');
		$this->load->model('sertifikat');
		$this->load->model('status');
		$this->load->model('jenis_sertifikat');
	}

	// public function load_dashboard1()
	// {
	// 	$menu_opened['menu'] = $this->jenis_sertifikat->buka_sertifikat(0);

	// 	$this->load->view('dashboard/head');
	// 	$this->load->view('dashboard/header_page');
	// 	$this->load->view('dashboard/sidebar', $menu_opened);
	// 	$this->load->view('dashboard/content');
	// 	$this->load->view('dashboard/footer');
	// 	$this->load->view('dashboard/control_sidebar');
	// 	$this->load->view('dashboard/script_closure');
	// }

	// public function load_dashboard2()
	// {
	// 	$this->load->view('dashboard2/head');
	// 	$this->load->view('dashboard2/header_page');
	// 	$this->load->view('dashboard2/sidebar');
	// 	$this->load->view('dashboard2/content');
	// 	$this->load->view('dashboard2/footer');
	// 	$this->load->view('dashboard2/control_sidebar');
	// 	$this->load->view('dashboard2/script_closure');
	// }

	// public function load_dashboard($id_posisi_bidang)
	// {
	// 	$data['test'] = array();
	// 	// $this->template->load_view($kode_bidang, 'dashboard', 'content', $data);
	// 	$this->template->load_view($id_posisi_bidang, 'dashboard2', 'content');
	// }

	public function index()
	{
		$data_anggaran = $this->anggaran->get_jumlah_anggaran_group_by_status();
		$data_anggaran = $this->convert_to_readable_morris($data_anggaran);

		$pertanahan = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("pertanahan");
		$pertanahan = $this->convert_to_readable_morris($pertanahan);

		$slo = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("slo");
		$slo = $this->convert_to_readable_morris($slo);

		$pengujian = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("pengujian alat k3");
		$pengujian = $this->convert_to_readable_morris($pengujian);

		$perizinan = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("perizinan");
		$perizinan = $this->convert_to_readable_morris($perizinan);

		$lisensi = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("lisensi");
		$lisensi = $this->convert_to_readable_morris($lisensi);

		$sertifikat = $this->jenis_sertifikat->get_all_jenis_sertifikat();

		$data = array(
			'data_anggaran'	=> $data_anggaran,
			'pertanahan'	=> $pertanahan,
			'slo'			=> $slo,
			'pengujian'		=> $pengujian,
			'perizinan'		=> $perizinan,
			'lisensi'		=> $lisensi,
			'sertifikat'	=> $sertifikat
			);

		$this->template->load_view('dashboard2', 'dashboard', $data);
	}

	private function convert_to_readable_morris($data)
	{
		$result = "";
		foreach ($data as $key => $one_data) {
			$result .= "{label: '".$one_data['label']."', value: ".$one_data['value']."},";
		}
		$result = substr($result, 0, -1);

		return $result;
	}
}
