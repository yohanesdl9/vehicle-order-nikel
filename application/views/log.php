<div class="row">
	<div class="col-md-12">
		<div class="card">
      <div class="card-body">
			<div class="row">
          <div class="col-md-6">
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
        </div>
        <div class="table-responsive-md mt-3">
          <table class="table table-bordered table-striped table-hover" id="tableLog">
            <thead>
              <tr>
                <th class="text-center">Tanggal</th>
                <th class="text-center">User</th>
                <th class="text-center">Role</th>
                <th class="text-center">Keterangan</th>
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
<script>
$(document).ready(function(){
	$('input[name="mode_filter"]:checked').trigger('change');

	var datatable = $('#tableLog').DataTable({
    'responsive': true,
    'processing': true,
    'serverSide': true,
    'serverMethod': 'post',
    'searching': true,
    'ordering': false,
    'destroy': true,
    'ajax': {
      'url': "<?= base_url('log/log_datatable') ?>",
      'data': function(data){
        data.mode_filter = $('input[name="mode_filter"]:checked').val();
        data.date_start = $('input[name="date_start"]').val();
        data.date_end = $('input[name="date_end"]').val();
        data.date = $('input[name="date"]').val();
        data.bulan = $('select[name="bulan"]').val();
        data.tahun = $('select[name="tahun"]').val();
      },
    },
    'columns': [
      { data: 'tanggal' }, 
      { data: 'user' },
      { data: 'privileges' },
      { data: 'log' },
    ],
    'columnDefs': [
      {
        targets: [0, 1, 2],
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

	$('input[name="mode_filter"]').change(function(){
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
</script>
