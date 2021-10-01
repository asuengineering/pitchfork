<?php

/**
 * Pitchfork functions and definitions
 *
 * @package pitchfork
 */

// Set up theme defaults and register support for various WordPress features
require get_template_directory() . '/inc/after-setup-theme.php';


// Enqueue scripts and styles
require get_template_directory() . '/inc/enqueue-scripts.php';


// Customizer options
require get_template_directory() . '/inc/customizer/customizer-sanitizers.php';            
require get_template_directory() . '/inc/customizer/customizer-preview-js.php';            
require get_template_directory() . '/inc/customizer/customizer-controls-js.php';           
require get_template_directory() . '/inc/customizer/customizer-post-message-support.php'; 
require get_template_directory() . '/inc/customizer/customizer-endorsed-unit-logos.php'; 
require get_template_directory() . '/inc/customizer/customizer-settings.php';        


// Add preload for CDN
// require get_template_directory() . '/inc/resource-hints.php';


// Custom template functions for this theme
require get_template_directory() . '/inc/template-functions.php';


// Custom template tags for this theme
require get_template_directory() . '/inc/template-tags.php';


// Register widget area
require get_template_directory() . '/inc/widgets-init.php';


// Load ASU WordPress nav walker
require get_template_directory() . '/inc/wp-custom-menu.php';
