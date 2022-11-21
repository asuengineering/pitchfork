<?php
/**
 * Pitchfork Theme options page.
 *
 * @package pitchfork
 * @author ASU Engineering
 *
 * Creates a theme options page with a handful of controls which
 * should be limited to an admin or super-admin
 */


if( function_exists('acf_add_options_page') ) {

	/**
	 * Restrict access to this options page to admin role only.
	 * The "enhanced multsite" section within will be restricted to super-admin only.
	 * Effectively prevents those settings from even showing up on a single site install of the theme.
	 */

	acf_add_options_page(array(
        'page_title'    => 'Pitchfork General Settings',
        'menu_title'    => 'Pitchfork Settings',
        'menu_slug'     => 'pitchfork-settings',
		'parent_slug'   => 'options-general.php',
        'capability'    => 'manage_options',
        'redirect'      => false,
    ));

}

