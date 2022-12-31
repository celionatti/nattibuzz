<?php

use Core\Helpers;

$this->total = $total;

?>

<?php $this->start('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-3">
    <h2>Categories</h2>
    <a href="<?= ROOT ?>admin/category/new" class="btn btn sm btn-primary">New Category</a>
</div>

<section class="table-responsive">
    <?php if ($categories): ?>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Category</th>
                <th>Slug</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($categories as $key => $category): ?>
            <tr>
                <td>
                    <?= $key + 1; ?>
                </td>
                <td>
                    <?= $category->category; ?>
                </td>
                <td>
                    <?= $category->slug ?>
                </td>
                <td>
                    <?= ucwords($category->status) ?>
                </td>
                <td class="text-end">
                    <a href="<?= ROOT ?>admin/category/<?= $category->id ?>" class="btn btn-sm btn-info"><i
                            class="bi bi-pencil-square"></i></a>
                    <button class="btn btn-sm btn-danger" onclick="confirmDelete('<?= $category->id ?>')"><i
                            class="bi bi-trash"></i></button>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?= $this->partial('includes/pager'); ?>
    <?php else: ?>
        <h4 class="text-center text-danger border-bottom border-3 border-danger py-2">No Data available.</h4>
    <?php endif; ?>
</section>
<?php $this->end(); ?>

<?php $this->start('script') ?>
<script>
    function confirmDelete(categoryId) {
        if (window.confirm("Are you sure you want to delete the category? This cannot be undone!")) {
            window.location.href = `<?= ROOT ?>admin/deleteCategory/${categoryId}`;
        }
    }
</script>
<?php $this->end(); ?>