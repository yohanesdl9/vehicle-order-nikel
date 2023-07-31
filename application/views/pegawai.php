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
				<a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#insertPegawai"><i class="fas fa-plus"></i> Tambah Data</a>
				<div class="table-responsive">
					<table class="table table-bordered datatable">
						<thead>
							<tr>
								<th class="text-center">Nama Pegawai</th>
								<th class="text-center">Alamat</th>
								<th class="text-center">Telepon</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($pegawai as $p) { ?>
							<tr>
								<td><?= $p['nama'] ?></td>
								<td><?= $p['alamat'] ?></td>
								<td class="text-center"><?= $p['telepon'] ?></td>
								<td class="text-center">
								<a href="#" class="btn btn-sm btn-secondary" onclick="editPegawai('<?= $p['id'] ?>')" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								<a href="#" class="btn btn-sm btn-danger" onclick="confirmHapus('<?= base_url('pegawai/delete/' . $p['id']) ?>')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></a>
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
<?php $this->load->view('template/modal', ['id' => 'insertPegawai', 'large' => true, 'title' => 'Tambah Data Pegawai', 'content' => 'modals/insert_pegawai', 'data' => []]) ?>
<?php $this->load->view('template/modal', ['id' => 'editPegawai', 'large' => true, 'title' => 'Edit Data Pegawai', 'content' => 'modals/edit_pegawai', 'data' => []]) ?>
<script>
$('#formInsertPegawai').submit(function(e){
	runFormValidation(e, '#formInsertPegawai', '<?= base_url('pegawai/validation') ?>');
});

$('#formUpdatePegawai').submit(function(e){
	runFormValidation(e, '#formUpdatePegawai', '<?= base_url('pegawai/validation') ?>');
});

function editPegawai(id) {
	$.get('<?= base_url('pegawai/get/') ?>' + id, function(result, status){
    if (status == 'success') {
      var data = JSON.parse(result);
      $('input[name="id_pegawai"]').val(id);
			$('#formUpdatePegawai input[name="nama"]').val(data.nama);
			$('#formUpdatePegawai textarea[name="alamat"]').val(data.alamat);
			$('#formUpdatePegawai input[name="telepon"]').val(data.telepon);
      $('#editPegawai').modal('show');
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
