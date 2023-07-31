<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Pemesanan extends CI_Controller {
	
	public function __construct() {
		parent::__construct();
		$this->M_app->redirectIfNotLoggedIn();
	}

	public function index() {
		
	}

}

/* End of file Pemesanan.php */
 ?>
