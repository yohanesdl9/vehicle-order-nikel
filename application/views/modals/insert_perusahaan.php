<form action="<?= base_url('perusahaan/insert') ?>" method="post" id="formInsertPerusahaan">
  <div class="modal-body">
		<div class="form-group row">
			<?= form_label('Nama Perusahaan*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('nama_perusahaan', '', ['class' => 'form-control', 'placeholder' => 'Nama perusahaan rental kendaraan. Contoh : Autonet Rent Car']) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Alamat*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_textarea('alamat', '', ['class' => 'form-control', 'placeholder' => 'Alamat lokasi perusahaan rental kendaraan. Contoh : Jl. Perusahaan Raya no. 20 Banjararum, Singosari, Kabupaten Malang.', 'rows' => 3]) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Telepon*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('telepon', '', ['class' => 'form-control', 'placeholder' => 'Nomor telepon perusahaan rental kendaraan. Contoh : 08833339991']) ?>
			</div>
		</div>		
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan Data</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
  </div>
</form>
