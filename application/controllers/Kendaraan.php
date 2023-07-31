<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Kendaraan extends CI_Controller {

	var $errors = [
		'required' => '%s wajib diisi.',
		'numeric' => '%s hanya boleh mengandung karakter numerik',
		'unique' => '%s sudah ada di kendaraan lain'
	];

	public function __construct() {
		parent::__construct();
		$this->M_app->redirectIfNotLoggedIn();
		$this->load->model(['M_kendaraan', 'M_perusahaan']);
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
			['field' => 'telepon', 'label' => 'Telepon', 'rules' => 'required|numeric', 'errors' => $this->errors],
    ];
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
		$data['created_at'] = date('Y-m-d H:i:s');
		$data['created_by'] = $this->session->userdata('name');
		$proc = $this->M_kendaraan->insert($data);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil menambahkan data', 'Gagal menambahkan data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Menambahkan data kendaraan');
		redirect('kendaraan');
	}

	public function update() {
		$data = $this->input->post();
		$id = $data['id_kendaraan'];
		unset($data['id_kendaraan']);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('name');
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

}

/* End of file Kendaraan.php */
 ?>
