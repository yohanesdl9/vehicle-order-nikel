<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	var $errors = [
		'required' => '%s wajib diisi.',
		'unique' => '%s sudah digunakan oleh user lain'
	];

	public function __construct() {
		parent::__construct();
		$this->M_app->redirectIfNotLoggedIn();
		$this->load->model('M_user');
	}

	public function index() {
		$this->load->view('template/index', [
			'title' => 'Manajemen User',
			'content' => 'user',
			'user' => $this->M_user->get()->result_array()
		]);
	}

	public function get($id) {
		echo json_encode($this->M_user->get($id)->row_array());
	}

	public function validation(){
		$input = $this->input->post();
    $validation = [
      ['field' => 'nama', 'label' => 'Nama Pengguna', 'rules' => 'required', 'errors' => $this->errors],
    ];
		/* Kondisi khusus untuk input user, tambahkan id untuk pengecekan tambahan */
		if (isset($input['id_user'])) {
			$id = $input['id_user'];
			$validation[] = ['field' => 'username', 'label' => 'Username', 'rules' => 'required|unique[cms_users.username,id,'.$id.']', 'errors' => $this->errors];
		} else {
			$validation[] = ['field' => 'username', 'label' => 'Username', 'rules' => 'required|unique[cms_users.username]', 'errors' => $this->errors];
			$validation[] =	['field' => 'password', 'label' => 'Password', 'rules' => 'required', 'errors' => $this->errors];
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
		$data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		$data['created_at'] = date('Y-m-d H:i:s');
		$proc = $this->M_user->insert($data);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil menambahkan data', 'Gagal menambahkan data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas('Menambahkan data user');
		redirect('user');
	}

	public function update() {
		$data = $this->input->post();
		$id = $data['id_user'];
		unset($data['id_user']);
		if (isset($data['password'])) $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
		$data['updated_at'] = date('Y-m-d H:i:s');
		$proc = $this->M_user->update($id, $data);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil mengubah data', 'Gagal mengubah data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas("Mengubah data user dengan id = $id");
		redirect('user');
	}

	public function delete($id) {
		$proc = $this->M_user->delete($id);
		$this->M_app->setAlertIfSuccessOrFailed($proc, 'Berhasil menghapus data', 'Gagal menghapus data. Terjadi kesalahan');
		if ($proc) $this->M_app->insertLogAktivitas("Menghapus data user dengan id = $id");
		redirect('user');
	}

}

/* End of file User.php */
 ?>
