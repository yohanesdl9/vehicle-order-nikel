<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_konsumsi_bbm extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function get($id_kendaraan) {
		return $this->db->where('id_kendaraan', $id_kendaraan)->where('deleted_at', NULL)->get('tb_kendaraan_konsumsi_bbm')->result_array();
	}

	public function get_single($id) {
		return $this->db->where('id', $id)->get('tb_kendaraan_konsumsi_bbm')->row_array();
	}

	public function insert($data) {
		return $this->db->insert('tb_kendaraan_konsumsi_bbm', $data);
	}

	public function update($id, $data) {
		return $this->db->update('tb_kendaraan_konsumsi_bbm', $data, ['id' => $id]);
	}

}

/* End of file M_konsumsi_bbm.php */
