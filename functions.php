<?php
/**
 * Understrap functions and definitions
 *
 * @package understrap
 */


// ------ LOAD CARBON FIELDS  -------
// Include additional widgets for Super Footer.

add_action( 'after_setup_theme', 'asufse_crb_load_widgets' );
function asufse_crb_load_widgets() {
    require_once( 'vendor/autoload.php' );
    \Carbon_Fields\Carbon_Fields::boot();

    include_once( 'inc/super-footer-widgets.php' );
}

/* Default Understrap inclusions 
------------------------------------ */
require get_template_directory() . '/inc/theme-settings.php';
require get_template_directory() . '/inc/setup.php';
require get_template_directory() . '/inc/widgets.php';
require get_template_directory() . '/inc/enqueue.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/customizer-asuheader.php';
require get_template_directory() . '/inc/custom-comments.php';
// require get_template_directory() . '/inc/jetpack.php';
require get_template_directory() . '/inc/class-wp-bootstrap-navwalker.php';
// require get_template_directory() . '/inc/woocommerce.php';
require get_template_directory() . '/inc/editor.php';


// ------ ASU HEADER & FOOTER INCLUDES -------

// Load global assets via remote get. Allows for easy access to the version in each of the URLs below.
function asuwp_load_global_head_scripts() {
	$request = wp_remote_get('http://www.asu.edu/asuthemes/4.6/heads/default.shtml');
	$response = wp_remote_retrieve_body( $request );
	echo $response;
}

// Build header parent site name based on customizer settings
function asuwp_load_header_sitenames() {

    if ( is_array( get_option( 'wordpress_asu_theme_options' ) ) ) {
        $cOptions = get_option( 'wordpress_asu_theme_options' );
    }

    if ( isset( $cOptions ) && $cOptions['parent']) {
        // Check box is true. 
        $parent = '<a href="%1$s" id="parent-site">%2$s</a>&nbsp;&nbsp;|&nbsp;&nbsp;';
        $parent = sprintf( $parent, esc_html( $cOptions['parent_url'] ), $cOptions['parent_site_name'] );
    } else {
        $parent = '';
    }
    
    return $parent;
}

// Remote get ASU global header elements. Print site name along with returned code.
function asuwp_load_global_header() {
    $request = wp_remote_get('http://www.asu.edu/asuthemes/4.6/headers/default.shtml');
    $response = wp_remote_retrieve_body( $request );

    $parent = asuwp_load_header_sitenames();

    $response .= '<div id="sitename-wrapper">' . $parent . '<a href="'. get_home_url() . '" title="Home" rel="home" id="current-site">'. get_bloginfo( 'name' ) . '</a></div>';
    echo $response;

}
// Remote get ASU global footer elements.
function asuwp_load_global_footer() {
    $request = wp_remote_get('http://www.asu.edu/asuthemes/4.6/includes/footer.shtml');
    $response = wp_remote_retrieve_body( $request );
    echo $response;
}

// Add custom home icon & menu entry to main nav manu.
function asuwp_add_home_menu_icon ( $items, $args ) {
    if ($args->theme_location == 'primary') {

        if (is_front_page()) {
            $homeicon = '<li id="menu-item-home" class="menu-item current-menu-item active">';
        } else {
            $homeicon = '<li id="menu-item-home" class="menu-item">';
        }

        $homeicon .= '<a href="' . get_home_url() . '" title="Home" id="home-icon-main-nav" class="nav-link">';
        $homeicon .= '<span class="fa fa-home" aria-hidden="true"></span>';
        $homeicon .= '</a>';
        $homeicon .= '</li>';
        
        $items = $homeicon . $items;
    }
    return $items;
}
add_filter( 'wp_nav_menu_items', 'asuwp_add_home_menu_icon', 10, 2 );

