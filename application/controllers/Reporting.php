<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

class Reporting extends CI_Controller {

	public function __construct() 
	{
		parent::__construct();
		$this->load->library('authentifier');
		$this->authentifier->session_check();

		$this->load->model('report');
		$this->load->model('distrik');
	}

	public function summary_slo()
	{
		$kode_dasar_hukum = array("O003");
		$nama_status = array("Aktif", "Alarm", "Kadaluarsa");

		$distrik = $this->distrik->get_all_distrik();
		
		$objSpreadsheet = new Spreadsheet();
		
		$objSpreadsheet->getProperties()->setCreator('Administrator Sismindokum')
		->setLastModifiedBy('Administrator Sismindokum')
		->setTitle('Data Sismindokum PJB');

		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:G4')->getFont()->setBold(true);

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

		$objSpreadsheet->getActiveSheet()->getStyle('A3:G4')->getFill()->setFillType(Fill::FILL_SOLID);
		$objSpreadsheet->getActiveSheet()->getStyle('A3:G4')->getFill()->getStartColor()->setARGB('FF40BCD8');
	
		$objSpreadsheet->getActiveSheet()->getStyle('D4')->getFill()->getStartColor()->setARGB('FF2CA021');
		$objSpreadsheet->getActiveSheet()->getStyle('E4')->getFill()->getStartColor()->setARGB('FFE28400');
		$objSpreadsheet->getActiveSheet()->getStyle('F4')->getFill()->getStartColor()->setARGB('FFAF0800');

		// $drawing = new Worksheet\Drawing();

		// $logo_path = "./assets/img/logo_pjb_small.png";

		// $drawing->setName('Logo');
		// $drawing->setDescription('Logo');
		// $drawing->setPath($logo_path);
		// $drawing->setHeight(36);
		// $drawing->setOffsetX(8);
		// $drawing->setCoordinates('B1');

		// $drawing->setWorksheet($objSpreadsheet->getActiveSheet());

		$objSpreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'MONITORING SLO UNIT PEMBANGKITAN PT. PJB');

		$objSpreadsheet->setActiveSheetIndex(0)
		->setCellValue('A3', 'No.')
		->setCellValue('B3', 'Unit Pembangkit')
		->setCellValue('C3', 'Jumlah Unit')
		->setCellValue('D3', 'Status Sertifikasi')
		->setCellValue('G3', 'Keterangan')
		->setCellValue('D4', 'Aktif')
		->setCellValue('E4', 'Alarm')
		->setCellValue('F4', 'Expired');

		$objSpreadsheet->getActiveSheet()->mergeCells('A1:G2');
		$objSpreadsheet->getActiveSheet()->mergeCells('A3:A4');
		$objSpreadsheet->getActiveSheet()->mergeCells('B3:B4');
		$objSpreadsheet->getActiveSheet()->mergeCells('C3:C4');
		$objSpreadsheet->getActiveSheet()->mergeCells('D3:F3');
		$objSpreadsheet->getActiveSheet()->mergeCells('G3:G4');

		$cell_data = 5;
		$no_cell = 1;
		foreach ($distrik as $key => $one_distrik) {
			$lt = 'A';

			$data_report = $this->report->get_jumlah_sertifikat_by_kode_dasar_hukum($one_distrik['id_distrik'], $kode_dasar_hukum, $nama_status);
			if (empty($data_report) || is_null($data_report))
				$jumlah = 0;
			else
				$jumlah = $data_report['Aktif']['jumlah_sertifikat'] + $data_report['Alarm']['jumlah_sertifikat'] + $data_report['Kadaluarsa']['jumlah_sertifikat'];

			$objSpreadsheet->setActiveSheetIndex(0)
			->setCellValue($lt++.$cell_data, $no_cell++)
			->setCellValue($lt++.$cell_data, $one_distrik['nama_distrik'])
			->setCellValue($lt++.$cell_data, $jumlah);

			if (empty($data_report) || is_null($data_report))
			{
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue($lt++.$cell_data, 0)
				->setCellValue($lt++.$cell_data, 0)
				->setCellValue($lt++.$cell_data, 0);
			}
			else
			{
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue($lt++.$cell_data, $data_report['Aktif']['jumlah_sertifikat'])
				->setCellValue($lt++.$cell_data, $data_report['Alarm']['jumlah_sertifikat'])
				->setCellValue($lt++.$cell_data, $data_report['Kadaluarsa']['jumlah_sertifikat']);
			}
			
			$cell_data++;
		}

		$objSpreadsheet->getActiveSheet()->getStyle('A1:G'.--$cell_data)->applyFromArray($styleArray);
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:G4')->getAlignment()
		->setHorizontal(Alignment::HORIZONTAL_CENTER);

		for ($count = 'A'; $count <= 'G'; $count++)
		{
			$objSpreadsheet->getActiveSheet()
			->getColumnDimension($count)->setAutoSize(true);
		}

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="text.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');
	}

	public function perizinan_bidang_teknik()
	{
		$kode_dasar_hukum = array("L", "K", "O");
		$nama_status = array("Aktif", "Alarm", "Kadaluarsa");
		$not_kode_dasar_hukum = "O003";

		$distrik = $this->distrik->get_all_distrik();
		
		$objSpreadsheet = new Spreadsheet();
		
		$objSpreadsheet->getProperties()->setCreator('Administrator Sismindokum')
		->setLastModifiedBy('Administrator Sismindokum')
		->setTitle('Data Sismindokum PJB');

		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:G4')->getFont()->setBold(true);

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

		$objSpreadsheet->getActiveSheet()->getStyle('A3:G4')->getFill()->setFillType(Fill::FILL_SOLID);
		$objSpreadsheet->getActiveSheet()->getStyle('A3:G4')->getFill()->getStartColor()->setARGB('FF40BCD8');
	
		$objSpreadsheet->getActiveSheet()->getStyle('D4')->getFill()->getStartColor()->setARGB('FF2CA021');
		$objSpreadsheet->getActiveSheet()->getStyle('E4')->getFill()->getStartColor()->setARGB('FFE28400');
		$objSpreadsheet->getActiveSheet()->getStyle('F4')->getFill()->getStartColor()->setARGB('FFAF0800');

		$objSpreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'MONITORING SLO UNIT PEMBANGKITAN PT. PJB');

		$objSpreadsheet->setActiveSheetIndex(0)
		->setCellValue('A3', 'No.')
		->setCellValue('B3', 'Unit Pembangkit')
		->setCellValue('C3', 'Jumlah Unit')
		->setCellValue('D3', 'Status Sertifikasi')
		->setCellValue('G3', 'Keterangan')
		->setCellValue('D4', 'Aktif')
		->setCellValue('E4', 'Alarm')
		->setCellValue('F4', 'Expired');

		$objSpreadsheet->getActiveSheet()->mergeCells('A1:G2');
		$objSpreadsheet->getActiveSheet()->mergeCells('A3:A4');
		$objSpreadsheet->getActiveSheet()->mergeCells('B3:B4');
		$objSpreadsheet->getActiveSheet()->mergeCells('C3:C4');
		$objSpreadsheet->getActiveSheet()->mergeCells('D3:F3');
		$objSpreadsheet->getActiveSheet()->mergeCells('G3:G4');

		$cell_data = 5;
		$no_cell = 1;
		foreach ($distrik as $key => $one_distrik) {
			$lt = 'A';

			$data_report = $this->report->get_jumlah_sertifikat_by_kode_dasar_hukum($one_distrik['id_distrik'], $kode_dasar_hukum, $nama_status, $not_kode_dasar_hukum);
			if (empty($data_report) || is_null($data_report))
				$jumlah = 0;
			else
				$jumlah = $data_report['Aktif']['jumlah_sertifikat'] + $data_report['Alarm']['jumlah_sertifikat'] + $data_report['Kadaluarsa']['jumlah_sertifikat'];

			$objSpreadsheet->setActiveSheetIndex(0)
			->setCellValue($lt++.$cell_data, $no_cell++)
			->setCellValue($lt++.$cell_data, $one_distrik['nama_distrik'])
			->setCellValue($lt++.$cell_data, $jumlah);

			if (empty($data_report) || is_null($data_report))
			{
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue($lt++.$cell_data, 0)
				->setCellValue($lt++.$cell_data, 0)
				->setCellValue($lt++.$cell_data, 0);
			}
			else
			{
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue($lt++.$cell_data, $data_report['Aktif']['jumlah_sertifikat'])
				->setCellValue($lt++.$cell_data, $data_report['Alarm']['jumlah_sertifikat'])
				->setCellValue($lt++.$cell_data, $data_report['Kadaluarsa']['jumlah_sertifikat']);
			}
			
			$cell_data++;
		}

		$objSpreadsheet->getActiveSheet()->getStyle('A1:G'.--$cell_data)->applyFromArray($styleArray);
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:G4')->getAlignment()
		->setHorizontal(Alignment::HORIZONTAL_CENTER);

		for ($count = 'A'; $count <= 'G'; $count++)
		{
			$objSpreadsheet->getActiveSheet()
			->getColumnDimension($count)->setAutoSize(true);
		}

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="text.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');
	}

	public function perizinan_bidang_administrasi()
	{
		$kode_dasar_hukum = array("T", "B", "P", "U", "D", "A");
		$nama_status = array("Aktif", "Alarm", "Kadaluarsa");
		
		$distrik = $this->distrik->get_all_distrik();
		
		$objSpreadsheet = new Spreadsheet();
		
		$objSpreadsheet->getProperties()->setCreator('Administrator Sismindokum')
		->setLastModifiedBy('Administrator Sismindokum')
		->setTitle('Data Sismindokum PJB');

		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:G4')->getFont()->setBold(true);

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

		$objSpreadsheet->getActiveSheet()->getStyle('A3:G4')->getFill()->setFillType(Fill::FILL_SOLID);
		$objSpreadsheet->getActiveSheet()->getStyle('A3:G4')->getFill()->getStartColor()->setARGB('FF40BCD8');
	
		$objSpreadsheet->getActiveSheet()->getStyle('D4')->getFill()->getStartColor()->setARGB('FF2CA021');
		$objSpreadsheet->getActiveSheet()->getStyle('E4')->getFill()->getStartColor()->setARGB('FFE28400');
		$objSpreadsheet->getActiveSheet()->getStyle('F4')->getFill()->getStartColor()->setARGB('FFAF0800');

		$objSpreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'MONITORING SLO UNIT PEMBANGKITAN PT. PJB');

		$objSpreadsheet->setActiveSheetIndex(0)
		->setCellValue('A3', 'No.')
		->setCellValue('B3', 'Unit Pembangkit')
		->setCellValue('C3', 'Jumlah Unit')
		->setCellValue('D3', 'Status Sertifikasi')
		->setCellValue('G3', 'Keterangan')
		->setCellValue('D4', 'Aktif')
		->setCellValue('E4', 'Alarm')
		->setCellValue('F4', 'Expired');

		$objSpreadsheet->getActiveSheet()->mergeCells('A1:G2');
		$objSpreadsheet->getActiveSheet()->mergeCells('A3:A4');
		$objSpreadsheet->getActiveSheet()->mergeCells('B3:B4');
		$objSpreadsheet->getActiveSheet()->mergeCells('C3:C4');
		$objSpreadsheet->getActiveSheet()->mergeCells('D3:F3');
		$objSpreadsheet->getActiveSheet()->mergeCells('G3:G4');

		$cell_data = 5;
		$no_cell = 1;
		foreach ($distrik as $key => $one_distrik) {
			$lt = 'A';

			$data_report = $this->report->get_jumlah_sertifikat_by_kode_dasar_hukum($one_distrik['id_distrik'], $kode_dasar_hukum, $nama_status);
			if (empty($data_report) || is_null($data_report))
				$jumlah = 0;
			else
				$jumlah = $data_report['Aktif']['jumlah_sertifikat'] + $data_report['Alarm']['jumlah_sertifikat'] + $data_report['Kadaluarsa']['jumlah_sertifikat'];

			$objSpreadsheet->setActiveSheetIndex(0)
			->setCellValue($lt++.$cell_data, $no_cell++)
			->setCellValue($lt++.$cell_data, $one_distrik['nama_distrik'])
			->setCellValue($lt++.$cell_data, $jumlah);

			if (empty($data_report) || is_null($data_report))
			{
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue($lt++.$cell_data, 0)
				->setCellValue($lt++.$cell_data, 0)
				->setCellValue($lt++.$cell_data, 0);
			}
			else
			{
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue($lt++.$cell_data, $data_report['Aktif']['jumlah_sertifikat'])
				->setCellValue($lt++.$cell_data, $data_report['Alarm']['jumlah_sertifikat'])
				->setCellValue($lt++.$cell_data, $data_report['Kadaluarsa']['jumlah_sertifikat']);
			}
			
			$cell_data++;
		}

		$objSpreadsheet->getActiveSheet()->getStyle('A1:G'.--$cell_data)->applyFromArray($styleArray);
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:G4')->getAlignment()
		->setHorizontal(Alignment::HORIZONTAL_CENTER);

		for ($count = 'A'; $count <= 'G'; $count++)
		{
			$objSpreadsheet->getActiveSheet()
			->getColumnDimension($count)->setAutoSize(true);
		}

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="text.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');
	}

	public function perizinan_bidang_sdm()
	{
		$kode_dasar_hukum = array("S", "C");
		$nama_status = array("Aktif", "Alarm", "Kadaluarsa");
		
		$distrik = $this->distrik->get_all_distrik();
		
		$objSpreadsheet = new Spreadsheet();
		
		$objSpreadsheet->getProperties()->setCreator('Administrator Sismindokum')
		->setLastModifiedBy('Administrator Sismindokum')
		->setTitle('Data Sismindokum PJB');

		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:G4')->getFont()->setBold(true);

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

		$objSpreadsheet->getActiveSheet()->getStyle('A3:G4')->getFill()->setFillType(Fill::FILL_SOLID);
		$objSpreadsheet->getActiveSheet()->getStyle('A3:G4')->getFill()->getStartColor()->setARGB('FF40BCD8');
	
		$objSpreadsheet->getActiveSheet()->getStyle('D4')->getFill()->getStartColor()->setARGB('FF2CA021');
		$objSpreadsheet->getActiveSheet()->getStyle('E4')->getFill()->getStartColor()->setARGB('FFE28400');
		$objSpreadsheet->getActiveSheet()->getStyle('F4')->getFill()->getStartColor()->setARGB('FFAF0800');

		$objSpreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'MONITORING SLO UNIT PEMBANGKITAN PT. PJB');

		$objSpreadsheet->setActiveSheetIndex(0)
		->setCellValue('A3', 'No.')
		->setCellValue('B3', 'Unit Pembangkit')
		->setCellValue('C3', 'Jumlah Unit')
		->setCellValue('D3', 'Status Sertifikasi')
		->setCellValue('G3', 'Keterangan')
		->setCellValue('D4', 'Aktif')
		->setCellValue('E4', 'Alarm')
		->setCellValue('F4', 'Expired');

		$objSpreadsheet->getActiveSheet()->mergeCells('A1:G2');
		$objSpreadsheet->getActiveSheet()->mergeCells('A3:A4');
		$objSpreadsheet->getActiveSheet()->mergeCells('B3:B4');
		$objSpreadsheet->getActiveSheet()->mergeCells('C3:C4');
		$objSpreadsheet->getActiveSheet()->mergeCells('D3:F3');
		$objSpreadsheet->getActiveSheet()->mergeCells('G3:G4');

		$cell_data = 5;
		$no_cell = 1;
		foreach ($distrik as $key => $one_distrik) {
			$lt = 'A';

			$data_report = $this->report->get_jumlah_sertifikat_by_kode_dasar_hukum($one_distrik['id_distrik'], $kode_dasar_hukum, $nama_status);
			if (empty($data_report) || is_null($data_report))
				$jumlah = 0;
			else
				$jumlah = $data_report['Aktif']['jumlah_sertifikat'] + $data_report['Alarm']['jumlah_sertifikat'] + $data_report['Kadaluarsa']['jumlah_sertifikat'];

			$objSpreadsheet->setActiveSheetIndex(0)
			->setCellValue($lt++.$cell_data, $no_cell++)
			->setCellValue($lt++.$cell_data, $one_distrik['nama_distrik'])
			->setCellValue($lt++.$cell_data, $jumlah);

			if (empty($data_report) || is_null($data_report))
			{
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue($lt++.$cell_data, 0)
				->setCellValue($lt++.$cell_data, 0)
				->setCellValue($lt++.$cell_data, 0);
			}
			else
			{
				$objSpreadsheet->setActiveSheetIndex(0)
				->setCellValue($lt++.$cell_data, $data_report['Aktif']['jumlah_sertifikat'])
				->setCellValue($lt++.$cell_data, $data_report['Alarm']['jumlah_sertifikat'])
				->setCellValue($lt++.$cell_data, $data_report['Kadaluarsa']['jumlah_sertifikat']);
			}
			
			$cell_data++;
		}

		$objSpreadsheet->getActiveSheet()->getStyle('A1:G'.--$cell_data)->applyFromArray($styleArray);
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:G4')->getAlignment()
		->setHorizontal(Alignment::HORIZONTAL_CENTER);

		for ($count = 'A'; $count <= 'G'; $count++)
		{
			$objSpreadsheet->getActiveSheet()
			->getColumnDimension($count)->setAutoSize(true);
		}

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="text.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');
	}

	public function lisensi()
	{

	}
}
