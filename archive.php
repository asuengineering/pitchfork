<?php

/**
 * The template for displaying archive pages
 *
 * @package pitchfork
 */
get_header();
?>

<div class="container py-4">
	<?php
	$description = get_the_archive_description();
	if (have_posts()) : ?>
		<header class="page-header alignwide">
			<?php
			the_archive_title('<h1 class="page-title">', '</h1>');
			if ($description) : ?>
				<div class="archive-description lead fw-normal"><?php echo wp_kses_post(wpautop($description)); ?></div>
			<?php endif; ?>
		</header><!-- .page-header -->
		<div class="loop-container">
			<?php
			while (have_posts()) :
				the_post();
				get_template_part('template-parts/content-excerpt');
			endwhile;
			?>
		</div>
	<?php
		the_posts_pagination();
	else :
		get_template_part('template-parts/content-none');
	endif;
	?>
</div>

<?php get_footer();
