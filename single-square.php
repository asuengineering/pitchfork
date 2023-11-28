<?php
/**
 *
 * Template Name: Square story (FC)
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

			echo '<header class="entry-header">';

			echo get_the_post_thumbnail($post_id, 'full', array( 'class' => 'img-fluid' ));

			echo '<div class="title-wrap">';
			echo '<h4><span class="highlight-black">' . get_the_category_list(' &bull; ') . '</span></h4>';

			the_title( '<h1 class="entry-title article">', '</h1>' );
			echo '</div>'; // end .title-wrap

			echo '<div class="avatar-wrap">' . get_avatar( get_the_author_meta( 'ID' ), 80, 'mystery' ) . '</div>';

			echo '<div class="entry-byline">';
				pitchfork_posted_by();
			echo 'Senior science writer';
			echo '</div>';

			echo '<div class="entry-dateline">';
				pitchfork_posted_originally();
			echo 'Reading time 9 – 13 minutes</div>';



			echo '</header>';

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
