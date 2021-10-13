<?php
/**
 * Connect stylesheets & scripts
 *
 * @package pitchfork
 */

/**
 * Pitchfork_enqueue_scripts
 *
 * @return void
 */
function pitchfork_enqueue_scripts() {

	// Get the theme data.
	$the_theme     = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );

	$css_version = $theme_version . '.' . filemtime( get_template_directory() . '/css/theme.min.css' );
	$custom_js_version = $theme_version . '.' . filemtime( get_template_directory() . '/js/custom.min.js' );
	$bs_js_version = $theme_version . '.' . filemtime( get_template_directory() . '/src/js/bootstrap.bundle.min.js' );

	// Styles.
	wp_enqueue_style( 'pitchfork-styles', get_template_directory_uri() . '/css/theme.min.css', array(), $css_version );

	// Jquery + Bootstrap Bundle with PopperJS.
	wp_enqueue_script( 'bootstrap-bundle', get_template_directory_uri() . '/src/js/bootstrap.bundle.min.js', array( 'jquery' ), $bs_js_version );

	// Main JS.
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.min.js', array( 'jquery', 'bootstrap-bundle' ), $custom_js_version );

}
add_action( 'wp_enqueue_scripts', 'pitchfork_enqueue_scripts' );
