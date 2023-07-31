<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pemesanan extends CI_Model {

	public function __construct(){
		parent::__construct();
	}
	
	public function get($id) {
		return $this->db->where('id', $id)->where('deleted_at', NULL)->get('tb_pemesanan_kendaraan');
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

	public function generate_kode_pemesanan() {
		$kode = $this->db->where('YEAR(created_at)', date('Y'))->get('tb_pemesanan_kendaraan')->num_rows() + 1;
		return 'ORD/' . date('Y') . str_pad($kode, 6, '0', STR_PAD_LEFT);
	}

	public function datatable($postData = null) {
		$where_query = ''; $array_wheres = [];
		$status_approval = [
			'<span class="badge badge-pill badge-primary"><i class="fas fa-clock"></i> Pending</span>',
			'<span class="badge badge-pill badge-success"><i class="fas fa-check-circle"></i> Disetujui</span>',
			'<span class="badge badge-pill badge-danger"><i class="fas fa-times-circle"></i> Ditolak</span>'
		];

		$draw = $postData['draw'];
    $start = $postData['start'];
    $rowperpage = $postData['length'];
    $searchValue = $postData['search']['value'];

		$date_mode = $postData['mode_tanggal'];
		$filter_mode = $postData['mode_filter'];
		$filter_approval_verifikator = $postData['filter_status_verifikator'];
		$filter_approval_admin = $postData['filter_status_admin'];

		switch($filter_mode) {
			case 'periode':
				$date_start = $postData['date_start'];
				$date_end = $postData['date_end'];
				$array_wheres[] = "DATE($date_mode) BETWEEN '$date_start' AND '$date_end'";
				break;
			case 'tanggal':
				$date = $postData['date'];
				$array_wheres[] = "DATE($date_mode) = '$date'";
				break;
			case 'bulan':
				$bulan = $postData['bulan'];
				$tahun = $postData['tahun'];
				$array_wheres[] = "(MONTH($date_mode) = $bulan AND YEAR($date_mode) = $tahun)";
				break;
		}

		if ($filter_approval_verifikator != 'all') $array_wheres[] = "status_approval_verifikator = $filter_approval_verifikator";
		if ($filter_approval_admin != 'all') $array_wheres[] = "status_approval_final = $filter_approval_admin";
		if (count($array_wheres) > 0) $where_query = "AND " . implode(" AND ", $array_wheres);

		$main_query = "SELECT tpk.id, tpk.kode_pesan, DATE(tpk.created_at) AS tanggal_pemesanan, tpk.tanggal_mulai, tpk.tanggal_selesai, tpeg.nama AS nama_pemesan, tdri.nama AS nama_driver, tk.merek_kendaraan, tk.model_kendaraan, tk.nomor_polisi, cu.nama AS verifikator, tpk.status_approval_verifikator, tpk.status_approval_final
		FROM
		(SELECT * FROM tb_pemesanan_kendaraan WHERE deleted_at IS NULL $where_query) AS tpk
		INNER JOIN (SELECT id, nama FROM tb_pegawai WHERE deleted_at IS NULL) AS tpeg ON tpk.id_pegawai = tpeg.id
		INNER JOIN (SELECT id, nama FROM tb_pegawai WHERE deleted_at IS NULL) AS tdri ON tpk.id_driver = tdri.id
		INNER JOIN (SELECT id, merek_kendaraan, model_kendaraan, nomor_polisi FROM tb_kendaraan WHERE deleted_at IS NULL) AS tk ON tpk.id_kendaraan = tk.id
		INNER JOIN (SELECT id, nama FROM cms_users WHERE privileges = 'verificator' AND deleted_at IS NULL) AS cu ON tpk.verifikator = cu.id
		ORDER BY tpk.$date_mode DESC";

		$allRecords = $this->db->query($main_query);
		$totalRecords = $allRecords->num_rows();
		$totalRecordsWithFilter = $totalRecords;

		$main_query .= " LIMIT $start, $rowperpage";
		$record = $this->db->query($main_query)->result_array();

		$data = [];

		foreach ($record as $r) {
			$aksi = ''; $tanggal_digunakan = '';

			if ($r['tanggal_mulai'] == $r['tanggal_selesai']) {
				$tanggal_digunakan = dateIndo($r['tanggal_mulai']);
			} else {
				$tanggal_digunakan = dateIndo($r['tanggal_mulai']) . ' - ' . dateIndo($r['tanggal_selesai']);
			}

			$data[] = [
				'kode_pesan' => $r['kode_pesan'],
				'tanggal_pemesanan' => dateIndo($r['tanggal_pemesanan']),
				'tanggal_digunakan' => $tanggal_digunakan,
				'pemesan' => $r['nama_pemesan'],
				'driver' => $r['nama_driver'],
				'kendaraan' => $r['merek_kendaraan'] . ' ' . $r['model_kendaraan'] . ' (' . $r['nomor_polisi'] . ')',
				'verifikator' => $r['verifikator'],
				'status_approval_verifikator' => $status_approval[$r['status_approval_verifikator']],
				'status_approval_final' => $status_approval[$r['status_approval_final']],
				'aksi' => $aksi,
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

	public function export($postData = null) {
		$where_query = ''; $array_wheres = [];
		$status_approval = ['Pending', 'Disetujui', 'Ditolak'];

		$date_mode = $postData['mode_tanggal'];
		$filter_mode = $postData['mode_filter'];
		$filter_approval_verifikator = $postData['filter_status_verifikator'];
		$filter_approval_admin = $postData['filter_status_admin'];

		switch($filter_mode) {
			case 'periode':
				$date_start = $postData['date_start'];
				$date_end = $postData['date_end'];
				$array_wheres[] = "DATE($date_mode) BETWEEN '$date_start' AND '$date_end'";
				break;
			case 'tanggal':
				$date = $postData['date'];
				$array_wheres[] = "DATE($date_mode) = '$date'";
				break;
			case 'bulan':
				$bulan = $postData['bulan'];
				$tahun = $postData['tahun'];
				$array_wheres[] = "(MONTH($date_mode) = $bulan AND YEAR($date_mode) = $tahun)";
				break;
		}

		if ($filter_approval_verifikator != 'all') $array_wheres[] = "status_approval_verifikator = $filter_approval_verifikator";
		if ($filter_approval_admin != 'all') $array_wheres[] = "status_approval_final = $filter_approval_admin";
		if (count($array_wheres) > 0) $where_query = "AND " . implode(" AND ", $array_wheres);

		$main_query = "SELECT tpk.id, tpk.kode_pesan, DATE(tpk.created_at) AS tanggal_pemesanan, tpk.keterangan, tpk.tanggal_mulai, tpk.tanggal_selesai, tpeg.nama AS nama_pemesan, tdri.nama AS nama_driver, tk.merek_kendaraan, tk.model_kendaraan, tk.nomor_polisi, cu.nama AS verifikator, tpk.status_approval_verifikator, tpk.status_approval_final
		FROM
		(SELECT * FROM tb_pemesanan_kendaraan WHERE deleted_at IS NULL $where_query) AS tpk
		INNER JOIN (SELECT id, nama FROM tb_pegawai WHERE deleted_at IS NULL) AS tpeg ON tpk.id_pegawai = tpeg.id
		INNER JOIN (SELECT id, nama FROM tb_pegawai WHERE deleted_at IS NULL) AS tdri ON tpk.id_driver = tdri.id
		INNER JOIN (SELECT id, merek_kendaraan, model_kendaraan, nomor_polisi FROM tb_kendaraan WHERE deleted_at IS NULL) AS tk ON tpk.id_kendaraan = tk.id
		INNER JOIN (SELECT id, nama FROM cms_users WHERE privileges = 'verificator' AND deleted_at IS NULL) AS cu ON tpk.verifikator = cu.id
		ORDER BY tpk.$date_mode DESC";

		$allRecords = $this->db->query($main_query)->result_array();

		$data = [];

		foreach ($allRecords as $r) {
			$tanggal_digunakan = '';

			if ($r['tanggal_mulai'] == $r['tanggal_selesai']) {
				$tanggal_digunakan = dateIndo($r['tanggal_mulai']);
			} else {
				$tanggal_digunakan = dateIndo($r['tanggal_mulai']) . ' - ' . dateIndo($r['tanggal_selesai']);
			}

			$data[] = [
				'kode_pesan' => $r['kode_pesan'],
				'tanggal_pemesanan' => dateIndo($r['tanggal_pemesanan']),
				'tanggal_digunakan' => $tanggal_digunakan,
				'pemesan' => $r['nama_pemesan'],
				'driver' => $r['nama_driver'],
				'keterangan' => $r['keterangan'],
				'kendaraan' => $r['merek_kendaraan'] . ' ' . $r['model_kendaraan'] . ' (' . $r['nomor_polisi'] . ')',
				'verifikator' => $r['verifikator'],
				'status_approval_verifikator' => $status_approval[$r['status_approval_verifikator']],
				'status_approval_final' => $status_approval[$r['status_approval_final']],
			];
		}

		return $data; 
	}
}

/* End of file M_perusahaan.php */
