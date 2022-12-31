<?php

use Core\Form;
use Core\Helpers;

?>

<?php $this->start('content'); ?>
<form action="" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
    <?= Form::csrfField(); ?>
        <div class="row">
            <div class="col">
                <?= Form::inputField('Category', 'category', $category->category ?? '', ['class'=> 'form-control'], ['class'=> 'form-floating mb-3'], $errors) ?>
            </div>
            <div class="col">
                <?= Form::selectField('Status', 'status', $category->status ?? '', $category_status_opts ?? [], ['class'=> 'form-control'], ['class'=> 'form-floating mb-3'], $errors) ?>
            </div>
        </div>

            <p class="text-center mx-auto text-danger small fw-semibold border-top border-dark border-3 py-2">
                Note that only Category with relevant and consistence new can only be created. Thank you.
            </p>
            <div class="row">
                <div class="col">
                    <a href="/admin/categories" class="w-100 btn btn-lg btn-warning"><i
                            class="bi bi-arrow-left-square"></i> Back</a>
                </div>
                <div class="col">
                    <button class="w-100 btn btn-lg btn-dark" type="submit">Create New Category</button>
                </div>
            </div>
</form>
<?php $this->end(); ?>