<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_jadwal_service extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function get($id_kendaraan, $id = '') {
		if ($id != '') $this->db->where('id', $id);
		return $this->db->where('id_kendaraan', $id)->where('deleted_at', NULL)->get('tb_kendaraan_jadwal_service');
	}

	public function insert($data) {
		return $this->db->insert('tb_kendaraan_jadwal_service', $data);
	}

	public function update($id, $data) {
		return $this->db->update('tb_kendaraan_jadwal_service', $data, ['id' => $id]);
	}

}
