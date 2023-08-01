<div class="modal-body">
	<table class="table table-borderless" id="tableInfoDetail">
		<tr>
			<th>Kode Pemesanan</th>
			<td id="kode_pesan"></td>
		</tr>
		<tr>
			<th>Tanggal Pemesanan</th>
			<td id="tanggal_pemesanan"></td>
		</tr>
		<tr>
			<th>Tanggal Pemakaian</th>
			<td id="tanggal_digunakan"></td>
		</tr>
		<tr>
			<th>Pemesan</th>
			<td id="nama_pemesan"></td>
		</tr>
		<tr>
			<th>Driver</th>
			<td id="nama_driver"></td>
		</tr>
		<tr>
			<th>Kendaraan</th>
			<td id="kendaraan"></td>
		</tr>
	</table>
	<h4>Status Verifikasi</h4>
	<table class="table table-bordered" id="tableStatusVerifikasi">
		<thead>
			<tr>
				<th class="text-center">Pihak Yang Menyetujui</th>
				<th class="text-center">Status Verifikasi</th>
				<th class="text-center">Tanggal Verifikasi</th>
				<th class="text-center">Alasan Ditolak (Jika Status Ditolak)</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td class="text-center" id="verifikator"></td>
				<td class="text-center" id="status_approval_verifikator"></td>
				<td class="text-center" id="tanggal_approval_verifikator"></td>
				<td id="reason_rejected_verifikator"></td>
			</tr>
			<tr>
				<td class="text-center">Admin</td>
				<td class="text-center" id="status_approval_final"></td>
				<td class="text-center" id="tanggal_approval_final"></td>
				<td id="reason_rejected_final"></td>
			</tr>
		</tbody>
	</table>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
</div>
