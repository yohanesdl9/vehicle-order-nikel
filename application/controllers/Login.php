<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	var $errors = [
		'required' => '%s wajib diisi.'
	];

	public function __construct(){
		parent::__construct();
		$this->load->model('M_user');
	}

	public function index() {
		$this->load->view('login', [
			'title' => 'Login'
		]);
	}

	public function auth(){
		$input = $this->input->post();
		$check = $this->M_user->auth($input['username'], $input['password']);
		if ($check) {
			redirect('dashboard');
		} else {
			$this->M_app->setAlert('danger', 'Username/Password Salah. Silahkan Coba Lagi.');
			redirect('login');
		}
	}

	public function auth_validation(){
		$input = $this->input->post();
    $validation = [
      ['field' => 'username', 'label' => 'Username', 'rules' => 'required', 'errors' => $this->errors],
      ['field' => 'password', 'label' => 'Password', 'rules' => 'required', 'errors' => $this->errors],
    ];
    $this->form_validation->set_rules($validation);
    if ($this->form_validation->run()) {
      echo json_encode(['status' => TRUE]);
    } else {
      $validation_errors = str_replace(".", ".<br>", strip_tags(validation_errors('', '')));
      echo json_encode(['status' => FALSE, 'message' => $validation_errors]);
    }
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('login');
	}

}

/* End of file Login.php */
