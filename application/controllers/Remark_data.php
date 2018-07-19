<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remark_data extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->library('authentifier');
		$this->load->library('template');

		$this->load->model('sertifikat');
		$this->load->model('anggaran');
		$this->load->model('remark');
	}

	private function get_data_remark_sertifikat($id_sertifikat)
	{
		$data_sertifikat = $this->sertifikat->get_one_sertifikat_lengkap_by_id($id_sertifikat);
		$data_remark = $this->remark->get_remark_by_id_sertifikat($data_sertifikat['id_sertifikat']);
		$status_remark = $this->remark->get_all_status_remark();

		$data = array(
			'data_sertifikat'	=> $data_sertifikat,
			'data_remark'		=> $data_remark,
			'status_remark'		=> $status_remark
			);

		return $data;
	}

	private function get_data_remark_anggaran($id_anggaran)
	{
		$data_anggaran = $this->anggaran->get_anggaran_by_id($id_anggaran);
		$data_remark = $this->remark->get_remark_by_id_anggaran($data_anggaran['id_anggaran']);
		$status_remark = $this->remark->get_all_status_remark();

		$data = array(
			'data_anggaran'	=> $data_anggaran,
			'data_remark'	=> $data_remark,
			'status_remark'	=> $status_remark
			);

		return $data;
	}

	public function view_remark_anggaran($id_anggaran)
	{
		$data = $this->get_data_remark_anggaran($id_anggaran);

		$this->template->load_view('remark', 'anggaran_dasar', $data);
	}

	public function view_remark_pertanahan($id_sertifikat)
	{
		$data = $this->get_data_remark_sertifikat($id_sertifikat);

		$this->template->load_view('remark', 'pertanahan', $data);
	}

	public function view_remark_slo($id_sertifikat)
	{
		$data = $this->get_data_remark_sertifikat($id_sertifikat);

		$this->template->load_view('remark', 'slo', $data);
	}

	public function view_remark_perizinan($id_sertifikat)
	{
		$data = $this->get_data_remark_sertifikat($id_sertifikat);

		$this->template->load_view('remark', 'perizinan', $data);
	}

	public function view_remark_pengujian_alat_k3($id_sertifikat)
	{
		$data = $this->get_data_remark_sertifikat($id_sertifikat);

		$this->template->load_view('remark', 'pengujian_alat_k3', $data);
	}

	public function view_remark_lisensi($id_sertifikat)
	{
		$data = $this->get_data_remark_sertifikat($id_sertifikat);

		$this->template->load_view('remark', 'lisensi', $data);
	}

	// FUNCTION BELOW IS ONLY FOR POST DATA REMARK //
	public function anggaran_dasar_remark()
	{

	}

	public function sertifikat_remark()
	{

	}

}
