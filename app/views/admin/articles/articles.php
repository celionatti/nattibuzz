<?php

use Core\Helpers;
use Core\helpers\StringFormat;

$this->total = $total;

?>

<?php $this->start('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-3">
    <h2>Articles</h2>
    <a href="<?= ROOT ?>admin/article/new" class="btn btn sm btn-primary">New Article</a>
</div>

<section class="table-responsive">
    <table class="table table-striped table-secondary">
        <thead>
            <tr>
                <th>#</th>
                <th>Title</th>
                <th>Preview</th>
                <th>Image</th>
                <th>Author</th>
                <th>Status</th>
                <th>Created</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($articles as $key => $article): ?>
            <tr>
                <td>
                    <?= $key + 1 ?>
                </td>
                <td>
                    <?= StringFormat::Excerpt($article->title, 20); ?>
                </td>
                <td><a href="<?= ROOT ?>admin/review/<?= $article->slug ?>" class="text-dark">
                        <i class="bi bi-eye btn btn-sm btn-outline-dark"></i>
                    </a></td>
                <td><img src="<?= ROOT . $article->thumbnail ?>" alt=""
                        style="width: 50px; height: 50px;object-fit: cover;border-radius: 10px;"></td>
                <td>
                    <?= $article->username ?>
                </td>
                <td>
                    <?= $article->status ?>
                </td>
                <td>
                    <?= date("M j, Y ~ g:i a", strtotime($article->created_at)) ?>
                </td>
                <td class="text-end">
                    <a href="<?= ROOT ?>admin/article/<?= $article->id ?>" class="btn btn-sm btn-info"><i
                            class="bi bi-pencil-square"></i></a>
                    <button class="btn btn-sm btn-danger" onclick="confirmDelete('<?= $article->id ?>')"><i
                            class="bi bi-trash"></i></button>
                    <a href="<?= ROOT ?>admin/comments/<?= $article->slug ?>" class="btn btn-sm btn-warning"><i
                            class="bi bi-chat-dots"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= $this->partial('includes/pager'); ?>
</section>

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
