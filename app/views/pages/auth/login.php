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
                    <?= Form::csrfField(); ?>
                <?= Form::inputField('E-mail', 'email', $user->email ?? '', ['class'=> 'form-control', 'type' => 'email'], ['class'=> 'form-floating mb-3'], $errors) ?>

                <?= Form::inputField('Password', 'password', $user->password ?? '', ['class'=> 'form-control', 'type' => 'password'], ['class'=> 'form-floating mb-3'], $errors) ?>

                <div class="row">
                    <div class="col">
                        <?= Form::checkField('Remember', 'remember', $user->remember == "on" ?? '', ['class'=> 'mx-1'], ['class'=> 'checkbox my-2'], $errors) ?>
                    </div>
                    <div class="col">
                        <div class="text-muted text-end"><i class="bi bi-key"></i> <a href="<?= ROOT ?>auth/forgot_password" class="text-black">Forgot Password?</a>
                        </div>
                    </div>
                </div>

                <button class="w-100 btn btn-lg btn-dark bg-primary text-white" type="submit">Login</button>
                <button class="w-100 btn btn-lg btn-danger bg-dark text-white my-3" type="button">Google Sign In</button>
                <hr class="my-1">
                <div class="text-center text-dark my-2">Don't have an account? <a href="<?= ROOT ?>auth/register" class="text-black">Create an Account</a></div>

                <p class="my-1 text-dark text-center">&copy; 2020 - <?= date("Y"); ?></p>
                <p class="text-dark text-center"><?= $this->getSiteTitle(); ?>, Inc. All Rights Reserved.</p>
                </form>
            </div>
        </div>
    </div>
<?php $this->end(); ?>
