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
		$this->load->model('sdm');
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
			//$data_anggaran = $this->convert_to_readable_morris($data_anggaran);
			$data_anggaran = $this->convert_to_highchart_data($data_anggaran);
			$total_anggaran = $this->anggaran->get_jumlah_data_anggaran();

			$data['total_anggaran'] = $total_anggaran;
			$data['data_anggaran'] = $data_anggaran;

			$data['distrik'] = $this->distrik->get_all_distrik();

			$kode_distrik = "ALL";
		}

		$pertanahan = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("pertanahan", $kode_distrik);
		$slo = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("slo", $kode_distrik);
		$pengujian = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("pengujian alat k3", $kode_distrik);
		$perizinan = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("perizinan", $kode_distrik);
		$lisensi = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("lisensi", $kode_distrik);
		$sdm = $this->sdm->get_jumlah_sdm_group_by_status($kode_distrik);

		$total_pertanahan = $this->sertifikat->get_jumlah_data_sertifikat_by_distrik("pertanahan", $kode_distrik);
		$total_slo = $this->sertifikat->get_jumlah_data_sertifikat_by_distrik("slo", $kode_distrik);
		$total_perizinan = $this->sertifikat->get_jumlah_data_sertifikat_by_distrik("perizinan", $kode_distrik);
		$total_pengujian = $this->sertifikat->get_jumlah_data_sertifikat_by_distrik("pengujian alat k3", $kode_distrik);
		$total_lisensi = $this->sertifikat->get_jumlah_data_sertifikat_by_distrik("lisensi", $kode_distrik);
		$total_sdm = $this->sdm->get_jumlah_data_sdm($kode_distrik);

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
		$sdm = $this->convert_to_highchart_data($sdm);

		$data['pertanahan'] = $pertanahan;
		$data['slo']		= $slo;
		$data['pengujian']	= $pengujian;
		$data['perizinan']	= $perizinan;
		$data['lisensi']	= $lisensi;
		$data['sdm']		= $sdm;

		$data['total_pertanahan']	= $total_pertanahan;
		$data['total_slo']			= $total_slo;
		$data['total_pengujian']	= $total_pengujian;
		$data['total_perizinan']	= $total_perizinan;
		$data['total_lisensi']		= $total_lisensi;
		$data['total_sdm']			= $total_sdm;

		$this->template->load_view('dashboard2', 'dashboard', $data);
	}

	public function ajax_get_dashboard_distrik_by_id($id_distrik)
	{
		$data = array();

		if ($this->authentifier->get_user_detail()['kode_distrik_pegawai'] != 'Z')
		{
			header('Content-Type: application/json');
			echo json_encode($data);
		}

		if ($id_distrik == "ALL")
			$kode_distrik = "ALL";
		else
			$kode_distrik = $this->distrik->get_distrik_by_id_distrik($id_distrik)['kode_distrik'];

		$pertanahan = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("pertanahan", $kode_distrik);
		$slo = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("slo", $kode_distrik);
		$pengujian = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("pengujian alat k3", $kode_distrik);
		$perizinan = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("perizinan", $kode_distrik);
		$lisensi = $this->sertifikat->get_jumlah_sertifikat_by_nama_jenis("lisensi", $kode_distrik);
		$sdm = $this->sdm->get_jumlah_sdm_group_by_status($kode_distrik);

		$total_pertanahan = $this->sertifikat->get_jumlah_data_sertifikat_by_distrik("pertanahan", $kode_distrik);
		$total_slo = $this->sertifikat->get_jumlah_data_sertifikat_by_distrik("slo", $kode_distrik);
		$total_perizinan = $this->sertifikat->get_jumlah_data_sertifikat_by_distrik("perizinan", $kode_distrik);
		$total_pengujian = $this->sertifikat->get_jumlah_data_sertifikat_by_distrik("pengujian alat k3", $kode_distrik);
		$total_lisensi = $this->sertifikat->get_jumlah_data_sertifikat_by_distrik("lisensi", $kode_distrik);
		$total_sdm = $this->sdm->get_jumlah_data_sdm($kode_distrik);

		$pertanahan = $this->convert_to_highchart_data($pertanahan);
		$slo = $this->convert_to_highchart_data($slo);
		$pengujian = $this->convert_to_highchart_data($pengujian);
		$perizinan = $this->convert_to_highchart_data($perizinan);
		$lisensi = $this->convert_to_highchart_data($lisensi);
		$sdm = $this->convert_to_highchart_data($sdm);

		$data['pertanahan'] = $pertanahan;
		$data['slo']		= $slo;
		$data['pengujian']	= $pengujian;
		$data['perizinan']	= $perizinan;
		$data['lisensi']	= $lisensi;
		$data['sdm']		= $sdm;

		$data['total_pertanahan']	= $total_pertanahan;
		$data['total_slo']			= $total_slo;
		$data['total_pengujian']	= $total_pengujian;
		$data['total_perizinan']	= $total_perizinan;
		$data['total_lisensi']		= $total_lisensi;
		$data['total_sdm']	= $total_sdm;
		
		header('Content-Type: application/json');
		echo json_encode($data, JSON_NUMERIC_CHECK);
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
