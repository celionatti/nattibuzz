<?php

?>

<?php $this->start('content') ?>
<?= $this->partial('includes/header'); ?>
<div class="container row">
  <div class="col-md-8" style="margin-top: 1.2rem;">
    <section class="border-bottom border-2 border-muted">
      <!-- Create Post -->
      <div class="card">
        <div class="card-body">
          <h5 class="text-primary fw-bold">Create Post</h5>
          <textarea name="create_post" class="form-control" rows="8" placeholder="Create a Post"
            style="resize: none;"></textarea>
          <div class="d-flex justify-content-around align-items-center">
            <button class="btn btn-sm my-2 bg-info text-white"><i class="bi bi-camera-video"></i>
              Video</button>
            <button class="btn btn-sm my-2 bg-warning text-white"><i class="bi bi-camera"></i>
              Photo</button>
          </div>
          <button class="btn btn-dark w-100">Post</button>
        </div>
      </div>
    </section>

    <section>
      <h4 class="fst-italic">StoryLines</h4>
      <!-- Story One -->
      <div class="card border-bottom border-2 border-muted my-2">
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
            Hello Everyone Thanks for watching, Please SUBSCRIBE My Channel - Like Comments and Share <a href="#"
              class="text-primary">https://www.youtube.com/channel/UCHhGx-DD7A8jq7j_NPGN6g&</a>

            <a href="#">
              <img src="<?= get_image('') ?>" alt="" class="img-fluid rounded-3 shadow-sm" style="height: 350px;" />
            </a>
          </p>
          <div class="d-flex justify-content-evenly align-items-center">
            <button class="p-2">
              <i class="bi bi-heart fs-5 bg-danger py-1 px-2 rounded-circle text-white text-center"></i>
              50 <span class="d-none d-lg-inline-block">Love</span>
            </button>

            <button class="p-2">
              <i class="bi bi-hand-thumbs-up fs-5 bg-primary py-1 px-2 rounded-circle text-white text-center"></i>
              100 <span class="d-none d-lg-inline-block">Likes</span>
            </button>

            <button type="button" class="p-2">
              <i class="bi bi-chat-dots fs-5 bg-warning py-1 px-2 rounded-circle text-white text-center"></i>
              5000 <span class="d-none d-lg-inline-block">Comments</span>
            </button>

            <button class="p-2">
              <i class="bi bi-share fs-5 bg-dark py-1 px-2 rounded-circle text-white text-center"></i>
            </button>
          </div>
        </div>
        <div class="card-footer">
          <div id="comment">
            <div class="d-flex justify-content-start align-items-center">
              <div>
                <img src="<?= get_image('assets/img/profile-3.jpg') ?>" alt="" class="card-img rounded-circle"
                  style="width: 60px; height: 60px;" />
              </div>
              <div class="d-flex justify-content-between align-items-center ml-auto">
                <h6 class="mt-2 fw-bold text-black">Lamidi Clara</h6>
                <small class="mx-2">- 2 hours ago</small>
              </div>
            </div>
            <p class="ms-5 text-dark">
              This will be the comment section.This will be the comment section.This will be the comment section.This
              will be the comment section.
            </p>
          </div>
          <div id="comment">
            <div class="d-flex justify-content-start align-items-center">
              <div>
                <img src="<?= get_image('assets/img/profile-3.jpg') ?>" alt="" class="card-img rounded-circle"
                  style="width: 60px; height: 60px;" />
              </div>
              <div class="d-flex justify-content-between align-items-center ml-auto">
                <h6 class="mt-2 fw-bold text-black">Lamidi Clara</h6>
                <small class="mx-2">- 2 hours ago</small>
              </div>
            </div>
            <p class="ms-5 text-dark">
              This will be the comment section.This will be the comment section.This will be the comment section.This
              will be the comment section.
            </p>
          </div>
        </div>
      </div>

    </section>
  </div>
  <?= $this->partial('includes/side_menu'); ?>
</div>



<?= $this->partial('includes/footer'); ?>
<?php $this->end(); ?>
