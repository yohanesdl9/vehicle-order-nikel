<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_user extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function get($id = '') {
		if ($id != '') $this->db->where('id', $id);
		return $this->db->where('deleted_at', NULL)->get('cms_users');
	}

	public function check_username_unique($username, $id = NULL) {
		if ($id != NULL) $this->db->where('id <>', $id);
		$check = $this->db->where('deleted_at', NULL)->where('username', $username)->get('cms_users');
		return $check->num_rows() == 0;
	}

	public function auth($username, $password) {
		$check = $this->db->where('username', $username)->get('cms_users');
		if ($check->num_rows() > 0) {
			$data = $check->row_array();
			if (password_verify($password, $data['password'])) {
				$this->session->set_userdata($data);
				return TRUE;
			} else {
				return FALSE;
			}
		} else {
			return FALSE;
		}
	}

	public function insert($data) {
		return $this->db->insert('cms_users', $data);
	}

	public function update($id, $data) {
		return $this->db->update('cms_users', $data, ['id' => $id]);
	}

	public function delete($id) {
		return $this->update($id, ['deleted_at' => date('Y-m-d H:i:s')]);
	}

}

/* End of file M_user.php */
 ?>
