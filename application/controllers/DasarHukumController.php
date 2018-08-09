<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dasarhukumcontroller extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
		$this->load->library('authentifier');
		$this->load->library('template');

		$this->load->model('dasar_hukum');
		$this->load->model('log_database');
		$this->load->model('menu');
		$this->load->model('status');
	}

	public function index()
	{
		$dasar_hukum = $this->dasar_hukum->get_all_dasar_hukum();
		
		$data = array(
			'dasar_hukum'			=> $dasar_hukum
			);
		return $this->template->load_view('data', 'dasar_hukum', $data);
	}

	public function tambah_dasar_hukum()
	{
		$data_menu2 = $this->menu->get_menu2_dasar_hukum();

		$data = array(
			'data_menu2'	=> $data_menu2
			);
		return $this->template->load_view('form', 'dasar_hukum', $data);
	}

	public function insert_dasar_hukum()
	{
		$input = $this->input->post();
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];

		$data = array(
			'kode_dasar_hukum'			=> $input['kode_dasar_hukum_add'],
			'nama_sub_jenis_sertifikat'	=> $input['nama_sub_jenis_sertifikat'],
			'keterangan_dasar_hukum'	=> $input['keterangan_add'],
			'dibuat_oleh'				=> $id_pegawai,
			'id_menu2'					=> $input['menu2_add']
			);
		$result = $this->dasar_hukum->insert_dasar_hukum($data);

		if ($result)
		{
			$id_dasar_hukum = $this->dasar_hukum->get_latest_id_dasar_hukum_by_pembuat($id_pegawai);

			$log_data = array(
				'nama_tabel'	=> "dasar_hukum",
				'id_pegawai'	=> $id_pegawai,
				'id_status_log'	=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'		=> $id_dasar_hukum
				);
			$id_log = $this->log_database->write_log($log_data);

			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Dasar Hukum baru berhasil ditambahkan");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Dasar Hukum baru gagal ditambahkan");
		}

		return redirect ('dasar_hukum');
	}

	public function edit_dasar_hukum($id)
	{
		$data_menu2 = $this->menu->get_menu2_dasar_hukum();
		$dasar_hukum = $this->dasar_hukum->get_dasar_hukum_by_id($id);

		$data = array(
			'data_menu2'	=> $data_menu2,
			'dasar_hukum'	=> $dasar_hukum
			);
		return $this->template->load_view('form', 'edit_dasar_hukum', $data);
	}

	public function update_dasar_hukum()
	{
		$input = $this->input->post();
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
		$id_dasar_hukum = $input['id_edit'];

		$data = array(
			'id_dasar_hukum'			=> $id_dasar_hukum,
			'kode_dasar_hukum'			=> $input['kode_dasar_hukum_edit'],
			'nama_sub_jenis_sertifikat'	=> $input['nama_sub_jenis_sertifikat'],
			'keterangan_dasar_hukum'	=> $input['keterangan_edit'],
			'dibuat_oleh'				=> $id_pegawai,
			'id_menu2'					=> $input['menu2_edit']
			);
		$result = $this->dasar_hukum->update_dasar_hukum($data);

		if ($result)
		{
			$log_data = array(
				'nama_tabel'	=> "dasar_hukum",
				'id_pegawai'	=> $id_pegawai,
				'id_status_log'	=> $this->status->get_id_status_by_nama("melakukan edit"),
				'id_data'		=> $id_dasar_hukum
				);
			$id_log = $this->log_database->write_log($log_data);

			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Dasar Hukum baru berhasil di-update");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Dasar Hukum baru gagal di-update");
		}

		return redirect ('dasar_hukum');
	}

	public function delete_dasar_hukum()
	{
		$input = $this->input->post();
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
		$id_dasar_hukum = $input['id_delete'];

		$data_dasar_hukum = $this->dasar_hukum->get_dasar_hukum_by_id($id_dasar_hukum);
		$json_data = json_encode($data_dasar_hukum);

		$log_data = array(
			'nama_tabel'				=> "dasar_hukum",
			'json_data_before_delete'	=> $json_data,
			'id_pegawai'				=> $id_pegawai,
			'id_status_log'				=> $this->status->get_id_status_by_nama("melakukan delete"),
			'id_data'					=> $id_dasar_hukum
			);
		$id_log = $this->log_database->write_log($log_data);
		
		$result = $this->dasar_hukum->delete_dasar_hukum($id_dasar_hukum);

		if ($result) 
		{
			$this->authentifier->set_flashdata('error_code', 1);	// Delete berhasil
			$this->authentifier->set_flashdata('error_msg', "Data Dasar Hukum berhasil dihapus");
		}
		else
		{
			$this->log_database->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error_code', 2);	// Delete gagal
			$this->authentifier->set_flashdata('error_msg', "Data Dasar Hukum gagal dihapus");
		}

		return redirect ('dasar_hukum');
	}

}
