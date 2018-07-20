<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LembagaController extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
		$this->load->library('authentifier');
		$this->load->library('template');

		$this->load->model('lembaga');
		$this->load->model('status');
		$this->load->model('log_database');
	}

	public function index()
	{
		$data_lembaga = $this->lembaga->get_all_detailed_lembaga();

		$data = array(
			'data_lembaga'	=> $data_lembaga
			);
		return $this->template->load_view('data', 'lembaga', $data);
	}

	public function tambah_lembaga()
	{
		return $this->template->load_view('form', 'lembaga');
	}

	public function insert_lembaga()
	{
		$input = $this->input->post();
		$id_status = $this->status->get_id_status_by_nama_status_dan_nama_tabel("Aktif", "Lembaga");
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];

		$data = array(
			'nama_lembaga'		=> $input['nama'],
			'alamat_lembaga'	=> $input['alamat'],
			'no_telp'			=> $input['no_telp'],
			'status_lembaga'	=> $id_status,
			'dibuat_oleh'		=> $id_pegawai
			);
		$result = $this->lembaga->insert_new_lembaga($data);

		if ($result)
		{
			$id_lembaga = $this->lembaga->get_id_lembaga_terbaru_by_pembuat($id_pegawai);

			$log_data = array(
				'nama_tabel'	=> "lembaga",
				'id_pegawai'	=> $id_pegawai,
				'id_status_log'	=> $this->status->get_id_status_by_nama("melakukan create"),
				'id_data'		=> $id_lembaga
				);
			$id_log = $this->log_database->write_log($log_data);

			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect ('lembaga');
	}

	public function edit_lembaga($id_lembaga)
	{
		$data_lembaga = $this->lembaga->get_lembaga_by_id_lembaga($id_lembaga);

		$data = array(
			'data_lembaga'	=> $data_lembaga
			);
		return $this->template->load_view('form', 'edit_lembaga', $data);
	}

	public function update_lembaga()
	{
		$input = $this->input->post();
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
		$id_lembaga = $input['id'];

		$data = array(
			'id_lembaga'		=> $input['id'],
			'nama_lembaga'		=> $input['nama'],
			'alamat_lembaga'	=> $input['alamat'],
			'no_telp'			=> $input['no_telp'],
			'dibuat_oleh'		=> $id_pegawai
			);
		$result = $this->lembaga->update_lembaga($data);

		if ($result)
		{
			$log_data = array(
				'nama_tabel'	=> "lembaga",
				'id_pegawai'	=> $id_pegawai,
				'id_status_log'	=> $this->status->get_id_status_by_nama("melakukan edit"),
				'id_data'		=> $id_lembaga
				);
			$id_log = $this->log_database->write_log($log_data);

			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect ('lembaga');
	}

	public function delete_lembaga()
	{
		$input = $this->input->post();
		$id_pegawai = $this->authentifier->get_user_detail()['id_pegawai'];
		$id_lembaga = $input['id'];

		$data_lembaga = $this->lembaga->get_lembaga_by_id_lembaga($input['id']);
		$json_data = json_encode($data_lembaga);

		$log_data = array(
			'nama_tabel'				=> "lembaga",
			'json_data_before_delete'	=> $json_data,
			'id_pegawai'				=> $id_pegawai,
			'id_status_log'				=> $this->status->get_id_status_by_nama("melakukan delete"),
			'id_data'					=> $id_lembaga
			);
		$id_log = $this->log_database->write_log($log_data);
		
		$result = $this->lembaga->delete_lembaga($input['id']);

		if ($result)
		{
			$this->authentifier->set_flashdata('error', 1);
		}
		else
		{
			$this->log_database->delete_log_by_id($id_log);
			$this->authentifier->set_flashdata('error', 2);
		}

		return redirect ('lembaga');
	}

}
