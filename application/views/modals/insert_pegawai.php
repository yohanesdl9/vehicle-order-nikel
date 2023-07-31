<form action="<?= base_url('pegawai/insert') ?>" method="post" id="formInsertPegawai">
  <div class="modal-body">
		<div class="form-group row">
			<?= form_label('Nama Pegawai*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('nama', '', ['class' => 'form-control', 'placeholder' => 'Nama lengkap pegawai. Contoh : Ahmad Fauzi.']) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Alamat*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_textarea('alamat', '', ['class' => 'form-control', 'placeholder' => 'Alamat tempat tinggal pegawai. Contoh : Jl. Perusahaan Raya no. 20 Banjararum, Singosari, Kabupaten Malang.', 'rows' => 3]) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Telepon*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('telepon', '', ['class' => 'form-control', 'placeholder' => 'Nomor HP pegawai. Contoh : 089789898882']) ?>
			</div>
		</div>		
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan Data</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
  </div>
</form>
