<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->M_app->redirectIfNotLoggedIn();
		$this->load->model('M_dashboard');
	}

	public function index(){
		$this->load->view('template/index', [
			'title' => 'Dashboard',
			'content' => 'dashboard',
			'pesan_tahun' => $this->M_dashboard->get_jumlah_pemesanan('tahun'),
			'pesan_bulan' => $this->M_dashboard->get_jumlah_pemesanan('bulan')
		]);
	}

	public function get_grafik_bulanan(){
		$data = $this->M_dashboard->get_grafik_penggunaan_kendaraan();
		echo json_encode($data);
	}

	public function get_grafik_tahunan(){
		$data = $this->M_dashboard->get_grafik_penggunaan_kendaraan('tahun');
		echo json_encode($data);
	}

}

/* End of file Dashboard.php */

?>
