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
		$this->load->model('distrik');
	}

	public function index()
	{
		$kode_distrik = $this->authentifier->get_user_detail()['kode_distrik_pegawai'];
		$data = array();

		if ($kode_distrik == 'Z')
		{
			$data_anggaran = $this->anggaran->get_jumlah_anggaran_group_by_status();
			$data_anggaran = $this->convert_to_readable_morris($data_anggaran);
			$data['data_anggaran'] = $data_anggaran;

			$data['distrik'] = $this->distrik->get_all_distrik();
		}

		$pertanahan = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("pertanahan", $kode_distrik);
		$slo = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("slo", $kode_distrik);
		$pengujian = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("pengujian alat k3", $kode_distrik);
		$perizinan = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("perizinan", $kode_distrik);
		$lisensi = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("lisensi", $kode_distrik);

		// $pertanahan = $this->convert_to_readable_morris($pertanahan);
		// $slo = $this->convert_to_readable_morris($slo);
		// $pengujian = $this->convert_to_readable_morris($pengujian);
		// $perizinan = $this->convert_to_readable_morris($perizinan);
		// $lisensi = $this->convert_to_readable_morris($lisensi);
		$pertanahan = $this->convert_to_highchart_data($pertanahan);
		$slo = $this->convert_to_highchart_data($slo);
		$pengujian = $this->convert_to_highchart_data($pengujian);
		$perizinan = $this->convert_to_highchart_data($perizinan);
		$lisensi = $this->convert_to_highchart_data($lisensi);

		$sertifikat = $this->jenis_sertifikat->get_all_jenis_sertifikat();

		$data['pertanahan'] = $pertanahan;
		$data['slo']		= $slo;
		$data['pengujian']	= $pengujian;
		$data['perizinan']	= $perizinan;
		$data['lisensi']	= $lisensi;
		$data['sertifikat']	= $sertifikat;

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

	private function convert_to_highchart_data($data)
	{
		$newdata = array();

		foreach ($data as $key => $one_data) {
			$newdata[] = $one_data;
		}

		return $newdata;
	}
}
