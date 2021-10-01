<?php

/**
 * Theme support functions
 *
 * @package pitchfork
 */

add_action('after_setup_theme', 'uds_pitchfork_setup');
if (!function_exists('uds_pitchfork_setup')) {

	function uds_pitchfork_setup()
	{
		add_theme_support('automatic-feed-links');

		add_theme_support('customize-selective-refresh-widgets');

		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
				'navigation-widgets'
			)
		);

		add_theme_support('post-thumbnails');

		add_theme_support('title-tag');

		register_nav_menus(array(
			'primary' => esc_html__('Primary', 'pitchfork'),
		));
		
	}
}

