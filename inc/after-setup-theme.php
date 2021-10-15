<?php
/**
 * Theme support functions
 *
 * @package pitchfork
 */

add_action( 'after_setup_theme', 'pitchfork_theme_setup' );
if ( ! function_exists( 'pitchfork_theme_setup' ) ) {
	
	/**
	 * Setup functions for theme.
	 *
	 * @return void
	 */
	function pitchfork_theme_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		// Register nav menus.
		register_nav_menus(
			array(
				'primary' => __( 'Main Menu', 'uds-wordpress-theme' ),
				'footer' => __( 'Footer Menu', 'uds-wordpress-theme' ),
				'social-media' => __( 'Social Media Menu', 'uds-wordpress-theme' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Adding Thumbnail basic support
		 */
		add_theme_support( 'post-thumbnails', array( 'post' ) );

		/*
		 * Adding support for Widget edit icons in customizer
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );
		
	}
}

