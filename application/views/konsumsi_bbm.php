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

			</div>
		</div>
		<div class="card">
			<div class="card-body">
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
		</div>
	</div>
</div>
