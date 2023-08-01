<div class="row">
	<div class="col-md-6">
		<div class="card report-card">
			<div class="card-body">
				<div class="d-flex justify-content-between">
					<div>
						<p class="text-dark font-weight-semibold font-14">Jumlah Pemesanan Kendaraan Bulan Ini</p>
						<h3 class="my-3" id="omset_hari"><?= $pesan_bulan['total_overall'] ?></h3>
						<p>
							<i class="fas fa-clock" data-toggle="tooltip" data-placement="top" title="Pending"></i>
							Pending : <?= $pesan_bulan['pending'] ?>
						</p>
						<p>
							<i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top" title="Diterima"></i>
							Diterima (Tahap Verifikator) : <?= $pesan_bulan['approved_verificator'] ?>
						</p>
						<p>
							<i class="fas fa-times-circle" data-toggle="tooltip" data-placement="top" title="Diterima"></i>
							Ditolak (Tahap Verifikator) : <?= $pesan_bulan['rejected_verificator'] ?>
						</p>
						<p>
							<i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top" title="Diterima"></i>
							Diterima (Tahap Final) : <?= $pesan_bulan['approved_final'] ?>
						</p>
						<p>
							<i class="fas fa-times-circle" data-toggle="tooltip" data-placement="top" title="Diterima"></i>
							Ditolak (Tahap Final) : <?= $pesan_bulan['rejected_final'] ?>
						</p>
					</div>
					<div class="align-self-center">
						<i class="fas fa-money-bill report-main-icon bg-soft-purple text-purple"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-6">
		<div class="card report-card">
			<div class="card-body">
				<div class="d-flex justify-content-between">
					<div>
						<p class="text-dark font-weight-semibold font-14">Jumlah Pemesanan Kendaraan Tahun Ini</p>
						<h3 class="my-3" id="omset_hari"><?= $pesan_tahun['total_overall'] ?></h3>
						<p>
							<i class="fas fa-clock" data-toggle="tooltip" data-placement="top" title="Pending"></i>
							Pending : <?= $pesan_tahun['pending'] ?>
						</p>
						<p>
							<i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top" title="Diterima"></i>
							Diterima (Tahap Verifikator) : <?= $pesan_tahun['approved_verificator'] ?>
						</p>
						<p>
							<i class="fas fa-times-circle" data-toggle="tooltip" data-placement="top" title="Diterima"></i>
							Ditolak (Tahap Verifikator) : <?= $pesan_tahun['rejected_verificator'] ?>
						</p>
						<p>
							<i class="fas fa-check-circle" data-toggle="tooltip" data-placement="top" title="Diterima"></i>
							Diterima (Tahap Final) : <?= $pesan_tahun['approved_final'] ?>
						</p>
						<p>
							<i class="fas fa-times-circle" data-toggle="tooltip" data-placement="top" title="Diterima"></i>
							Ditolak (Tahap Final) : <?= $pesan_tahun['rejected_final'] ?>
						</p>
					</div>
					<div class="align-self-center">
						<i class="fas fa-money-bill report-main-icon bg-soft-purple text-purple"></i>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-12">
		<div class="row">
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body">
						<h4 class="header-title mt-0 mb-4">Penggunaan Kendaraan Bulan Ini</h4>
						<div class="chart-demo">
							<div id="apex_bar1" class="apex-charts"></div>
						</div>                                        
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="card">
					<div class="card-body">
						<h4 class="header-title mt-0 mb-4">Penggunaan Kendaraan Tahun Ini</h4>
						<div class="chart-demo">
							<div id="apex_bar2" class="apex-charts"></div>
						</div>                                        
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	getPenggunaanBulanan();
	getPenggunaanTahunan();
});

function getPenggunaanBulanan(){
	$.get('<?= base_url('dashboard/get_grafik_bulanan') ?>', function(result, status) {
    if (status == 'success') {
      var data = JSON.parse(result);
			renderChart(data.label, data.value, '#apex_bar1');
    } else {
      Swal.fire({
        title: 'Oops...',
        text: 'Gagal mengambil data',
        icon: 'error'
      });
    }
	});
}

function getPenggunaanTahunan(){
	$.get('<?= base_url('dashboard/get_grafik_tahunan') ?>', function(result, status) {
    if (status == 'success') {
      var data = JSON.parse(result);
			renderChart(data.label, data.value, '#apex_bar2');
    } else {
      Swal.fire({
        title: 'Oops...',
        text: 'Gagal mengambil data',
        icon: 'error'
      });
    }
	});
}

function renderChart(label, value, selector) {
	var options = {
		chart: {
			height: 380,
			type: 'bar',
			toolbar: { show: false },
			dropShadow: {
				enabled: true, top: 5, left: 5, bottom: 0,
				right: 0, blur: 5, color: '#45404a2e', opacity: 0.35
			},
		},
		plotOptions: {
			bar: {
				horizontal: true,
			}
		},
		dataLabels: {
			enabled: false
		},
		series: [{
			data: value
		}],
		colors: ["#95a6bf"],
		yaxis: {
			axisBorder: {
				show: true,
				color: '#bec7e0',
			},  
			axisTicks: {
				show: true,
				color: '#bec7e0',
			}, 
		},
		xaxis: {
			categories: label,        
		},
		states: {
			hover: { filter: 'none' }
		},
		grid: {
			borderColor: '#f1f3fa'
		}
	}

	var chart = new ApexCharts(
		document.querySelector(selector),
		options
	);

	chart.render();
}
</script>
