<?php defined('BASEPATH') OR exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

	public function __construct($rules = array()) {
		$this->CI =& get_instance();
		parent::__construct($rules);
	}
	
	public function unique(?string $str, string $field): bool{
    [$field, $ignoreField, $ignoreValue] = array_pad(explode(',', $field), 3,null);
    sscanf($field, '%[^.].%[^.]', $table, $field);
		$db = isset($this->CI->db) ? $this->CI->db : NULL;
		if ($db != NULL) {
			$row = $db->select('1')->where($field, $str)->where('deleted_at', NULL)->limit(1);
			if (!empty($ignoreField) && !empty($ignoreValue) && !preg_match('/^\{(\w+)\}$/', $ignoreValue)) $row = $row->where("{$ignoreField} !=", $ignoreValue);
			return $row->get($table)->row() === null;
		} else {
			return FALSE;
		}
  }
}

?>
