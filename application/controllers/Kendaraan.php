<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan extends CI_Controller {

	var $errors = [
		'required' => '%s wajib diisi.',
		'numeric' => '%s hanya boleh mengandung karakter numerik.',
		'unique' => '%s sudah ada di kendaraan lain.',
		'is_natural_no_zero' => '%s tidak boleh bernilai nol.'
	];

	public function __construct() {
		parent::__construct();
		$this->M_app->redirectIfNotLoggedIn();
		$this->load->model(['M_kendaraan', 'M_perusahaan', 'M_konsumsi_bbm', 'M_jadwal_service']);
	}

	public function index() {
		$this->load->view('template/index', [
			'title' => 'Kendaraan',
			'content' => 'kendaraan',
			'kendaraan' => $this->M_kendaraan->get()->result_array(),
			'perusahaan' => $this->M_perusahaan->get()->result_array()
		]);
	}

	public function get($id) {
		echo json_encode($this->M_kendaraan->get($id)->row_array());
	}

	public function validation(){
		$input = $this->input->post();
    $validation = [
      ['field' => 'merek_kendaraan', 'label' => 'Merek Kendaraan', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'model_kendaraan', 'label' => 'Model Kendaraan', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'tahun', 'label' => 'Tahun Kendaraan', 'rules' => 'required|numeric|is_natural_no_zero', 'errors' => $this->errors],
    ];
		if (isset($input['id_kendaraan'])) {
			$id = $input['id_kendaraan'];
			$validation[] = ['field' => 'nomor_polisi', 'label' => 'Nomor Polisi', 'rules' => 'required|unique[tb_kendaraan.nomor_polisi,id,'.$id.']', 'errors' => $this->errors];
			$validation[] = ['field' => 'nomor_rangka', 'label' => 'Nomor Rangka', 'rules' => 'unique[tb_kendaraan.nomor_rangka,id,'.$id.']', 'errors' => $this->errors];
			$validation[] = ['field' => 'nomor_mesin', 'label' => 'Nomor Mesin', 'rules' => 'unique[tb_kendaraan.nomor_mesin,id,'.$id.']', 'errors' => $this->errors];
		} else {
			$validation[] = ['field' => 'nomor_polisi', 'label' => 'Nomor Polisi', 'rules' => 'required|unique[tb_kendaraan.nomor_polisi]', 'errors' => $this->errors];
			$validation[] = ['field' => 'nomor_rangka', 'label' => 'Nomor Rangka', 'rules' => 'unique[tb_kendaraan.nomor_rangka]', 'errors' => $this->errors];
			$validation[] = ['field' => 'nomor_mesin', 'label' => 'Nomor Mesin', 'rules' => 'unique[tb_kendaraan.nomor_mesin]', 'errors' => $this->errors];
		}

		if ($input['tipe_kepemilikan'] == 'sewa') {
			$validation[] = ['field' => 'id_perusahaan', 'label' => 'Perusahaan Penyedia Rental Kendaraan', 'rules' => 'required|unique', 'errors' => $this->errors];
		}
    $this->form_validation->set_rules($validation);
    if ($this->form_validation->run()) {
      echo json_encode(['status' => TRUE]);
    } else {
      $validation_errors = str_replace(".", ".<br>", strip_tags(validation_errors('', '')));
      echo json_encode(['status' => FALSE, 'message' => $validation_errors]);
    }
	}

	public function insert() {
		$data = $this->input->post();
		foreach ($data as $key => $value) if ($value == '') unset($data[$key]);
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['created_by'] = $this->session->userdata('nama');
		$proc = $this->M_kendaraan->insert($data);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil menambahkan data', 'Gagal menambahkan data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Menambahkan data kendaraan');
		redirect('kendaraan');
	}

	public function update() {
		$data = $this->input->post();
		$id = $data['id_kendaraan'];
		unset($data['id_kendaraan']);
		foreach ($data as $key => $value) if ($value == '') unset($data[$key]);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('nama');
		$proc = $this->M_kendaraan->update($id, $data);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil mengubah data', 'Gagal mengubah data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas("Mengubah data kendaraan dengan id = $id");
		redirect('kendaraan');
	}

	public function delete($id) {
		$proc = $this->M_kendaraan->delete($id);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil menghapus data', 'Gagal menghapus data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas("Menghapus data kendaraan dengan id = $id");
		redirect('kendaraan');
	}

	public function konsumsi_bbm($id) {
		$this->load->view('template/index', [
			'title' => 'Riwayat Konsumsi BBM Kendaraan',
			'content' => 'konsumsi_bbm',
			'kendaraan' => $this->M_kendaraan->get($id)->row_array(),
			'konsumsi' => $this->M_konsumsi_bbm->get($id)
		]);
	}

	public function get_konsumsi_bbm($id) {
		echo json_encode($this->M_konsumsi_bbm->get_single($id));
	}

	public function konsumsi_bbm_validation() {
		$input = $this->input->post();
    $validation = [
      ['field' => 'tanggal_check', 'label' => 'Tanggal Check', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'jarak_tempuh', 'label' => 'Jarak Tempuh', 'rules' => 'required|numeric', 'errors' => $this->errors],
      ['field' => 'konsumsi_bbm', 'label' => 'Konsumsi BBM', 'rules' => 'required|numeric', 'errors' => $this->errors],
    ];
    $this->form_validation->set_rules($validation);
    if ($this->form_validation->run()) {
      echo json_encode(['status' => TRUE]);
    } else {
      $validation_errors = str_replace(".", ".<br>", strip_tags(validation_errors('', '')));
      echo json_encode(['status' => FALSE, 'message' => $validation_errors]);
    }
	}

	public function insert_konsumsi_bbm() {
		$input = $this->input->post();
		$kendaraan = $this->M_kendaraan->get($input['id_kendaraan'])->row_array();
		$input['created_at'] = date('Y-m-d H:i:s');
		$input['created_by'] = $this->session->userdata('nama');
		$proc = $this->M_konsumsi_bbm->insert($input);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil menambahkan data', 'Gagal menambahkan data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Menambahkan data konsumsi BBM kendaraan ' . $kendaraan['nomor_polisi']);
		redirect('kendaraan/konsumsi_bbm/' . $input['id_kendaraan']);
	}

	public function update_konsumsi_bbm() {
		$input = $this->input->post();
		$id_konsumsi = $input['id_konsumsi_bbm'];
		unset($input['id_konsumsi_bbm']);
		$kendaraan = $this->M_kendaraan->get($input['id_kendaraan'])->row_array();
		$input['updated_at'] = date('Y-m-d H:i:s');
		$input['updated_by'] = $this->session->userdata('nama');
		$proc = $this->M_konsumsi_bbm->update($id_konsumsi, $input);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil mengubah data', 'Gagal mengubah data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Mengubah data konsumsi BBM kendaraan ' . $kendaraan['nomor_polisi'] . ' dengan id = ' . $id_konsumsi);
		redirect('kendaraan/konsumsi_bbm/' . $input['id_kendaraan']);
	}

	public function jadwal_service($id) {
		$this->load->view('template/index', [
			'title' => 'Jadwal Service Kendaraan',
			'content' => 'jadwal_service',
			'kendaraan' => $this->M_kendaraan->get($id)->row_array(),
			'service' => $this->M_jadwal_service->get($id)
		]);
	}

	public function get_jadwal_service($id) {
		echo json_encode($this->M_jadwal_service->get_single($id));
	}

	public function jadwal_service_validation() {
		$input = $this->input->post();
    $validation = [
      ['field' => 'tanggal_service', 'label' => 'Tanggal Service', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'keterangan_service', 'label' => 'Keterangan Service', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'lokasi_service', 'label' => 'Lokasi Service', 'rules' => 'required', 'errors' => $this->errors],
    ];
    $this->form_validation->set_rules($validation);
    if ($this->form_validation->run()) {
      echo json_encode(['status' => TRUE]);
    } else {
      $validation_errors = str_replace(".", ".<br>", strip_tags(validation_errors('', '')));
      echo json_encode(['status' => FALSE, 'message' => $validation_errors]);
    }
	}

	public function insert_jadwal_service() {
		$input = $this->input->post();
		$kendaraan = $this->M_kendaraan->get($input['id_kendaraan'])->row_array();
		$input['created_at'] = date('Y-m-d H:i:s');
		$input['created_by'] = $this->session->userdata('nama');
		$proc = $this->M_jadwal_service->insert($input);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil menambahkan data', 'Gagal menambahkan data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Menambahkan jadwal service BBM kendaraan ' . $kendaraan['nomor_polisi']);
		redirect('kendaraan/jadwal_service/' . $input['id_kendaraan']);
	}

	public function update_jadwal_service() {
		$input = $this->input->post();
		$id_konsumsi = $input['id_jadwal_service'];
		unset($input['id_jadwal_service']);
		$kendaraan = $this->M_kendaraan->get($input['id_kendaraan'])->row_array();
		$input['updated_at'] = date('Y-m-d H:i:s');
		$input['updated_by'] = $this->session->userdata('nama');
		$proc = $this->M_jadwal_service->update($id_konsumsi, $input);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil mengubah data', 'Gagal mengubah data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Mengubah data jadwal service kendaraan ' . $kendaraan['nomor_polisi'] . ' dengan id = ' . $id_konsumsi);
		redirect('kendaraan/jadwal_service/' . $input['id_kendaraan']);
	}

}

/* End of file Kendaraan.php */
 ?>
