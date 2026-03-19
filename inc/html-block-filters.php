<?php
/**
 * HTML filtering of the_content using HTML API.
 * - core/pagination blocks, alter output of next/previous labels.
 *
 * @package pitchfork
 *
 * Helpful docs:
 *  - https://wpdevelopment.courses/articles/wp-html-tag-processor/
 *  - https://developer.wordpress.org/reference/classes/wp_html_tag_processor/
 *
 *
 */

add_filter( 'render_block_core/query-pagination', 'pitchfork_strip_query_pagination_labels_when_chevron', 10, 2 );
/**
 * Remove visible Previous/Next text from query pagination links when chevron mode is active.
	*
	* @param string $block_content Rendered block HTML.
	* @param array  $block         Parsed block array.
	* @return string
	*/
	function pitchfork_strip_query_pagination_labels_when_chevron( $block_content, $block ) {
		if ( empty( $block_content ) || ! class_exists( 'WP_HTML_Tag_Processor' ) ) {
			return $block_content;
		}

		$attrs = $block['attrs'] ?? array();

		// Only adjust output for chevron mode.
		if ( ( $attrs['paginationArrow'] ?? 'none' ) !== 'chevron' ) {
			return $block_content;
		}

		$processor = new WP_HTML_Tag_Processor( $block_content );

		$in_target_anchor   = false;
		$in_icon_span       = false;
		$strip_visible_text  = false;
		$current_aria_label  = '';

		while ( $processor->next_token() ) {
			$token_type = $processor->get_token_type();

			if ( '#tag' === $token_type ) {
				$tag_name   = $processor->get_tag();
				$is_closer  = $processor->is_tag_closer();
				$class_name = (string) $processor->get_attribute( 'class' );

				if ( $is_closer ) {
					if ( 'SPAN' === $tag_name ) {
						$in_icon_span = false;
					}

					if ( 'A' === $tag_name ) {
						$in_target_anchor  = false;
						$in_icon_span      = false;
						$strip_visible_text = false;
						$current_aria_label = '';
					}

					continue;
				}

				// Track the previous/next anchors.
				if ( 'A' === $tag_name ) {
					if ( false !== strpos( $class_name, 'wp-block-query-pagination-previous' ) ) {
						$in_target_anchor  = true;
						$strip_visible_text = true;
						$current_aria_label = 'Previous Page';
						$processor->set_attribute( 'aria-label', $current_aria_label );
						continue;
					}

					if ( false !== strpos( $class_name, 'wp-block-query-pagination-next' ) ) {
						$in_target_anchor  = true;
						$strip_visible_text = true;
						$current_aria_label = 'Next Page';
						$processor->set_attribute( 'aria-label', $current_aria_label );
						continue;
					}
				}

				// Keep the chevron icon span intact.
				if ( $in_target_anchor && 'SPAN' === $tag_name ) {
					if (
						false !== strpos( $class_name, 'wp-block-query-pagination-previous-arrow' ) ||
						false !== strpos( $class_name, 'wp-block-query-pagination-next-arrow' )
					) {
						$in_icon_span = true;
					}
				}

				continue;
			}

			// Blank visible text nodes inside the target anchor, but not inside the icon span.
			if ( '#text' === $token_type && $in_target_anchor && $strip_visible_text && ! $in_icon_span ) {
				$processor->set_modifiable_text( '' );
			}
		}

		return $processor->get_updated_html();
	}
