<?php


use Core\Form;
use Core\helpers\TimeFormat;


?>

<?php $this->start('content') ?>
<main class="container">
    <h3 class="text-center fst-italic my-3 border-bottom border-2 border-danger py-2">Change Password</h3>
    <form action="" method="post">
        <?= Form::csrfField(); ?>

        <?= Form::inputField('Old Password', 'old_password', $user->old_password ?? '', ['class'=> "form-control"], ['class'=> "mb-3 form-floating"], $errors); ?>

        <?= Form::inputField('Password', 'new_password', $user->new_password ?? '', ['class'=> "form-control"], ['class'=> "mb-3 form-floating"], $errors); ?>

        <?= Form::inputField('Confirm Password', 'confirm_password', $user->confirm_password ?? '', ['class'=> "form-control"], ['class'=> "mb-3 form-floating"], $errors); ?>

        <div class="row">
            <div class="col">
                <a href="<?= ROOT ?>profile" class="btn btn-warning w-100"><i class="bi bi-arrow-left-circle"></i>
                    Back</a>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-dark w-100">Change Password</button>
            </div>
        </div>
    </form>
</main>
<?php $this->end(); ?>

<?php $this->start('script') ?>
<script>
    function display_image(file) {
        document.querySelector(".image-preview").src = URL.createObjectURL(file);
    }
</script>
<?php $this->end(); ?>

