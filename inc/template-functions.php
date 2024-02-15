<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package pitchfork
 */

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 *
 * @return void
 */
function pitchfork_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'pitchfork_pingback_header' );


if ( ! function_exists( 'pitchfork_custom_archive_title' ) ) {
	/**
	 * Remove the default WordPress object label from archive title pages.
	 * https://developer.wordpress.org/reference/hooks/get_the_archive_title/#user-contributed-notes
	 *
	 * @param string $title archive title.
	 * @return string
	 */
	function pitchfork_custom_archive_title( $title ) {
		if ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_tag() ) {
			$title = single_tag_title( '', false );
		} elseif ( is_author() ) {
			$title = '<span class="vcard">' . get_the_author() . '</span>';
		} elseif ( is_tax() ) { // for custom post types.
			$title = sprintf( '%1$s', single_term_title( '', false ) );
		} elseif ( is_post_type_archive() ) {
			$title = post_type_archive_title( '', false );
		}
		return $title;
	}
}
add_filter( 'get_the_archive_title', 'pitchfork_custom_archive_title' );

// Redirect author archive pages by default. Override with child theme if desired.
if (! function_exists( 'pitchfork_redirect_author_archive_pages') ) {

	function pitchfork_redirect_author_archive_pages() {
		global $wp_query;

		if ( is_author() ) {
			// Redirect to homepage, set status to 301 permenant redirect.
			// Function defaults to 302 temporary redirect.
			wp_redirect(get_option('home'), 301);
			exit;
		}
	}
}
add_action( 'template_redirect', 'pitchfork_redirect_author_archive_pages' );

// Add featured image to RSS feeds for posts
if (! function_exists( 'pitchfork_add_post_thumbnail_to_rss') ) {
	function pitchfork_add_post_thumbnail_to_rss($content) {
		global $post;
		if( has_post_thumbnail( $post->ID ) ) {
			$content = get_the_content() . '<!-- wp:post-featured-image /--><div class="post-thumbnail">' . get_the_post_thumbnail($post->ID) . '</div>';
		}
		return $content;
	}
}
add_filter('the_excerpt_rss', 'pitchfork_add_post_thumbnail_to_rss');
add_filter('the_content_feed', 'pitchfork_add_post_thumbnail_to_rss');

