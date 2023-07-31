<form action="<?= base_url('pemesanan/insert') ?>" method="post" id="formInsertPemesanan">
  <div class="modal-body">
		<div class="form-group row">
			<?= form_label('Pemesan*', '', ['class' => 'col-md-2 col-form-label']) ?>
			<div class="col-md-10">
				<select name="id_pegawai" class="form-control select2">
					<option value="">Silahkan Pilih Pemesan</option>
					<?php foreach ($pegawai as $p) { ?>
					<option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<?= form_label('Driver*', '', ['class' => 'col-md-2 col-form-label']) ?>
			<div class="col-md-10">
				<select name="id_driver" class="form-control select2">
					<option value="">Silahkan Pilih Driver</option>
					<?php foreach ($pegawai as $p) { ?>
					<option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<?= form_label('Kendaraan*', '', ['class' => 'col-md-2 col-form-label']) ?>
			<div class="col-md-10">
				<select name="id_kendaraan" class="form-control select2">
					<option value="">Silahkan Pilih Kendaraan</option>
					<?php foreach ($kendaraan as $p) { ?>
					<option value="<?= $p['id'] ?>"><?= $p['nomor_polisi'] . ' - ' . $p['merek_kendaraan'] . ' ' . $p['model_kendaraan'] ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
		<div class="form-group row">
			<?= form_label('Keterangan*', '', ['class' => 'col-md-2 col-form-label']) ?>
			<div class="col-md-10">
				<?= form_textarea('keterangan', '', ['class' => 'form-control', 'placeholder' => 'Keterangan terkait pemesanan yang dibuat', 'rows' => '3']); ?>
			</div>
		</div>
		<div class="form-group row">
			<?= form_label('Tanggal Pemakaian*', '', ['class' => 'col-md-2 col-form-label']) ?>
			<div class="col-md-3">
				<input type="date" name="tanggal_mulai" class="form-control" min="<?= date('Y-m-d', strtotime('+1 day')) ?>">
			</div>
			<?= form_label('s.d.', '', ['class' => 'col-md-1 col-form-label text-center']) ?>
			<div class="col-md-3">
				<input type="date" name="tanggal_selesai" class="form-control" min="<?= date('Y-m-d', strtotime('+2 day')) ?>">
			</div>
			<div class="col-md-3">
				<div class="form-check-inline mt-2">
					<?= form_checkbox('is_satu_hari', '1', FALSE, ['class' => 'form-check-input']) ?>
					<?= form_label('Satu Hari Pemakaian', '', ['class' => 'form-check-label']) ?>
				</div>
			</div>
		</div>
		<div class="form-group row">
			<?= form_label('Staf Verifikasi*', '', ['class' => 'col-md-2 col-form-label']) ?>
			<div class="col-md-10">
				<select name="verifikator" class="form-control select2">
					<option value="">Silahkan Pilih User Staf Verifikasi</option>
					<?php foreach ($verifikator as $p) { ?>
					<option value="<?= $p['id'] ?>"><?= $p['nama'] ?></option>
					<?php } ?>
				</select>
			</div>
		</div>
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan Data</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
  </div>
</form>
