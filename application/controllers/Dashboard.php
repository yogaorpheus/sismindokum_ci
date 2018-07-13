<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
		$this->load->model('jenis_sertifikat');
		$this->load->library('template');
		$this->load->library('authentifier');
		$this->authentifier->session_check();
	}

	public function load_dashboard1()
	{
		$menu_opened['menu'] = $this->jenis_sertifikat->buka_sertifikat(0);

		$this->load->view('dashboard/head');
		$this->load->view('dashboard/header_page');
		$this->load->view('dashboard/sidebar', $menu_opened);
		$this->load->view('dashboard/content');
		$this->load->view('dashboard/footer');
		$this->load->view('dashboard/control_sidebar');
		$this->load->view('dashboard/script_closure');
	}

	public function load_dashboard2()
	{
		$this->load->view('dashboard2/head');
		$this->load->view('dashboard2/header_page');
		$this->load->view('dashboard2/sidebar');
		$this->load->view('dashboard2/content');
		$this->load->view('dashboard2/footer');
		$this->load->view('dashboard2/control_sidebar');
		$this->load->view('dashboard2/script_closure');
	}

	public function load_dashboard($id_posisi_bidang)
	{
		$data['test'] = array();
		// $this->template->load_view($kode_bidang, 'dashboard', 'content', $data);
		$this->template->load_view($id_posisi_bidang, 'dashboard2', 'content');
	}

	public function index()
	{
		$this->template->load_view('dashboard2', 'content');
	}
}
