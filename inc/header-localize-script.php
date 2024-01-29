<?php
/**
 * Pitchfork theme - localize_script function for component header.
 *
 * @package pitchfork
 */

add_action( 'wp_enqueue_scripts', 'pitchfork_localize_component_header_script', 99 );
if ( ! function_exists( 'pitchfork_localize_component_header_script' ) ) {

	function pitchfork_localize_component_header_script() {

		// load current user status
		global $current_user;

		/**
		 * UDS Header: Menu settings
		 * ACF options defined in options page located at options-general.php?page=pitchfork-settings
		 *
		 * Handles situations in which ACF fields have not been set by exclusively setting default options.
		 */

		$animate_title = get_option('options_animate_title');
		$expand_on_hover = get_option('options_expand_on_hover');

		$mobile_menu_breakpoint = get_option('options_mobile_menu_breakpoint');
		if (empty($mobile_menu_breakpoint )) {
			$mobile_menu_breakpoint = 'Lg';
		}

		/**
		 * UDS Header: Logo settings
		 * Same options location as above. Both overrides are "opt-in" by design.
		 *
		 * Get each logo field. If checked, build formatted array, add to object - in enqueue, pull in from object
		 */
		if(get_option('options_asu_logo_override')) {
			$asu_logo_override_array =
			[
				'alt' => get_option('options_asu_logo_override_alt_text'),   // default: 'Arizona State University'
				'src' => get_option('options_asu_logo_override_url'),        // default: 'arizona-state-university-logo-vertical.png'
				'mobileSrc' => get_option('options_asu_logo_override_mobile_logo_url'),  // default: 'arizona-state-university-logo.png'
				'brandLink' => get_option('options_asu_logo_override_link'),  // default: 'https://asu.edu'
			];
		}
		$show_partner_logo = get_option('options_add_partner_logo');
		if(get_option('options_add_partner_logo')) {
			$add_partner_logo_array =
			[
				'alt' => get_option('options_partner_logo_alt_text'),        // default: 'Arizona State University'
				'src' => get_option('options_partner_logo_url'),        // default: 'arizona-state-university-logo-vertical.png'
				'mobileSrc' => get_option('options_partner_logo_mobile_url'),  // default: 'arizona-state-university-logo.png'
				'brandLink' => get_option('options_partner_logo_link'),  // default: 'https://asu.edu'
			];
		}

		// Build navTree / mobileNavTree props using walker class.
		if ( has_nav_menu('primary')) {
			$menu_items = wp_nav_menu([
				'theme_location' => 'primary',
				'walker' => new Pitchfork_React_Header_Navtree(),
				'echo' => false,
				'container' => '',
				'items_wrap' => '%3$s', // See: wp_nav_menu codex for why. Returns empty string.
			]);
		} else {
			$menu_items = array();
		}

		// Expected return from nav walker is a serialized array. But if the array is empty/error,
		// is_seralized() should return false. Explictly return an empty array if so.
		// Handles the use case where the menu is only composed of CTA buttons.
		if ( is_serialized( $menu_items )) {
			$menu_items = maybe_unserialize($menu_items);
		} else {
			$menu_items = array();
		}

		// Build ctaButton prop using walker class.
		if ( has_nav_menu('primary')) {
			$cta_buttons = wp_nav_menu([
				'theme_location' => 'primary',
				'walker' => new Pitchfork_React_Header_CTAButtons(),
				'echo' => false,
				'container' => '',
				'items_wrap' => '%3$s', // See: wp_nav_menu codex for why. Returns empty string.
				'depth' => 1,
			]);
		} else {
			$cta_buttons = array();
		}

		// If there are no CTA buttons defined in the menu, the CTA walker explicitly returns a
		// serlizized empty array. Shouldn't be any need to further check is_serialized().
		$cta_buttons = maybe_unserialize($cta_buttons);

		// Parse domain name from site_url() function to include within Search prop.
		$searchDomain = parse_url( get_site_url(), PHP_URL_HOST );

		// Prep localized array items for wp_localize_script below.
		$localized_array = 	array(
			'loggedIn' => is_user_logged_in(),
			'loginLink' => site_url() . '/wp-admin',
			'logoutLink' => wp_logout_url(),
			'userName' => $current_user->user_login,
			'navTree' => $menu_items,
			'mobileNavTree' => $menu_items,
			'expandOnHover' => $expand_on_hover,
			'baseUrl' => site_url(),
			'logo' => false,
			'isPartner' => false,
			'title' => get_bloginfo(),
			'animateTitle' => $animate_title,
			'breakpoint' => $mobile_menu_breakpoint,
			'searchUrl' => 'https://search.asu.edu/search',
			'site' => $searchDomain,
		);

		// Passing an empty array to UDS Header component in the 'buttons' prop
		// produces a zero character where the buttons should be. Only passing the prop
		// if there is actually data to pass.
		if (! empty($cta_buttons)) {
			$localized_array['buttons'] = $cta_buttons;
		}

		/**
		 * TODO: Add support for logo and partner logo settings.
		 * Replace props for logo and partner with schema below.
		 *
		 * 	'logo' => $logo_override,
		 *  [
		 *      'alt' => 'alt text',        // default: 'Arizona State University'
		 *      'src' => '/wp-content/uploads/2022/11/US-Navy-logo.jpg',        // default: 'arizona-state-university-logo-vertical.png'
		 *      'mobileSrc' => '/wp-content/uploads/2022/11/US-Navy-logo.jpg',  // default: 'arizona-state-university-logo.png'
		 *      'brandLink' => 'https://asu.edu',  // default: 'https://asu.edu'
		 *  ],
		 *  'isPartner' => $show_partner_logo,
		 *  'partnerLogo' => $partner_logo,
		 **/

		// Add the parent org name and URL.
		// Don't pass the props unless both are present within the customzier.

		$parent_org_name = get_theme_mod( 'parent_unit_name' );
		$parent_org_link = get_theme_mod( 'parent_unit_link' );

		if ( (! empty( $parent_org_name ) ) && (! empty( $parent_org_link ) ) ) {
			$localized_array['parentOrg'] = $parent_org_name;
			$localized_array['parentOrgUrl'] = $parent_org_link;
		}

		// pass WordPress PHP variables to the uds-header-scripts script we enqueued above
		// These variables are props for the header React component
		wp_localize_script(
			'pitchfork-custom', // the handle of the script to pass our variables
			'udsHeaderVars', // object name to access our PHP variables from in our script
			$localized_array
		);
	}
}
