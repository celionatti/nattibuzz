<?php


use Core\helpers\TimeFormat;


?>

<?php $this->start('content') ?>
    <main class="container my-3">
        <?php if ($user): ?>
        <img src="<?= get_image($user->img ?? '', 'user') ?>" alt="" class="mx-auto d-block rounded-circle" style="width: 250px; height: 250px;object-fit: cover;cursor: pointer;">

        <div class="d-flex justify-content-between align-items-end">
            <div>
                <a href="<?= ROOT ?>" class="btn btn-primary mx-1"><i class="bi bi-house-door"></i> Back Home</a>
            </div>
            <div>
                <a href="<?= ROOT ?>profile/edit" class="btn btn-warning mx-1"><i class="bi bi-pencil-square"></i> Edit</a>
                <a href="<?= ROOT ?>profile/change_password" class="btn btn-info mx-1"><i class="bi bi-key"></i> Change
                    Password</a>
            </div>
        </div>
        <section class="my-4 container">
            <div class="row g-3 border-bottom border-3 border-danger my-3">
                <div class="col">
                    <h3>First Name:</h3>
                </div>
                <div class="col text-end">
                    <h3>
                        <?= $user->fname ?>
                    </h3>
                </div>
            </div>
            <div class="row g-3 border-bottom border-3 border-danger my-3">
                <div class="col">
                    <h3>Last Name:</h3>
                </div>
                <div class="col text-end">
                    <h3>
                        <?= $user->lname ?>
                    </h3>
                </div>
            </div>
            <div class="row g-3 border-bottom border-3 border-danger my-3">
                <div class="col">
                    <h3>Username:</h3>
                </div>
                <div class="col text-end">
                    <h3>
                        <?= $user->username ?>
                    </h3>
                </div>
            </div>
            <div class="row g-3 border-bottom border-3 border-danger my-3">
                <div class="col">
                    <h3>E-mail:</h3>
                </div>
                <div class="col text-end">
                    <h3 class="text-lowercase">
                        <?= $user->email ?>
                    </h3>
                </div>
            </div>
            <div class="row g-3 border-bottom border-3 border-danger my-3">
                <div class="col">
                    <h3>Phone Number:</h3>
                </div>
                <div class="col text-end">
                    <h3>
                        <?= $user->phone ?>
                    </h3>
                </div>
            </div>
            <div class="row g-3 border-bottom border-3 border-danger my-3">
                <div class="col">
                    <h3>Access Level:</h3>
                </div>
                <div class="col text-end">
                    <h3>
                        <?= $user->acl ?>
                    </h3>
                </div>
            </div>
            <div class="row g-3 border-bottom border-3 border-danger my-3">
                <div class="col">
                    <h3>Referral Link:</h3>
                </div>
                <div class="col text-end">
                    <h3>
                        <?= $user->ref_uid ?? '' ?>
                    </h3>
                </div>
            </div>
            <div class="row g-3 border-bottom border-3 border-danger my-3">
                <div class="col">
                    <h3>Joined on:</h3>
                </div>
                <div class="col text-end">
                    <h3>
                        <?= TimeFormat::DateOne($user->created_at) ?>
                    </h3>
                </div>
            </div>
        </section>
        <?php else: ?>
        <section>
            <h5 class="text-center border-bottom border-3 border-danger py-2">No Profile for you here.... yet</h5>
            <div class="text-center">
                <a href="<?= ROOT ?>" class="btn btn-sm btn-primary text-center">Back Home</a>
            </div>
        </section>
        <?php endif; ?>
    </main>
    <?= $this->partial('includes/footer'); ?>
<?php $this->end(); ?>
