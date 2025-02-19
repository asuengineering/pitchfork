<?php
/**
 * Template Name: No title
 *
 * Based off the regular page.php, but does not output a page title by default.
 * Reminder: You can output a <header> tag by using the core/group block and settings in the Advancced panel.
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

