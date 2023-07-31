<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemesanan extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function get($id = '') {
		if ($id != '') $this->db->where('id', $id);
		return $this->db->where('deleted_at', NULL)->get('tb_pemesanan_kendaraan');
	}

	public function insert($data) {
		return $this->db->insert('tb_pemesanan_kendaraan', $data);
	}

	public function update($id, $data) {
		return $this->db->update('tb_pemesanan_kendaraan', $data, ['id' => $id]);
	}

	public function delete($id) {
		return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s'), 'deleted_by' => $this->session->userdata('nama')]);
	}
}

/* End of file M_perusahaan.php */
