<?php

use Core\Form;

?>

<!-- Footer -->
<div class="container">
    <footer class="pt-5 text-center">

        <div class="d-flex flex-column flex-sm-row justify-content-between align-items-center py-4 my-2 border-top">
            <p>&copy; <?= date('Y') ?>
                <?= $settings['site_name'] ?? $this->getSiteTitle(); ?>, Inc. All Rights Reserved.</p>
            <div class="social">
                <a href="#"><i class="bi bi-facebook"></i></a>
                <a href="#"><i class="bi bi-twitter"></i></a>
                <a href="#"><i class="bi bi-instagram"></i></a>
                <a href="#"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </footer>
</div>
