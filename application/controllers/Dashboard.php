<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->M_app->redirectIfNotLoggedIn();
	}

	public function index(){
		$this->load->view('template/index', [
			'title' => 'Dashboard',
			'content' => 'dashboard'
		]);
	}

}

/* End of file Dashboard.php */

?>
