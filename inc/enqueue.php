<?php
/**
 * Understrap enqueue scripts
 *
 * @package understrap
 */

function asufse_enqueue_scripts() {
	// Get the theme data.
	$the_theme = wp_get_theme();
	$theme_version = $the_theme->get( 'Version' );
	$css_version = $theme_version . '.' . filemtime(get_template_directory() . '/css/theme.css');
	
    wp_register_script( 'font-awesome-five', get_template_directory_uri() . '/src/fontawesome-pro/js/all.js', false, '5.2.0' );
    wp_enqueue_script( 'font-awesome-five' );

    wp_register_style( 'roboto-font', 'https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900,900i');
    wp_enqueue_style( 'roboto-font' );

	// By default, Understrap will load the child theme's stylesheet and not the parent. This fixes this to normal behavior.
	// wp_enqueue_style( 'understrap-styles', get_stylesheet_directory_uri() . '/css/theme.css', array(), $css_version );
	wp_enqueue_style( 'pitchfork', get_template_directory_uri() . '/css/theme.css', array(), $css_version );

	wp_enqueue_script( 'jquery');
	wp_enqueue_script( 'popper-scripts', get_template_directory_uri() . '/js/popper.min.js', array(), $theme_version, true);
	
	$js_version = $theme_version . '.' . filemtime(get_template_directory() . '/js/theme.min.js');
	wp_enqueue_script( 'understrap-scripts', get_template_directory_uri() . '/js/theme.min.js', array(), $js_version, true );
	wp_enqueue_script( 'asu-mobile-menu', get_template_directory_uri() . '/js/mobile-menu.js', array(), $js_version, true );
	
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'asufse_enqueue_scripts' );