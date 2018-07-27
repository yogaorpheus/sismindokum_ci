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

	public function update_lembaga_sertif_sdm()
	{
		$this->load->model('sdm');
		$this->load->model('pegawai');

		$query = $this->sdm->get_old_data_lembaga_sdm();

		$data = array();
		$count = 1;
		foreach ($query as $key => $one_data) {
			$data['id_lembaga'] = $one_data['id_lembaga'];
			$data['id_pegawai'] = $this->pegawai->get_id_pegawai_by_nid($one_data['nid']);
			$data['kode_sertifikasi'] = $one_data['kode_sertifikasi'];

			$result = $this->sdm->update_lembaga_sdm($data);
			if ($result)
				echo "Data ".$count++." - Berhasil Dimasukkan<br>";
			else
				echo "Data ".$count++." - Gagal Dimasukkan<br><br>";
		}
	}

	public function test()
	{
		$string = "Namaku Yoga Samudra";
		echo $string;
		echo "<br><br>";
		echo "hilangin 4 karakter dari belakang";
		echo "<br><br>";

		$string = substr($string, 0, -4);
		echo $string;
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