<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('authentifier');
		$this->authentifier->session_check();

		$this->load->model('status');
		$this->load->model('anggaran');
		$this->load->model('sertifikat');
		$this->load->model('sdm');
		$this->load->model('distrik');
	}
	// public function load_data()
	// {
	// 	$data_content = $this->status->get_all_status();
	// 	$data = array(
	// 		'data_content' => $data_content);
	// 	// print_r($data);
	// 	// die();
	// 	$this->template->load_view('data', 'data', $data);
	// }

	//-------------------------------------- SEMUA DATA ANGGARAN DASAR -----------------------------------------------
	public function anggaran_dasar()
	{
		$data_anggaran_dasar = $this->anggaran->get_all_anggaran_by_status("Aktif");
		$jenis_distrik = $this->distrik->get_all_distrik();

		$data = array(
			'data_anggaran_dasar'	=> $data_anggaran_dasar,
			'distrik'				=> $jenis_distrik
			);

		$this->template->load_view('data', 'anggaran_dasar', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT ANGGARAN DASAR BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA PERTANAHAN -----------------------------------------------
	public function pertanahan()
	{
		$data_pertanahan = $this->sertifikat->get_data_sertifikat("pertanahan", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		$jenis_distrik = $this->distrik->get_all_distrik();

		$data = array(
			'data_pertanahan' 	=> $data_pertanahan,
			'distrik'			=> $jenis_distrik
			);

		$this->template->load_view('data', 'pertanahan', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT PERTANAHAN BERAKHIR DISINI ----------------------------------

	//--------------------------------- SEMUA DATA SERTIFIKAT LAIK OPERASI -----------------------------------------------
	public function slo()
	{
		$data_slo = $this->sertifikat->get_data_sertifikat("slo", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		$jenis_distrik = $this->distrik->get_all_distrik();

		$data = array(
			'data_slo' 	=> $data_slo,
			'distrik'	=> $jenis_distrik
			);

		$this->template->load_view('data', 'slo', $data);
	}
	//--------------------- DATA APAPUN TERKAIT SERTIFIKAT LAIK OPERASI BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA SERTIFIKAT SDM -----------------------------------------------
	public function sertifikat_sdm()
	{
		$data_sdm = $this->sdm->get_all_data_sdm($this->authentifier->get_user_detail()['kode_distrik_pegawai'], "Aktif");
		$jenis_distrik = $this->distrik->get_all_distrik();

		$data = array(
			'data_sdm'	=> $data_sdm,
			'distrik'	=> $jenis_distrik
			);
		$this->template->load_view('data', 'sertifikat_sdm', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT SERTIFIKAT SDM BERAKHIR DISINI ----------------------------------

	//------------------------------------------ SEMUA DATA PERIZINAN -----------------------------------------------
	public function perizinan()
	{
		$data_perizinan = $this->sertifikat->get_data_sertifikat("perizinan", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		$jenis_distrik = $this->distrik->get_all_distrik();

		$data = array(
			'data_perizinan' 	=> $data_perizinan,
			'distrik'			=> $jenis_distrik
			);

		$this->template->load_view('data', 'perizinan', $data);
	}
	//------------------------------ DATA APAPUN TERKAIT PERIZINAN BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA PENGUJIAN ALAT K3 -----------------------------------------------
	public function pengujian_alat_k3()
	{
		$data_pengujian = $this->sertifikat->get_data_sertifikat("pengujian alat k3", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		$jenis_distrik = $this->distrik->get_all_distrik();

		$data = array(
			'data_pengujian' 	=> $data_pengujian,
			'distrik'			=> $jenis_distrik
			);

		$this->template->load_view('data', 'pengujian_alat_k3', $data);
	}
	//-------------------------- DATA APAPUN TERKAIT PENGUJIAN ALAT K3 BERAKHIR DISINI ----------------------------------

	//-------------------------------------------- SEMUA DATA LISENSI -----------------------------------------------
	public function lisensi()
	{
		$data_lisensi = $this->sertifikat->get_data_sertifikat("lisensi", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		$jenis_distrik = $this->distrik->get_all_distrik();

		$data = array(
			'data_lisensi' 	=> $data_lisensi,
			'distrik'		=> $jenis_distrik
			);

		$this->template->load_view('data', 'lisensi', $data);
	}
	//-------------------------------- DATA APAPUN TERKAIT LISENSI BERAKHIR DISINI ----------------------------------
}
