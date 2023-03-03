<?php
/**
 * The default template in use by all pages within the Pitchfork theme.
 *
 * @package pitchfork
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

	<main id="skip-to-content" <?php post_class(); ?>>

		<?php

		while ( have_posts() ) {

			the_post();

			// get_template_part( 'templates-global/global-banner' );

			// Parse through the blocks on the page.
			// If an acf/hero block is in the #1 position, do nothing.
			// Otherwise display the post title.
			$content_blocks = parse_blocks( $post->post_content );
			$first_block_names = array('acf/hero', 'acf/hero-video', 'core/post-title');

			if ( ! in_array( $content_blocks[0]['blockName'], $first_block_names )) {
				the_title( '<div class="page-title"><h1 class="entry-title">', '</h1></div>' );
			}

			the_content();

			// Display the edit post button to logged in users.
			if ( is_user_logged_in() ) {
				echo '<footer class="entry-footer"><div class="container"><div class="row"><div class="col-md-12">';
				edit_post_link( __( 'Edit', 'pitchfork' ), '<span class="edit-link">', '</span>' );
				echo '</div></div></div></footer><!-- end .entry-footer -->';
			}
		}

		?>

	</main><!-- #main -->

<?php
get_footer();

