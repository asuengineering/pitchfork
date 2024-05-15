<?php
/**
 * HTML filtering of the_content using HTML API.
 * Available since WP 6.2
 *
 * @package pitchfork
 *
 * Helpful docs:
 *  - https://wpdevelopment.courses/articles/wp-html-tag-processor/
 *  - https://developer.wordpress.org/reference/classes/wp_html_tag_processor/
 *
 *
 */


/**
 * Add data layer tracking for buttons that also have distinct labels in the editor.
 */
function pitchfork_datalayer_core_button( $block_content, $block ) {

	// Looking for core buttons and excluding blocks with no visible just yet.
    if ( ! $block_content || $block['blockName'] !== 'core/button' ) {
        return $block_content;
    }

	// Check for existence of a block name in the metadata. Return early if none found.
	if (! empty($block['attrs']['metadata']['name'])) {
		$blockname = $block['attrs']['metadata']['name'];
	} else {
		return $block_content;
	}

	// If we are still here, add the block name to the datalayer elements and render block.
	$processor = new WP_HTML_Tag_Processor( $block_content );

	if ( $processor->next_tag( array( 'class_name' => 'wp-element-button' ) ) ) {
		$processor->set_attribute( 'data-ga', $blockname);
		$processor->set_attribute( 'data-ga-name', 'onclick' );
		$processor->set_attribute( 'data-ga-event', 'link' );
		$processor->set_attribute( 'data-ga-action', 'click' );
		$processor->set_attribute( 'data-ga-type', 'internal link' );
		$processor->set_attribute( 'data-ga-region', 'main content' );
	}

	return $processor->get_updated_html();

}
add_filter( 'render_block', 'pitchfork_datalayer_core_button', 10, 2 );
