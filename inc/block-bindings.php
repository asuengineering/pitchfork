<?php
/**
 * Block bindings support.
 *
 * - Add binding for 'current_permalink' which is useful in a query loop.
 * - Bind arbitrary paragraph display, heading or button source
 *
 * @package pitchfork
 */

function pitchfork_get_current_permalink_binding_value( array $source_args, WP_Block $block_instance, string $attribute_name ): string {
	$post_id = 0;

	// Prefer an explicit postId argument if supplied.
	if ( ! empty( $source_args['postId'] ) ) {
		$post_id = absint( $source_args['postId'] );
	}
	// Otherwise, try the current loop/global post context.
	elseif ( function_exists( 'get_the_ID' ) ) {
		$post_id = get_the_ID();
	}

	if ( ! $post_id ) {
		return '';
	}

	return (string) get_permalink( $post_id );
}

/**
 * Register the block binding source on init.
 *
 * Uses `register_block_bindings_source()` introduced in WordPress 6.5.
 *
 * @return void
 */
function pitchfork_register_current_permalink_binding(): void {

	if ( ! function_exists( 'register_block_bindings_source' ) ) {
		return;
	}

	register_block_bindings_source( 'pitchfork/current-permalink', array(
		'label'              => __( 'Current permalink', 'pitchfork' ),
		'get_value_callback' => 'pitchfork_get_current_permalink_binding_value',
	));
}
add_action( 'init', 'pitchfork_register_current_permalink_binding' );
