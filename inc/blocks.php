<?php
/**
 * File: blocks.php
 *
 * @package Pitchfork
 *
 */

/**
 * Unregisters a few of the WordPress native blocks that
 * we will not be supporting in this theme.
 *
 * It fires after other plugins and the above block init function add their blocks
 * to the WP registry. Using those entries, it filters the list, removing the unsupported
 * blocks and returning a smaller array.
 *
 * Overwritable by a child theme.
 */

if ( ! function_exists( 'pitchfork_unregister_native_blocks' ) ) {

	/**
	 * Gather the list of registered blocks, remove elements from the returned array.
	 */
	function pitchfork_unregister_native_blocks() {
		// Get the list of registered blocks including those added by plugins.
		$registered_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();

		// Removing native blocks from the "text" category.

		unset( $registered_blocks['core/pullquote'] );
		unset( $registered_blocks['core/quote'] );
		unset( $registered_blocks['core/preformatted'] );
		unset( $registered_blocks['core/verse'] );

		// Strip the array down to just the keys.
		$registered_blocks = array_keys( $registered_blocks );

		return $registered_blocks;
	}

	add_filter( 'allowed_block_types_all', 'pitchfork_unregister_native_blocks' );
}

// Deregister the core WordPress block patterns.
if ( ! function_exists( 'pitchfork_remove_core_patterns' ) ) {
	/**
	 * Removes theme support for 'core-block-patterns', which removes
	 * ALL core block patterns from the editor.
	 */
	function pitchfork_remove_core_patterns() {
		remove_theme_support( 'core-block-patterns' );
	}
	add_action( 'after_setup_theme', 'pitchfork_remove_core_patterns' );
}

// Add block patterns for Pitchfork
if ( function_exists( 'register_block_pattern_category' ) ) {
	register_block_pattern_category(
		'pitchfork-directory',
		array( 'label' => __( 'Pitchfork: Directory', 'pitchfork' ) )
	);

	register_block_pattern_category(
		'pitchfork-card',
		array( 'label' => __( 'Pitchfork: Cards', 'pitchfork' ) )
	);

	register_block_pattern_category(
		'pitchfork-card-layouts',
		array( 'label' => __( 'Pitchfork: Card Layouts', 'pitchfork' ) )
	);

}

if ( ! function_exists( 'pitchfork_gutenberg_css' ) ) {
	/**
	 * Load CSS styles in editor area.
	 */
	function pitchfork_gutenberg_css() {
		add_theme_support( 'editor-styles' );
		add_editor_style( 'dist/css/theme.css' );
	}
}
add_action( 'after_setup_theme', 'pitchfork_gutenberg_css' );


/**
 * Opt in/out features for the theme and the block editor.
 * From: https://developer.wordpress.org/block-editor/developers/themes/theme-support/
 *
 * @return void
 */
function pitchfork_theme_support_block_editor_opt_in() {

	// This is still in expirimental-theme.json, but not an actual theme.json
	add_theme_support( 'responsive-embeds' );

	// Reminder: Lots of other theme options moved to theme.json.

}
add_action( 'after_setup_theme', 'pitchfork_theme_support_block_editor_opt_in' );



/**
 * With the use of the separate core assets filter, we can easily deregister
 * block styles from individual core blocks with the deregister_style hook.
 * Ref: https://github.com/WordPress/gutenberg/issues/32051#issuecomment-1058964416
 *
 * Affects front end only, not block editor screens.
 * Ref: https://developer.wordpress.org/reference/functions/wp_should_load_separate_core_block_assets/
 *
 * @return void
 */
function pitchfork_remove_core_wp_block_styles() {
    wp_deregister_style( 'wp-block-button' );
	wp_deregister_style( 'wp-block-image' );
	wp_deregister_style( 'wp-block-separator' );
}
add_filter( 'should_load_separate_core_block_assets', '__return_true' );
add_action( 'wp_enqueue_scripts', 'pitchfork_remove_core_wp_block_styles', 100 );
