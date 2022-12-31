<?php

use Core\helpers\StringFormat;
use Core\helpers\TimeFormat;

$this->total = $total;

?>

<?php $this->start('content') ?>
<div class="d-flex align-items-center justify-content-between mb-3">
    <a href="<?= ROOT ?>admin/articles" class="btn btn-dark"><i class="bi bi-arrow-left-circle"></i> Back</a>
    <h2>Comments</h2>
</div>

<?php if($comments): ?>
<?php foreach($comments as $comment): ?>

<div class="card my-2">
    <div class="card-body bg-light">
        <input type="hidden" class="slug" value="<?= $comment->article_slug ?>">
        <div class="main-comment">
            <hr class="my-2">
            <!-- List all comments -->
            <div class="comment-container">
                <div class="reply_box border p-2 mb-2">
                    <h6 class="border-bottom d-inline"><?= $comment->username ?> <span class="float-end"><i class="bi bi-clock"></i> <?= TimeFormat::StringTime($comment->created_at) ?></span></h6>
                    <p class="params"><?= $comment->message ?></p>
                    <button onclick="confirmDelete('<?= $comment->id ?>')" class="btn btn-sm btn-danger">Delete</button>
                    <button value="<?= $comment->id ?>" class="btn btn-sm btn-warning view_reply_btn">View Replies</button>
                    <div class="mx-5 reply_section"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php endforeach; ?>

<?= $this->partial('includes/pager'); ?>

<?php endif; ?>

<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script>
    function confirmDelete(commentId) {
        if (window.confirm("Are you sure you want to delete the comment? This cannot be undone!")) {
            window.location.href = `<?= ROOT ?>admin/commentDelete/${commentId}`;
        }
    }
    function deleteReply(commentId) {
        if (window.confirm("Are you sure you want to delete the comment reply? This cannot be undone!")) {
            window.location.href = `<?= ROOT ?>admin/commentReplyDelete/${commentId}`;
        }
    }
</script>
<script src="<?= ROOT ?>assets/js/admin_comment.js"></script>
<?php $this->end(); ?>
