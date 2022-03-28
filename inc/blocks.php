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
		unset( $registered_blocks['core/verse'] );
		unset( $registered_blocks['core/pullquote'] );
		unset( $registered_blocks['core/preformatted'] );
		unset( $registered_blocks['core/cover'] );
		unset( $registered_blocks['core/file'] );
		// unset( $registered_blocks['core/button'] );
		// unset( $registered_blocks['core/buttons'] );
		// unset( $registered_blocks['core/column'] );
		// unset( $registered_blocks['core/columns'] );


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


if ( ! function_exists( 'pitchfork_gutenberg_css' ) ) {
	/**
	 * Load CSS styles in editor area.
	 */
	function pitchfork_gutenberg_css() {
		add_theme_support( 'editor-styles' );
		add_editor_style( 'css/theme.min.css' );
	}
}
add_action( 'after_setup_theme', 'pitchfork_gutenberg_css' );


if ( ! function_exists( 'pitchfork_theme_support_block_editor_opt_in' ) ) {
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
}
add_action( 'after_setup_theme', 'pitchfork_theme_support_block_editor_opt_in' );



