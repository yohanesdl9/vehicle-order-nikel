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

	function get_pemesanan_to_verify() {
		$this->load->model('M_dashboard');
		// Untuk tampilan di sidebar menu, jika ada pemesanan yang perlu ditinjau
		if ($this->session->userdata('privileges') == 'admin') {
			return $this->M_dashboard->get_pemesanan_by_approval_status(1, 0);
		} else {
			return $this->M_dashboard->get_pemesanan_by_approval_status(0, 0);
		}
	}
}

/* End of file M_app.php */
 ?>
