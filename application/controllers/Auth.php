<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		//Example : $this->load->model('model_name');
		$this->load->helper(array('html', 'form', 'url'));
		$this->load->library('form_validation', 'session');
		$this->load->library('authentifier');
	}

	public function login()
	{
		$errors = array_filter($_POST);
		// print_r($errors);
		// die();

		if (!empty($errors))
		{
			$this->form_validation->set_rules('nid', 'NID', 'trim|required|xss_clean');
			$this->form_validation->set_rules('pass', 'Password', 'trim|required|xss_clean');

			if ($this->form_validation->run() == true)
			{
				$this->session->set_flashdata('error', 1);
				$this->session->set_flashdata('error_message', "Input NID atau Password masih kosong");
				// Error 1 adalah Kesalahan Melakukan Login dimana ada NID atau Password yang belum diisi dan entah bagaimana bisa lolos
				redirect ('home');
			}
			else
			{
				$userdata = array(
					'nid' => $this->input->post('nid'),
					'password' => $this->input->post('pass')
					);

				// $usercheck = file_get_contents('http://login.ptpjb.com/ldap_api/auth_opendj/'.$userdata['nid'].'/'.$userdata['password']);
				// $usercheck = json_decode($usercheck);
				
				// if ($usercheck->valid)
				if ($userdata['password'] == "123")
				{
					$login_validation = $this->authentifier->login($userdata['nid']);
					// Lolos login sebagai pegawai PJB dengan ellipse
					// Cek di database apakah punya izin mengakses aplikasi
					if ($login_validation)
					{
						// var_dump($this->authentifier->get_user_detail());
						// die();
						redirect ('dashboard');
					}
					else
					{
						$this->session->set_flashdata('error', 3);
						$this->session->set_flashdata('error_message', "Anda tidak punya hak akses pada aplikasi");
						// Error 3 adalah Kesalahan dimana User yang masuk adalah staff PJB, tapi tidak memiliki hak akses masuk ke aplikasi
						redirect ('home');
					}
				}
				else
				{
					$this->session->set_flashdata('error', 2);
					$this->session->set_flashdata('error_message', "NID dan Password tidak terdaftar sebagai karyawan PJB");
					// Error 2 adalah Kesalahan dimana User Login tidak memiliki kecocokan username atau password sebagai staff PJB
					redirect ('home');
				}
			}
		}

		redirect ('home');
	}

	public function logout()
	{
		$this->authentifier->logout();
		return redirect ('/');
	}

}
