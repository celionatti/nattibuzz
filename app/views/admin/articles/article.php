<?php

use Core\Form;
use Core\Helpers;

?>

<?php $this->start('head'); ?>
<link rel="stylesheet" href="<?= ROOT ?>assets/summernote/summernote-lite.min.css">
<?php $this->end(); ?>

<?php $this->start('content'); ?>
<div class="col-md-12 mx-auto mb-4">
    <form action="" method="post" enctype="multipart/form-data" class="">
        <h1 class="h3 mb-3 fw-normal text-center">
            <?= $heading ?>
        </h1>
        <?= Form::csrfField(); ?>
            <div class="row">
                <?= Form::inputField('Title', 'title', $article->title ?? '', ['class' => 'form-control'], ['class' => 'form-floating mb-3 col-md-8'], $errors); ?>
                <?= Form::selectField('Status', 'status', $article->status ?? '', $statusOptions ?? [], ['class'=> 'form-control'], ['class'=> 'form-floating mb-3 col-md-4'], $errors); ?>
                <?= Form::selectField('Category', 'category_id', $article->category_id ?? '', $categoryOptions ?? [], ['class'=> 'form-control'], ['class'=> 'form-floating mb-3 col-md-4'], $errors); ?>
                <?= Form::selectField('Trending', 'trending', $article->trending ?? '', $trendingOptions ?? [], ['class'=> 'form-control'], ['class'=> 'form-floating mb-3 col-md-4'], $errors); ?>

                <?= Form::inputField('Tags', 'tags', $article->tags ?? '', [ 'class'=> 'form-control'], ['class'=> 'form-floating mb-3 col-md-4'], $errors) ?>

                <?= Form::fileField('Article Thumbnail', 'thumbnail', ['class'=> 'form-control', 'onchange'=> "display_image_edit(this.files[0])"], ['class'=> 'col-md-12 mb-3'], $errors); ?>

                <div class="d-flex align-items-center justify-content-center">
                    <h5 class="mx-3">Current Article Featured Image: </h5>
                    <img src="<?= get_image($article->thumbnail) ?? '' ?>" alt="" class="mx-auto d-block image-preview-edit" style="height:150px;width:250px;object-fit:cover;border-radius: 10px;cursor: pointer;">
                </div>

                <?= Form::textareaField('Article Content', 'content', $article->content ?? '', ['class'=> 'form-control border-top border-danger border-5 summernote'], ['class'=> 'form-group mb-3 col-md-12'], $errors); ?>
                <?= Form::inputField('Meta Description', 'meta_description', $article->meta_description ?? '', ['class' => 'form-control'], ['class' => 'form-floating mb-3 col-md-7'], $errors); ?>
                <?= Form::inputField('Meta Keywords', 'meta_keywords', $article->meta_keywords ?? '', ['class' => 'form-control'], ['class' => 'form-floating mb-3 col-md-5'], $errors); ?>
            </div>
            <div class="row">
                <div class="col">
                    <a href="<?= ROOT ?>admin/articles" class="btn btn-warning w-100"><i class="bi bi-arrow-left-circle"></i> Back</a>
                </div>
                <div class="col">
                    <button type="submit" class="btn btn-primary w-100">Create Article</button>
                </div>
            </div>
    </form>
</div>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script src="<?= ROOT ?>assets/summernote/summernote-lite.min.js"></script>
<script>
    function display_image_edit(file) {
        document.querySelector(".image-preview-edit").src = URL.createObjectURL(file);
    }

    $('.summernote').summernote({
        placeholder: 'Article content',
        tabsize: 2,
        height: 400
    });
</script>

<?php $this->end(); ?>