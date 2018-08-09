<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'home/home';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

$route['home'] = 'home/home';
// LEMBAGA ROUTE //
$route['lembaga'] 						= 'lembagacontroller/index';
$route['lembaga/tambah_lembaga']		= 'lembagacontroller/tambah_lembaga';
$route['lembaga/edit_lembaga/(:num)'] 	= 'lembagacontroller/edit_lembaga/$1';

// DASAR HUKUM ROUTE //
$route['dasar_hukum']							= 'dasarhukumcontroller/index';
$route['dasar_hukum/tambah_dasar_hukum']		= 'dasarhukumcontroller/tambah_dasar_hukum';
$route['dasar_hukum/edit_dasar_hukum/(:num)']	= 'dasarhukumcontroller/edit_dasar_hukum/$1';

// UNIT ROUTE //
$route['unit'] 					= 'unitcontroller/index';
$route['unit/tambah_unit']		= 'unitcontroller/tambah_unit';
$route['unit/edit_unit/(:num)'] = 'unitcontroller/edit_unit/$1';

// PEGAWAI ROUTE //
$route['pegawai_pjb']	= 'pegawaicontroller/index';

// DOWNLOAD ROUTE //
	// WITHOUT DISTRICT CODE //
$route['data/anggaran_dasar/download'] 			= 'downloadexcel/anggaran_dasar/aktif';
$route['data_lama/anggaran_dasar/download']		= 'downloadexcel/anggaran_dasar/selesai';
$route['data/pertanahan/download']				= 'downloadexcel/pertanahan/1';
$route['data_lama/pertanahan/download']			= 'downloadexcel/pertanahan/0';
$route['data/slo/download']						= 'downloadexcel/slo/1';
$route['data_lama/slo/download']				= 'downloadexcel/slo/0';
$route['data/perizinan/download']				= 'downloadexcel/perizinan/1';
$route['data_lama/perizinan/download']			= 'downloadexcel/perizinan/0';
$route['data/pengujian_alat_k3/download']		= 'downloadexcel/pengujian/1';
$route['data_lama/pengujian_alat_k3/download']	= 'downloadexcel/pengujian/0';
$route['data/lisensi/download']					= 'downloadexcel/lisensi/1';
$route['data_lama/lisensi/download']			= 'downloadexcel/lisensi/0';
$route['data/sertifikat_sdm/download']			= 'downloadexcel/sertifikat_sdm/1';
$route['data_lama/sertifikat_sdm/download']		= 'downloadexcel/sertifikat_sdm/0';
$route['lembaga/download']						= 'downloadexcel/lembaga/1';
$route['unit/download']							= 'downloadexcel/unit';
$route['dasar_hukum/download']					= 'downloadexcel/dasar_hukum';
	// WITH DISTRICT CODE
$route['data/pertanahan/download/(:any)']				= 'downloadexcel/pertanahan/1/$1';
$route['data_lama/pertanahan/download/(:any)']			= 'downloadexcel/pertanahan/0/$1';
$route['data/slo/download/(:any)']						= 'downloadexcel/slo/1/$1';
$route['data_lama/slo/download/(:any)']					= 'downloadexcel/slo/0/$1';
$route['data/perizinan/download/(:any)']				= 'downloadexcel/perizinan/1/$1';
$route['data_lama/perizinan/download/(:any)']			= 'downloadexcel/perizinan/0/$1';
$route['data/pengujian_alat_k3/download/(:any)']		= 'downloadexcel/pengujian/1/$1';
$route['data_lama/pengujian_alat_k3/download/(:any)']	= 'downloadexcel/pengujian/0/$1';
$route['data/lisensi/download/(:any)']					= 'downloadexcel/lisensi/1/$1';
$route['data_lama/lisensi/download/(:any)']				= 'downloadexcel/lisensi/0/$1';
$route['data/sertifikat_sdm/download/(:any)']			= 'downloadexcel/sertifikat_sdm/1/$1';
$route['data_lama/sertifikat_sdm/download/(:any)']		= 'downloadexcel/sertifikat_sdm/0/$1';
$route['unit/download/(:any)']							= 'downloadexcel/unit/$1';

// REVIEW LAMPIRAN ROUTE //
$route['data/pertanahan_review/(:num)'] 		= 'data_crud/pertanahan_review/$1';
$route['data/anggaran_dasar_review/(:num)'] 	= 'data_crud/anggaran_dasar_review/$1';
$route['data/slo_review/(:num)'] 				= 'data_crud/slo_review/$1';
$route['data/perizinan_review/(:num)'] 			= 'data_crud/perizinan_review/$1';
$route['data/pengujian_alat_k3_review/(:num)'] 	= 'data_crud/pengujian_alat_k3_review/$1';
$route['data/lisensi_review/(:num)'] 			= 'data_crud/lisensi_review/$1';

$route['data_lama/pertanahan_review/(:num)'] 			= 'data_crud/pertanahan_review/$1';
$route['data_lama/anggaran_dasar_review/(:num)'] 		= 'data_crud/anggaran_dasar_review/$1';
$route['data_lama/slo_review/(:num)'] 					= 'data_crud/slo_review/$1';
$route['data_lama/perizinan_review/(:num)'] 			= 'data_crud/perizinan_review/$1';
$route['data_lama/pengujian_alat_k3_review/(:num)'] 	= 'data_crud/pengujian_alat_k3_review/$1';
$route['data_lama/lisensi_review/(:num)'] 				= 'data_crud/lisensi_review/$1';

// EDIT ROUTE //
$route['data/pertanahan_edit/(:num)'] 			= 'data_crud/pertanahan_edit/$1';
$route['data/anggaran_dasar_edit/(:num)'] 		= 'anggaran_dasar/anggaran_dasar_edit/$1';
$route['data/slo_edit/(:num)'] 					= 'data_crud/slo_edit/$1';
$route['data/perizinan_edit/(:num)'] 			= 'data_crud/perizinan_edit/$1';
$route['data/pengujian_alat_k3_edit/(:num)'] 	= 'data_crud/pengujian_alat_k3_edit/$1';
$route['data/lisensi_edit/(:num)'] 				= 'data_crud/lisensi_edit/$1';

// REMARK ROUTE //
$route['data/pertanahan_remark/(:num)'] 			= 'remark_data/view_remark_pertanahan/$1';
$route['data/anggaran_dasar_remark/(:num)'] 		= 'remark_data/view_remark_anggaran/$1';
$route['data/slo_remark/(:num)'] 					= 'remark_data/view_remark_slo/$1';
$route['data/perizinan_remark/(:num)'] 				= 'remark_data/view_remark_perizinan/$1';
$route['data/pengujian_alat_k3_remark/(:num)'] 		= 'remark_data/view_remark_pengujian_alat_k3/$1';
$route['data/lisensi_remark/(:num)'] 				= 'remark_data/view_remark_lisensi/$1';

// DELETE ROUTE //
$route['data/pertanahan_delete/(:num)'] 		= 'data_crud/pertanahan_delete/$1';
$route['data/anggaran_dasar_delete/(:num)'] 	= 'anggaran_dasar/anggaran_dasar_delete/$1';
$route['data/slo_delete/(:num)'] 				= 'data_crud/slo_delete/$1';
$route['data/perizinan_delete/(:num)'] 			= 'data_crud/perizinan_delete/$1';
$route['data/pengujian_alat_k3_delete/(:num)'] 	= 'data_crud/pengujian_alat_k3_delete/$1';
$route['data/lisensi_delete/(:num)'] 			= 'data_crud/lisensi_delete/$1';