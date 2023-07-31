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
				<a href="#" class="btn btn-success mb-3" data-toggle="modal" data-target="#insertUser"><i class="fas fa-plus"></i> Tambah Data</a>
				<div class="table-responsive">
					<table class="table table-bordered datatable">
						<thead>
							<tr>
								<th class="text-center">Nama Pengguna</th>
								<th class="text-center">Username</th>
								<th class="text-center">Role</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody>
						<?php foreach ($user as $p) { ?>
							<tr>
								<td><?= $p['nama'] ?></td>
								<td><?= $p['username'] ?></td>
								<td class="text-center"><?= ucwords($p['privileges']) ?></td>
								<td class="text-center">
								<a href="#" class="btn btn-sm btn-secondary" onclick="editUser('<?= $p['id'] ?>')" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a>
								<a href="#" class="btn btn-sm btn-danger" onclick="confirmHapus('<?= base_url('user/delete/' . $p['id']) ?>')" data-toggle="tooltip" data-placement="top" title="Hapus"><i class="fas fa-trash"></i></a>
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
<?php $this->load->view('template/modal', ['id' => 'insertUser', 'large' => true, 'title' => 'Tambah Data User', 'content' => 'modals/insert_user', 'data' => []]) ?>
<?php $this->load->view('template/modal', ['id' => 'editUser', 'large' => true, 'title' => 'Edit Data User', 'content' => 'modals/edit_user', 'data' => []]) ?>
<script>
$('#formInsertUser').submit(function(e){
	runFormValidation(e, '#formInsertUser', '<?= base_url('user/validation') ?>');
});

$('#formUpdateUser').submit(function(e){
	runFormValidation(e, '#formUpdateUser', '<?= base_url('user/validation') ?>');
});

function editUser(id) {
	$.get('<?= base_url('user/get/') ?>' + id, function(result, status){
    if (status == 'success') {
      var data = JSON.parse(result);
      $('input[name="id_user"]').val(id);
			$('#formUpdateUser input[name="nama"]').val(data.nama);
			$('#formUpdateUser input[name="privileges"]').filter('[value="'+data.privileges+'"]').prop('checked', true);
			$('#formUpdateUser input[name="username"]').val(data.username);
      $('#editUser').modal('show');
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
