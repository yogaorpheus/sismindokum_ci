<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawaicontroller extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		
		$this->load->library('authentifier');
		$this->load->library('template');

		$this->load->model('pegawai');
	}

	public function index()
	{
		$kode_distrik_pegawai = $this->authentifier->get_user_detail()['kode_distrik_pegawai'];

		if ($kode_distrik_pegawai == 'Z')
		{
			$data_pegawai = $this->pegawai->get_all_pegawai();
		}
		else
		{
			$data_pegawai = $this->pegawai->get_all_pegawai($kode_distrik_pegawai);
		}

		$data = array(
			'data_pegawai'	=> $data_pegawai
			);

		return $this->template->load_view('data', 'pegawai', $data);
	}

}
