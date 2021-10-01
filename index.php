<?php

/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @package pitchfork
 */
get_header();
?>

<div class="container py-4">
	<?php if ( have_posts() ) : ?>

		<div class="loop-container">
			<?php
			while ( have_posts() ) :
				the_post();
				get_template_part( 'template-parts/content-excerpt' );
			endwhile;
			?>
		</div>

		<?php
		pitchfork_the_posts_pagination();
	else :
		get_template_part( 'template-parts/content-none' );
	endif; 
	?>
</div>

<?php
get_footer();
