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
		unset( $registered_blocks['core/button'] );
		unset( $registered_blocks['core/buttons'] );
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
		// Setting editor-font-sizes to an empty array removes the size picker from the Gutenberg frame.
		add_theme_support( 'editor-font-sizes', array());

		add_theme_support( 'disable-custom-font-sizes' );
		add_theme_support( 'disable-custom-colors' );
		add_theme_support( 'disable-custom-gradients' );
		add_theme_support( 'responsive-embeds' );

		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name' => esc_attr__( 'ASU Gold', 'uds-wordpress-theme' ),
					'slug' => 'asu-gold',
					'color' => '#ffc627',
				),
				array(
					'name' => esc_attr__( 'ASU Maroon', 'uds-wordpress-theme' ),
					'slug' => 'asu-maroon',
					'color' => '#8c1d40',
				),
				array(
					'name' => esc_attr__( 'ASU Blue', 'uds-wordpress-theme' ),
					'slug' => 'asu-blue',
					'color' => '#00A3E0',
				),
				array(
					'name' => esc_attr__( 'ASU Green', 'uds-wordpress-theme' ),
					'slug' => 'asu-green',
					'color' => '#78BE20',
				),
				array(
					'name' => esc_attr__( 'ASU Orange', 'uds-wordpress-theme' ),
					'slug' => 'asu-orange',
					'color' => '#ff7f32',
				),
				array(
					'name' => esc_attr__( 'ASU Gray 1', 'uds-wordpress-theme' ),
					'slug' => 'asu-gray-1',
					'color' => '#fafafa',
				),
				array(
					'name' => esc_attr__( 'ASU Gray 2', 'uds-wordpress-theme' ),
					'slug' => 'asu-gray-2',
					'color' => '#e8e8e8',
				),
				array(
					'name' => esc_attr__( 'ASU Gray 3', 'uds-wordpress-theme' ),
					'slug' => 'asu-gray-3',
					'color' => '#d0d0d0',
				),
				array(
					'name' => esc_attr__( 'ASU Gray 4', 'uds-wordpress-theme' ),
					'slug' => 'asu-gray-4',
					'color' => '#bfbfbf',
				),
				array(
					'name' => esc_attr__( 'ASU Gray 5', 'uds-wordpress-theme' ),
					'slug' => 'asu-gray-5',
					'color' => '#747474',
				),
				array(
					'name' => esc_attr__( 'ASU Gray 6', 'uds-wordpress-theme' ),
					'slug' => 'asu-gray-6',
					'color' => '#484848',
				),
				array(
					'name' => esc_attr__( 'ASU Gray 7', 'uds-wordpress-theme' ),
					'slug' => 'asu-gray-7',
					'color' => '#191919',
				),
				array(
					'name' => esc_attr__( 'ASU White', 'uds-wordpress-theme' ),
					'slug' => 'asu-white',
					'color' => '#ffffff',
				),
			)
		);
	}
}
add_action( 'after_setup_theme', 'pitchfork_theme_support_block_editor_opt_in' );


// if ( ! function_exists( 'pitchfork_register_core_block_styles' ) ) {    
//     /**
//      * Add block styles to existing core blocks.
// 	 * Remove unwanted styles from core blocks.
//      *
//      * @return void
//      */
//     function pitchfork_register_core_block_styles() {
// 		// Lead paragraph
// 		register_block_style(
// 			'core/paragraph',
// 			array(
// 				'name'         => 'lead',
// 				'label'        => __( 'Lead', 'pitchfork' ),
// 				'is_default'   => false,
// 			)
//     	);
// 	};
// }
// add_action( 'init', 'pitchfork_register_core_block_styles');

