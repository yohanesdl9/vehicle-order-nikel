<form action="<?= base_url('kendaraan/update_jadwal_service') ?>" method="post" id="updateJadwalService">
  <div class="modal-body">
		<?= form_hidden('id_jadwal_service', '') ?>
		<?= form_hidden('id_kendaraan', $kendaraan['id']) ?>
		<div class="form-group row">
			<?= form_label('Tanggal Service*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<input type="date" name="tanggal_service" class="form-control" value="<?= date('Y-m-d') ?>">
			</div>
		</div>
		<div class="form-group row">
			<?= form_label('keterangan Service*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_textarea('keterangan_service', '', ['class' => 'form-control', 'placeholder' => 'Keterangan service yang dilakukan. Contoh : service kaki-kaki', 'rows' => '5']) ?>
			</div>
		</div>
		<div class="form-group row">
			<?= form_label('Lokasi Service*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('lokasi_service', '', ['class' => 'form-control', 'placeholder' => 'Lokasi service akan dilakukan. Contoh : Mitsubishi Krama Yudha Jakarta.']) ?>
			</div>
		</div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan Data</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
  </div>
</form>
