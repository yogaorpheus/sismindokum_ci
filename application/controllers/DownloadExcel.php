<?php
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet;
use PhpOffice\PhpSpreadsheet\Style;

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
		$objSpreadsheet->setActiveSheetIndex(0)
		->getStyle('A1:K1')->getAlignment()
		->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
		->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
		// $objSpreadsheet->setActiveSheetIndex(0)
		// ->getStyle('A1:K1')->getBorder()
		// ->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK);

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

		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('A')->setAutoSize(true);
		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('B')->setAutoSize(true);
		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('C')->setAutoSize(true);
		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('D')->setAutoSize(true);
		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('E')->setAutoSize(true);
		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('F')->setAutoSize(true);
		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('G')->setAutoSize(true);
		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('H')->setAutoSize(true);
		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('I')->setAutoSize(true);
		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('J')->setWidth(40);
		$objSpreadsheet->getActiveSheet()
		->getColumnDimension('K')->setAutoSize(true);

		$objSpreadsheet->getActiveSheet()->setTitle('Report Excel');
		$objSpreadsheet->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.ms-excel');
		header('Content-Disposition: attachment;filename="Report Excel.xlsx"');
		header('Cache-Control: max-age=0');

		$writer = new Xlsx($objSpreadsheet);
		$writer->save('php://output');

		// exit;
	}

}
