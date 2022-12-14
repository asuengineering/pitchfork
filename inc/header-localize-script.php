<?php
/**
 * Pitchfork theme - localize_script function for component header.
 *
 * @package pitchfork
 */

add_action( 'wp_enqueue_scripts', 'pitchfork_localize_component_header_script', 99 );
if ( ! function_exists( 'pitchfork_localize_component_header_script' ) ) {

	function pitchfork_localize_component_header_script() {

		$parent_org_name = get_theme_mod( 'parent_unit_name' );
		$parent_org_link = get_theme_mod( 'parent_unit_link' );

		// load current user status
		global $current_user;

		$menu_name   = 'primary';
		$menu_items  = uds_react_get_menu_formatted_array( $menu_name );
		echo '<script>console.log("enqueue animate title")</script>';
		echo '<script>console.log('.json_encode($menu_items['animate-title']).')</script>';

		$localized_array = 	array(
			'loggedIn' => is_user_logged_in(),
			'loginLink' => site_url() . '/wp-admin',
			'logoutLink' => wp_logout_url(),
			'userName' => $current_user->user_login,
			'navTree' => $menu_items['nav-items'],
			'mobileNavTree' => $menu_items['nav-items'], // define an alternate navigation menu for mobile view
			'expandOnHover' => $menu_items['expand-on-hover'],
			'baseUrl' => '/', // this could be very important for subfolder multisites where the menu base url (e.g. Home) must point to the current subsite, not the root.
			'logo' => $menu_items['logo-override'],
			// // [
			// // 	'alt' => 'alt text',        // default: 'Arizona State University'
			// // 	'src' => '/wp-content/uploads/2022/11/US-Navy-logo.jpg',        // default: 'arizona-state-university-logo-vertical.png'
			// // 	'mobileSrc' => '/wp-content/uploads/2022/11/US-Navy-logo.jpg',  // default: 'arizona-state-university-logo.png'
			// // 	'brandLink' => 'https://asu.edu',  // default: 'https://asu.edu'
			// // ],
			'isPartner' => $menu_items['show-partner-logo'],
			'partnerLogo' => $menu_items['partner-logo'],
			'title' => get_bloginfo(),
			'animateTitle' => $menu_items['animate-title'],
			'parentOrg' => $parent_org_name,
			'parentOrgUrl' => $parent_org_link,
			'breakpoint' => $menu_items['mobile-menu-breakpoint'],
			'buttons' => $menu_items['cta-buttons'],
		);

		// do_action( 'qm/debug', $localized_array );

		// wp_die( var_dump( $menu_items ) );

		// pass WordPress PHP variables to the uds-header-scripts script we enqueued above
		// These variables are props for the header React component
		wp_localize_script(
			'pitchfork-custom', // the handle of the script to pass our variables
			'udsHeaderVars', // object name to access our PHP variables from in our script
			$localized_array
			// register an array of variables we would like to use in our script
			// array(
			// 	'loggedIn' => is_user_logged_in(),
			// 	'loginLink' => site_url() . '/wp-admin',
			// 	'logoutLink' => wp_logout_url(),
			// 	'userName' => $current_user->user_login,
			// 	'navTree' => $menu_items['nav-items'],
			// 	'mobileNavTree' => $menu_items['nav-items'], // define an alternate navigation menu for mobile view
			// 	'expandOnHover' => $menu_items['expand-on-hover'],
			// 	'baseUrl' => '/', // this could be very important for subfolder multisites where the menu base url (e.g. Home) must point to the current subsite, not the root.
			// 	'logo' => $menu_items['logo-override'],
			// 	// [
			// 	// 	'alt' => 'alt text',        // default: 'Arizona State University'
			// 	// 	'src' => '/wp-content/uploads/2022/11/US-Navy-logo.jpg',        // default: 'arizona-state-university-logo-vertical.png'
			// 	// 	'mobileSrc' => '/wp-content/uploads/2022/11/US-Navy-logo.jpg',  // default: 'arizona-state-university-logo.png'
			// 	// 	'brandLink' => 'https://asu.edu',  // default: 'https://asu.edu'
			// 	// ],
			// 	'isPartner' => $menu_items['show-partner-logo'],
			// 	'partnerLogo' => $menu_items['partner-logo'],
			// 	'title' => get_bloginfo(),
			// 	'animateTitle' => $menu_items['animate-title'],
			// 	'parentOrg' => $parent_org_name,
			// 	'parentOrgUrl' => $parent_org_link,
			// 	'breakpoint' => $menu_items['mobile-menu-breakpoint'],
			// 	'buttons' => $menu_items['cta-buttons'],
			// )
		);
	}
}
