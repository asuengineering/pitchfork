<?php

/**
 * Displays the footer widget area.
 *
 * @package Byvex
 */
?>

<div class="mt-auto bg-light border-top">
    <?php if (is_active_sidebar('sidebar-1')) : ?>
        <div class="container py-4">
            <aside class="widget-area row gy-3 justify-content-between">
                <?php dynamic_sidebar('sidebar-1'); ?>
            </aside><!-- .widget-area -->
        </div>
    <?php endif; ?>
</div>
