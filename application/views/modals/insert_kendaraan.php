<form action="<?= base_url('kendaraan/insert') ?>" method="post" id="formInsertKendaraan">
  <div class="modal-body">
		<div class="form-group row">
			<?= form_label('Merek Kendaraan*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('merek_kendaraan', '', ['class' => 'form-control', 'placeholder' => 'Merek Kendaraan. Contoh : Mitsubishi.']) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Model Kendaraan*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('model_kendaraan', '', ['class' => 'form-control', 'placeholder' => 'Model Kendaraan. Contoh : Fuso.']) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Nomor Polisi*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('nomor_polisi', '', ['class' => 'form-control', 'placeholder' => 'Nomor Polisi Kendaraan. Contoh : N9883UA']) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Nomor Rangka', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('nomor_rangka', '', ['class' => 'form-control', 'placeholder' => 'Nomor rangka sesuai yang tertera di STNK. Contoh : MH2KB21104L043392']) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Nomor Mesin', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('nomor_mesin', '', ['class' => 'form-control', 'placeholder' => 'Nomor mesin sesuai yang tertera di STNK. Contoh : JB43E8998288']) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Tahun Kendaraan*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<input type="number" name="tahun" class="form-control" placeholder="Tahun pembuatan kendaraan. Contoh : 2014">
			</div>
		</div>
		<div class="form-group row">
			<?= form_label('Jenis Angkutan*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<div class="form-check-inline mt-2">
					<?= form_radio('jenis_angkutan', 'orang', true, ['class' => 'form-check-input']) ?>
					<?= form_label('Orang', '', ['class' => 'form-check-label']) ?>
				</div>
				<div class="form-check-inline mt-2">
					<?= form_radio('jenis_angkutan', 'barang', false, ['class' => 'form-check-input']) ?>
					<?= form_label('Barang', '', ['class' => 'form-check-label']) ?>
				</div>
			</div>
		</div>				
		<div class="form-group row">
			<?= form_label('Tipe Kepemilikan*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<div class="form-check-inline mt-2">
					<?= form_radio('tipe_kepemilikan', 'perusahaan', true, ['class' => 'form-check-input']) ?>
					<?= form_label('Milik Perusahaan', '', ['class' => 'form-check-label']) ?>
				</div>
				<div class="form-check-inline mt-2">
					<?= form_radio('tipe_kepemilikan', 'sewa', false, ['class' => 'form-check-input']) ?>
					<?= form_label('Sewa dari Rental', '', ['class' => 'form-check-label']) ?>
				</div>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Tempat Rental Kendaraan*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<select name="id_perusahaan" class="form-control select2">
					<option value="">Silahkan Pilih Perusahaan</option>
					<?php foreach ($perusahaan as $p) { ?>
					<option value="<?= $p['id'] ?>"><?= $p['nama_perusahaan'] ?></option>
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
