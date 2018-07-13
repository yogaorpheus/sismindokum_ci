<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat_data extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		
		$this->load->library('authentifier');

		$this->load->model('sertifikat')
	}

	// BERIKUT ADALAH METHOD YANG AKAN DIGUNAKAN UNTUK MENAMBAH DATA PADA SETIAP SERTIFIKAT
	public function tambah_pertanahan()
	{
		$input = $this->input->post();
	}
}
