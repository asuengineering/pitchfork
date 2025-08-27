<?php
/**
 * Pitchfork Theme options page.
 *
 * @package pitchfork
 * @author ASU Engineering
 */

/**
 * Register the ACF Options page at init.
 */
add_action('acf/init', 'pitchfork_register_options_page');
function pitchfork_register_options_page() {

	// Only proceed if the function is available (ACF active).
	if ( ! function_exists('acf_add_options_page') ) {
		return;
	}

	// (Optional) Only register in admin to avoid unnecessary front-end work.
	if ( ! is_admin() ) {
		return;
	}

	acf_add_options_page(array(
		'page_title'  => 'Pitchfork General Settings',
		'menu_title'  => 'Pitchfork Settings',
		'menu_slug'   => 'pitchfork-settings',
		'parent_slug' => 'options-general.php',
		'capability'  => 'manage_options',
		'redirect'    => false,
	));
}

/**
 * Add custom location rule to ACF to enable checking if the site is multisite.
 */
add_action('acf/init', 'pitchfork_init_multisite_location_rule');
function pitchfork_init_multisite_location_rule() {

	// Check function exists, then include and register the custom location type class.
	if ( function_exists('acf_register_location_type') ) {
		include_once get_template_directory() . '/inc/class-acf-add-multisite-location.php';
		acf_register_location_type( 'Pitchfork_ACF_Location_Is_Multisite' );
	}
}
