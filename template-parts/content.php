<?php

/**
 * Template part for displaying post content in single.php
 *
 * @package pitchfork
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<h1 class="entry-title default-max-width text-break"><?php the_title() ?></h1>
		<p><?php esc_html_e('Posted under', 'pitchfork'); ?> <?php the_category(', '); ?> <?php esc_html_e('On', 'pitchfork'); ?> <?php pitchfork_posted_on(); ?> <?php esc_html_e('By', 'pitchfork'); ?> <?php pitchfork_posted_by(); ?> </p>
	</header><!-- .entry-header -->
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
	<footer class="entry-footer default-max-width">
		<?php pitchfork_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article>
