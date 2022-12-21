<?php
/**
 * Pitchfork functions and definitions
 *
 * @package pitchfork
 */

// TGMPA plugin activation script. Checks for required active plugins and nags the user to install.
require_once get_template_directory() . '/inc/tgmpa/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

// Set up theme defaults and register support for various WordPress features.
require get_template_directory() . '/inc/after-setup-theme.php';

// Enqueue scripts and styles.
require get_template_directory() . '/inc/enqueue-scripts.php';

// Localize script and "walker" functions for component header.
require get_template_directory() . '/inc/wp-custom-menu.php';
require get_template_directory() . '/inc/header-localize-script.php';

// Add favicons, anti iFrame hijacking and other improvements.
require get_template_directory() . '/inc/header-additions.php';

// Add nav walker classes for main menu and social media icons.
// require get_template_directory() . '/inc/class-bootstrap-walker-nav-menu.php';
require get_template_directory() . '/inc/class-wp-social-media-walker.php';
require get_template_directory() . '/inc/class-unity-react-header-navtree-walker.php';
require get_template_directory() . '/inc/class-unity-react-header-ctabtn-walker.php';

// Theme options page includes controls for the theme's multisite behavior and analytics.
require get_template_directory() . '/inc/theme-options.php';

// Customizer options.
require get_template_directory() . '/inc/customizer/customizer-sanitizers.php';
require get_template_directory() . '/inc/customizer/customizer-preview-js.php';
require get_template_directory() . '/inc/customizer/customizer-controls-js.php';
require get_template_directory() . '/inc/customizer/customizer-post-message-support.php';
require get_template_directory() . '/inc/customizer/customizer-endorsed-unit-logos.php';
require get_template_directory() . '/inc/customizer/customizer-settings.php';

// Render partials from customizer controls. Used for header.php and for selective refresh of the customizer.
require get_template_directory() . '/inc/render-partials.php';

// Add preload for CDN.
// require get_template_directory() . '/inc/resource-hints.php'; !

// Custom template functions for this theme.
require get_template_directory() . '/inc/template-functions.php';

// Custom template tags for this theme.
require get_template_directory() . '/inc/template-tags.php';

// Load ASU WordPres pagination function.
require get_template_directory() . '/inc/pagination.php';

// Remove support for a couple of the native WordPress blocks.
require get_template_directory() . '/inc/blocks.php';

// Might be temporary. Remove duotone SVG from <body>.
remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

