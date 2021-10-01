<?php

/**
 * Add widgets here, like sidebar widget and footer widget
 *
 * @package Byvex
 */

function byvex_widgets_init()
{
	register_sidebar(
		array(
			'name' => __('Footer Widgets', 'byvex'),
			'id' => 'sidebar-1',
			'description' => __('Add widgets here', 'byvex'),
			'before_widget' => '<section id="%1$s" class="widget %2$s col-sm-6 col-md-4 col-lg-3">',
			'after_widget' => '</section>',
			'before_title' => '<h3 class="h4 widget-title mb-0 pb-2">',
			'after_title' => '</h3>',
		)
	);
}
add_action('widgets_init', 'byvex_widgets_init');
