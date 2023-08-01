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
				<h4 class="card-title">Tambah Data Konsumsi BBM</h4>
			</div>
			<div class="card-body">
				<form action="<?= base_url('kendaraan/insert_konsumsi_bbm') ?>" method="post" id="insertKonsumsiBbm">
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
								<th class="text-center">Tanggal Pengecekan</th>
								<th class="text-center">Jarak Tempuh (km)</th>
								<th class="text-center">Konsumsi BBM (km/L)</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($konsumsi as $k) { ?>
							<tr>
								<td class="text-center"><?= dateIndo($k['tanggal_check']) ?></td>
								<td class="text-center"><?= number_format($k['jarak_tempuh'], 1, ',', '.') ?></td>
								<td class="text-center"><?= number_format($k['konsumsi_bbm'], 1, ',', '.') ?></td>
								<td class="text-center">
									<a href="#" class="btn btn-sm btn-info" onclick="editKonsumsiBbm('<?= $k['id'] ?>')" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
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
<?php $this->load->view('template/modal', ['id' => 'editKonsumsiBbm', 'large' => false, 'title' => 'Update Data Konsumsi BBM', 'content' => 'modals/edit_konsumsi_bbm', 'data' => []]) ?>
<script>
$('#insertKonsumsiBbm').submit(function(e){
	runFormValidation(e, '#insertKonsumsiBbm', '<?= base_url('kendaraan/konsumsi_bbm_validation') ?>');
});

$('#updateKonsumsiBbm').submit(function(e){
	runFormValidation(e, '#updateKonsumsiBbm', '<?= base_url('kendaraan/konsumsi_bbm_validation') ?>');
});

function editKonsumsiBbm(id) {
	$.get('<?= base_url('kendaraan/get_konsumsi_bbm/') ?>' + id, function(result, status){
    if (status == 'success') {
      var data = JSON.parse(result);
      $('input[name="id_konsumsi_bbm"]').val(id);
			$('#updateKonsumsiBbm input[name="tanggal_check"]').val(data.tanggal_check);
			$('#updateKonsumsiBbm input[name="jarak_tempuh"]').val(data.jarak_tempuh);
			$('#updateKonsumsiBbm input[name="konsumsi_bbm"]').val(data.konsumsi_bbm);
      $('#editKonsumsiBbm').modal('show');
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
