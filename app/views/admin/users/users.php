<?php

use Core\Helpers;

$this->total = $total;

?>

<?php $this->start('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-3">
    <h2>Users</h2>
    <a href="<?= ROOT ?>admin/user/new" class="btn btn sm btn-primary">New User</a>
</div>

<section class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Access Level</th>
                <th>Status</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $key => $user): ?>
            <tr>
                <td>
                    <?= $key + 1; ?>
                </td>
                <td>
                    <?= $user->displayName(); ?>
                </td>
                <td>
                    <?= $user->email ?>
                </td>
                <td>
                    <?= ucwords($user->acl) ?>
                </td>
                <td>
                    <?= $user->blocked ? "Blocked" : "Active" ?>
                </td>
                <td class="text-end">
                    <a href="<?= ROOT ?>admin/user/<?= $user->uid ?>" class="btn btn-sm btn-info"><i
                            class="bi bi-pencil-square"></i></a>
                    <a href="<?= ROOT ?>admin/toggleUser/<?= $user->uid ?>"
                        class="btn btn-sm <?= $user->blocked ? "btn-warning" : "btn-secondary" ?>">
                        <?= $user->blocked ? "Unblock" : "Block" ?>
                    </a>
                    <button class="btn btn-sm btn-danger" onclick="confirmDelete('<?= $user->uid ?>')"><i
                            class="bi bi-trash"></i></button>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?= $this->partial('includes/pager'); ?>
</section>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script>
    function confirmDelete(userId) {
        if (window.confirm("Are you sure you want to delete the user? This cannot be undone!")) {
            window.location.href = `<?= ROOT ?>admin/deleteUser/${userId}`;
        }
    }
</script>
<?php $this->end(); ?>