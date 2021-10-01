<?php

/**
 * Template part for displaying post content in single.php
 *
 * @package Byvex
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title default-max-width text-break"><?php the_title() ?></h1>
		<p><?php esc_html_e('Posted under', 'byvex'); ?> <?php the_category(', '); ?> <?php esc_html_e('On', 'byvex'); ?> <?php byvex_posted_on(); ?> <?php esc_html_e('By', 'byvex'); ?> <?php byvex_posted_by(); ?> </p>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<footer class="entry-footer default-max-width">
		<?php byvex_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article>
