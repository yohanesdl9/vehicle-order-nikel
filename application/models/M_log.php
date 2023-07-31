<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_log extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}
	
	public function datatable($postData = null) {
		$draw = $postData['draw'];
    $start = $postData['start'];
    $rowperpage = $postData['length'];
    $searchValue = $postData['search']['value'];

    // Custom search filter
    $filter_mode = $postData['mode_filter'];
		$where_log = [];
		switch($filter_mode) {
			case 'periode':
				$date_start = $postData['date_start'];
				$date_end = $postData['date_end'];
				$where_log[] = "DATE(timestamp) BETWEEN '$date_start' AND '$date_end'";
				break;
			case 'tanggal':
				$date = $postData['date'];
				$where_log[] = "DATE(timestamp) = '$date'";
				break;
			case 'bulan':
				$bulan = $postData['bulan'];
				$tahun = $postData['tahun'];
				$where_log[] = "(MONTH(timestamp) = $bulan AND YEAR(timestamp) = $tahun)";
				break;
		}

		if (count($where_log) > 0) $query_where_log = "WHERE " . implode(" AND ", $where_log);

		$main_query = "SELECT tl.timestamp, tl.log, cu.nama AS nama_user, cu.privileges
		FROM
		(SELECT id_cms_users, timestamp, log FROM tb_log $query_where_log) AS tl
		INNER JOIN (SELECT id, nama, privileges FROM cms_users WHERE deleted_at IS NULL) AS cu ON tl.id_cms_users = cu.id
		ORDER BY tl.timestamp DESC";

		$allRecords = $this->db->query($main_query);
		$totalRecords = $allRecords->num_rows();
		$totalRecordsWithFilter = $totalRecords;

		$main_query .= " LIMIT $start, $rowperpage";
		$record = $this->db->query($main_query)->result_array();

		$data = [];

		foreach ($record as $r) {
			$data[] = [
				'tanggal' => dateTimeIndo($r['timestamp']),
				'user' => $r['nama_user'],
				'privileges' => ucwords($r['privileges']),
				'log' => $r['log'],
			];
		}

		$response = array(
			"query" => $main_query,
			"draw" => intval($draw),
			"iTotalRecords" => $totalRecords,
			"iTotalDisplayRecords" => $totalRecordsWithFilter,
			"aaData" => $data,
		);
		return $response; 
	}
}

/* End of file M_log.php */
 ?>
