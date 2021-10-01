<?php

/**
 * Connect stylesheets & scripts
 *
 * @package pitchfork
 */

function byvex_enqueue_scripts()
{
	// Bootstrap CSS
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css', array(), filemtime(get_template_directory() . "/css/bootstrap.min.css"));

	// Style CSS
	wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', array('bootstrap'), filemtime(get_template_directory() . "/css/style.css"));

	// Google Font - Rubik
	wp_enqueue_style('rubik', 'https://fonts.googleapis.com/css2?family=Rubik:wght@400;500;600;700&display=swap', array('bootstrap', 'style'));

	// Bootstrap Bundle with PopperJS
	wp_enqueue_script('bootstrap-bundle', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', array('jquery'), filemtime(get_template_directory() . "/js/bootstrap.bundle.min.js"), true);

	// Main JS
	wp_enqueue_script('main', get_template_directory_uri() . '/js/main.js', array('jquery', 'bootstrap-bundle'), filemtime(get_template_directory() . "/js/main.js"), true);

	// Remove Block Styles
	wp_dequeue_style('wp-block-library');
	wp_dequeue_style('wp-block-library-theme');
}
add_action('wp_enqueue_scripts', 'byvex_enqueue_scripts');
