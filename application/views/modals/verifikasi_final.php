<form action="<?= base_url('pemesanan/verifikasi_final') ?>" method="post" id="formVerifikasiFinal">
  <div class="modal-body">
		<?= form_hidden('id_pemesanan', '') ?>
		<?= form_hidden('kode_pesan', '') ?>
		<table class="table table-borderless" id="tableInfoFinal">
			<tr>
				<th style="width: 30%;">Kode Pemesanan</th>
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
			<tr>
				<th>Staf Verifikasi</th>
				<td id="verifikator"></td>
			</tr>
			<tr>
				<th>Status Verifikasi (dari Verifikator)</th>
				<td id="status_approval_verifikator"></td>
			</tr>
			<tr>
				<th>Tanggal Verifikasi (dari Verifikator)</th>
				<td id="tanggal_approval_verifikator"></td>
			</tr>
			<tr>
				<th>Pilih Status Verifikasi</th>
				<td>
					<div class="form-check-inline">
						<?= form_radio('status_approval_final', 1, true, ['class' => 'form-check-input']) ?>
						<?= form_label('Disetujui', '', ['class' => 'form-check-label']) ?>
					</div>
					<div class="form-check-inline">
						<?= form_radio('status_approval_final', 2, false, ['class' => 'form-check-input']) ?>
						<?= form_label('Ditolak', '', ['class' => 'form-check-label']) ?>
					</div>	
				</td>
			</tr>
			<tr>
				<th>Alasan Pemesanan Ditolak</th>
				<td><?= form_textarea('reason_rejected_final', '', ['class' => 'form-control', 'rows' => '5', 'placeholder' => 'Berikan alasan mengapa pesanan ditolak (jika memilih status ditolak)']) ?></td>
			</tr>
		</table>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan Data</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
  </div>
</form>
