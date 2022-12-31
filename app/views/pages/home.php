<?php


?>

<?php $this->start('content') ?>
<?= $this->partial('includes/header'); ?>
<div class="container row">
    <?= $this->partial('includes/side_details'); ?>
    <div class="col-md-5" style="margin-top: 1.2rem;">
        <section class="border-bottom border-2 border-muted">
          <!-- Create Post -->
            <div class="card">
              <div class="card-body">
                <h5 class="text-primary fw-bold">Create Post</h5>
                  <textarea name="create_post" class="form-control" placeholder="Create a Post"></textarea>
                  <div class="d-flex justify-content-around align-items-center">
                    <button class="btn btn-sm my-2 bg-info text-white"><i class="bi bi-camera-video"></i> Video</button>
                    <button class="btn btn-sm my-2 bg-warning text-white"><i class="bi bi-camera"></i> Photo</button>
                  </div>
                  <button class="btn btn-dark w-100">Post</button>
              </div>
            </div>
        </section>

        <section>
            <h4 class="fst-italic">StoryLines</h4>
            <div class="card">
              <div class="card-header">
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
              <div class="card-body">
                  <p class="text-dark">
                    Hello Everyone Thanks for watching, Please SUBSCRIBE My Channel - Like Comments and Share <a href="#" class="text-primary">https://www.youtube.com/channel/UCHhGx-DD7A8jq7j_NPGN6g&</a>

                      <img src="<?= get_image('') ?>" alt="" class="img-fluid rounded-3 shadow-sm" style="height: 220px;" />
                  </p>
              </div>
            </div>
        </section>
    </div>
    <?= $this->partial('includes/side_menu'); ?>
</div>



<?= $this->partial('includes/footer'); ?>
<?php $this->end(); ?>
