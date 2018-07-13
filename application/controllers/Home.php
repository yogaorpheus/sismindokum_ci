<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		//Example : $this->load->helper(array('html', 'form', etc));
	}

	public function home()
	{
		$data = array('login' => null);
		$this->load->view('login', $data);
	}

	public function test()
	{
		$this->load->view('testing');
	}

}
