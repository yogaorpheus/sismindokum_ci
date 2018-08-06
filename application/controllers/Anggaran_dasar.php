<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Anggaran_dasar extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();

		$this->load->library('authentifier');
		$this->load->library('template');
		$this->authentifier->session_check();
		
		$this->load->model('anggaran');
		$this->load->model('status');
		$this->load->model('log_database');
	}

	public function upload_file_lampiran($nama_lampiran)
	{
		$file_path = "";

		$config['upload_path']          = './assets/lampiran/';
        $config['allowed_types']        = 'gif|jpg|jpeg|png|pdf|docx|doc|rar|zip';
       	$config['remove_spaces']		= true;
       	$config['max_size']				= '10000';

		$this->load->library('upload', $config);
		$test_upload = $this->upload->do_upload($nama_lampiran);
		$file_data = array();
		
		if (! $test_upload)
		{
			$this->authentifier->set_flashdata('error', 3);
		}
		else
		{
			$file = $this->upload->data();
			$file_path = base_url('assets/lampiran')."/".$file['file_name'];

			$file_data['file_path'] = $file_path;
			$file_data['file_name'] = $file['file_name'];
		}

		return $file_data;
	}

	public function tambah_anggaran_dasar()
	{
		$file_path1 = $this->upload_file_lampiran('lampiran1');
		$file_path2 = $this->upload_file_lampiran('lampiran2');

		$input = $this->input->post();

		$tanggal_rups_sirkuler = DateTime::createFromFormat('m/d/Y', $input['tanggal_rups_sirkuler'])->format('Y-m-d');
		$tanggal_akta = DateTime::createFromFormat('m/d/Y', $input['tanggal_akta'])->format('Y-m-d');

		$insert_data = array(
			'tanggal_rups_sirkuler'		=> $tanggal_rups_sirkuler,
			'tahun_anggaran'			=> $input['tahun_anggaran'],
			'tanggal_akta_anggaran'		=> $tanggal_akta,
			'no_akta_anggaran'			=> $input['no_akta'],
			'no_penerimaan_anggaran'	=> $input['nomor_penerimaan'],
			'file_anggaran_1'			=> $file_path1['file_path'],
			'file_anggaran_2'			=> $file_path2['file_path'],
			'nama_file1'				=> $file_path1['file_name'],
			'nama_file2'				=> $file_path2['file_name'],
			'status_anggaran'			=> $input['status'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai']
			);

		$result = $this->anggaran->insert_anggaran_dasar($insert_data);

		if ($result)
		{
			$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
			
			$log_data = array(
				'nama_tabel'		=> 'anggaran',
				'id_pegawai'		=> $id_pegawai,
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'			=> $this->anggaran->get_id_anggaran_latest_by_user($id_pegawai)
				);
			$id_log = $this->log_database->write_log($log_data);

			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Data Anggaran berhasil ditambahkan");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Data Anggaran gagal ditambahkan");
		}

		return redirect ('form/anggaran_dasar');
	}

	public function anggaran_dasar_edit($id_anggaran)
	{
		$status_anggaran = $this->status->get_status_by_nama_tabel('anggaran');
		$data_anggaran = $this->anggaran->get_anggaran_by_id($id_anggaran);

		$data_anggaran['tanggal_rups_sirkuler'] = DateTime::createFromFormat('Y-m-d', $data_anggaran['tanggal_rups_sirkuler'])->format('m/d/Y');
		$data_anggaran['tanggal_akta'] = DateTime::createFromFormat('Y-m-d', $data_anggaran['tanggal_akta_anggaran'])->format('m/d/Y');

		$data = array(
			'status' 		=> $status_anggaran,
			'data_anggaran'	=> $data_anggaran
			);

		$this->template->load_view('form', 'edit_anggaran_dasar', $data);
	}

	public function anggaran_dasar_update()
	{
		$file_path1 = $this->upload_file_lampiran('lampiran1');
		$file_path2 = $this->upload_file_lampiran('lampiran2');

		$input = $this->input->post();
		
		$tanggal_rups_sirkuler = DateTime::createFromFormat('m/d/Y', $input['tanggal_rups_sirkuler'])->format('Y-m-d');
		$tanggal_akta = DateTime::createFromFormat('m/d/Y', $input['tanggal_akta'])->format('Y-m-d');

		$data_anggaran = $this->anggaran->get_anggaran_by_id($input['id_anggaran']);

		$data = array(
			'id_anggaran'				=> $input['id_anggaran'],
			'tanggal_rups_sirkuler'		=> $tanggal_rups_sirkuler,
			'tahun_anggaran'			=> $input['tahun_anggaran'],
			'tanggal_akta_anggaran'		=> $tanggal_akta,
			'no_akta_anggaran'			=> $input['no_akta'],
			'no_penerimaan_anggaran'	=> $input['nomor_penerimaan'],
			'status_anggaran'			=> $input['status'],
			'jabatan_pic'				=> $this->authentifier->get_user_detail()['posisi_pegawai'],
			'dibuat_oleh'				=> $this->authentifier->get_user_detail()['id_pegawai']
			);

		if (!is_null($file_path1) && !empty($file_path1))
		{
			$data['file_anggaran_1'] = $file_path1['file_path'];
			$data['nama_file1'] = $file_path1['file_name'];
		}

		if (!is_null($file_path2) && !empty($file_path2))
		{
			$data['file_anggaran_2'] = $file_path2['file_path'];
			$data['nama_file2'] = $file_path2['file_name'];
		}

		$result = $this->anggaran->update_anggaran_dasar($data);

		if ($result) 
		{
			$log_data = array(
				'nama_tabel'		=> 'anggaran',
				'id_pegawai'		=> $this->authentifier->get_user_detail()['id_pegawai'],
				'id_status_log'		=> $this->status->get_id_status_by_nama("melakukan edit"),
				'id_data'			=> $data['id_anggaran']
				);
			$id_log = $this->log_database->write_log($log_data);

			// if (!is_null($file_path1) && !empty($file_path1))
			// 	unlink("assets/lampiran/".$data_anggaran['nama_file1']);

			// if (!is_null($file_path2) && !empty($file_path2))
			// 	unlink("assets/lampiran/".$data_anggaran['nama_file2']);

			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Data Anggaran berhasil di-update");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Data Anggaran gagal di-update");
		}

		return redirect ('data/anggaran_dasar');
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
		$id_log = $this->log_database->write_log($log_data);

		$result = $this->anggaran->delete_anggaran_by_id($id_anggaran);

		if ($result) 
		{
			$this->authentifier->set_flashdata('error_code', 1);	// Delete berhasil
			$this->authentifier->set_flashdata('error_msg', "Data Anggaran berhasil dihapus");
		}
		else
		{
			$this->log_database->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error_code', 2);	// Delete gagal
			$this->authentifier->set_flashdata('error_msg', "Data Anggaran gagal dihapus");
		}

		return redirect ('data/anggaran_dasar');
	}
}
