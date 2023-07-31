<div id="<?= $id ?>" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog <?= $large ? 'modal-xl' : 'modal-lg' ?>">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title mt-0" id="myModalLabel"><?= $title ?></h5>
      </div>
      <?php $this->load->view($content, $data) ?>
    </div>
  </div>
</div>
