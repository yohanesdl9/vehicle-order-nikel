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
				<a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#insertKendaraan"><i class="fas fa-plus"></i> Tambah Data</a>
				<div class="table-responsive">
					<table class="table table-bordered datatable">
						<thead>
							<tr>
								<th class="text-center">Merek & Model Kendaraan</th>
								<th class="text-center">Nomor Polisi</th>
								<th class="text-center">Tahun Kendaraan</th>
								<th class="text-center">Tipe Kepemilikan</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($kendaraan as $p) { ?>
							<tr>
								<td><?= $p['merek_kendaraan'] . ' ' . $p['model_kendaraan'] ?></td>
								<td class="text-center"><?= $p['nomor_polisi'] ?></td>
								<td class="text-center"><?= $p['tahun'] ?></td>
								<td class="text-center"><?= ucwords($p['tipe_kepemilikan']) ?></td>
								<td class="text-center">
								<a href="#" class="btn btn-sm btn-secondary" onclick="editKendaraan('<?= $p['id'] ?>')" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								<a href="#" class="btn btn-sm btn-danger" onclick="confirmHapus('<?= base_url('kendaraan/delete/' . $p['id']) ?>')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></a>
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
<?php $this->load->view('template/modal', ['id' => 'insertKendaraan', 'large' => true, 'title' => 'Tambah Data Kendaraan', 'content' => 'modals/insert_kendaraan', 'data' => []]) ?>
<?php $this->load->view('template/modal', ['id' => 'editKendaraan', 'large' => true, 'title' => 'Edit Data Kendaraan', 'content' => 'modals/edit_kendaraan', 'data' => []]) ?>
<script>
$('#formInsertKendaraan').submit(function(e){
	runFormValidation(e, '#formInsertKendaraan', '<?= base_url('kendaraan/validation') ?>');
});

$('#formUpdateKendaraan').submit(function(e){
	runFormValidation(e, '#formUpdateKendaraan', '<?= base_url('kendaraan/validation') ?>');
});

function editKendaraan(id) {
	$.get('<?= base_url('kendaraan/get/') ?>' + id, function(result, status){
    if (status == 'success') {
      var data = JSON.parse(result);
      // $('input[name="id_kendaraan"]').val(id);
			// $('#formUpdateKendaraan input[name="nama"]').val(data.nama);
			// $('#formUpdateKendaraan textarea[name="alamat"]').val(data.alamat);
			// $('#formUpdateKendaraan input[name="telepon"]').val(data.telepon);
      $('#editKendaraan').modal('show');
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
