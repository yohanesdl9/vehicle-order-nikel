<div class="row">
	<div class="col-md-12">
		<?php if($this->session->flashdata('message')) { ?>
		<div class="alert alert-<?= $this->session->flashdata('color') ?> alert-dismissible mt-2" role="alert">
			<?= $this->session->flashdata('message') ?>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div> 
		<?php } ?> 
		<div class="card">
      <div class="card-body">
				<?php if ($this->session->userdata('privileges') == 'admin') { ?>
					<a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#insertPemesanan"><i class="fas fa-plus"></i> Tambah Pemesanan Baru</a>
				<?php } ?>
				<form action="<?= base_url('pemesanan/export_excel') ?>" method="POST">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group row">
								<?= form_label('Filter dan Urutkan Dari (Paling Baru)', '', ['class' => 'col-md-3 col-form-label text-left']) ?>
								<div class="col-md-9">
									<select name="mode_tanggal" id="" class="form-control select2">
										<option value="created_at" selected>Tanggal Pemesanan</option>
										<option value="tanggal_mulai">Tanggal Mulai Digunakan</option>
										<option value="tanggal_selesai">Tanggal Selesai Digunakan</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<div class="form-check mt-2">
										<?= form_radio('mode_filter', 'periode', false, ['class' => 'form-check-input']) ?>
										<?= form_label('Periode Tanggal', '', ['class' => 'form-check-label']) ?>
									</div>
								</div>
								<div class="col-md-4">
									<input type="date" name="date_start" class="form-control" value="<?= date("Y-m-d", strtotime('-7 days')) ?>">
								</div>
								<?= form_label('s.d.', '', ['class' => 'col-md-1 col-form-label text-center']) ?>
								<div class="col-md-4">
									<input type="date" name="date_end" class="form-control" value="<?= date("Y-m-d") ?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<div class="form-check mt-2">
										<?= form_radio('mode_filter', 'tanggal', true, ['class' => 'form-check-input']) ?>
										<?= form_label('Tanggal ', '', ['class' => 'form-check-label']) ?>
									</div>
								</div>
								<div class="col-md-9">
									<input type="date" name="date" class="form-control" value="<?= date("Y-m-d") ?>">
								</div>
							</div>
							<div class="form-group row">
								<div class="col-md-3">
									<div class="form-check mt-2">
										<?= form_radio('mode_filter', 'bulan', false, ['class' => 'form-check-input']) ?>
										<?= form_label('Bulan dan Tahun', '', ['class' => 'form-check-label']) ?>
									</div>
								</div>
								<div class="col-md-5">
									<select name="bulan" class="form-control">
										<?php foreach ($months as $key => $value){ ?>
											<option value="<?= $key ?>" <?= $key == date('n') ? 'selected' : '' ?>><?= $value ?></option>
										<?php } ?>
									</select>
								</div>
								<div class="col-md-4">
									<select name="tahun" class="form-control">
										<?php for ($i = date('Y', strtotime('-5 years')); $i <= date('Y'); $i++) { ?>
											<option value="<?= $i ?>" <?= $i == date('Y') ? 'selected' : '' ?>><?= $i ?></option>
										<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group row">
								<?= form_label('Filter Status Approval Verifikator', '', ['class' => 'col-md-4 col-form-label text-left']) ?>
								<div class="col-md-8">
									<select name="filter_status_verifikator" id="" class="form-control select2">
										<option value="all" selected>Semua Status</option>
										<option value="0">Pending</option>
										<option value="1">Disetujui</option>
										<option value="1">Ditolak</option>
									</select>
								</div>
							</div>
							<div class="form-group row">
								<?= form_label('Filter Status Approval Admin', '', ['class' => 'col-md-4 col-form-label text-left']) ?>
								<div class="col-md-8">
									<select name="filter_status_admin" id="" class="form-control select2">
										<option value="all" selected>Semua Status</option>
										<option value="0">Pending</option>
										<option value="1">Disetujui</option>
										<option value="1">Ditolak</option>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-12">
							<button type="submit" class="btn btn-success float-right"><i class="fas fa-file-excel"></i> Ekspor ke Excel</button>
						</div>
					</div>
				</form>
        <div class="table-responsive-md mt-3">
          <table class="table table-bordered table-striped table-hover" id="tablePemesanan">
            <thead>
              <tr>
								<th class="text-center">Kode Pemesanan</th>
                <th class="text-center">Tanggal Pemesanan</th>
								<th class="text-center">Tanggal Pemakaian</th>
                <th class="text-center">Pemesan</th>
                <th class="text-center">Driver</th>
								<th class="text-center">Kendaraan</th>
								<th class="text-center">Verifikator</th>
                <th class="text-center">Status Approval Verifikator</th>
								<th class="text-center">Status Approval Admin</th>
								<th class="text-center">Aksi</th>
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table>
        </div>
      </div>
    </div>
	</div>
</div>
<?php $this->load->view('template/modal', ['id' => 'insertPemesanan', 'large' => true, 'title' => 'Tambah Pemesanan Baru', 'content' => 'modals/insert_pemesanan', 'data' => []]) ?>
<script>
$(document).ready(function(){
	$('input[name="mode_filter"]:checked').trigger('change');
	$('input[name="is_satu_hari"]').trigger('change');
	$('input[name="tanggal_mulai"]').trigger('change');

	var datatable = $('#tablePemesanan').DataTable({
    'responsive': true,
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'searching': true,
    'ordering': false,
    'destroy': true,
    'ajax': {
      'url': "<?= base_url('pemesanan/datatable') ?>",
      'data': function(data){
				data.mode_tanggal = $('select[name="mode_tanggal"]').val();
        data.mode_filter = $('input[name="mode_filter"]:checked').val();
        data.date_start = $('input[name="date_start"]').val();
        data.date_end = $('input[name="date_end"]').val();
        data.date = $('input[name="date"]').val();
        data.bulan = $('select[name="bulan"]').val();
        data.tahun = $('select[name="tahun"]').val();
				data.filter_status_verifikator = $('select[name="filter_status_verifikator"]').val();
				data.filter_status_admin = $('select[name="filter_status_admin"]').val();
      },
    },
    'columns': [
			{ data : 'kode_pesan' },
			{ data : 'tanggal_pemesanan' },
			{ data : 'tanggal_digunakan' },
			{ data : 'pemesan' },
			{ data : 'driver' },
			{ data : 'kendaraan' },
			{ data : 'verifikator' },
			{ data : 'status_approval_verifikator' },
			{ data : 'status_approval_final' },
			{ data : 'aksi' },
    ],
    'columnDefs': [
      {
        targets: [0, 1, 2, 7, 8, 9],
        className: 'text-center'
      },
    ],
  });

	$('input[name="date_start"]').change(function(){
		datatable.draw();
	});

	$('input[name="date_end"]').change(function(){
		datatable.draw();
	});

	$('input[name="date"]').change(function(){
		datatable.draw();
	});

	$('select[name="bulan"]').change(function(){
		datatable.draw();
	});

	$('select[name="tahun"]').change(function(){
		datatable.draw();
	});

	$('select[name="mode_tanggal"]').change(function(){
		datatable.draw();
	});

	$('input[name="mode_filter"]').change(function(){
		datatable.draw();
	});

	$('select[name="filter_status_verifikator"]').change(function(){
		datatable.draw();
	});

	$('select[name="filter_status_admin"]').change(function(){
		datatable.draw();
	});
});

$('input[name="mode_filter"]').change(function(){
	var value = $(this).val();
	$('input[name="date_start"]').attr('disabled', (value != 'periode'));
	$('input[name="date_end"]').attr('disabled', (value != 'periode'));
	$('input[name="date"]').attr('disabled', (value != 'tanggal'));
	$('select[name="bulan"]').attr('disabled', (value != 'bulan'));
	$('select[name="tahun"]').attr('disabled', (value != 'bulan'));
});

$('#formInsertPemesanan').submit(function(e){
	runFormValidation(e, '#formInsertPemesanan', '<?= base_url('pemesanan/validation') ?>');
});

$('input[name="is_satu_hari"]').change(function(){
	var checked = $(this).is(':checked');
	var selector = $(this).closest('form').attr('id');
	$('#' + selector + ' input[name="tanggal_selesai"]').attr('disabled', checked);
	if ($('#' + selector + ' input[name="tanggal_selesai"]').val() != '') $('#' + selector + ' input[name="tanggal_selesai"]').val('');
});

$('input[name="tanggal_mulai"]').change(function(){
	var value = $(this).val();
	var selector = $(this).closest('form').attr('id');
	var date = new Date(value);
	if (value != '') {
		var new_limit_date = new Date(date.setDate(date.getDate() + 1)).toISOString().split('T')[0];
		$('#' + selector + ' input[name="tanggal_selesai"]').attr('min', new_limit_date);
		if ($('#' + selector + ' input[name="tanggal_selesai"]').val() != '') $('#' + selector + ' input[name="tanggal_selesai"]').val(new_limit_date);
	}
	// $('#' + selector + ' input[name="tanggal_selesai"]').attr('disabled', checked);
});
</script>
