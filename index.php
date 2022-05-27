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

<main id="skip-to-content" <?php post_class(); ?>>
	<div class="container py-4">
		<div class="index-title">
			<?php 
				echo '<h1 class="page-title">' . get_bloginfo( 'name' ) . '</h1>';
				// The blog description is disabled in the customizer
				if (! empty(get_bloginfo('description'))) {
					echo '<p class="lead">' . get_bloginfo( 'description' ) . '</p>';
				}
			?>
		</div>

		<div class="row">
			<?php 
			if ( have_posts() ) {
				// Start the loop.
				while ( have_posts() ) {
					the_post();
					get_template_part( 'template-parts/content-card' );
				}
			} else {
				get_template_part( 'template-parts/content-none' );
			}
			?>
		</div>

		<div class="row py-4">
			<div class="col">
				<!-- The pagination component -->
				<?php pitchfork_pagination(); ?>
			</div>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
