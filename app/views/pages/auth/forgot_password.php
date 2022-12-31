<?php

use Core\Form;
use Core\Helpers;


?>

<?php $this->start('content'); ?>
    <div class="container col-xl-12 col-xxl-12 px-2 py-2 shadow-lg mx-auto my-5">
        <div class="row align-items-center g-lg-5 py-5">
            <div class="col-lg-5 text-center text-lg-start">
                <img src="<?= ROOT ?>assets/img/logo2.png" alt="" class="w-100" style="object-fit: cover;">
            </div>
            <div class="col-md-10 mx-auto col-lg-7">
                <div class="">
                    <a href="<?= ROOT ?>" class="btn btn-outline-secondary mb-2"><i class="bi bi-house-fill px-4"></i></a>
                </div>
                <form action="" method="post" class="p-4 p-md-2 rounded-3">
                    <h2 class="fst-italic text-center border-bottom border-3 border-danger py-2 mb-4">Forgot Password</h2>
                    <?= Form::csrfField(); ?>
                <?= Form::inputField('E-mail', 'email', $user['email'] ?? '', ['class'=> 'form-control', 'type' => 'email'], ['class'=> 'form-floating mb-3'], $errors) ?>

                <button class="w-100 btn btn-lg btn-dark" type="submit">Send Request</button>
                <hr class="my-1">
                <div class="text-muted text-center my-2">Or <a href="<?= ROOT ?>auth/login" class="text-black">Login</a></div>
                
                <p class="mt-1 text-muted text-center">&copy; 2020 - <?= date("Y"); ?></p>
                <p class="mt-1 text-muted text-center"><?= $this->getSiteTitle(); ?>, Inc. All Rights Reserved.</p>
                </form>
            </div>
        </div>
    </div>
<?php $this->end(); ?>