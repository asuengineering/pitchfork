<?php
/**
 * Connect stylesheets & scripts
 *
 * @package pitchfork
 */

/**
 * Register/enqueue scripts for Pitchfork.
 *
 * @return void
 */
function pitchfork_enqueue_scripts() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	// Registering scripts as a separate action from enquing them to make admin enquing easier.

	// Compiled SASS from ASU Boostrap + theme modifications.
	$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
	wp_register_style( 'pitchfork-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );

	// Jquery + Bootstrap Bundle with PopperJS.
	$bs_js_version = $theme_version . '.' . filemtime( get_template_directory() . '/src/js/bootstrap.bundle.min.js' );
	wp_register_script( 'bootstrap-bundle', get_template_directory_uri() . '/src/js/bootstrap.bundle.min.js', array( 'jquery' ), $bs_js_version );

	// Custom scripts from the theme.
	$custom_js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/custom.min.js' );
	wp_register_script( 'custom', get_template_directory_uri() . '/js/custom.min.js', array( 'jquery', 'bootstrap-bundle' ), $custom_js_version, false );

	// Font Awesome. Kit distributed by ASU Engineering.
	wp_register_script ( 'font-awesome-kit', 'https://kit.fontawesome.com/51b562cd96.js', array(), null, false );
	wp_script_add_data( 'font-awesome-kit', 'crossorigin', 'anonymous' );

	// Cookie consent scripts.
	wp_register_script ( 'cookie-consent-preact', get_template_directory_uri() . '/src/preact/js/preact.min.js', array(), null, false );
	wp_register_script ( 'cookie-consent', get_template_directory_uri() . '/src/cookie-consent/js/cookie-consent.min.js', array('cookie-consent-preact'), null, false );

	// Enqueued scripts for front end display.
	wp_enqueue_style('pitchfork-styles');
	wp_enqueue_script('bootstrap-bundle');
	wp_enqueue_script('font-awesome-kit');
	wp_enqueue_script('cookie-consent');
	wp_enqueue_script('custom');

}
add_action( 'wp_enqueue_scripts', 'pitchfork_enqueue_scripts' );


/**
 * Register/enqueue scripts for Pitchfork.
 */
function pitchfork_enqueue_admin_scripts() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	// SASS fixes specifically for the admin area. (Gutenberg).
	$admin_css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/admin.min.css' );
	wp_register_style( 'pitchfork-admin-styles', get_template_directory_uri() . '/css/admin.min.css', array(), $admin_css_version );

	// Enqueued scripts for front end display.
	wp_enqueue_style('pitchfork-admin-styles');
	wp_enqueue_script('bootstrap-bundle');
	wp_enqueue_script('font-awesome-kit');
	wp_enqueue_script('custom');

}
add_action( 'admin_enqueue_scripts', 'pitchfork_enqueue_admin_scripts' );
