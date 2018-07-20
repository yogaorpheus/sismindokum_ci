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

		$test = localtime();
		print_r($test);
		die();
	}

	public function test()
	{
		$string = "PengUjian Alat K3";
		$lowercase = strtolower($string);
		$result = str_replace(" ", "_", $lowercase);

		echo $result;
	}

	public function tester()
	{
		$data = array();

		$data[0] = array(
			'nama_data'		=> "data-nol",
			'data1'			=> array()
			);
		$data[2] = array(
			'nama_data'		=> "data-dua"
			);
		$data[5] = array(
			'nama_data'		=> "data-lima",
			'data1'			=> array(),
			'data2'			=> array()
			);
		$data[6] = array('nama_data'	=> "data-enam"
			);

		$data[0]['data1'][0]['nama_data'] = "data-nol-inside-nol";
		$data[5]['data1'][0]['nama_data'] = "data-lima-inside-nol";
		$data[5]['data2'][1]['nama_data'] = "data-lima-inside-satu";

		foreach ($data as $key => $value) {
			echo "data-".$key." : ".$value['nama_data'];
			echo "</br>";

			if (isset($value['data1']))
			{
				foreach ($value['data1'] as $key1 => $value1) {
					echo "\tdata-in-".$key1." : ".$value1['nama_data'];
					echo "</br>";
				}
			}

			if (isset($value['data2']))
			{
				foreach ($value['data2'] as $key1 => $value1) {
					echo "\tdata-in-".$key1." : ".$value1['nama_data'];
					echo "</br>";
				}
			}
		}
		echo "</br>";

		$this->load->model('hak_akses');
		$menu1 = $this->hak_akses->get_all_menu_utama();
		$menu2 = $this->hak_akses->get_all_sub_menu_utama();

		print_r($menu1);
		echo "</br>";
		print_r($menu2);
		echo "</br></br>";

		$stress = array();

		$stress[0][1] = "this one stress here!";
		$stress[0][3] = "shit, someone caught me!";
		$stress[1][0] = "oh my stress!!!";
		$stress[1][2] = "this one almost got stressed out";
		$stress[2][0] = "this one not stress";
		$stress[2][2] = "i am normal now";
		

		foreach ($stress as $key => $value) {
			echo "Stress out : ".$key."</br>";
			foreach ($value as $key1 => $value1) {
				echo "Stress in : ".$key1;
				echo "</br>";
				echo $value1."</br>";
			}
			echo "</br>";
		}

		$stress[0]['nama_stress'] = "HUMILIATED STRESS";
		$stress[2]['nama_stress'] = "REALLY STRESSED OUT!";
		$stress[2][null][0] = "Yippeee";

		$tester[null][0] = "Muster your Courage";
		$tester[null][1] = null;

		print_r($stress);
		echo "</br></br>";

		if (is_array($tester)) {
			echo "Percobaan 1 - variabel tester adalah ARRAY</br>";

			if (is_null($tester)) {
				echo "Percobaan 2 - variabel tester bernilai NULL</br>";
			}

			if (empty($tester)) {
				echo "Percobaan 3 - variabel tester kosong (EMPTY)</br>";
			}

			if (isset($tester[null])) {
				echo "Percobaan 4 - variabel tester[null] ada</br>";
			}

			if (isset($tester[null][null])) {
				echo "Percobaan 5 - variabel tester[null][null] ada</br>";
			}

			$array_length = count($tester);
			echo "Panjang Array adalah : ".$array_length."</br>";
		}
		echo "</br>";

		foreach ($tester as $key => $value) {
			echo "Key : ".$key."</br>";
			foreach ($value as $key1 => $value1) {
				echo "Key added : ".$key1."</br>";
				echo $value1."</br>";
			}
		}

		print_r($tester);
	}
}
