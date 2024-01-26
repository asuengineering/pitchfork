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

	<?php

		while ( have_posts() ) {

			the_post();

			echo '<header class="entry-header">';

			echo '<div class="title-wrap">';
			the_title( '<h1 class="entry-title article">', '</h1>' );
			echo '</div>'; // end .title-wrap

			echo get_the_post_thumbnail($post_id, 'full', array( 'class' => 'img-fluid' ));
			echo '<h4 class="share">Social share icons</h4>';

			echo '</header>';

			echo '<div class="content-wrap"><section class="content">';
			the_content();
			echo '</section>';

			echo '<aside class="secondary"><div class="sidebar-wrap">';

			echo '<div class="post-meta">';
			echo '<div class="attribution">';

			echo get_avatar( get_the_author_meta( 'ID' ), 80, 'mystery' );

			echo '<div class="entry-byline"><p>';
				esc_html_e( 'By ', 'pitchfork' );
				pitchfork_posted_by();
			echo '</p>';
			echo '<p>';
				pitchfork_posted_originally();
			echo '</p>';
			echo '</div>';

			echo '</div>';  // end .attribution

			echo '<h4><span class="highlight-black">Categories</span></h4>';
			echo the_category();

			// echo '<h4><span class="highlight-black">Tags</span></h4>';
			the_tags('<h4><span class="highlight-black">Tags</span></h4><ul><li>', '</li><li>', '</li></ul>');

			echo '</div></aside></div>'; // end .sidebar-wrap, .secondary, .content-wrap

			echo '<footer class="entry-footer default-max-width">';
				pitchfork_entry_footer();
			echo '</footer>';

			pitchfork_the_post_navigation();

			// Comments template would go here.

		}

		?>
	</article>

<?php
get_footer();
