<?php
/**
 * The template for displaying archive pages
 *
 * @package pitchfork
 */

get_header();
?>

<main id="skip-to-content" <?php post_class(); ?>>
	<div class="container py-4">
		<?php 
			the_archive_title( '<h2 class="page-title mb-6">', '</h2>' );
			$description = get_the_archive_description(); 
			if ( $description ) {
				echo '<div class="archive-description lead fw-normal">' . wp_kses_post( wpautop( $description )) . '</div>';
			}
		?>
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
	</div>
	<div class="row py-4">
		<div class="col">
			<!-- The pagination component -->
			<?php pitchfork_pagination(); ?>
		</div>
	</div>
</main><!-- #main -->

<?php
get_footer();
