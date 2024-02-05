<?php
/**
 *
 * The default template for displaying single posts.
 * Inspired by a discarded design for Inner Circle that was deemed too complicated for stories of that nature.
 *
 * @package pitchfork
 */


// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<article id="skip-to-content post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php while ( have_posts() ) {

		the_post();
		?>

		<header class="entry-header">
			<div class="title-wrap">
			<?php the_title( '<h1 class="entry-title article">', '</h1>' ); ?>
			</div>

			<?php echo get_the_post_thumbnail($post_id, 'full', array( 'class' => 'img-fluid' )); ?>

		</header>

		<div class="content-wrap">

			<section class="excerpt">
				<?php the_excerpt(); ?>
			</section>

			<aside class="secondary">
				<div class="sidebar-wrap">

					<div class="post-meta">

						<div class="attribution">

							<?php echo get_avatar( get_the_author_meta( 'ID' ), 80, 'mystery' ); ?>
							<div class="entry-byline">
								<p>
									<?php esc_html_e( 'By ', 'pitchfork' );
									pitchfork_posted_by(); ?>
								</p>
								<p>
									<?php pitchfork_posted_originally(); ?>
								</p>
							</div>

						</div>

						<?php
						// Category list as button-tags from the card spec.
						$categories = get_the_category();
						if ( ! empty( $categories ) ) {
							$categorylist = '<ul class="category-list">';
							foreach( $categories as $category ) {
								$categorylist .= '<li><a class="btn btn-tag btn-tag-alt-white" href="' . esc_url( get_category_link( $category->term_id ) ) . '">' . esc_html( $category->name ) . '</a></li>';
							}
							$categorylist .= '</ul>';
						}
						echo $categorylist;
						?>

						<?php
						// Social share intent icons. Probably a plugin later...
						?>
						<ul class="social-share">
							<li><a href="#"><i class="fa-brands fa-square-facebook"></i></a></li>
							<li><a href="#"><i class="fa-brands fa-square-x-twitter"></i></a></li>
							<li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
							<li><a href="#"><i class="fa-brands fa-square-instagram"></i></a></li>
							<li><a href="#"><i class="fa-brands fa-square-github"></i></a></li>
						</ul>

					</div>
				</div>
			</aside>

			<section class="content">
				<?php the_content(); ?>
			</section>

		<footer class="entry-footer default-max-width">
			<?php pitchfork_entry_footer(); ?>
			<h4><span class="highlight-black">Tags</span></h4>
			<?php the_tags('<h4><span class="highlight-black">Tags</span></h4><ul><li>', '</li><li>', '</li></ul>'); ?>
		</footer>

		<?php

		pitchfork_the_post_navigation();

		// Comments template would go here.

	}

	echo '</article>';

get_footer();
