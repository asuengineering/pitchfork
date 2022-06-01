<?php
/**
 * The default template for displaying all single posts. 
 * References content-single for formatting of info within the loop.
 *
 * @package pitchfork
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main id="skip-to-content">
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

		<?php

			while ( have_posts() ) {

				the_post();

				// Parse through the blocks on the page.
				// If an acf/hero block is in the #1 position, do nothing.
				// Otherwise display the post title and other "header" info.
				
				$content_blocks = parse_blocks( $post->post_content );

				if ('acf/hero' !== $content_blocks[0]['blockName']) {

					if ( has_post_thumbnail() ) {
						echo '<header class="entry-header alignwide">';
						the_post_thumbnail('medium_large', array( 'class' => 'img-fluid' ));
					} else {
						echo '<header class="entry-header no-thumbnail">';
					}
					
					the_title( '<h1 class="entry-title">', '</h1>' );

					echo '<p class="entry-byline">';
						esc_html_e( 'Posted by ', 'pitchfork' );
						pitchfork_posted_by();
						esc_html_e( ' on ', 'pitchfork' );
						pitchfork_posted_on();
					echo '</p>';
					
					echo '</header>';

				}

				the_content();

				echo '<footer class="entry-footer default-max-width">';
					pitchfork_entry_footer();
				echo '</footer>';

				pitchfork_the_post_navigation();

				// Comments template would go here. 

			}

			?>
		</article>
	</main><!-- #main -->
	
<?php
get_footer();
