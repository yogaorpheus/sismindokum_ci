<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template 
{
	var $ci;

	function __construct()
	{
		$this->ci =& get_instance();
		$this->ci->load->library('authentifier');
	}

	function load_view($bodyContentFolder, $bodyContentFile=null, $data=array())
	{
		$data['menu'] = $this->ci->authentifier->get_menu_aktif();
		$data['menu_tampil'] = $this->ci->authentifier->get_menu_aktif()['menu_tampil'];
		$data['menu_utama'] = $this->ci->authentifier->get_menu_aktif()['menu_utama'];
		$data['sub_menu'] = $this->ci->authentifier->get_menu_aktif()['sub_menu'];
		$data['menu_crud'] = $this->ci->authentifier->get_menu_aktif()['menu_crud'];
		$data['user'] = $this->ci->authentifier->get_user_detail();
		$data['head']['head'] = $bodyContentFolder;

		if (!is_null($bodyContentFile))
		{
			$bodyContentFile = $this->ci->load->view($bodyContentFolder.'/'.$bodyContentFile, $data, TRUE);
		}
		else
		{
			$bodyContentFile = null;
		}

		if (is_null($data))
		{
			$data = array('body' => array('body' => $bodyContentFile));
		}
		else if (is_array($data))
		{
			$data['body']['body'] = $bodyContentFile;
		}

		// $data['body'] seharusnya menyimpan semua data terkait yang akan ditampilkan dalam konten
		// kemudian menggunakan sebuah halaman view yang hanya dikhususkan untuk satu template pada semua konten
		
		// Templating menggunakan view
		$this->ci->load->view('dashboard2/outer', $data);

		// Templating bukan di view, tapi di library
		// $data['menu'] = $this->ci->bidang_sertifikat->filter_by_bidang($kode_bidang);
		// $this->ci->load->view('dashboard/head');
		// $this->ci->load->view('dashboard/header_page');
		// $this->ci->load->view('dashboard/sidebar', $data);
		// $this->ci->load->view('dashboard/content');
		// $this->ci->load->view('dashboard/footer');
		// $this->ci->load->view('dashboard/control_sidebar');
		// $this->ci->load->view('dashboard/script_closure');
	}
}

?>