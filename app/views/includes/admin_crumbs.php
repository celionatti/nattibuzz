<?php

use Core\Application;
use Core\helpers\TimeFormat;

/** @var mixed currentUser */

$currentUser = Application::$app->currentUser;


?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h5 class="text-muted">Welcome To Admin Dashboard <span class="border-bottom border-2 border-danger">
            <?= ucwords($currentUser->displayName()) ?>
        </span></h5>
    <div class="btn-toolbar mb-2 mb-md-0">
        <button type="button" class="btn btn-sm btn-outline-danger me-2">
            <i class="bi bi-clock"></i> <span><?= TimeFormat::DateOne(date('Y-m-d H:i:s')) ?></span>
        </button>
        <div class="btn-group">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
        </div>
    </div>
</div>