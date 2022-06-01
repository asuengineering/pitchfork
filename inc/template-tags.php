<?php
/**
 * Custom template tags for this theme
 *
 * @package pitchfork
 */

/**
 * Add class to excerpt.
 *
 * @param  mixed $excerpt Post excerpt.
 * @return $excerpt Post excerpt.
 */
function pitchfork_add_class_to_excerpt( $excerpt ) {
	return str_replace( '<p', '<p class="mb-2"', $excerpt );
}
add_filter( 'the_excerpt', 'pitchfork_add_class_to_excerpt' );


/**
 * Pitchfork_excerpt_more
 *
 * @param  mixed $more Before elipsis.
 * @return mixed $more Elipsis.
 */
function pitchfork_excerpt_more( $more ) {
	if ( ! is_admin() ) {
		return '...';
	}
}
add_filter( 'excerpt_more', 'pitchfork_excerpt_more' );


if ( ! function_exists( 'pitchfork_posted_on' ) ) :
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function pitchfork_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published visually-hidden" datetime="%1$s">%2$s</time> (Last updated: <time class="updated" datetime="%3$s">%4$s</time>)';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( '%s', 'post date', 'pitchfork' ),
			$time_string
		);

		echo '<span class="posted-on">' . $posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;



if ( ! function_exists( 'pitchfork_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function pitchfork_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( '%s', 'post author', 'pitchfork' ),
			'<span>' . esc_html( get_the_author() ) . '</span>'
		);
		echo $byline; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
endif;



if ( ! function_exists( 'pitchfork_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function pitchfork_entry_footer() {
		 // Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ' ', 'pitchfork' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links me-1">Categorized: ' . esc_html__( '%1$s', 'pitchfork' ) . '</span>', $categories_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'pitchfork' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">Tags: ' . esc_html__( '%1$s', 'pitchfork' ) . '</span>', $tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
			}
		}
	}
endif;



// Print the next and previous posts navigation.
if ( ! function_exists( 'pitchfork_the_post_navigation' ) ) {   
	/**
	 * Pitchfork_the_post_navigation
	 *
	 * @return void
	 */
	function pitchfork_the_post_navigation() {
		the_post_navigation(
			array(
				'prev_text' => '<span>%title</span>',
				'next_text' => '<span>%title</span>',
			)
		);
	}
}


// Print numbered pagination.
if ( ! function_exists( 'pitchfork_the_posts_pagination' ) ) {
	/**
	 * Print the next and previous posts navigation.
	 *
	 * @return void
	 */
	function pitchfork_the_posts_pagination() {
		the_posts_pagination(
			array(
				'type' => 'list',
				'class' => 'my-2',
				'mid_size' => 1,
				'end_size' => 2,
			)
		);
	}
}


if ( ! function_exists( 'pitchfork_default_body_attributes' ) ) {
	/**
	 * Adds schema markup to the body element.
	 *
	 * @param array $atts An associative array of attributes.
	 * @return array
	 */
	function pitchfork_default_body_attributes( $atts ) {
		$atts['itemscope'] = '';
		$atts['itemtype']  = 'http://schema.org/WebSite';
		return $atts;
	}
}
add_filter( 'pitchfork_body_attributes', 'pitchfork_default_body_attributes' );


if ( ! function_exists( 'pitchfork_body_attributes' ) ) {
	/**
	 * Displays the attributes for the body element.
	 */
	function pitchfork_body_attributes() {
		/**
		 * Filters the body attributes.
		 *
		 * @param array $atts An associative array of attributes.
		 */
		$atts = array_unique( apply_filters( 'pitchfork_body_attributes', $atts = array() ) );
		if ( ! is_array( $atts ) || empty( $atts ) ) {
			return;
		}
		$attributes = '';
		foreach ( $atts as $name => $value ) {
			if ( $value ) {
				$attributes .= sanitize_key( $name ) . '="' . esc_attr( $value ) . '" ';
			} else {
				$attributes .= sanitize_key( $name ) . ' ';
			}
		}
		echo trim( $attributes ); // phpcs:ignore WordPress.Security.EscapeOutput
	}
}
