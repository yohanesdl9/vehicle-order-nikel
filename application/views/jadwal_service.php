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
		<div class="mb-2">
      <a href="<?= base_url('kendaraan') ?>"><i class="fas fa-chevron-circle-left"></i> Kembali ke halaman Kendaraan</a>
    </div>
		<div class="card">
			<div class="card-header">
				<h4 class="card-title">Tambah Data Jadwal Service</h4>
			</div>
			<div class="card-body">
				<form action="<?= base_url('kendaraan/insert_jadwal_service') ?>" method="post" id="insertJadwalService">
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
					<button type="submit" class="btn btn-success float-right"><i class="fas fa-save"></i> Simpan Data</button>
				</form>
			</div>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="table-responsive-md">
					<table class="table table-bordered">
						<tr>
							<th>Kendaraan</th>
							<td><?= $kendaraan['merek_kendaraan'] . ' ' . $kendaraan['model_kendaraan'] ?></td>
						</tr>
						<tr>
							<th>Nomor Polisi</th>
							<td><?= $kendaraan['nomor_polisi'] ?></td>
						</tr>
					</table>
				</div>
				<div class="table-responsive-md">
					<table class="table table-bordered datatable">
						<thead>
							<tr>
								<th class="text-center">Tanggal Service</th>
								<th class="text-center">Keterangan Service</th>
								<th class="text-center">Lokasi Service</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($service as $k) { ?>
							<tr>
								<td class="text-center"><?= dateIndo($k['tanggal_service']) ?></td>
								<td><?= nl2br($k['keterangan_service']) ?></td>
								<td><?= $k['lokasi_service'] ?></td>
								<td class="text-center">
									<a href="#" class="btn btn-sm btn-info" onclick="editJadwalService('<?= $k['id'] ?>')" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								</td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $this->load->view('template/modal', ['id' => 'editJadwalService', 'large' => false, 'title' => 'Update Data Jadwal Service', 'content' => 'modals/edit_jadwal_service', 'data' => []]) ?>
<script>
$('#insertJadwalService').submit(function(e){
	runFormValidation(e, '#insertJadwalService', '<?= base_url('kendaraan/jadwal_service_validation') ?>');
});

$('#updateJadwalService').submit(function(e){
	runFormValidation(e, '#updateJadwalService', '<?= base_url('kendaraan/jadwal_service_validation') ?>');
});

function editJadwalService(id) {
	$.get('<?= base_url('kendaraan/get_jadwal_service/') ?>' + id, function(result, status){
    if (status == 'success') {
      var data = JSON.parse(result);
      $('input[name="id_jadwal_service"]').val(id);
			$('#updateJadwalService input[name="tanggal_service"]').val(data.tanggal_service);
			$('#updateJadwalService textarea[name="keterangan_service"]').val(data.keterangan_service);
			$('#updateJadwalService input[name="lokasi_service"]').val(data.lokasi_service);
      $('#editJadwalService').modal('show');
    } else {
      Swal.fire({
        title: 'Oops...',
        text: 'Gagal mengambil data',
        icon: 'error'
      });
    }
  });
}
</script>
