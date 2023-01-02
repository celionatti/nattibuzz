<?php

?>

<?php $this->start('content') ?>
<?= $this->partial('includes/header'); ?>
<div class="container row">
  <div class="col-md-8" style="margin-top: 1.2rem;">

    <section>
      <div class="card border-bottom border-2 border-muted my-2">
        <div class="card-body">
          <div class="d-flex justify-content-start align-items-center">
            <img src="<?= get_image('assets/img/profile-3.jpg') ?>" alt="" class="card-img rounded-circle"
              style="width: 60px; height: 60px;" />
            <div class="d-flex flex-column">
              <div class="d-flex justify-content-between align-items-center mx-3">
                <h6 class="mt-2 fw-bold text-black">Lamidi Clara</h6>
                <small class="mx-2">- 2 hours ago</small>
              </div>
              <div>
                <small class="mx-3">02 march at 12:58 PM</small>
              </div>
            </div>
          </div>
        </div>
      </div>

    </section>
  </div>
  <?= $this->partial('includes/side_menu'); ?>
</div>



<?= $this->partial('includes/footer'); ?>
<?php $this->end(); ?>
