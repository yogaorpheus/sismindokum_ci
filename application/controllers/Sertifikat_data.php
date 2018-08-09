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
		$this->load->model('remainder');
	}

	private function upload_file_lampiran($nama_sub_folder)
	{
		$file_path = "";

		$config['upload_path']          = './assets/lampiran/'.$nama_sub_folder.'/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|docx|doc|rar|zip';
       	$config['remove_spaces']		= true;
       	$config['max_size']				= '10000';

       	$this->load->library('upload', $config);
		$test_upload = $this->upload->do_upload('lampiran');
		$file_data = array();
		
		if (!$test_upload)
		{
			$this->authentifier->set_flashdata('error', 3);
		}
		else
		{
			$file = $this->upload->data();
			$file_path = base_url('assets/lampiran')."/".$nama_sub_folder."/".$file['file_name'];
			
			$file_data['file_path'] = $file_path;
			$file_data['file_name'] = $file['file_name'];
		}

		return $file_data;
	}

	private function set_status_sertifikat($id_sertifikat)
	{
		$data_sertifikat = $this->sertifikat->get_sertifikat_by_id($id_sertifikat);
		
		$id_remainder = $data_sertifikat['id_remainder_sertifikat'];
		$durasi_remainder = $this->remainder->get_durasi_remainder_by_id($id_remainder);

		$selisih_tanggal = $this->sertifikat->get_selisih_tanggal($id_sertifikat);
		$data = array(
			'id_sertifikat'	=> $id_sertifikat
			);

		if ($selisih_tanggal > $durasi_remainder)
		{
			$data['status_sertifikat'] = $this->status->get_id_status_by_nama_status_dan_nama_tabel("Aktif", "Sertifikat");
		}
		else if (($selisih_tanggal <= $durasi_remainder) && ($selisih_tanggal > 0))
		{
			$data['status_sertifikat'] = $this->status->get_id_status_by_nama_status_dan_nama_tabel("Alarm", "Sertifikat");
		}
		else if ($selisih_tanggal <= 0)
		{
			$data['status_sertifikat'] = $this->status->get_id_status_by_nama_status_dan_nama_tabel("Kadaluarsa", "Sertifikat");
		}

		$result = $this->sertifikat->update_data_sertifikat($data);
	}

	private function set_tahun_berakhir_forever()
	{
		$tahun_berakhir_forever = "12/31/4999";
		$tahun_berakhir_forever = DateTime::createFromFormat('m/d/Y', $tahun_berakhir_forever)->format('Y-m-d');

		return $tahun_berakhir_forever;
	}

	// BERIKUT ADALAH METHOD YANG AKAN DIGUNAKAN UNTUK MENAMBAH DATA PADA SETIAP SERTIFIKAT
	public function tambah_pertanahan()
	{
		$file_path = $this->upload_file_lampiran("pertanahan");

		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('pertanahan');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		if ($tanggal_berakhir == '0000-00-00')
			$tanggal_berakhir = $this->set_tahun_berakhir_forever();

		$data = array(
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_dasar_hukum_sertifikat'	=> $input['jenis_pertanahan'],
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'judul_sertifikat'			=> $input['lokasi_sertifikat'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $file_path['file_path'],
			'nama_file'					=> $file_path['file_name'],
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'status_sertifikat'			=> 3,
			'id_remainder_sertifikat'	=> $input['remainder']
			);
		// Status sertifikat masih menggunakan nilai default

		$result = $this->sertifikat->tambah_data_pertanahan($data);
		
		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			$id_sertifikat = $this->sertifikat->get_id_sertifikat_latest_by_user($id_pegawai);

			$this->set_status_sertifikat($id_sertifikat);

			$log_data = array(
				'nama_tabel'		=> 'sertifikat',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_sertifikat
				);
			$id_log = $this->log_database->write_log($log_data);
			// Insert data sukses
			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Data Pertanahan berhasil ditambahkan");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Data Pertanahan gagal ditambahkan");
		}

		return redirect('form/pertanahan');
	}

	public function tambah_lisensi()
	{
		$file_path = $this->upload_file_lampiran("lisensi");

		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('lisensi');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		if ($tanggal_berakhir == '0000-00-00')
			$tanggal_berakhir = $this->set_tahun_berakhir_forever();

		$data = array(
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_dasar_hukum_sertifikat'	=> $input['jenis_lisensi'],
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'judul_sertifikat'			=> $input['nama_lisensi'],
			'spesifikasi_lisensi'		=> $input['spesifikasi'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $file_path['file_path'],
			'nama_file'					=> $file_path['file_name'],
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'status_sertifikat'			=> 3,
			'id_remainder_sertifikat'	=> $input['remainder']
			);

		$result = $this->sertifikat->tambah_data_lisensi($data);
		
		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			$id_sertifikat = $this->sertifikat->get_id_sertifikat_latest_by_user($id_pegawai);

			$this->set_status_sertifikat($id_sertifikat);

			$log_data = array(
				'nama_tabel'		=> 'sertifikat',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_sertifikat
				);
			$id_log = $this->log_database->write_log($log_data);
			// Insert data sukses
			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Data Lisensi berhasil ditambahkan");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Data Lisensi gagal ditambahkan");
		}

		return redirect('form/lisensi');
	}

	public function tambah_pengujian_alat_k3()
	{
		$file_path = $this->upload_file_lampiran("pengujian");

		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('pengujian alat k3');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		if ($tanggal_berakhir == '0000-00-00')
			$tanggal_berakhir = $this->set_tahun_berakhir_forever();

		$data = array(
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_dasar_hukum_sertifikat'	=> $input['jenis_pengujian'],
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'judul_sertifikat'			=> $input['peralatan'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $file_path['file_path'],
			'nama_file'					=> $file_path['file_name'],
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'status_sertifikat'			=> 3,
			'id_remainder_sertifikat'	=> $input['remainder']
			);

		$result = $this->sertifikat->tambah_data_pengujian_alat_k3($data);
		
		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			$id_sertifikat = $this->sertifikat->get_id_sertifikat_latest_by_user($id_pegawai);

			$this->set_status_sertifikat($id_sertifikat);

			$log_data = array(
				'nama_tabel'		=> 'sertifikat',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_sertifikat
				);
			$id_log = $this->log_database->write_log($log_data);
			// Insert data sukses
			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Data Pengujian Alat berhasil ditambahkan");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Data Pengujian Alat gagal ditambahkan");
		}

		return redirect('form/pengujian_alat_k3');
	}

	public function tambah_perizinan()
	{
		$file_path = $this->upload_file_lampiran("perizinan");

		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('perizinan');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		if ($tanggal_berakhir == '0000-00-00')
			$tanggal_berakhir = $this->set_tahun_berakhir_forever();

		$data = array(
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_dasar_hukum_sertifikat'	=> $input['jenis_perizinan'],
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'judul_sertifikat'			=> $input['peralatan'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $file_path['file_path'],
			'nama_file'					=> $file_path['file_name'],
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'status_sertifikat'			=> 3,
			'id_remainder_sertifikat'	=> $input['remainder']
			);

		$result = $this->sertifikat->tambah_data_perizinan($data);
		
		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			$id_sertifikat = $this->sertifikat->get_id_sertifikat_latest_by_user($id_pegawai);

			$this->set_status_sertifikat($id_sertifikat);

			$log_data = array(
				'nama_tabel'		=> 'sertifikat',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_sertifikat
				);
			$id_log = $this->log_database->write_log($log_data);
			// Insert data sukses
			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Data Perizinan berhasil ditambahkan");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Data Perizinan gagal ditambahkan");
		}

		return redirect('form/perizinan');
	}

	public function tambah_slo()
	{
		$file_path = $this->upload_file_lampiran("slo");

		$input = $this->input->post();

		$id_jenis_sertifikat = $this->jenis_sertifikat->get_id_jenis_sertifikat('slo');
		$tanggal_terbit = DateTime::createFromFormat('m/d/Y', $input['tanggal_terbit'])->format('Y-m-d');
		$tanggal_berakhir = DateTime::createFromFormat('m/d/Y', $input['tanggal_berakhir'])->format('Y-m-d');

		if ($tanggal_berakhir == '0000-00-00')
			$tanggal_berakhir = $this->set_tahun_berakhir_forever();

		$data = array(
			'id_lembaga_sertifikat'		=> $input['lembaga'],
			'id_jenis_sertifikat'		=> $id_jenis_sertifikat,
			'id_dasar_hukum_sertifikat'	=> $input['jenis_slo'],
			'id_unit_sertifikat'		=> $input['unit_sertifikasi'],
			'id_distrik_sertifikat'		=> $input['distrik'],
			'no_sertifikat'				=> $input['no_sertifikat'],
			'tanggal_sertifikasi'		=> $tanggal_terbit,
			'tanggal_kadaluarsa'		=> $tanggal_berakhir,
			'file_sertifikat'			=> $file_path['file_path'],
			'nama_file'					=> $file_path['file_name'],
			'keterangan'				=> $input['keterangan'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai'],
			'status_sertifikat'			=> 3,
			'id_remainder_sertifikat'	=> $input['remainder']
			);

		$result = $this->sertifikat->tambah_data_slo($data);
		
		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			$id_sertifikat = $this->sertifikat->get_id_sertifikat_latest_by_user($id_pegawai);

			$this->set_status_sertifikat($id_sertifikat);

			$log_data = array(
				'nama_tabel'		=> 'sertifikat',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $id_sertifikat
				);
			$id_log = $this->log_database->write_log($log_data);
			// Insert data sukses
			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Data SLO berhasil ditambahkan");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Data SLO gagal ditambahkan");
		}

		return redirect('form/slo');
	}
}
