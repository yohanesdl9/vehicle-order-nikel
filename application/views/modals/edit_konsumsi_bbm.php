<form action="<?= base_url('kendaraan/update_konsumsi_bbm') ?>" method="post" id="updateKonsumsiBbm">
  <div class="modal-body">
		<?= form_hidden('id_konsumsi_bbm', '') ?>
		<?= form_hidden('id_kendaraan', $kendaraan['id']) ?>
		<div class="form-group row">
			<?= form_label('Tanggal Pengecekan*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<input type="date" name="tanggal_check" class="form-control" value="<?= date('Y-m-d') ?>">
			</div>
		</div>
		<div class="form-group row">
			<?= form_label('Jarak Tempuh (km)*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<input type="number" name="jarak_tempuh" class="form-control" placeholder="Jarak tempuh kendaraan (dalam kilometer)" step="0.1">
			</div>
		</div>
		<div class="form-group row">
			<?= form_label('Konsumsi BBM (km/L)*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<input type="number" name="konsumsi_bbm" class="form-control" placeholder="Konsumsi bahan bakar kendaraan (dalam kilometer per liter)" step="0.1">
			</div>
		</div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan Data</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
  </div>
</form>
