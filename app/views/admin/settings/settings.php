<?php

use Core\helpers\StringFormat;
use Core\helpers\TimeFormat;

$this->total = $total;

?>

<?php $this->start('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-3">
    <h2>Settings</h2>
    <a href="<?= ROOT ?>admin/setting/new" class="btn btn sm btn-primary">New Setting</a>
</div>

<section class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Setting (Name)</th>
                <th>Value</th>
                <th>Status</th>
                <th>Date</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($settings as $key => $setting): ?>
            <tr>
                <td>
                    <?= $key + 1; ?>
                </td>
                <td>
                    <?= $setting->setting ?>
                </td>
                <td>
                    <?php if($setting->type === 'text'): ?>
                        <?= StringFormat::Excerpt($setting->value ?? '', 30) ?>
                    <?php elseif($setting->type === 'image'): ?>
                        <img src="<?= get_image($setting->value) ?>" alt="" style="width: 75px; height: 75px;object-fit: cover;border-radius: 10px;">
                    <?php else: ?>
                        <?= $setting->value ?>
                    <?php endif; ?>
                </td>
                <td class="<?= $setting->status === 'active' ? 'text-success' : 'text-warning' ?> fw-bold">
                    <?= $setting->status ?>
                </td>
                <td>
                    <?= TimeFormat::DateOne($setting->created_at) ?>
                </td>
                <td class="text-end">
                    <a href="<?= ROOT ?>admin/setting/<?= $setting->id ?>" class="btn btn-sm btn-info"><i
                            class="bi bi-pencil-square"></i></a>
                    <button class="btn btn-sm btn-danger" onclick="confirmDelete('<?= $setting->id ?>')"><i
                            class="bi bi-trash"></i></button>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?= $this->partial('includes/pager'); ?>
</section>
<?php $this->end(); ?>

<?php $this->start('script') ?>
<script>
    function confirmDelete(settingId) {
        if (window.confirm("Are you sure you want to delete the setting? This cannot be undone!")) {
            window.location.href = `<?= ROOT ?>admin/deleteSetting/${settingId}`;
        }
    }
</script>
<?php $this->end(); ?>
