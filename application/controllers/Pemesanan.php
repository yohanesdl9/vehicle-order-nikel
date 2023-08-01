<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Pemesanan extends CI_Controller {

	var $errors = [
		'required' => '%s wajib diisi.'
	];
	
	public function __construct() {
		parent::__construct();
		$this->M_app->redirectIfNotLoggedIn();
		$this->load->model(['M_pemesanan', 'M_pegawai', 'M_user', 'M_kendaraan']);
	}

	public function index() {
		$this->load->view('template/index', [
			'title' => 'Pemesanan Kendaraan',
			'months' => bulanIndo(),
			'content' => 'pemesanan',
			'pegawai' => $this->M_pegawai->get()->result_array(),
			'kendaraan' => $this->M_kendaraan->get()->result_array(),
			'verifikator' => $this->M_user->get_verificator()
		]);
	}

	public function get($id) {
		echo json_encode($this->M_pemesanan->get($id));
	}

	public function validation() {
		$input = $this->input->post();
		$validation = [
      ['field' => 'id_pegawai', 'label' => 'Pemesan', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'id_kendaraan', 'label' => 'Kendaraan', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'id_driver', 'label' => 'Driver', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'keterangan', 'label' => 'Keterangan', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'tanggal_mulai', 'label' => 'Tanggal Mulai Pemakaian', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'verifikator', 'label' => 'Staf User Verifikasi', 'rules' => 'required', 'errors' => $this->errors],
    ];
		if (!isset($input['is_satu_hari'])) $validation[] = ['field' => 'tanggal_selesai', 'label' => 'Tanggal Selesai Pemakaian', 'rules' => 'required', 'errors' => $this->errors];
		$this->form_validation->set_rules($validation);
    if ($this->form_validation->run()) {
      echo json_encode(['status' => TRUE]);
    } else {
      $validation_errors = str_replace(".", ".<br>", strip_tags(validation_errors('', '')));
      echo json_encode(['status' => FALSE, 'message' => $validation_errors]);
    }
	}

	public function datatable() {
		$post = $this->input->post();
		$data = $this->M_pemesanan->datatable($post);
    echo json_encode($data);
	}

	public function insert() {
		$input = $this->input->post();
		if (isset($input['is_satu_hari'])) $input['tanggal_selesai'] = $input['tanggal_mulai'];
		unset($input['is_satu_hari']);
		$input['kode_pesan'] = $this->M_pemesanan->generate_kode_pemesanan();
		$input['status_approval_verifikator'] = 0;
		$input['status_approval_final'] = 0;
		$input['created_at'] = date('Y-m-d H:i:s');
		$input['created_by'] = $this->session->userdata('nama');
		$proc = $this->M_pemesanan->insert($input);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil menambahkan data', 'Gagal menambahkan data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Menambahkan data pemesanan kode ' . $input['kode_pesan']);
		redirect('pemesanan');
	}

	public function verifikasi_verifikator(){
		$data = $this->input->post();
		$id = $data['id_pemesanan'];
		$kode = $data['kode_pesan'];
		foreach ($data as $key => $value) if ($value == '') unset($data[$key]);
		unset($data['id_pemesanan'], $data['kode_pesan']);
		$data['tanggal_approval_verifikator'] = date('Y-m-d H:i:s');
		$proc = $this->M_pemesanan->update($id, $data);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil mengubah data', 'Gagal mengubah data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Memverifikasi tahap pertama data pemesanan kode ' . $kode);
		redirect('pemesanan');
	}

	public function verifikasi_final(){
		$data = $this->input->post();
		$id = $data['id_pemesanan'];
		$kode = $data['kode_pesan'];
		foreach ($data as $key => $value) if ($value == '') unset($data[$key]);
		unset($data['id_pemesanan'], $data['kode_pesan']);
		$data['tanggal_approval_final'] = date('Y-m-d H:i:s');
		$proc = $this->M_pemesanan->update($id, $data);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil mengubah data', 'Gagal mengubah data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Memverifikasi tahap akhir data pemesanan kode ' . $kode);
		redirect('pemesanan');
	}

	public function export_excel(){ 
		$post = $this->input->post();
		$data = $this->M_pemesanan->export($post);
    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

		$columns = [
			'A' => ['dimension' => 36, 'header' => 'Kode Pemesanan', 'field' => 'kode_pesan'],
			'B' => ['dimension' => 30, 'header' => 'Pegawai', 'field' => 'pemesan'],
			'C' => ['dimension' => 30, 'header' => 'Driver', 'field' => 'driver'],
			'D' => ['dimension' => 54, 'header' => 'Keterangan', 'field' => 'keterangan'],
			'E' => ['dimension' => 36, 'header' => 'Tanggal Pemesanan', 'field' => 'tanggal_pemesanan'],
			'F' => ['dimension' => 48, 'header' => 'Tanggal Penggunaan', 'field' => 'tanggal_digunakan'],
			'G' => ['dimension' => 36, 'header' => 'Verifikator', 'field' => 'verifikator'],
			'H' => ['dimension' => 24, 'header' => 'Status Approval Verifikator', 'field' => 'status_approval_verifikator'],
			'I' => ['dimension' => 24, 'header' => 'Status Approval Admin', 'field' => 'status_approval_final'],
		];

		foreach ($columns as $key => $value) {
			$sheet->getColumnDimension($key)->setWidth($value['dimension']);
			$sheet->setCellValue($key . '5', $value['header']);
		
			$sheet->getStyle($key . '5')->getFont()->setBold(true);
			$sheet->getStyle($key . '5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			$sheet->getStyle($key . '5')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
		}

		$sheet->setCellValue('A1', 'LAPORAN PENGGUNAAN KENDARAAN');
    $sheet->getStyle('A1')->getFont()->setBold(true);
    $sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->mergeCells('A1:I1');

		$rows = 6;
		foreach ($data as $value) {
			foreach ($columns as $index => $field) {
				$sheet->setCellValue($index . $rows, $value[$field['field']]);
			}
			$rows++;
		}

		$writer = new Xlsx($spreadsheet);
    $filename = "Laporan Penggunaan Kendaraan";
    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="'. $filename .'.xlsx"'); 
    header('Cache-Control: max-age=0');
    ob_end_clean();
    $writer->save('php://output');
	}

}

/* End of file Pemesanan.php */
 ?>
