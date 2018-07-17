<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_crud extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		$this->load->library('template');
		$this->load->library('authentifier');

		$this->load->model('status');
		$this->load->model('anggaran');
		$this->load->model('sertifikat');
		$this->load->model('log');
	}

	//-------------------------------------- SEMUA DATA ANGGARAN DASAR -----------------------------------------------
	public function anggaran_dasar_edit($id_anggaran)
	{
		$data_anggaran = $this->anggaran->get_anggaran_by_id($id_anggaran);

		$data = array(
			'data_anggaran'		=> $data_anggaran
			);
		return $this->template->load_view('form', 'edit_anggaran_dasar', $data);
	}

	public function anggaran_dasar_delete($id_anggaran)
	{
		$data_anggaran = $this->anggaran->get_anggaran_by_id($id_anggaran);
		$json_data = json_encode($data_anggaran);

		$log_data = array(
			'nama_tabel'				=> "anggaran",
			'json_data_before_delete'	=> $json_data,
			'id_pegawai'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'id_status_log'				=> $this->status->get_id_status_by_nama("melakukan delete"),
			'id_data'					=> $id_anggaran
			);
		$id_log = $this->log->write_log($log_data);

		$result = $this->anggaran->delete_anggaran_by_id($id_anggaran);

		if ($result) 
		{
			$this->authentifier->set_flashdata('error', 1);	// Delete berhasil
		}
		else
		{
			$this->log->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error', 2);	// Delete gagal
		}

		return redirect ('data/anggaran_dasar');
	}
	//-------------------------- DATA APAPUN TERKAIT ANGGARAN DASAR BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA PERTANAHAN -----------------------------------------------
	public function pertanahan_edit($id_sertifikat)
	{
		$data_pertanahan = $this->sertifikat->get_sertifikat_by_id($id_sertifikat, "pertanahan");

		$data = array(
			'data_pertanahan'		=> $data_pertanahan
			);
		return $this->template->load_view('form', 'edit_pertanahan', $data);
	}

	public function pertanahan_delete($id_sertifikat)
	{
		$data_pertanahan = $this->sertifikat->get_sertifikat_by_id($id_sertifikat, "pertanahan");
		$json_data = json_encode($data_pertanahan);

		$log_data = array(
			'nama_tabel'				=> "sertifikat",
			'json_data_before_delete'	=> $json_data,
			'id_pegawai'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'id_status_log'				=> $this->status->get_id_status_by_nama("melakukan delete"),
			'id_data'					=> $id_sertifikat
			);
		$id_log = $this->log->write_log($log_data);

		$result = $this->sertifikat->delete_sertifikat_by_id($id_sertifikat, $data_pertanahan['id_jenis_sertifikat']);

		if ($result) 
		{
			$this->authentifier->set_flashdata('error', 1);	// Delete berhasil
		}
		else
		{
			$this->log->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error', 2);	// Delete gagal
		}

		return redirect ('data/pertanahan');
	}
	//-------------------------- DATA APAPUN TERKAIT PERTANAHAN BERAKHIR DISINI ----------------------------------

	//--------------------------------- SEMUA DATA SERTIFIKAT LAIK OPERASI -----------------------------------------------
	public function slo_edit($id_sertifikat)
	{
		$data_slo = $this->sertifikat->get_sertifikat_by_id($id_sertifikat, "slo");

		$data = array(
			'data_slo'		=> $data_slo
			);
		return $this->template->load_view('form', 'edit_slo', $data);
	}

	public function slo_delete($id_sertifikat)
	{
		$data_slo = $this->sertifikat->get_sertifikat_by_id($id_sertifikat, "slo");
		$json_data = json_encode($data_slo);

		$log_data = array(
			'nama_tabel'				=> "sertifikat",
			'json_data_before_delete'	=> $json_data,
			'id_pegawai'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'id_status_log'				=> $this->status->get_id_status_by_nama("melakukan delete"),
			'id_data'					=> $id_sertifikat
			);
		$id_log = $this->log->write_log($log_data);

		$result = $this->sertifikat->delete_sertifikat_by_id($id_sertifikat, $data_slo['id_jenis_sertifikat']);

		if ($result) 
		{
			$this->authentifier->set_flashdata('error', 1);	// Delete berhasil
		}
		else
		{
			$this->log->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error', 2);	// Delete gagal
		}

		return redirect ('data/slo');
	}
	//--------------------- DATA APAPUN TERKAIT SERTIFIKAT LAIK OPERASI BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA SERTIFIKAT SDM -----------------------------------------------
	public function sertifikat_sdm()
	{

	}
	//-------------------------- DATA APAPUN TERKAIT SERTIFIKAT SDM BERAKHIR DISINI ----------------------------------

	//------------------------------------------ SEMUA DATA PERIZINAN -----------------------------------------------
	public function perizinan_edit($id_sertifikat)
	{
		$data_perizinan = $this->sertifikat->get_sertifikat_by_id($id_sertifikat, "perizinan");

		$data = array(
			'data_perizinan'		=> $data_perizinan
			);
		return $this->template->load_view('form', 'edit_perizinan', $data);
	}

	public function perizinan_delete($id_sertifikat)
	{
		$data_perizinan = $this->sertifikat->get_sertifikat_by_id($id_sertifikat, "perizinan");
		$json_data = json_encode($data_perizinan);

		$log_data = array(
			'nama_tabel'				=> "sertifikat",
			'json_data_before_delete'	=> $json_data,
			'id_pegawai'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'id_status_log'				=> $this->status->get_id_status_by_nama("melakukan delete"),
			'id_data'					=> $id_sertifikat
			);
		$id_log = $this->log->write_log($log_data);

		$result = $this->sertifikat->delete_sertifikat_by_id($id_sertifikat, $data_perizinan['id_jenis_sertifikat']);

		if ($result) 
		{
			$this->authentifier->set_flashdata('error', 1);	// Delete berhasil
		}
		else
		{
			$this->log->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error', 2);	// Delete gagal
		}

		return redirect ('data/perizinan');
	}
	//------------------------------ DATA APAPUN TERKAIT PERIZINAN BERAKHIR DISINI ----------------------------------

	//-------------------------------------- SEMUA DATA PENGUJIAN ALAT K3 -----------------------------------------------
	public function pengujian_alat_k3_edit($id_sertifikat)
	{
		$data_pengujian = $this->sertifikat->get_sertifikat_by_id($id_sertifikat, "pengujian alat k3");

		$data = array(
			'data_pengujian'		=> $data_pengujian
			);
		return $this->template->load_view('form', 'edit_pengujian_alat_k3', $data);
	}

	public function pengujian_alat_k3_delete($id_sertifikat)
	{
		$data_pengujian = $this->sertifikat->get_sertifikat_by_id($id_sertifikat, "pengujian alat k3");
		$json_data = json_encode($data_pengujian);

		$log_data = array(
			'nama_tabel'				=> "sertifikat",
			'json_data_before_delete'	=> $json_data,
			'id_pegawai'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'id_status_log'				=> $this->status->get_id_status_by_nama("melakukan delete"),
			'id_data'					=> $id_sertifikat
			);
		$id_log = $this->log->write_log($log_data);

		$result = $this->sertifikat->delete_sertifikat_by_id($id_sertifikat, $data_pengujian['id_jenis_sertifikat']);

		if ($result) 
		{
			$this->authentifier->set_flashdata('error', 1);	// Delete berhasil
		}
		else
		{
			$this->log->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error', 2);	// Delete gagal
		}

		return redirect ('data/pengujian_alat_k3');
	}
	//-------------------------- DATA APAPUN TERKAIT PENGUJIAN ALAT K3 BERAKHIR DISINI ----------------------------------

	//-------------------------------------------- SEMUA DATA LISENSI -----------------------------------------------
	public function lisensi_edit($id_sertifikat)
	{
		$data_lisensi = $this->sertifikat->get_sertifikat_by_id($id_sertifikat, "lisensi");

		$data = array(
			'data_lisensi'		=> $data_lisensi
			);
		return $this->template->load_view('form', 'edit_lisensi', $data);
	}

	public function lisensi_delete($id_sertifikat)
	{
		$data_lisensi = $this->sertifikat->get_sertifikat_by_id($id_sertifikat, "lisensi");
		$json_data = json_encode($data_lisensi);

		$log_data = array(
			'nama_tabel'				=> "sertifikat",
			'json_data_before_delete'	=> $json_data,
			'id_pegawai'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'id_status_log'				=> $this->status->get_id_status_by_nama("melakukan delete"),
			'id_data'					=> $id_sertifikat
			);
		$id_log = $this->log->write_log($log_data);

		$result = $this->sertifikat->delete_sertifikat_by_id($id_sertifikat, $data_lisensi['id_jenis_sertifikat']);

		if ($result) 
		{
			$this->authentifier->set_flashdata('error', 1);	// Delete berhasil
		}
		else
		{
			$this->log->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error', 2);	// Delete gagal
		}

		return redirect ('data/lisensi');
	}
	//-------------------------------- DATA APAPUN TERKAIT LISENSI BERAKHIR DISINI ----------------------------------
}
