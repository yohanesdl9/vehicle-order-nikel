<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {
	
	public function __construct(){
		parent::__construct();
	}

	public function get_jumlah_pemesanan($mode = 'tahun') {
		$data = [
			'pending' => $this->get_pemesanan_by_approval_status(0, 0, $mode),
			'approved_verificator' => $this->get_pemesanan_by_approval_status(1, 0, $mode),
			'rejected_verificator' => $this->get_pemesanan_by_approval_status(2, 0, $mode),
			'approved_final' => $this->get_pemesanan_by_approval_status(1, 1, $mode),
			'rejected_final' => $this->get_pemesanan_by_approval_status(1, 2, $mode),
		];

		$total = 0;

		foreach ($data as $key => $value) $total += $value;
		$data['total_overall'] = $total;

		return $data;
	}
	
	public function get_grafik_penggunaan_kendaraan($mode = 'bulan'){
		if ($mode == 'bulan') {
			$where_query = "(MONTH(tanggal_mulai) = MONTH(NOW()) AND YEAR(tanggal_mulai) = YEAR(NOW()))";
		} else if ($mode == 'tahun') {
			$where_query = "YEAR(tanggal_mulai) = YEAR(NOW()))";
		}

		$query = "SELECT tk.merek_kendaraan, tk.model_kendaraan, tk.nomor_polisi, IFNULL(main.jumlah_pemakaian, 0) AS jumlah_pemakaian
		FROM (SELECT * FROM tb_kendaraan WHERE deleted_at IS NULL) AS tk
		LEFT JOIN (SELECT id_kendaraan, Count(id) AS jumlah_pemakaian FROM tb_pemesanan_kendaraan
		WHERE deleted_at IS NULL AND status_approval_verifikator = 1 AND status_approval_final = 1 AND MONTH(tanggal_mulai) = MONTH(NOW()) AND YEAR(tanggal_mulai) = YEAR(NOW())
		GROUP BY id_kendaraan) AS main ON main.id_kendaraan = tk.id
		LIMIT 0, 5";

		$result = $this->db->query($query)->result_array();

		$label = []; $value = [];

		foreach ($result as $res) {
			$label[] = $res['merek_kendaraan'] . ' ' . $res['model_kendaraan'] . ' - ' . $res['nomor_polisi'];
			$value[] = $res['jumlah_pemakaian'];
		}

		return [
			'label' => $label,
			'value' => $value
		];
	}

	public function get_pemesanan_by_approval_status($verificator_approval_status, $final_approval_status, $mode = 'lifetime') {
		if ($mode == 'bulan') {
			$this->db->where('MONTH(created_at)', date('n'));
			$this->db->where('YEAR(created_at)', date('Y'));
		} else if ($mode == 'tahun') {
			$this->db->where('YEAR(created_at)', date('Y'));
		}

		$this->db->where('deleted_at', NULL);
		$this->db->where('status_approval_verifikator', $verificator_approval_status);
		$this->db->where('status_approval_final', $final_approval_status);
		if ($this->session->userdata('privileges') == 'verificator') {
			$this->db->where('verifikator', $this->session->userdata('id'));
		}
		return $this->db->get('tb_pemesanan_kendaraan')->num_rows();
	}
}

/* End of file M_dashboard.php */
