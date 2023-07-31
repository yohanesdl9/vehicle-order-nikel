<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pegawai extends CI_Controller {

	var $errors = [
		'required' => '%s wajib diisi.',
		'numeric' => '%s hanya boleh mengandung karakter numerik'
	];

	public function __construct() {
		parent::__construct();
		$this->M_app->redirectIfNotLoggedIn();
		$this->load->model('M_pegawai');
	}

	public function index() {
		$this->load->view('template/index', [
			'title' => 'Pegawai',
			'content' => 'pegawai',
			'pegawai' => $this->M_pegawai->get()->result_array()
		]);
	}

	public function get($id) {
		echo json_encode($this->M_pegawai->get($id)->row_array());
	}

	public function validation(){
		$input = $this->input->post();
    $validation = [
      ['field' => 'nama', 'label' => 'Nama Pegawai', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'alamat', 'label' => 'Alamat', 'rules' => 'required', 'errors' => $this->errors],
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
		$proc = $this->M_pegawai->insert($data);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil menambahkan data', 'Gagal menambahkan data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Menambahkan data pegawai');
		redirect('pegawai');
	}

	public function update() {
		$data = $this->input->post();
		$id = $data['id_pegawai'];
		unset($data['id_pegawai']);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$data['updated_by'] = $this->session->userdata('name');
		$proc = $this->M_pegawai->update($id, $data);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil mengubah data', 'Gagal mengubah data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas("Mengubah data pegawai dengan id = $id");
		redirect('pegawai');
	}

	public function delete($id) {
		$proc = $this->M_pegawai->delete($id);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil menghapus data', 'Gagal menghapus data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas("Menghapus data pegawai dengan id = $id");
		redirect('pegawai');
	}

}

/* End of file Pegawai.php */
 ?>
