<?php

use Core\Application;

/** @var mixed currentUser */

$currentUser = Application::$app->currentUser;


?>

<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
        <ul class="nav flex-column">
        <li class="nav-item">
            <a class="nav-link <?= URL(1) == 'dashboard' ? 'active' : '' ?>" aria-current="dashboard" href="<?= ROOT ?>admin/dashboard">
                <i class="bi bi-speedometer2"></i>
                Dashboard
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link <?= URL(1) == 'articles' || URL(1) == 'article' || URL(1) == 'comments' || URL(1) == 'review' ? 'active' : '' ?>"
                aria-current="articles" href="<?= ROOT ?>admin/articles">
                <i class="bi bi-file-richtext"></i>
                Articles
            </a>
        </li>
        <?php if($currentUser->acl === 'admin' || $currentUser->acl === 'manager'): ?>
            <li class="nav-item">
                <a class="nav-link <?= URL(1) == 'advertisements' || URL(1) == 'advertisement' ? 'active' : '' ?>" aria-current="advertisements"
                    href="<?= ROOT ?>admin/advertisements">
                    <i class="bi bi-fullscreen"></i>
                    Advertisement
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= URL(1) == 'tickers' || URL(1) == 'ticker' ? 'active' : '' ?>" aria-current="tickers"
                    href="<?= ROOT ?>admin/tickers">
                    <i class="bi bi-three-dots"></i>
                    Tickers
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= URL(1) == 'users' || URL(1) == 'user' ? 'active' : '' ?>" aria-current="users"
                    href="<?= ROOT ?>admin/users">
                    <i class="bi bi-person"></i>
                    Users
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= URL(1) == 'categories' || URL(1) == 'category' ? 'active' : '' ?>" aria-current="categories"
                    href="<?= ROOT ?>admin/categories">
                    <i class="bi bi-tags"></i>
                    Categories
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= URL(1) == 'settings' || URL(1) == 'setting' ? 'active' : '' ?>" aria-current="settings"
                    href="<?= ROOT ?>admin/settings">
                    <i class="bi bi-wrench-adjustable-circle"></i>
                    Settings
                </a>
            </li>
        <?php endif; ?>

        </ul>

        <h6
            class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted text-uppercase">
            <span>Others</span>
            <a class="link-secondary" href="#" aria-label="Others">
                <span class="bi bi-1-circle align-text-bottom"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link <?= URL(0) == 'home' ? 'active' : '' ?>" aria-current="home" href="<?= ROOT ?>">
                    <i class="bi bi-house"></i>
                    View Site
                </a>
            </li>
                <li class="nav-item my-5">
                    <a class="nav-link bg-dark" href="<?= ROOT ?>profile">
                        <img src="<?= get_image($currentUser->img ?? '', 'user') ?>" alt="mdo" width="45" height="45"
                            class="rounded-circle shadow" style="object-fit: cover;">
                        <span class="mx-2 text-light">
                            <?= $currentUser->username ?>
                        </span>
                    </a>
                </li>
        </ul>
    </div>
</nav>
