<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reminder_Data extends CI_Controller {
	
	public function __construct() 
	{
		parent::__construct();

		$this->load->model('sertifikat');
	}

	public function sertifikat()
	{
		$data_sertifikat = $this->sertifikat->get_alarmed_dan_expired_sertifikat_dan_pic();

		echo "<table border='1'>";
		echo "<tr>";
		echo "<th>No.</th>";
		echo "<th>Jenis Sertifikat</th>";
		echo "<th>Nomor Sertifikat</th>";
		echo "<th>Status</th>";
		echo "<th>Tanggal Expired</th>";
		echo "<th>Reminder</th>";
		echo "<th>Nama PIC</th>";
		echo "<th>Email PIC</th>";
		echo "<th>Jabatan PIC</th>";
		echo "<th>Distrik</th>";
		echo "</tr>";

		$no = 1;
		foreach ($data_sertifikat as $key => $onedata) {
			echo "<tr>";
			echo "<td>".$no++."</td>";
			echo "<td>".$onedata['nama_jenis_sertifikat']."</td>";
			echo "<td>".$onedata['no_sertifikat']."</td>";
			echo "<td>".$onedata['nama_status']."</td>";
			echo "<td>".$onedata['tanggal_kadaluarsa']."</td>";
			echo "<td>".$onedata['nama_remainder']."</td>";
			echo "<td>".$onedata['nama_lengkap_pegawai']."</td>";
			echo "<td>".$onedata['email_pegawai']."</td>";
			echo "<td>".$onedata['jabatan_pic']."</td>";
			echo "<td>".$onedata['nama_distrik']."</td>";
			echo "</tr>";

			// $send_to = $onedata['email_pegawai'];
			// $subject = "Notifikasi Aplikasi Sistem Informasi Monitoring Dokumen Hukum PJB Surabaya";
			// $message = "Sertifikat dengan nomor ".$onedata['no_sertifikat']." dan jenis ".$onedata['nama_jenis_sertifikat']. "\n";

			// if ($onedata['nama_status'] == "Alarm")
			// 	$message .= "akan segera berakhir dalam jangka waktu remainder yang sudah anda tentukan.\n";
			// else if ($onedata['nama_status'] == "Kadaluarsa")
			// 	$message .= "sudah berakhir dan melewati jangka waktu remainder yang sudah anda tentukan.\n";

			// $message .= "Adapun masa berakhir sertifikat yaitu pada ".$onedata['tanggal_kadaluarsa']."\n";
			// $message .= "Demikian surat ini kami buat.\n\nAdministrator.";

			// $headers = array(
			// 	'From'	=> 'admin_sismindokum@ptpjb.com',
			// 	'Reply-To'	=> 'admin_sismindokum@ptpjb.com',
			// 	'X-Mailer'	=> 'PHP/' . phpversion()
			// 	);

			// mail($send_to, $subject, $message, $headers);
		}

		echo "</table>";
	}
}
