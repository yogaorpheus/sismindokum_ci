<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat extends CI_Model {

	public function __construct() 
	{
		parent::__construct();
		$this->load->database();
	}

	// METHOD BERIKUT DIGUNAKAN UNTUK MENGAMBIL DATA SEMUA SERTIFIKAT TERGANTUNG PADA JENISNYA
	public function get_data_sertifikat($nama_jenis_sertif, $kode_distrik)
	{
		$this->db->where('nama_jenis_sertifikat', $nama_jenis_sertif);
		$id_jenis_sertifikat = $this->db->get('jenis_sertifikat')->row_array()['id_jenis_sertifikat'];

		$this->db->where('nama_status', 'Selesai');
		$this->db->where('penggunaan_tabel_status', 'sertifikat');
		$id_status_selesai = $this->db->get('status')->row_array()['id_status'];

		$this->db->where('nama_status', 'Dihapus');
		$this->db->where('penggunaan_tabel_status', 'sertifikat');
		$id_status_dihapus = $this->db->get('status')->row_array()['id_status'];

		$this->db->where('kode_distrik', $kode_distrik);
		$id_distrik = $this->db->get('distrik')->row_array()['id_distrik'];

		//$this->db->select('sertifikat.*, status.nama_status');
		$this->db->where('status_sertifikat !=', $id_status_selesai);
		$this->db->where('status_sertifikat !=', $id_status_dihapus);
		$this->db->where('sertifikat.id_jenis_sertifikat', $id_jenis_sertifikat);
		$this->db->join('status', 'status.id_status = sertifikat.status_sertifikat', 'inner');
		$this->db->join('lembaga', 'lembaga.id_lembaga = sertifikat.id_lembaga_sertifikat', 'left');
		
		if ($id_jenis_sertifikat == 1 || $id_jenis_sertifikat == 3 || $id_jenis_sertifikat == 4)
		{
			$this->db->join('sub_jenis_sertifikat', 'sub_jenis_sertifikat.id_sub_jenis_sertifikat = sertifikat.id_sub_jenis_sertifikat', 'left');
		}
		else if ($id_jenis_sertifikat == 2)
		{
			$this->db->join('unit', 'unit.id_unit = sertifikat.id_unit_sertifikat', 'left');
		}

		if ($kode_distrik != 'Z')
		{
			$this->db->where('sertifikat.id_distrik_sertifikat', $id_distrik);
		}

		$this->db->join('distrik', 'distrik.id_distrik = sertifikat.id_distrik_sertifikat', 'inner');
		$query = $this->db->get('sertifikat');

		return $query->result_array();
	}

	public function get_sertifikat_by_id($id, $nama_jenis_sertif = null)
	{
		if (!is_null($nama_jenis_sertif))
		{
			$this->db->where('nama_jenis_sertifikat', $nama_jenis_sertif);
			$id_jenis_sertifikat = $this->db->get('jenis_sertifikat')->row_array()['id_jenis_sertifikat'];
		}

		$this->db->where('id_sertifikat', $id);
		
		if (!is_null($nama_jenis_sertif))
			$this->db->where('id_jenis_sertifikat', $id_jenis_sertifikat);

		$this->db->join('status', 'status.id_status = sertifikat.status_sertifikat', 'inner');
		$query = $this->db->get('sertifikat');

		return $query->row_array();
	}

	public function get_one_sertifikat_lengkap_by_id($id)
	{
		$this->db->select('sertifikat.*, status.nama_status, pegawai.nama_lengkap_pegawai, dasar_hukum.kode_dasar_hukum, dasar_hukum.keterangan_dasar_hukum, lembaga.nama_lembaga, jenis_sertifikat.nama_jenis_sertifikat, sub_jenis_sertifikat.nama_sub_jenis_sertifikat, unit.nama_unit, distrik.nama_distrik');
		$this->db->where('id_sertifikat', $id);
		$this->db->join('status', 'status.id_status = sertifikat.status_sertifikat', 'inner');
		$this->db->join('distrik', 'distrik.id_distrik = sertifikat.id_distrik_sertifikat', 'inner');
		$this->db->join('pegawai', 'pegawai.id_pegawai = sertifikat.dibuat_oleh', 'left');
		$this->db->join('dasar_hukum', 'dasar_hukum.id_dasar_hukum = sertifikat.id_dasar_hukum_sertifikat', 'left');
		$this->db->join('lembaga', 'lembaga.id_lembaga = sertifikat.id_lembaga_sertifikat', 'left');
		$this->db->join('jenis_sertifikat', 'jenis_sertifikat.id_jenis_sertifikat = sertifikat.id_jenis_sertifikat', 'left');
		$this->db->join('sub_jenis_sertifikat', 'sub_jenis_sertifikat.id_sub_jenis_sertifikat = sertifikat.id_sub_jenis_sertifikat', 'left');
		$this->db->join('unit', 'unit.id_unit = sertifikat.id_unit_sertifikat', 'left');

		$query = $this->db->get('sertifikat');

		return $query->row_array();
	}

	public function get_id_sertifikat_latest_by_user($id_pegawai)
	{
		$this->db->where('dibuat_oleh', $id_pegawai);
		$this->db->order_by('id_sertifikat', 'DESC');
		$this->db->limit(1);
		$id_sertifikat = $this->db->get('sertifikat')->row_array()['id_sertifikat'];

		return $id_sertifikat;
	}

	public function get_all_sertifikat_lama($nama_sertifikat, $kode_distrik)
	{
		$this->db->where('nama_jenis_sertifikat', $nama_sertifikat);
		$id_jenis_sertifikat = $this->db->get('jenis_sertifikat')->row_array()['id_jenis_sertifikat'];

		$this->db->where('nama_status', 'Selesai');
		$this->db->where('penggunaan_tabel_status', 'sertifikat');
		$id_status = $this->db->get('status')->row_array()['id_status'];

		$this->db->where('kode_distrik', $kode_distrik);
		$id_distrik = $this->db->get('distrik')->row_array()['id_distrik'];

		$this->db->where('sertifikat.id_jenis_sertifikat', $id_jenis_sertifikat);
		$this->db->where('status_sertifikat', $id_status);
		$this->db->join('status', 'status.id_status = sertifikat.status_sertifikat', 'inner');
		$this->db->join('lembaga', 'lembaga.id_lembaga = sertifikat.id_lembaga_sertifikat', 'left');

		if ($id_jenis_sertifikat == 1 || $id_jenis_sertifikat == 3 || $id_jenis_sertifikat == 4)
		{
			$this->db->join('sub_jenis_sertifikat', 'sub_jenis_sertifikat.id_sub_jenis_sertifikat = sertifikat.id_sub_jenis_sertifikat', 'left');
		}
		else if ($id_jenis_sertifikat == 2)
		{
			$this->db->join('unit', 'unit.id_unit = sertifikat.id_unit_sertifikat', 'left');
		}

		if ($kode_distrik != 'Z')
		{
			$this->db->where('sertifikat.id_distrik_sertifikat', $id_distrik);
		}

		$this->db->join('distrik', 'distrik.id_distrik = sertifikat.id_distrik_sertifikat', 'inner');
		$query = $this->db->get('sertifikat');

		return $query->result_array();
	}

	public function get_jumlah_sertifikat_by_nama_jenis($nama_sertifikat, $kode_distrik_pegawai)
	{
		$this->db->where('nama_jenis_sertifikat', $nama_sertifikat);
		$id_jenis_sertifikat = $this->db->get('jenis_sertifikat')->row_array()['id_jenis_sertifikat'];

		$this->db->where('kode_distrik', $kode_distrik_pegawai);
		$id_distrik = $this->db->get('distrik')->row_array()['id_distrik'];

		$main_query = "";
		$main_query .= "SELECT COUNT(s.id_sertifikat) AS value, status.nama_status AS label\n";
		
		$inner_query = "SELECT id_sertifikat, status_sertifikat\n";
		$inner_query .= "FROM sertifikat WHERE id_jenis_sertifikat = ".$id_jenis_sertifikat;
		if ($kode_distrik_pegawai != 'Z')
			$inner_query .= " AND id_distrik_sertifikat = ".$id_distrik;

		$main_query .= "FROM (".$inner_query.")s\n";
		$main_query .= "RIGHT JOIN status ON s.status_sertifikat = status.id_status\n";
		$main_query .= "WHERE status.penggunaan_tabel_status = 'sertifikat'";
		$main_query .= "GROUP BY status.nama_status\n";
		$main_query .= "ORDER BY status.id_status";

		$query = $this->db->query($main_query);

		return $query->result_array();
	}

	public function delete_sertifikat_by_id($id_sertif, $id_jenis_sertif)
	{
		$this->db->where('nama_status', "Dihapus");
		$this->db->where('penggunaan_tabel_status', "sertifikat");
		$id_status_dihapus = $this->db->get('status')->row_array()['id_status'];

		$data = array(
			'status_sertifikat'	=> $id_status_dihapus
			);
		$this->db->where('id_sertifikat', $id_sertif);
		$this->db->where('id_jenis_sertifikat', $id_jenis_sertif);
		$this->db->set($data);
		$query = $this->db->update('sertifikat');

		return $query;
	}

	public function update_data_sertifikat($data)
	{
		$this->db->where('id_sertifikat', $data['id_sertifikat']);
		$this->db->set($data);
		$query = $this->db->update('sertifikat');

		return $query;
	}

	public function tambah_data_pertanahan($data)
	{
		$query = $this->db->insert('sertifikat', $data);

		return $query;
	}

	public function tambah_data_lisensi($data)
	{
		$query = $this->db->insert('sertifikat', $data);

		return $query;
	}

	public function tambah_data_pengujian_alat_k3($data)
	{
		$query = $this->db->insert('sertifikat', $data);

		return $query;
	}

	public function tambah_data_perizinan($data)
	{
		$query = $this->db->insert('sertifikat', $data);

		return $query;
	}

	public function tambah_data_slo($data)
	{
		$query = $this->db->insert('sertifikat', $data);

		return $query;
	}

	public function get_selisih_tanggal($id_sertifikat)
	{
		$query = $this->db->query(
			"SELECT DATEDIFF(tanggal_kadaluarsa, now()) AS selisih_tanggal
			FROM sertifikat
			WHERE sertifikat.id_sertifikat = ".$id_sertifikat
			);

		$selisih_tanggal = $query->row_array()['selisih_tanggal'];
		return $selisih_tanggal;
	}

}
