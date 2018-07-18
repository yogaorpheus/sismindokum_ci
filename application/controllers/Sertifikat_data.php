<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat_data extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		
		$this->load->helper(array('form', 'url'));
		$this->load->library('authentifier');

		$this->load->model('sertifikat');
		$this->load->model('dasar_hukum');
		$this->load->model('jenis_sertifikat');
		$this->load->model('log_database');
		$this->load->model('status');
	}

	public function upload_file_lampiran()
	{
		$file_path = "";

		$config['upload_path']          = './assets/lampiran/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|docx|doc';
       	$config['remove_spaces']		= true;

		$this->load->library('upload', $config);
		$test_upload = $this->upload->do_upload('lampiran');
		
		if (! $test_upload)
		{
			$this->authentifier->set_flashdata('error', 3);
		}
		else
		{
			$file = $this->upload->data();
			$file_path = base_url('assets/lampiran')."/".$file['file_name'];
		}

		return $file_path;
	}

	// BERIKUT ADALAH METHOD YANG AKAN DIGUNAKAN UNTUK MENAMBAH DATA PADA SETIAP SERTIFIKAT
	public function tambah_pertanahan()
	{
		$file_path = $this->upload_file_lampiran();

		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('pertanahan');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		$data = array(
			'id_dasar_hukum_sertifikat'	=> $input['referensi_pertanahan'],
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_sub_jenis_sertifikat'	=> $input['jenis_sertifikat'],
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'judul_sertifikat'			=> $input['lokasi_sertifikat'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $file_path,
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'status_sertifikat'			=> 3
			);
		// Status sertifikat masih menggunakan nilai default

		$result = $this->sertifikat->tambah_data_pertanahan($data);
		
		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			$id_sertifikat = $this->sertifikat->get_id_sertifikat_latest_by_user($id_pegawai);

			$log_data = array(
				'nama_tabel'		=> 'sertifikat',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_sertifikat
				);
			$id_log = $this->log_database->write_log($log_data);
			// Insert data sukses
			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect('form/pertanahan');
	}

	public function tambah_lisensi()
	{
		$file_path = $this->upload_file_lampiran();

		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('lisensi');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		$data = array(
			'id_dasar_hukum_sertifikat'	=> $input['referensi_lisensi'],
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'judul_sertifikat'			=> $input['nama_lisensi'],
			'spesifikasi_lisensi'		=> $input['spesifikasi'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $file_path,
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'status_sertifikat'			=> 3
			);

		$result = $this->sertifikat->tambah_data_lisensi($data);
		
		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			$id_sertifikat = $this->sertifikat->get_id_sertifikat_latest_by_user($id_pegawai);

			$log_data = array(
				'nama_tabel'		=> 'sertifikat',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_sertifikat
				);
			$id_log = $this->log_database->write_log($log_data);
			// Insert data sukses
			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect('form/lisensi');
	}

	public function tambah_pengujian_alat_k3()
	{
		$file_path = $this->upload_file_lampiran();

		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('pengujian alat k3');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		$data = array(
			'id_dasar_hukum_sertifikat'	=> $input['referensi_pengujian'],
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_sub_jenis_sertifikat'	=> $input['jenis_pengujian'],
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'judul_sertifikat'			=> $input['peralatan'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $file_path,
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'status_sertifikat'			=> 3
			);

		$result = $this->sertifikat->tambah_data_pengujian_alat_k3($data);
		
		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			$id_sertifikat = $this->sertifikat->get_id_sertifikat_latest_by_user($id_pegawai);

			$log_data = array(
				'nama_tabel'		=> 'sertifikat',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_sertifikat
				);
			$id_log = $this->log_database->write_log($log_data);
			// Insert data sukses
			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect('form/pengujian_alat_k3');
	}

	public function tambah_perizinan()
	{
		$file_path = $this->upload_file_lampiran();

		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('perizinan');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		$data = array(
			'id_dasar_hukum_sertifikat'	=> $input['referensi_perizinan'],
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_sub_jenis_sertifikat'	=> $input['jenis_perizinan'],
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'judul_sertifikat'			=> $input['peralatan'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $file_path,
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'status_sertifikat'			=> 3
			);

		$result = $this->sertifikat->tambah_data_perizinan($data);
		
		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			$id_sertifikat = $this->sertifikat->get_id_sertifikat_latest_by_user($id_pegawai);

			$log_data = array(
				'nama_tabel'		=> 'sertifikat',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_sertifikat
				);
			$id_log = $this->log_database->write_log($log_data);
			// Insert data sukses
			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect('form/perizinan');
	}

	public function tambah_slo()
	{
		$file_path = $this->upload_file_lampiran();

		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('slo');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		$data = array(
			'id_dasar_hukum_sertifikat'	=> $input['referensi_slo'],
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_unit_sertifikat'		=> $input['unit_sertifikasi'],
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $file_path,
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'status_sertifikat'			=> 3
			);

		$result = $this->sertifikat->tambah_data_slo($data);
		
		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			$id_sertifikat = $this->sertifikat->get_id_sertifikat_latest_by_user($id_pegawai);

			$log_data = array(
				'nama_tabel'		=> 'sertifikat',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_sertifikat
				);
			$id_log = $this->log_database->write_log($log_data);
			// Insert data sukses
			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect('form/slo');
	}
}
