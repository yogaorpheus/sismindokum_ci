<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Remark_data extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->library('authentifier');
		$this->load->library('template');
		$this->authentifier->session_check();

		$this->load->model('sertifikat');
		$this->load->model('anggaran');
		$this->load->model('remark');
		$this->load->model('status');
		$this->load->model('jenis_sertifikat');
		$this->load->model('log_database');
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

	private function set_status_sertifikat($id_sertifikat, $nama_status)
	{
		$id_status = $this->status->get_id_status_by_nama_status_dan_nama_tabel($nama_status, "sertifikat");

		$data = array(
			'status_sertifikat'	=> $id_status,
			'id_sertifikat'		=> $id_sertifikat
			);
		$result = $this->sertifikat->update_data_sertifikat($data);

		return $result;
	}

	private function set_status_anggaran($id_anggaran, $nama_status)
	{
		$id_status = $this->status->get_id_status_by_nama_status_dan_nama_tabel($nama_status, "anggaran");

		$data = array(
			'status_anggaran'	=> $id_status,
			'id_anggaran'		=> $id_anggaran
			);
		$result = $this->anggaran->update_anggaran_dasar($data);

		return $result;
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
		$input = $this->input->post();
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];

		$sub_link = $input['sub_link'];
		$id_anggaran = $input['id_anggaran'];

		$data = array(
			'id_data'	=> $input['id_anggaran'],
			'status_remark'	=> $input['status_remark'],
			'keterangan'	=> $input['keterangan'],
			'dibuat_oleh'	=> $id_pegawai,
			'tabel_data'	=> "anggaran"
			);

		$result = $this->remark->insert_new_remark($data);

		if ($result)
		{
			$id_remark = $this->remark->get_id_new_remark($id_pegawai);

			$log_data = array(
				'nama_tabel'		=> 'remark',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_remark
				);
			$id_log = $this->log_database->write_log($log_data);

			$remark_selesai = $this->remark->get_remark_selesai_by_id_anggaran($id_anggaran);

			if (!is_null($remark_selesai) && !empty($remark_selesai))
			{
				// Ada remark selesai pada sertifikat
				$check_selesai = $this->set_status_anggaran($id_anggaran, "Tidak Aktif");
				if ($check_selesai)
				{
					$sub_link_2 = substr($sub_link, 0, -7);
					return redirect('data/'.$sub_link_2);
				}
			}

			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect ('data/'.$sub_link.'/'.$id_anggaran);
	}

	public function sertifikat_remark()
	{
		$input = $this->input->post();
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];

		$sub_link = $input['sub_link'];
		$id_sertifikat = $input['id_sertifikat'];

		$data = array(
			'id_data'		=> $input['id_sertifikat'],
			'status_remark'	=> $input['status_remark'],
			'keterangan'	=> $input['keterangan'],
			'dibuat_oleh'	=> $id_pegawai,
			'tabel_data'	=> "sertifikat"
			);

		$result = $this->remark->insert_new_remark($data);

		if ($result)
		{
			$id_remark = $this->remark->get_id_new_remark($id_pegawai);

			$log_data = array(
				'nama_tabel'		=> 'remark',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_remark
				);
			$id_log = $this->log_database->write_log($log_data);

			$remark_selesai = $this->remark->get_remark_selesai_by_id_sertifikat($id_sertifikat);

			if (!is_null($remark_selesai) && !empty($remark_selesai))
			{
				// Ada remark selesai pada sertifikat
				$check_selesai = $this->set_status_sertifikat($id_sertifikat, "Selesai");
				if ($check_selesai)
				{
					$sub_link_2 = substr($sub_link, 0, -7);
					return redirect('data/'.$sub_link_2);
				}
			}

			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect ('data/'.$sub_link.'/'.$id_sertifikat);
	}

	public function delete_remark()
	{
		$input = $this->input->post();

		$sub_link = $input['sub_link'];
		$id_data = $input['id_data'];

		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
		$id_remark = $input['id'];

		$data_remark = $this->remark->get_remark_by_id($id_remark);
		$json_data = json_encode($data_remark);

		$log_data = array(
			'nama_tabel'				=> 'remark',
			'json_data_before_delete'	=> $json_data,
			'id_pegawai'				=> $id_pegawai,
			'id_status_log'				=> $this->status->get_id_status_by_nama("melakukan delete"),
			'id_data'					=> $id_remark
			);
		$id_log = $this->log_database->write_log($log_data);

		$result = $this->remark->delete_remark($id_remark);

		if ($result)
		{
			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			$this->log_database->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect ('data/'.$sub_link.'/'.$id_data);
	}

}
