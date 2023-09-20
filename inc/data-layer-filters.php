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
 * Adds data layer elements for every button block on the page.
 *
 * 20-Sept-2023: We're not quite ready for this one yet.
 * We will likely want to do this on a conditional basis. Keeping around as a working example.
 * Uncomment the render_block filter to enable.
 */
function pitchfork_datalayer_core_button( $block_content, $block ) {
    if ( ! $block_content || $block['blockName'] !== 'core/button' ) {
        return $block_content;
    }

    $processor = new WP_HTML_Tag_Processor( $block_content );

    if ( $processor->next_tag( array( 'class_name' => 'wp-element-button' ) ) ) {
		do_action('qm/debug', $block_content);
        $processor->set_attribute( 'data-ga', wp_strip_all_tags($block_content));
		$processor->set_attribute( 'data-ga-name', 'onclick' );
		$processor->set_attribute( 'data-ga-event', 'link' );
		$processor->set_attribute( 'data-ga-action', 'click' );
		$processor->set_attribute( 'data-ga-type', 'internal link' );
		$processor->set_attribute( 'data-ga-region', 'main content' );
    }

    return $processor->get_updated_html();
}
// add_filter( 'render_block', 'pitchfork_datalayer_core_button', 10, 2 );
