<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unitcontroller extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
		$this->load->library('authentifier');
		$this->load->library('template');

		$this->load->model('unit');
		$this->load->model('status');
		$this->load->model('distrik');
		$this->load->model('log_database');
	}

	public function index()
	{
		$data = array();

		$kode_distrik_pegawai = $this->authentifier->get_user_detail()['kode_distrik_pegawai'];
		$id_distrik = $this->distrik->get_id_distrik_by_kode ($kode_distrik_pegawai);

		if ($kode_distrik_pegawai == 'Z')
		{
			$jenis_distrik = $this->distrik->get_all_distrik();
			$data_unit = $this->unit->get_all_detailed_unit();
			$data['distrik'] = $jenis_distrik;
		}
		else
			$data_unit = $this->unit->get_all_detailed_unit($id_distrik);
		
		$data['data_unit'] = $data_unit;
		
		return $this->template->load_view('data', 'unit', $data);
	}

	public function tambah_unit()
	{
		$data_distrik = $this->distrik->get_all_distrik();

		$data = array(
			'data_distrik'	=> $data_distrik
			);
		return $this->template->load_view('form', 'unit', $data);
	}

	public function insert_unit()
	{
		$input = $this->input->post();
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];

		$data = array(
			'nama_unit'			=> $input['nama'],
			'id_distrik_unit'	=> $input['distrik'],
			'dibuat_oleh'		=> $id_pegawai
			);
		$result = $this->unit->insert_new_unit($data);

		if ($result)
		{
			$id_unit = $this->unit->get_id_unit_terbaru_by_pembuat($id_pegawai);

			$log_data = array(
				'nama_tabel'	=> "unit",
				'id_pegawai'	=> $id_pegawai,
				'id_status_log'	=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'		=> $id_unit
				);
			$id_log = $this->log_database->write_log($log_data);

			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Unit baru berhasil ditambahkan");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Unit baru gagal ditambahkan");
		}

		return redirect ('unit');
	}

	public function edit_unit($id_unit)
	{
		$data_unit = $this->unit->get_unit_by_id_unit($id_unit);
		$data_distrik = $this->distrik->get_all_distrik();

		$data = array(
			'data_unit'		=> $data_unit,
			'data_distrik'	=> $data_distrik
			);
		return $this->template->load_view('form', 'edit_unit', $data);
	}

	public function update_unit()
	{
		$input = $this->input->post();
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
		$id_unit = $input['id'];

		$data = array(
			'id_unit'			=> $id_unit,
			'nama_unit'			=> $input['nama'],
			'id_distrik_unit'	=> $input['distrik'],
			'dibuat_oleh'		=> $id_pegawai
			);
		$result = $this->unit->update_unit($data);

		if ($result)
		{
			$log_data = array(
				'nama_tabel'	=> "unit",
				'id_pegawai'	=> $id_pegawai,
				'id_status_log'	=> $this->status->get_id_status_by_nama("melakukan edit"),
				'id_data'		=> $id_unit
				);
			$id_log = $this->log_database->write_log($log_data);

			$this->authentifier->set_flashdata('error_code', 1);
			$this->authentifier->set_flashdata('error_msg', "Unit baru berhasil di-update");
		}
		else
		{
			// Insert data gagal
			$this->authentifier->set_flashdata('error_code', 2);
			$this->authentifier->set_flashdata('error_msg', "Unit baru gagal di-update");
		}

		return redirect ('unit');
	}

	public function delete_unit()
	{
		$input = $this->input->post();
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
		$id_unit = $input['id'];

		$data_unit = $this->unit->get_unit_by_id_unit($id_unit);
		$json_data = json_encode($data_unit);

		$log_data = array(
			'nama_tabel'				=> "unit",
			'json_data_before_delete'	=> $json_data,
			'id_pegawai'				=> $id_pegawai,
			'id_status_log'				=> $this->status->get_id_status_by_nama("melakukan delete"),
			'id_data'					=> $id_unit
			);
		$id_log = $this->log_database->write_log($log_data);
		
		$result = $this->unit->delete_unit($id_unit);

		if ($result) 
		{
			$this->authentifier->set_flashdata('error_code', 1);	// Delete berhasil
			$this->authentifier->set_flashdata('error_msg', "Data Unit berhasil dihapus");
		}
		else
		{
			$this->log_database->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error_code', 2);	// Delete gagal
			$this->authentifier->set_flashdata('error_msg', "Data Unit gagal dihapus");
		}

		return redirect ('unit');
	}

}
