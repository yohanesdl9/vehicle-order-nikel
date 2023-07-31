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
				<a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#insertPerusahaan"><i class="fas fa-plus"></i> Tambah Data</a>
				<div class="table-responsive">
					<table class="table table-bordered datatable">
						<thead>
							<tr>
								<th class="text-center">Nama Perusahaan</th>
								<th class="text-center">Alamat</th>
								<th class="text-center">Telepon</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($perusahaan as $p) { ?>
							<tr>
								<td><?= $p['nama_perusahaan'] ?></td>
								<td><?= $p['alamat'] ?></td>
								<td class="text-center"><?= $p['telepon'] ?></td>
								<td class="text-center">
								<a href="#" class="btn btn-sm btn-secondary" onclick="editPerusahaan('<?= $p['id'] ?>')" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								<a href="#" class="btn btn-sm btn-danger" onclick="confirmHapus('<?= base_url('perusahaan/delete/' . $p['id']) ?>')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></a>
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
<?php $this->load->view('template/modal', ['id' => 'insertPerusahaan', 'large' => true, 'title' => 'Tambah Data Perusahaan Rental Kendaraan', 'content' => 'modals/insert_perusahaan', 'data' => []]) ?>
<?php $this->load->view('template/modal', ['id' => 'editPerusahaan', 'large' => true, 'title' => 'Tambah Data Perusahaan Rental Kendaraan', 'content' => 'modals/edit_perusahaan', 'data' => []]) ?>
<script>
$('#formInsertPerusahaan').submit(function(e){
	runFormValidation(e, '#formInsertPerusahaan', '<?= base_url('perusahaan/validation') ?>');
});

$('#formUpdatePerusahaan').submit(function(e){
	runFormValidation(e, '#formUpdatePerusahaan', '<?= base_url('perusahaan/validation') ?>');
});

function editPerusahaan(id) {
	$.get('<?= base_url('perusahaan/get/') ?>' + id, function(result, status){
    if (status == 'success') {
      var data = JSON.parse(result);
      $('input[name="id_perusahaan"]').val(id);
			$('#formUpdatePerusahaan input[name="nama_perusahaan"]').val(data.nama_perusahaan);
			$('#formUpdatePerusahaan textarea[name="alamat"]').val(data.alamat);
			$('#formUpdatePerusahaan input[name="telepon"]').val(data.telepon);
      $('#editPerusahaan').modal('show');
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
