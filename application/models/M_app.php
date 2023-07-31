<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_app extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	function redirectIfNotLoggedIn(){
		if (!$this->session->has_userdata('id')) redirect('login');
	}

	function setAlertIfSuccessOrFailed($proc, $message_success, $message_failed) {
		if ($proc) {
			$this->setAlert('success', $message_success);
		} else {
			$this->setAlert('danger', $message_failed);
		}
	}

	function setAlert($alert_type, $message){
    $this->session->set_flashdata('color', $alert_type);
    $this->session->set_flashdata('message', $message);
  }

	function insertLogAktivitas($keterangan) {
		return $this->db->insert('tb_log', [
			'id_cms_users' => $this->session->userdata('id'),
			'timestamp' => date('Y-m-d H:i:s'),
			'log' => $keterangan
		]);
	}

}

/* End of file M_app.php */
 ?>
