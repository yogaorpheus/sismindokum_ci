<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class DownloadExcel extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		
		$this->load->library('authentifier');
		$this->authentifier->session_check();

		$this->load->model('anggaran');
		$this->load->model('sertifikat');
		$this->load->model('sdm');
		$this->load->model('remark');
	}

	// private function pre_setting_excel($objSpreadsheet, $columnCount)
	// {
	// 	$objSpreadsheet->getProperties()->setCreator('YogaOcean - Administrator')
	// 	->setLastModifiedBy('YogaOcean - Administrator')
	// 	->setTitle('Test Excel Ocean');

	// 	$objSpreadsheet->setActiveSheetIndex(0)
	// 	->getStyle('A1:'.$columnCount.'1')->getFont()->setBold(true);

	// 	$objSpreadsheet->getActiveSheet()->getStyle('A1:'.$columnCount.'1')->getFill()->setFillType(Fill::FILL_SOLID);
	// 	$objSpreadsheet->getActiveSheet()->getStyle('A1:'.$columnCount.'1')->getFill()->getStartColor()->setARGB('FF40BCD8');

	// 	return $objSpreadsheet->getActiveSheet();
	// }

	// private function post_setting_excel($objSpreadsheet, $columnCount, $rowCount, $countColumn)
	// {
	// 	$styleArray = [
	// 	    'borders' => [
	// 	        'allBorders' => [
	// 	            'borderStyle' => Border::BORDER_THIN,
	// 	            'color' => ['argb' => '00000000'],
	// 	        ],
	// 	    ],
	// 	    'alignment' => [
	// 	        'horizontal' => Alignment::HORIZONTAL_LEFT,
	// 	        'vertical' => Alignment::VERTICAL_CENTER,
	// 	    ],
	// 	];

	// 	$objSpreadsheet->getActiveSheet()->getStyle('A1:'.$columnCount.--$rowCount)->applyFromArray($styleArray);
	// 	$objSpreadsheet->setActiveSheetIndex(0)
	// 	->getStyle('A1:'.$columnCount.'1')->getAlignment()
	// 	->setHorizontal(Alignment::HORIZONTAL_CENTER);

	// 	$column = 'A';
	// 	for ($count = 0; $count < $countColumn; $count++)
	// 	{
	// 		$objSpreadsheet->getActiveSheet()
	// 		->getColumnDimension($column)->setAutoSize(true);
	// 		$column++;
	// 	}

	// 	$objSpreadsheet->getActiveSheet()->setTitle('Report Excel');

	// 	return $objSpreadsheet->getActiveSheet();
	// }

	public function anggaran_dasar($nama_status)
	{
		$nama_status = str_replace("_", " ", $nama_status);
		$data = $this->anggaran->get_all_anggaran_by_status($nama_status);

		$objSpreadsheet = new Spreadsheet();

		$objSpreadsheet->getProperties()->setCreator('YogaOcean - Administrator')
		->setLastModifiedBy('YogaOcean - Administrator')
		->setTitle('Test Excel Ocean');

		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:K1')->getFont()->setBold(true);

		$styleArray = [
		    'borders' => [
		        'allBorders' => [
		            'borderStyle' => Border::BORDER_THIN,
		            'color' => ['argb' => '00000000'],
		        ],
		    ],
		    'alignment' => [
		        'horizontal' => Alignment::HORIZONTAL_LEFT,
		        'vertical' => Alignment::VERTICAL_CENTER,
		    ],
		];

		$objSpreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()->setFillType(Fill::FILL_SOLID);
		$objSpreadsheet->getActiveSheet()->getStyle('A1:K1')->getFill()->getStartColor()->setARGB('FF40BCD8');
		// $objSpreadsheet->setActiveSheetIndex(0) = $this->pre_setting_excel($objSpreadsheet, 'K');

		$objSpreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'No.')
		->setCellValue('B1', 'Tahun')
		->setCellValue('C1', 'Tanggal RUPS Sirkuler')
		->setCellValue('D1', 'No. Akta')
		->setCellValue('E1', 'Tanggal Akta')
		->setCellValue('F1', 'Nomor Penerimaan Kemenkumham')
		->setCellValue('G1', 'PIC')
		->setCellValue('H1', 'Status Anggaran')
		->setCellValue('I1', 'Status Remark')
		->setCellValue('J1', 'Keterangan Remark')
		->setCellValue('K1', 'Pembuat Remark');

		$no_cell = 2;
		$no_data = 1;
		foreach ($data as $key => $one_data) {
			$objSpreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$no_cell, $no_data++)
			->setCellValue('B'.$no_cell, $one_data['tahun_anggaran'])
			->setCellValue('C'.$no_cell, $one_data['tanggal_rups_sirkuler'])
			->setCellValue('D'.$no_cell, $one_data['no_akta_anggaran'])
			->setCellValue('E'.$no_cell, $one_data['tanggal_akta_anggaran'])
			->setCellValue('F'.$no_cell, $one_data['no_penerimaan_anggaran'])
			->setCellValue('G'.$no_cell, $one_data['jabatan_pic'])
			->setCellValue('H'.$no_cell, $one_data['nama_status']);

			$data_remark = $this->remark->get_remark_by_id_anggaran($one_data['id_anggaran']);
			$count_remark = count($data_remark)-1;
			$merge = $count_remark + $no_cell;

			if($count_remark > 0)
			{
				for ($count = 'A'; $count <= 'K'; $count++)
					$objSpreadsheet->getActiveSheet()->mergeCells($count.$no_cell.':'.$count.$merge);
			}

			foreach ($data_remark as $key => $one_remark) {
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue('I'.$no_cell, $one_remark['nama_status'])
				->setCellValue('J'.$no_cell, $one_remark['keterangan'])
				->setCellValue('K'.$no_cell, $one_remark['nama_lengkap_pegawai']);

				$no_cell++;
			}

			if (!is_null($data_remark) && !empty($data_remark))
				$no_cell -= 1;

			$no_cell++;
		}

		// $objSpreadsheet->setActiveSheetIndex(0) = $this->post_setting_excel($objSpreadsheet, 'K', $no_cell, 11);

		$objSpreadsheet->getActiveSheet()->getStyle('A1:K'.--$no_cell)->applyFromArray($styleArray);
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:K1')->getAlignment()
		->setHorizontal(Alignment::HORIZONTAL_CENTER);

		for ($count = 'A'; $count <= 'L'; $count++)
		{
			$objSpreadsheet->getActiveSheet()
			->getColumnDimension($count)->setAutoSize(true);
		}
		$objSpreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(40);
		$objSpreadsheet->getActiveSheet()->getStyle('J2:J'.$no_cell)->getAlignment()->setWrapText(true);

		$objSpreadsheet->getActiveSheet()->setTitle('Report Excel');
		$objSpreadsheet->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data Anggaran.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');

		// exit;
	}

	public function pertanahan($status = 1)
	{
		if ($status)
			$data = $this->sertifikat->get_data_sertifikat("pertanahan", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		else
			$data = $this->sertifikat->get_all_sertifikat_lama("pertanahan", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);

		$objSpreadsheet = new Spreadsheet();

		$objSpreadsheet->getProperties()->setCreator('YogaOcean - Administrator')
		->setLastModifiedBy('YogaOcean - Administrator')
		->setTitle('Test Excel Ocean');

		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:L1')->getFont()->setBold(true);

		$styleArray = [
		    'borders' => [
		        'allBorders' => [
		            'borderStyle' => Border::BORDER_THIN,
		            'color' => ['argb' => '00000000'],
		        ],
		    ],
		    'alignment' => [
		        'horizontal' => Alignment::HORIZONTAL_LEFT,
		        'vertical' => Alignment::VERTICAL_CENTER,
		    ],
		];

		$objSpreadsheet->getActiveSheet()->getStyle('A1:L1')->getFill()->setFillType(Fill::FILL_SOLID);
		$objSpreadsheet->getActiveSheet()->getStyle('A1:L1')->getFill()->getStartColor()->setARGB('FF40BCD8');

		$objSpreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'No.')
		->setCellValue('B1', 'Distrik')
		->setCellValue('C1', 'Jenis Sertifikat')
		->setCellValue('D1', 'No. Sertifikat')
		->setCellValue('E1', 'Lokasi Sertifikat')
		->setCellValue('F1', 'PIC')
		->setCellValue('G1', 'Tanggal Terbit')
		->setCellValue('H1', 'Tanggal Berakhir')
		->setCellValue('I1', 'Status Sertifikat')
		->setCellValue('J1', 'Status Remark')
		->setCellValue('K1', 'Keterangan Remark')
		->setCellValue('L1', 'Pembuat Remark');

		$no_cell = 2;
		$no_data = 1;
		foreach ($data as $key => $one_data) {
			$objSpreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$no_cell, $no_data++)
			->setCellValue('B'.$no_cell, $one_data['nama_distrik'])
			->setCellValue('C'.$no_cell, $one_data['nama_sub_jenis_sertifikat'])
			->setCellValue('D'.$no_cell, $one_data['no_sertifikat'])
			->setCellValue('E'.$no_cell, $one_data['judul_sertifikat'])
			->setCellValue('F'.$no_cell, $one_data['jabatan_pic'])
			->setCellValue('G'.$no_cell, $one_data['tanggal_sertifikasi'])
			->setCellValue('H'.$no_cell, $one_data['tanggal_kadaluarsa'])
			->setCellValue('I'.$no_cell, $one_data['nama_status']);

			$data_remark = $this->remark->get_remark_by_id_sertifikat($one_data['id_sertifikat']);
			$count_remark = count($data_remark)-1;
			$merge = $count_remark + $no_cell;

			if($count_remark > 0)
			{
				for ($count = 'A'; $count <= 'I'; $count++)
					$objSpreadsheet->getActiveSheet()->mergeCells($count.$no_cell.':'.$count.$merge);
			}

			foreach ($data_remark as $key => $one_remark) {
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue('J'.$no_cell, $one_remark['nama_status'])
				->setCellValue('K'.$no_cell, $one_remark['keterangan'])
				->setCellValue('L'.$no_cell, $one_remark['nama_lengkap_pegawai']);

				$no_cell++;
			}

			if (!is_null($data_remark) && !empty($data_remark))
				$no_cell -= 1;

			$no_cell++;
		}

		$objSpreadsheet->getActiveSheet()->getStyle('A1:L'.--$no_cell)->applyFromArray($styleArray);
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:L1')->getAlignment()
		->setHorizontal(Alignment::HORIZONTAL_CENTER);

		for ($count = 'A'; $count <= 'L'; $count++)
		{
			$objSpreadsheet->getActiveSheet()
			->getColumnDimension($count)->setAutoSize(true);
		}
		$objSpreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(40);
		$objSpreadsheet->getActiveSheet()->getStyle('K2:K'.$no_cell)->getAlignment()->setWrapText(true);

		$objSpreadsheet->getActiveSheet()->setTitle('Report Excel');
		$objSpreadsheet->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data Pertanahan.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');
	}

	public function slo($status = 1)
	{
		if ($status)
			$data = $this->sertifikat->get_data_sertifikat("slo", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		else
			$data = $this->sertifikat->get_all_sertifikat_lama("slo", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);

		$objSpreadsheet = new Spreadsheet();

		$objSpreadsheet->getProperties()->setCreator('YogaOcean - Administrator')
		->setLastModifiedBy('YogaOcean - Administrator')
		->setTitle('Test Excel Ocean');

		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:L1')->getFont()->setBold(true);

		$styleArray = [
		    'borders' => [
		        'allBorders' => [
		            'borderStyle' => Border::BORDER_THIN,
		            'color' => ['argb' => '00000000'],
		        ],
		    ],
		    'alignment' => [
		        'horizontal' => Alignment::HORIZONTAL_LEFT,
		        'vertical' => Alignment::VERTICAL_CENTER,
		    ],
		];

		$objSpreadsheet->getActiveSheet()->getStyle('A1:L1')->getFill()->setFillType(Fill::FILL_SOLID);
		$objSpreadsheet->getActiveSheet()->getStyle('A1:L1')->getFill()->getStartColor()->setARGB('FF40BCD8');

		$objSpreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'No.')
		->setCellValue('B1', 'Distrik')
		->setCellValue('C1', 'Unit Sertifikasi')
		->setCellValue('D1', 'No. Sertifikat')
		->setCellValue('E1', 'Lembaga')
		->setCellValue('F1', 'PIC')
		->setCellValue('G1', 'Tanggal Terbit')
		->setCellValue('H1', 'Tanggal Berakhir')
		->setCellValue('I1', 'Status Sertifikat')
		->setCellValue('J1', 'Status Remark')
		->setCellValue('K1', 'Keterangan Remark')
		->setCellValue('L1', 'Pembuat Remark');

		$no_cell = 2;
		$no_data = 1;
		foreach ($data as $key => $one_data) {
			$objSpreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$no_cell, $no_data++)
			->setCellValue('B'.$no_cell, $one_data['nama_distrik'])
			->setCellValue('C'.$no_cell, $one_data['nama_unit'])
			->setCellValue('D'.$no_cell, $one_data['no_sertifikat'])
			->setCellValue('E'.$no_cell, $one_data['nama_lembaga'])
			->setCellValue('F'.$no_cell, $one_data['jabatan_pic'])
			->setCellValue('G'.$no_cell, $one_data['tanggal_sertifikasi'])
			->setCellValue('H'.$no_cell, $one_data['tanggal_kadaluarsa'])
			->setCellValue('I'.$no_cell, $one_data['nama_status']);

			$data_remark = $this->remark->get_remark_by_id_sertifikat($one_data['id_sertifikat']);
			$count_remark = count($data_remark)-1;
			$merge = $count_remark + $no_cell;

			if($count_remark > 0)
			{
				for ($count = 'A'; $count <= 'I'; $count++)
					$objSpreadsheet->getActiveSheet()->mergeCells($count.$no_cell.':'.$count.$merge);
			}

			foreach ($data_remark as $key => $one_remark) {
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue('J'.$no_cell, $one_remark['nama_status'])
				->setCellValue('K'.$no_cell, $one_remark['keterangan'])
				->setCellValue('L'.$no_cell, $one_remark['nama_lengkap_pegawai']);

				$no_cell++;
			}

			if (!is_null($data_remark) && !empty($data_remark))
				$no_cell -= 1;

			$no_cell++;
		}

		$objSpreadsheet->getActiveSheet()->getStyle('A1:L'.--$no_cell)->applyFromArray($styleArray);
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:L1')->getAlignment()
		->setHorizontal(Alignment::HORIZONTAL_CENTER);

		for ($count = 'A'; $count <= 'L'; $count++)
		{
			$objSpreadsheet->getActiveSheet()
			->getColumnDimension($count)->setAutoSize(true);
		}
		$objSpreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(40);
		$objSpreadsheet->getActiveSheet()->getStyle('K2:K'.$no_cell)->getAlignment()->setWrapText(true);

		$objSpreadsheet->getActiveSheet()->setTitle('Report Excel');
		$objSpreadsheet->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data SLO.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');
	}

	public function perizinan($status = 1)
	{
		if ($status)
			$data = $this->sertifikat->get_data_sertifikat("perizinan", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		else
			$data = $this->sertifikat->get_all_sertifikat_lama("perizinan", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);

		$objSpreadsheet = new Spreadsheet();

		$objSpreadsheet->getProperties()->setCreator('YogaOcean - Administrator')
		->setLastModifiedBy('YogaOcean - Administrator')
		->setTitle('Test Excel Ocean');

		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:M1')->getFont()->setBold(true);

		$styleArray = [
		    'borders' => [
		        'allBorders' => [
		            'borderStyle' => Border::BORDER_THIN,
		            'color' => ['argb' => '00000000'],
		        ],
		    ],
		    'alignment' => [
		        'horizontal' => Alignment::HORIZONTAL_LEFT,
		        'vertical' => Alignment::VERTICAL_CENTER,
		    ],
		];

		$objSpreadsheet->getActiveSheet()->getStyle('A1:M1')->getFill()->setFillType(Fill::FILL_SOLID);
		$objSpreadsheet->getActiveSheet()->getStyle('A1:M1')->getFill()->getStartColor()->setARGB('FF40BCD8');

		$objSpreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'No.')
		->setCellValue('B1', 'Distrik')
		->setCellValue('C1', 'Jenis Perizinan')
		->setCellValue('D1', 'Peralatan')
		->setCellValue('E1', 'No. Sertifikat')
		->setCellValue('F1', 'Lembaga')
		->setCellValue('G1', 'PIC')
		->setCellValue('H1', 'Tanggal Terbit')
		->setCellValue('I1', 'Tanggal Berakhir')
		->setCellValue('J1', 'Status Sertifikat')
		->setCellValue('K1', 'Status Remark')
		->setCellValue('L1', 'Keterangan Remark')
		->setCellValue('M1', 'Pembuat Remark');

		$no_cell = 2;
		$no_data = 1;
		foreach ($data as $key => $one_data) {
			$objSpreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$no_cell, $no_data++)
			->setCellValue('B'.$no_cell, $one_data['nama_distrik'])
			->setCellValue('C'.$no_cell, $one_data['nama_sub_jenis_sertifikat'])
			->setCellValue('D'.$no_cell, $one_data['judul_sertifikat'])
			->setCellValue('E'.$no_cell, $one_data['no_sertifikat'])
			->setCellValue('F'.$no_cell, $one_data['nama_lembaga'])
			->setCellValue('G'.$no_cell, $one_data['jabatan_pic'])
			->setCellValue('H'.$no_cell, $one_data['tanggal_sertifikasi'])
			->setCellValue('I'.$no_cell, $one_data['tanggal_kadaluarsa'])
			->setCellValue('J'.$no_cell, $one_data['nama_status']);

			$data_remark = $this->remark->get_remark_by_id_sertifikat($one_data['id_sertifikat']);
			$count_remark = count($data_remark)-1;
			$merge = $count_remark + $no_cell;

			if($count_remark > 0)
			{
				for ($count = 'A'; $count <= 'J'; $count++)
					$objSpreadsheet->getActiveSheet()->mergeCells($count.$no_cell.':'.$count.$merge);
			}

			foreach ($data_remark as $key => $one_remark) {
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue('K'.$no_cell, $one_remark['nama_status'])
				->setCellValue('L'.$no_cell, $one_remark['keterangan'])
				->setCellValue('M'.$no_cell, $one_remark['nama_lengkap_pegawai']);

				$no_cell++;
			}

			if (!is_null($data_remark) && !empty($data_remark))
				$no_cell -= 1;

			$no_cell++;
		}

		$objSpreadsheet->getActiveSheet()->getStyle('A1:M'.--$no_cell)->applyFromArray($styleArray);
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:M1')->getAlignment()
		->setHorizontal(Alignment::HORIZONTAL_CENTER);

		for ($count = 'A'; $count <= 'M'; $count++)
		{
			$objSpreadsheet->getActiveSheet()
			->getColumnDimension($count)->setAutoSize(true);
		}
		$objSpreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(40);
		$objSpreadsheet->getActiveSheet()->getStyle('L2:L'.$no_cell)->getAlignment()->setWrapText(true);

		$objSpreadsheet->getActiveSheet()->setTitle('Report Excel');
		$objSpreadsheet->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data Perizinan.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');
	}

	public function pengujian($status = 1)
	{
		if ($status)
			$data = $this->sertifikat->get_data_sertifikat("pengujian alat k3", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		else
			$data = $this->sertifikat->get_all_sertifikat_lama("pengujian alat k3", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);

		$objSpreadsheet = new Spreadsheet();

		$objSpreadsheet->getProperties()->setCreator('YogaOcean - Administrator')
		->setLastModifiedBy('YogaOcean - Administrator')
		->setTitle('Test Excel Ocean');

		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:M1')->getFont()->setBold(true);

		$styleArray = [
		    'borders' => [
		        'allBorders' => [
		            'borderStyle' => Border::BORDER_THIN,
		            'color' => ['argb' => '00000000'],
		        ],
		    ],
		    'alignment' => [
		        'horizontal' => Alignment::HORIZONTAL_LEFT,
		        'vertical' => Alignment::VERTICAL_CENTER,
		    ],
		];

		$objSpreadsheet->getActiveSheet()->getStyle('A1:M1')->getFill()->setFillType(Fill::FILL_SOLID);
		$objSpreadsheet->getActiveSheet()->getStyle('A1:M1')->getFill()->getStartColor()->setARGB('FF40BCD8');

		$objSpreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'No.')
		->setCellValue('B1', 'Distrik')
		->setCellValue('C1', 'Jenis Pengujian')
		->setCellValue('D1', 'Peralatan')
		->setCellValue('E1', 'No. Pengujian')
		->setCellValue('F1', 'Lembaga')
		->setCellValue('G1', 'PIC')
		->setCellValue('H1', 'Tanggal Terbit')
		->setCellValue('I1', 'Tanggal Berakhir')
		->setCellValue('J1', 'Status Sertifikat')
		->setCellValue('K1', 'Status Remark')
		->setCellValue('L1', 'Keterangan Remark')
		->setCellValue('M1', 'Pembuat Remark');

		$no_cell = 2;
		$no_data = 1;
		foreach ($data as $key => $one_data) {
			$objSpreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$no_cell, $no_data++)
			->setCellValue('B'.$no_cell, $one_data['nama_distrik'])
			->setCellValue('C'.$no_cell, $one_data['nama_sub_jenis_sertifikat'])
			->setCellValue('D'.$no_cell, $one_data['judul_sertifikat'])
			->setCellValue('E'.$no_cell, $one_data['no_sertifikat'])
			->setCellValue('F'.$no_cell, $one_data['nama_lembaga'])
			->setCellValue('G'.$no_cell, $one_data['jabatan_pic'])
			->setCellValue('H'.$no_cell, $one_data['tanggal_sertifikasi'])
			->setCellValue('I'.$no_cell, $one_data['tanggal_kadaluarsa'])
			->setCellValue('J'.$no_cell, $one_data['nama_status']);

			$data_remark = $this->remark->get_remark_by_id_sertifikat($one_data['id_sertifikat']);
			$count_remark = count($data_remark)-1;
			$merge = $count_remark + $no_cell;

			if($count_remark > 0)
			{
				for ($count = 'A'; $count <= 'J'; $count++)
					$objSpreadsheet->getActiveSheet()->mergeCells($count.$no_cell.':'.$count.$merge);
			}

			foreach ($data_remark as $key => $one_remark) {
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue('K'.$no_cell, $one_remark['nama_status'])
				->setCellValue('L'.$no_cell, $one_remark['keterangan'])
				->setCellValue('M'.$no_cell, $one_remark['nama_lengkap_pegawai']);

				$no_cell++;
			}

			if (!is_null($data_remark) && !empty($data_remark))
				$no_cell -= 1;

			$no_cell++;
		}

		$objSpreadsheet->getActiveSheet()->getStyle('A1:M'.--$no_cell)->applyFromArray($styleArray);
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:M1')->getAlignment()
		->setHorizontal(Alignment::HORIZONTAL_CENTER);

		for ($count = 'A'; $count <= 'M'; $count++)
		{
			$objSpreadsheet->getActiveSheet()
			->getColumnDimension($count)->setAutoSize(true);
		}
		$objSpreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(40);
		$objSpreadsheet->getActiveSheet()->getStyle('L2:L'.$no_cell)->getAlignment()->setWrapText(true);

		$objSpreadsheet->getActiveSheet()->setTitle('Report Excel');
		$objSpreadsheet->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data Pengujian Alat K3.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');
	}

	public function lisensi($status = 1)
	{
		if ($status)
			$data = $this->sertifikat->get_data_sertifikat("lisensi", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);
		else
			$data = $this->sertifikat->get_all_sertifikat_lama("lisensi", $this->authentifier->get_user_detail()['kode_distrik_pegawai']);

		$objSpreadsheet = new Spreadsheet();

		$objSpreadsheet->getProperties()->setCreator('YogaOcean - Administrator')
		->setLastModifiedBy('YogaOcean - Administrator')
		->setTitle('Test Excel Ocean');

		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:M1')->getFont()->setBold(true);

		$styleArray = [
		    'borders' => [
		        'allBorders' => [
		            'borderStyle' => Border::BORDER_THIN,
		            'color' => ['argb' => '00000000'],
		        ],
		    ],
		    'alignment' => [
		        'horizontal' => Alignment::HORIZONTAL_LEFT,
		        'vertical' => Alignment::VERTICAL_CENTER,
		    ],
		];

		$objSpreadsheet->getActiveSheet()->getStyle('A1:M1')->getFill()->setFillType(Fill::FILL_SOLID);
		$objSpreadsheet->getActiveSheet()->getStyle('A1:M1')->getFill()->getStartColor()->setARGB('FF40BCD8');

		$objSpreadsheet->setActiveSheetIndex(0)
		->setCellValue('A1', 'No.')
		->setCellValue('B1', 'Distrik')
		->setCellValue('C1', 'Nama Lisensi')
		->setCellValue('D1', 'Spesifikasi')
		->setCellValue('E1', 'No. Lisensi')
		->setCellValue('F1', 'Lembaga')
		->setCellValue('G1', 'PIC')
		->setCellValue('H1', 'Tanggal Terbit')
		->setCellValue('I1', 'Tanggal Berakhir')
		->setCellValue('J1', 'Status Sertifikat')
		->setCellValue('K1', 'Status Remark')
		->setCellValue('L1', 'Keterangan Remark')
		->setCellValue('M1', 'Pembuat Remark');

		$no_cell = 2;
		$no_data = 1;
		foreach ($data as $key => $one_data) {
			$objSpreadsheet->setActiveSheetIndex(0)
			->setCellValue('A'.$no_cell, $no_data++)
			->setCellValue('B'.$no_cell, $one_data['nama_distrik'])
			->setCellValue('C'.$no_cell, $one_data['judul_sertifikat'])
			->setCellValue('D'.$no_cell, $one_data['spesifikasi_lisensi'])
			->setCellValue('E'.$no_cell, $one_data['no_sertifikat'])
			->setCellValue('F'.$no_cell, $one_data['nama_lembaga'])
			->setCellValue('G'.$no_cell, $one_data['jabatan_pic'])
			->setCellValue('H'.$no_cell, $one_data['tanggal_sertifikasi'])
			->setCellValue('I'.$no_cell, $one_data['tanggal_kadaluarsa'])
			->setCellValue('J'.$no_cell, $one_data['nama_status']);

			$data_remark = $this->remark->get_remark_by_id_sertifikat($one_data['id_sertifikat']);
			$count_remark = count($data_remark)-1;
			$merge = $count_remark + $no_cell;

			if($count_remark > 0)
			{
				for ($count = 'A'; $count <= 'J'; $count++)
					$objSpreadsheet->getActiveSheet()->mergeCells($count.$no_cell.':'.$count.$merge);
			}

			foreach ($data_remark as $key => $one_remark) {
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue('K'.$no_cell, $one_remark['nama_status'])
				->setCellValue('L'.$no_cell, $one_remark['keterangan'])
				->setCellValue('M'.$no_cell, $one_remark['nama_lengkap_pegawai']);

				$no_cell++;
			}

			if (!is_null($data_remark) && !empty($data_remark))
				$no_cell -= 1;

			$no_cell++;
		}

		$objSpreadsheet->getActiveSheet()->getStyle('A1:M'.--$no_cell)->applyFromArray($styleArray);
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:M1')->getAlignment()
		->setHorizontal(Alignment::HORIZONTAL_CENTER);

		for ($count = 'A'; $count <= 'M'; $count++)
		{
			$objSpreadsheet->getActiveSheet()
			->getColumnDimension($count)->setAutoSize(true);
		}
		$objSpreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(40);
		$objSpreadsheet->getActiveSheet()->getStyle('L2:L'.$no_cell)->getAlignment()->setWrapText(true);

		$objSpreadsheet->getActiveSheet()->setTitle('Report Excel');
		$objSpreadsheet->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Data Lisensi.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');
	}

}
