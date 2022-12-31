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

    <title>
        <?= $this->getSiteTitle(); ?>
    </title>
    <?php $this->content('head') ?>
</head>

<body>
    <?= Session::displaySessionAlerts(); ?>
    
    <?php $this->content('content'); ?>

    <!-- JQuery 3.4.1 -->
    <script src="<?= ROOT ?>assets/js/jquery-3.6.1.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="<?= ROOT ?>assets/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Custom Js -->
    <?php $this->content('script') ?>
</body>

</html>