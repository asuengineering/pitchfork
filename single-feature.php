<?php
/**
 *
 * Template Name: Featured story (FC)
 * Template Post Type: post
 *
 * An alternate template for displaying single posts.
 * References the design found in the Pixelgrade blog.
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

			// Parse through the blocks on the page.
			// If an acf/hero block is in the #1 position, do nothing.
			// Otherwise display the post title.
			// $content_blocks = parse_blocks( $post->post_content );
			// $first_block_names = array('acf/hero', 'acf/hero-video');

			// if ( ! in_array( $content_blocks[0]['blockName'], $first_block_names )) {

			// 	if ( has_post_thumbnail() ) {
			// 		echo '<header class="entry-header alignwide">';
			// 		the_post_thumbnail('medium_large', array( 'class' => 'img-fluid' ));
			// 	} else {
			// 		echo '<header class="entry-header no-thumbnail">';
			// 	}

			// 	the_title( '<h1 class="entry-title">', '</h1>' );

			// 	echo '<p class="entry-byline">';
			// 		esc_html_e( 'Posted by ', 'pitchfork' );
			// 		pitchfork_posted_by();
			// 		esc_html_e( ' on ', 'pitchfork' );
			// 		pitchfork_posted_on();
			// 	echo '</p>';

			// 	echo '</header>';

			// }

			echo '<header class="entry-header alignfull"><div class="wrap">';
			the_title( '<h1 class="entry-title">', '</h1>' );
			echo '<h2 class="entry-subtitle">Subtitle block goes here which explains more about the more punchy title of the article in question.</h2>';

			echo '<div class="post-meta">';
			echo '<div class="attribution">';

			echo get_avatar( get_the_author_meta( 'ID' ), 80, 'mystery' );

			echo '<p class="entry-byline">';
				esc_html_e( 'By ', 'pitchfork' );
				pitchfork_posted_by();
				esc_html_e( ' in ', 'pitchfork' );
				the_category(', ');;
			echo '</p>';

			echo '<p class="entry-dateline">';
				pitchfork_posted_originally();
			echo 'Reading time 9 – 13 minutes</p>';

			echo '</div>';  // end .attribution

			echo '<p class="share">Share this!</p>';

			echo '</div>'; // end .post-meta

			echo '</wrap></header>';

			echo '<section class="post-image alignwide">' . get_the_post_thumbnail($post_id, 'full', array( 'class' => 'img-fluid' )) . '</section>';

			echo '<section class="content">';
			the_content();
			echo '</section>';

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
