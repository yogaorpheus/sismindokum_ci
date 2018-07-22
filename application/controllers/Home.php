<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->library('authentifier');
		$this->load->library('template');
	}

	public function home()
	{
		$this->authentifier->session_check();
		$this->template->load_view('home', 'home');
	}

	public function index()
	{
		$this->load->view('login');
	}

	public function test()
	{
		$this->load->view('testing');
	}

}
