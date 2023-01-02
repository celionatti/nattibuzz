<?php

?>

<?php $this->start('content') ?>
<?= $this->partial('includes/header'); ?>
<div class="container row">
  <div class="col-md-8" style="margin-top: 1.2rem;">

    <section>
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
              <img src="<?= get_image('') ?>" alt="" class="img-fluid rounded-3 shadow-sm" style="height: 620px;" />
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
          <div class="add_comment my-2">
            <textarea class="comment_textbox form-control" rows="2"></textarea>
            <button type="submit" class="btn btn-primary btn-sm w-100 bg-primary text-white add_comment_btn my-2">Add
              Comment</button>
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
            <div class="ms-5">
              <button class="btn btn-sm btn-warning bg-warning text-white" type="button">Reply</button>
              <button class="btn btn-sm btn-primary bg-primary text-white" type="button">View Replies</button>
              <button class="btn btn-sm btn-danger bg-danger text-white" type="button">Delete</button>
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
