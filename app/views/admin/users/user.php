<?php

use Core\Form;
use Core\Helpers;


?>

<?php $this->start('content'); ?>
<h2><?= $header ?></h2>
<form action="" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
    <?= Form::csrfField(); ?>
<div class="row">
    <div class="col">
        <?= Form::inputField('Firstname', 'fname', $user->fname ?? '', ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors) ?>
    </div>
    <div class="col">
        <?= Form::inputField('Lastname', 'lname', $user->lname ?? '', ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors) ?>
    </div>
</div>
<?= Form::inputField('E-mail', 'email', $user->email ?? '', ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors) ?>
<div class="row">
    <div class="col">
        <?= Form::inputField('Phone', 'phone', $user->phone ?? '', ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors) ?>
    </div>
    <div class="col">
        <?= Form::selectField('Access Level', 'acl', $user->acl ?? '', $acl_opts ?? [], ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors) ?>
    </div>
</div>
<?= Form::inputField('Password', 'password', '', ['class' => 'form-control', 'type' => 'password'], ['class' => 'form-floating mb-3'], $errors) ?>
<?= Form::inputField('Confirm Password', 'confirm_password', '', ['class' => 'form-control', 'type' => 'password'], ['class' => 'form-floating mb-3'], $errors) ?>

<p class="text-center mx-auto text-danger small fw-semibold border-top border-dark border-3 py-2">Note that after user account has been created, you must send e-mail details of user credentials and most importantly the user password. Informing them about their account creation. Thank you.</p>
<div class="row">
    <div class="col">
        <a href="/admin/users" class="w-100 btn btn-lg btn-warning"><i class="bi bi-arrow-left-square"></i> Back</a>
    </div>
    <div class="col">
        <button class="w-100 btn btn-lg btn-dark" type="submit">Create New User</button>
    </div>
</div>
</form>
<?php $this->end(); ?>