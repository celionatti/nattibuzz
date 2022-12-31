<?php


use Core\Form;


?>

<?php $this->start('content'); ?>
<h2> <?= $header ?> </h2>
<form action="" method="post" enctype="multipart/form-data" class="p-4 p-md-5 border rounded-3 bg-light">
    <?= Form::csrfField(); ?>

    <?= Form::inputField('Setting (Name)', 'setting', $setting->setting ?? '', ['class' => "form-control"], ['class' => "form-floating mb-3"], $errors) ?>

    <?= Form::selectField('Type', 'type', $setting->type ?? '', $typeOpts ?? [], ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors) ?>

    <?= Form::selectField('Status', 'status', $setting->status ?? '', $statusOpts ?? [], ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors) ?>

    <?php if($setting->type === 'text'): ?>
    <?= Form::textareaField('Setting (Value)', 'value', $setting->value ?? '', ['class' => 'form-control', 'rows' => '10'], ['class' => 'col-md-12 mb-3'], $errors); ?>
    <?php elseif($setting->type === 'image'): ?>
        <?= Form::fileField('Image', 'value', ['class' => "form-control", 'onchange' => "display_image_edit(this.files[0])"], ['class' => "col-md-12 mb-3"], $errors) ?>

        <div class="d-flex align-items-center justify-content-center">
            <h5 class="mx-3">Current Image: </h5>
            <img src="<?= get_image($setting->value) ?? '' ?>" alt="" class="mx-auto d-block image-preview-edit"
                style="height:150px;width:250px;object-fit:cover;border-radius: 10px;cursor: pointer;">
        </div>
    <?php elseif ($setting->type === 'link'): ?>
        <?= Form::inputField('Setting (Value)', 'value', $setting->value ?? '', ['class' => 'form-control', 'type' => "url"], ['class' => 'form-floating mb-3'], $errors); ?>
    <?php endif; ?>

    <p class="text-center mx-auto text-danger small fw-semibold border-top border-dark border-3 py-2 my-2">
        Note that only Setting with relevant and consistence new can only be created. Thank you.
    </p>
    <div class="row">
        <div class="col">
            <a href="/admin/settings" class="w-100 btn btn-lg btn-warning"><i class="bi bi-arrow-left-circle"></i>
                Back</a>
        </div>
        <div class="col">
            <button class="w-100 btn btn-lg btn-dark" type="submit">Create New Setting</button>
        </div>
    </div>
</form>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script>
    function display_image_edit(file) {
        document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
    }
</script>

<?php $this->end(); ?>
