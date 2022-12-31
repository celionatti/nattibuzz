<?php




?>

<div class="col-md-4">
  <section class="position-sticky" style="top: 1rem;">
    <div class="p-4 my-3 bg-light rounded">
      <!-- Events -->
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6>Upcoming Events</h6>
          <span><a href="#">See all</a></span>
        </div>
        <div class="card-body">
          <img src="<?= get_image('assets/img/post-9.jpg', 'user') ?>" alt="" class="card-img rounded-4"
            style="height: 250px; object-fit: cover;cursor: pointer;" />
          <div class="d-flex justify-content-around align-items-center">
            <div class="my-2 bg-light rounded px-4 py-2 text-center">
              <h5 class="text-primary fw-bold m-0">21</h5>
              <h5 class="m-0 fw-bold text-black">July</h5>
            </div>
            <div class="my-2">
              <h6 class="m-0 text-black fw-bold">United state of America</h6>
              <small>New York City</small>
            </div>
          </div>
        </div>
        <div class="card-footer text-center">
          <button class="btn btn-info w-100"><i class="bi bi-star"></i> Interested</button>
        </div>
      </div>

      <hr class="my-1">

      <!-- Friend Requests -->
      <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
          <h6>Friend Requests</h6>
          <span><a href="#">See all</a></span>
        </div>
        <div class="card-body">
          <!-- Request -->
          <div class="request d-flex justify-content-start align-items-center">
            <div class="my-2">
              <img src="<?= get_image('assets/img/profile-3.jpg', 'user') ?>" alt="" class="card-img rounded-circle"
                style="height: 55px; width: 55px; object-fit: cover;cursor: pointer;" />
            </div>
            <div class="my-2">
              <h6 class="m-0 text-black fw-bold">Tilly Tinny</h6>
              <small>Lagos, Nigeria</small>
              <div class="my-1">
                <button class="btn btn-sm btn-primary shadow bg-primary text-white mx-1">Confirm</button>
                <button class="btn btn-sm btn-danger shadow bg-danger text-white mx-1">Declined</button>
              </div>
            </div>
          </div>
          <!-- Request -->
          <div class="request d-flex justify-content-start align-items-center">
            <div class="my-2">
              <img src="<?= get_image('assets/img/profile-2.jpg', 'user') ?>" alt="" class="card-img rounded-circle"
                style="height: 55px; width: 55px; object-fit: cover;cursor: pointer;" />
            </div>
            <div class="my-2">
              <h6 class="m-0 text-black fw-bold">Tilly Tinny</h6>
              <small>Lagos, Nigeria</small>
              <div class="my-1">
                <button class="btn btn-sm btn-primary shadow bg-primary text-white mx-1">Confirm</button>
                <button class="btn btn-sm btn-danger shadow bg-danger text-white mx-1">Declined</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <hr class="my-1">

      <!-- Messenger -->
      <div class="card">
        <div class="card-header d-flex justify-content-start align-items-center">
          <h6><i class="bi bi-chat-dots"></i> Messages</h6>
          <input type="search" name="search" placeholder="Search" class="form-control form-control-sm ms-2"
            style="width: 210px;" />
        </div>
        <div class="card-body">
          <!-- Message One -->
          <div class="d-flex justify-content-start align-items-center border-bottom border-2 border-muted" style="cursor: pointer;">
            <div class="my-2">
              <img src="<?= get_image('assets/img/profile-2.jpg', 'user') ?>" alt="" class="card-img rounded-circle"
                style="height: 55px; width: 55px; object-fit: cover;cursor: pointer;" />
            </div>
            <div class="mt-3">
              <h6 class="m-0 text-black fw-bold">Tilly Tinny</h6>
              <div class="d-flex align-items-center">
                <i class="bi bi-dot fs-2 text-success"></i>
                Online
              </div>
            </div>
          </div>
          <!-- Two -->
          <div class="d-flex justify-content-start align-items-center border-bottom border-2 border-muted" style="cursor: pointer;">
            <div class="my-2">
              <img src="<?= get_image('assets/img/profile-2.jpg', 'user') ?>" alt="" class="card-img rounded-circle"
                style="height: 55px; width: 55px; object-fit: cover;cursor: pointer;" />
            </div>
            <div class="mt-3">
              <h6 class="m-0 text-black fw-bold">Tilly Tinny</h6>
              <div class="d-flex align-items-center">
                <i class="bi bi-dot fs-2 text-success"></i>
                Online
              </div>
            </div>
          </div>

        </div>
        <div class="card-footer"></div>
      </div>
    </div>


  </section>
</div>
