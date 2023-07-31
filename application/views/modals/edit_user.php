<form action="<?= base_url('user/update') ?>" method="post" id="formUpdateUser">
  <div class="modal-body">
		<?= form_hidden('id_user', '') ?>
		<div class="form-group row">
			<?= form_label('Nama Pengguna*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('nama', '', ['class' => 'form-control', 'placeholder' => 'Nama pengguna. Contoh : Admin CS.']) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Hak Akses*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<div class="form-check-inline mt-2">
					<?= form_radio('privileges', 'admin', true, ['class' => 'form-check-input']) ?>
					<?= form_label('Admin', '', ['class' => 'form-check-label']) ?>
				</div>
				<div class="form-check-inline mt-2">
					<?= form_radio('privileges', 'verificator', false, ['class' => 'form-check-input']) ?>
					<?= form_label('Verificator', '', ['class' => 'form-check-label']) ?>
				</div>
			</div>
		</div>	
		<div class="form-group row">
			<?= form_label('Username*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_input('username', '', ['class' => 'form-control', 'placeholder' => 'Username untuk login ke sistem. Contoh : admin_cs.']) ?>
			</div>
		</div>		
		<div class="form-group row">
			<?= form_label('Password*', '', ['class' => 'col-md-3 col-form-label']) ?>
			<div class="col-md-9">
				<?= form_password('password', '', ['class' => 'form-control', 'placeholder' => 'Masukkan password di sini.']) ?>
			</div>
		</div>		
  </div>
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary">Simpan Data</button>
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
  </div>
</form>
