<?php

use Core\Session;


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="generator" content="Native Framework 1.0.0">
    <?php $this->content('meta') ?>
    <link rel="icon" href="<?= ROOT ?>favicon.ico" />
    <link rel="apple-touch-icon" href="<?= ROOT ?>favicon.ico" />
    <!-- Bootstrap Icons CSS -->
    <link rel="stylesheet" href="<?= ROOT ?>assets/bootstrap/css/bootstrap-icons.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?= ROOT ?>assets/bootstrap/css/bootstrap.min.css">
    <!-- Style CSS -->
    <link rel="stylesheet" href="<?= ROOT ?>assets/css/dashboard.css">

    <title>
        <?= $this->getSiteTitle(); ?>
    </title>
    <?php $this->content('head') ?>
</head>

<body>
    <?= Session::displaySessionAlerts(); ?>
    <?= $this->partial('includes/admin_header'); ?>

    <div class="container-fluid">
        <div class="row">
            <?php $this->partial('includes/admin_sidebar'); ?>
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php $this->partial('includes/admin_crumbs'); ?>
                <?php $this->content('content'); ?>
            </main>
        </div>
    </div>

    <!-- JQuery 3.4.1 -->
    <script src="<?= ROOT ?>assets/js/jquery-3.6.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="<?= ROOT ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Js -->
    <?php $this->content('script') ?>
</body>

</html>