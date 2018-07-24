<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		print_r(get_loaded_extensions());
	}

	public function testtest()
	{
		$this->load->model('ellipse');

		var_dump($this->ellipse->load_sdm());
		//phpinfo();
	}

	public function test()
	{
		$string = "PengUjian Alat K3";
		$lowercase = strtolower($string);
		$result = str_replace(" ", "_", $lowercase);

		echo $result;
	}

	public function kirim_email()
	{
		$this->load->library('email');
		$config = array(
			'protocol'		=> 'smtp',
			'smtp_host'		=> 'ssl://smtp.googlemail.com',
			'smtp_port'		=> 465,
			'smtp_user'		=> 'user_email',
			'smtp_pass'		=> 'user_password',
			'mailtype'		=> 'html',
			'charset'		=> 'utf-8'
			);
		$this->email->initialize($config);
		$this->email->set_mailtype("html");
		$this->email->set_newline("\r\n");

		$email_content = '<h1>Test Email</h1><p>Ini adalah email dari admin sismindokum</p>';
		
		$this->email->from('admin@sismindokum.com', 'Admin Sismindokum');
		$this->email->to('penerima@contoh.com');

		$this->email->subject('Test Kirim Email');
		$this->email->message($email_content);

		$test = $this->email->send();

		if ($test)
		{
			echo "Berhasil terkirim";
		}
		else {
			echo "Tidak berhasil dikirim";
		}
	}
}