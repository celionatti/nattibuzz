<?php


use Core\Form;
use Core\helpers\TimeFormat;


?>

<?php $this->start('content') ?>
<main class="container">
    <h3 class="text-center fst-italic my-3 border-bottom border-2 border-danger py-2">Update Profile</h3>
    <form action="" method="post" enctype="multipart/form-data">
        <?= Form::csrfField(); ?>
        <div class="my-2">
            <img src="<?= get_image($user->img ?? '', 'user') ?>" alt="" class="mx-auto d-block rounded-circle image-preview"
                style="width: 250px; height: 250px;object-fit: cover;cursor: pointer;">
            <?= Form::fileField('Profile Image', 'img', ['class'=> 'form-control', 'onchange'=>
                "display_image(this.files[0])"], ['class'=> 'my-2']) ?>
        </div>

        <div class="row">
            <div class="col">
                <?= Form::inputField('First Name', 'fname', $user->fname ?? '', ['class' => "form-control"], ['class' => "mb-3 form-floating"], $errors); ?>
            </div>
            <div class="col">
                <?= Form::inputField('Last Name', 'lname', $user->lname ?? '', ['class'=> "form-control"], ['class'=> "mb-3 form-floating"], $errors); ?>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?= Form::inputField('Username', 'username', $user->username ?? '', ['class'=> "form-control"], ['class'=> "mb-3 form-floating"], $errors); ?>
            </div>
            <div class="col">
                <?= Form::inputField('E-mail', 'email', $user->email ?? '', ['class' => 'form-control', 'type' => 'email'], ['class' => 'form-floating mb-3'], $errors); ?>
            </div>
        </div>
        <?= Form::inputField('Phone Number', 'phone', $user->phone ?? '', ['class'=> "form-control"], ['class'=> "mb-3 form-floating"], $errors); ?>

        <div class="row">
            <div class="col">
                <a href="<?= ROOT ?>profile" class="btn btn-warning w-100"><i class="bi bi-arrow-left-circle"></i>
                    Back</a>
            </div>
            <div class="col">
                <button type="submit" class="btn btn-dark w-100">Update</button>
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
