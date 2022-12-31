<?php

use Core\Helpers;
use Core\helpers\TimeFormat;


?>

<?php $this->start('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-3">
    <a href="<?= ROOT ?>admin/articles" class="btn btn sm btn-primary"><i class="bi bi-arrow-left-circle"></i> Back</a>
</div>
<div class="card">
    <div class="card-header d-flex align-content-center justify-content-between">
        <div>Review</div>
        <div>
            <a href="<?= ROOT ?>admin/article/<?= $article->id ?>" class="btn btn-sm btn-info"><i class="bi bi-pencil-square"></i></a>
            <button class="btn btn-sm btn-danger" onclick="confirmDelete('<?= $article->id ?>')"><i
                    class="bi bi-trash"></i></button>
        </div>
    </div>
    <div class="card-body">
        <h2 class="text-center text-capitalize">
            <?= $article->title ?>
        </h2>
        <!-- Post Image -->
        <div class="d-flex justify-content-center">
            <img src="<?= get_image($article->thumbnail) ?>" alt="" class="img-thumbnail" height="540px">
        </div>

        <section class="container overflow-hidden z-100">
            <div class="d-flex justify-content-between align-items-center border-bottom border-3 border-danger py-2 my-3">
                <div class="fw-bold">
                    Author: <span><?= $article->username ?></span>
                </div>
                <div class="fw-bold">
                    <i class="bi bi-hash"></i> <span><?= $article->tags ?></span>
                </div>
                <div class="fw-bold">
                    <i class="bi bi-clock"></i> <span><?= TimeFormat::DateOne($article->created_at) ?></span>
                </div>
            </div>
            <article class="fw-normal lh-base">
                <?= $article->content ?>
            </article>
        </section>
    </div>
</div>
<?php $this->end(); ?>

<?php $this->start('script') ?>
<script>
    function confirmDelete(articleId) {
        if (window.confirm("Are you sure you want to delete the article? This cannot be undone!")) {
            window.location.href = `<?= ROOT ?>admin/deleteArticle/${articleId}`;
        }
    }
</script>
<?php $this->end(); ?>
