<?php

use Core\Application;


/** @var mixed currentUser */

$currentUser = Application::$app->currentUser;


?>


<header>
    <nav class="navbar navbar-expand-md navbar-light bg-light text-center align-items-center" aria-label="Fourth navbar example">
        <div class="container-fluid">
            <a class="navbar-brand logo mx-3" href="<?= ROOT ?>">Natti<span>Buzz</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar"
                aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ml-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link <?= URL(0) === 'home' ? 'active' : '' ?>" aria-current="page" href="<?= ROOT ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= URL(0) === 'timelines' || URL(0) === 'timeline' ? 'active' : '' ?>" href="<?= ROOT ?>timelines">Timeline</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= URL(0) === 'friends' ? 'active' : '' ?>" href="<?= ROOT ?>friends">Friends</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= URL(0) === 'markets' ? 'active' : '' ?>" href="<?= ROOT ?>markets">Market</a>
                    </li>
                </ul>
                <div class="d-flex flex-column flex-sm-row w-50 gap-2">
                    <input name="search" type="search" class="form-control form-control-sm" placeholder="Find Friends ..." />
                    <button type="button" class="btn btn-sm btn-primary">Search</button>
                </div>
                <ul class="navbar-nav mx-auto mb-2 mb-md-0">
                    <li class="nav-item">
                        <a class="nav-link <?= URL(0) === 'profile' ? 'active' : '' ?>" aria-current="page" href="<?= ROOT ?>">Amisu Usman</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?= URL(0) === 'logout' ? 'active' : '' ?>" href="<?= ROOT ?>friends">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>
