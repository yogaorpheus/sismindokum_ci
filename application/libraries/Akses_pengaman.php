<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Akses_pengaman
{
	private var $ci;

	public function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('session');

		$this->is_validated();
	}

	private function is_validated()
	{
		if (! $this->ci->session->has_userdata('staff_pjb'))
			redirect ('home');
	}

}
?>