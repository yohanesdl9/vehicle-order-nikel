<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Log extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->M_app->redirectIfNotLoggedIn();
		$this->load->model('M_log');
	}

	public function index(){
		$this->load->view('template/index', [
			'title' => 'Log Aktivitas',
			'months' => bulanIndo(),
			'content' => 'log'
		]);
	}

	public function log_datatable(){
		$post = $this->input->post();
		$data = $this->M_log->datatable($post);
    echo json_encode($data);
	}

}

/* End of file Log.php */
