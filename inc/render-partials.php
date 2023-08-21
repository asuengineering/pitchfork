<?php
/**
 * Template Rendering Functions
 *
 * @package uds-wordpress-theme
 * @author KE Web Services
 *
 * In order to implement selective refresh in the customizer (see the link
 * below), some display logic has been moved out of our templates and into
 * functions here. The customizer can then call these methods via AJAX to
 * refresh just the parts of the page that are affected by the setting
 * being adjusted.
 *
 * (https://developer.wordpress.org/themes/customize-api/tools-for-improved-user-experience/#selective-refresh-fast-accurate-updates)
 */

/**
 * Returns the blog name in the header (which we call the subdomain name).
 * We are Using this function to avoid errors/warnings from PHPCS about the
 * use of anonymous functions in 'customizer-settings.php'.
 */
function uds_wp_render_blogname() {
	return get_bloginfo( 'name' );
}

/**
 * Render site title wrapper div
 *
 * The wrapper div for the site title should either be <div class="title">
 * or <div class="title subdomain-name"> depending on the presence or absence of the parent title info.
 */
function uds_wp_render_title_wrapper() {
	$parent_unit_name = get_theme_mod( 'parent_unit_name' );

	if ( empty( $parent_unit_name ) ) {
		echo '<div class="title subdomain-name">';
	} else {
		echo '<div class="title">';
	}
}

/**
 * Render parent unit name and link
 *
 * Takes the unit name and link settings and renders a link tag.
 */
function uds_wp_render_parent_unit_name() {
	$parent_unit_name = get_theme_mod( 'parent_unit_name' );
	$parent_unit_link = get_theme_mod( 'parent_unit_link' );

	if ( ! empty( $parent_unit_name ) ) {
		// If there is a unit name, do we need a link as well?
		if ( ! empty( $parent_unit_link ) ) {
			$parent_string = '<a class="unit-name" href="' . $parent_unit_link . '" data-ga-header="Parent unit name">' . $parent_unit_name . '</a>';
		} else {
			// There is no link entered but we want to still produce the unit name.
			// The following option is undocumented within UDS-Boostrap, but it works.
			$parent_string = '<span class="unit-name">' . $parent_unit_name . '</span>';
		}
	} else {
		// There is no parent name defined. Return empty.
		$parent_string = '';
	}

	echo $parent_string;
}

/**
 * Render site name
 *
 * Renders the default blog name setting in a span.
 */
function uds_wp_render_subdomain_name() {

	$parent_unit_name = get_theme_mod( 'parent_unit_name' );
	$sitename_is_linked = get_theme_mod( 'sitename_as_link' );
	$site_display_name = get_theme_mod( 'site_display_name' );
	$site_name = get_bloginfo( 'name' );

	// Determine the site name to display.
	if( ! empty( trim( $site_display_name ) ) ) {
		// An alternate 'display' title has been provided.
		$site_name = $site_display_name;
	}

	$title_string = '';
	$title_link = '<a href="' . get_bloginfo( 'url' ) . '" class="subdomain-link" data-ga-header="Subdomain name">' . $site_name . '</a>';

	// If a link is indicated, include the markup. Otherwise, just the site name.
	if ( $sitename_is_linked ) {
		$title_string .= $title_link;
	} else {
		$title_string .= $site_name;
	}

	if ( ! empty( $parent_unit_name ) ) {
		// There's a parent, so we need to add a span wrapper.
		$title_string = '<span class="subdomain-name">' . $title_string . '</span>';
	}

	echo $title_string;
}

/**
 * Add no-link css class .navbar-container, if needed.
 *
 * Considers the value of the header_navigation_menu theme mod and determines
 * whether or not to add the no-link css class to .navbar-container
 */
function uds_wp_render_navbar_container() {
	$nav_menu_enabled = get_theme_mod( 'header_navigation_menu' );
	$navbar_container = '<div class="navbar-container ';

	if ( 'disabled' === $nav_menu_enabled ) {
		$navbar_container .= 'no-links';
	}

	$navbar_container .= '">';

	echo $navbar_container;
}

/**
 * Render main navigation menu
 *
 * Takes the value of the header_navigation_menu theme mod and determines
 * whether or not to draw the main navigation menu.
 */
function uds_wp_render_main_nav_menu() {
	// We need access to the $wp object. Standard warning about using 'global'!
	global $wp;

	// get our setting and initialize some variables.
	$nav_menu_enabled = get_theme_mod( 'header_navigation_menu' );
	$current_url = add_query_arg( $wp->query_string, '', home_url( $wp->request ) );
	$we_are_on_the_homepage = ( home_url() === $current_url );
	$home_icon_class = 'nav-link-home';

	$multisite_enhance = false;
	$multisite_enhance = get_field('pitchfork_options_enhanced_multisite', 'option');

	// if nav menu is enabled, render it.
	if ( 'enabled' === $nav_menu_enabled ) { ?>

		<nav class="navbar-nav" aria-label="Main">

		<?php
		// draw the home icon, and set it active if we are on the home page.
		if ( $we_are_on_the_homepage ) {
			$home_icon_class .= ' active';
		}
		?>

		<?php
			// Determine which URL to use for the Home icon.
			$home_url = home_url();
			$home_title = get_bloginfo( 'name' ) . ' home';

			// Modify home URL & title if multisite enhancements are enabled.
			if ( (is_multisite() ) && ( $multisite_enhance ) ) {

				// Values are options created by ACF. Use either get_field or get_option to retrieve.
				$alt_home_url   = trim( get_field( 'pitchfork_options_home_icon_link', 'option' ) );
				$alt_home_title = trim( get_field( 'pitchfork_options_home_icon_tooltip', 'option' ) );

				// If the option has a value, attempt to use it.
				if ( ! empty( $alt_home_url ) ) {
					$home_url = $alt_home_url;
				}

				if ( ! empty( $alt_home_title ) ) {
					$home_title = $alt_home_title;
				}
			}
		?>

		<a class="nav-link <?php echo $home_icon_class; ?>" href="<?php echo esc_url( $home_url ); ?>" data-ga-header="home button">
			<span class="d-xl-none">Home</span>
			<span title="<?php echo $home_title; ?>" class="fas fa-fw fa-home"></span>
		</a>


		<?php
		// Multisite enhancements check. Do we want to use the "main site" menu?
		$multisite_enhance_nav = false;
		$multisite_enhance_nav = get_field('pitchfork_options_root_nav', 'option');
		if( (is_multisite()) && ( $multisite_enhance ) && ( $multisite_enhance_nav ) ) {
			// Switch our database context to the 'main' blog of our multisite.
			switch_to_blog( get_main_site_id() );
		}

		// Render the menu items.
		include get_template_directory() . '/template-parts/asu-navigation-menu.php';
		?>

		</nav>
		<form class="navbar-site-buttons form-inline">
			<?php
			if ( isset( $cta_menu_btns ) && ! empty( $cta_menu_btns ) ) {
				foreach ( $cta_menu_btns as $cta_menu_btn ) {
					echo $cta_menu_btn;
				}
			}
			?>
		</form>
		<?php
	}

	/**
	 * Because we may have switched blog IDs earlier, switch back to the current
	 * blog, just in case.
	 */
	if( is_multisite() && ms_is_switched() ) {
		restore_current_blog();
	}
}

/**
 * Render Footer Logo
 *
 * Takes the selected endorsed logo, and the value of the logo_url setting,
 * to determine what to render in the logo area of the footer. Selecting a
 * logo takes preference over a logo URL.
 */
function uds_wp_render_footer_logo() {
	$logo_type = get_theme_mod( 'footer_logo_type' );
	$logo_select = get_theme_mod( 'logo_select' );
	$logo_url = get_theme_mod( 'logo_url' );
    $logo_link = get_theme_mod( 'footer_logo_link' )? get_theme_mod( 'footer_logo_link' ):home_url( '/' );
	$logo_template = '<a href="%3$s"><img src="%1$s" alt="%2$s" /></a>';

	if ( $logo_type && 'asu' === $logo_type ) {
		// Footer logo type is set to 'asu'. Use ASU logo and link to asu.edu!
		uds_wp_render_asu_footer_logo();
	} else {

		// First, check for Preset Logo Selection.
		if ( $logo_select && 'none' !== $logo_select ) {

			// load array of endorsed units.
			$endorsed_logos = uds_wp_theme_get_endorsed_unit_logos();

			// lookup logo filename.
			$filename = '';
			foreach ( $endorsed_logos as $unit ) {
				if ( $unit['slug'] === $logo_select ) {
					$filename = $unit['filename'];
					break;
				}
			}

			echo wp_kses(
				sprintf(
					$logo_template,
					get_template_directory_uri() . '/src/endorsed-logos/' . $filename,
					get_bloginfo( 'name' ) . ' Logo',
					$logo_link
				),
				wp_kses_allowed_html( 'post' )
			);

			// Else, check for Logo URL.
		} elseif ( $logo_url && '' !== $logo_url ) {
			echo wp_kses(
				sprintf(
					$logo_template,
					$logo_url,
					get_bloginfo( 'name' ) . ' Logo',
					home_url( '/' )
				),
				wp_kses_allowed_html( 'post' )
			);
		} else {
			// No preset logo chosen, and no logo URL provided.
			// Fall back to using the ASU logo.
			uds_wp_render_asu_footer_logo();
		}
	}
}

if ( ! function_exists( 'uds_wp_render_contribute_button' ) ) {
	/**
	 * Render the 'Contribute' button
	 *
	 * Takes the contribute_url setting and coditionally renders the button.
	 */
	function uds_wp_render_contribute_button() {
		$contribute_url = get_theme_mod( 'contribute_url' );
		$contribute_text = get_theme_mod( 'contribute_text' ) ? get_theme_mod( 'contribute_text' ) : 'Contribute';
		$contribute_template = '<p class="contribute-button"><a href="%1$s" type="button" class="btn btn-gold">%2$s</a></p>';

		// Do we have a contribute?
		if ( $contribute_url && '' !== $contribute_url ) {
			echo wp_kses( sprintf( $contribute_template, $contribute_url, $contribute_text ), wp_kses_allowed_html( 'post' ) );
		}
	}
}
/**
 * Render Footer branding row (logo and social media icons together)
 *
 * Determines whether or not we render the logo+social row of the footer.
 * When this is set to 'disabled' we skip generating the markup altogether,
 * meaning that individual settings for logo or social icons are ignored.
 */
function uds_wp_render_footer_branding_row() {
	$row_status = get_theme_mod( 'footer_row_branding' );

	$multisite_enhance = false;
	$multisite_enhance = get_field('pitchfork_options_enhanced_multisite', 'option');

	$multisite_enhance_social = false;
	$multisite_enhance_social = get_field('pitchfork_options_root_social', 'option');

	if ( 'enabled' === $row_status ) {
		?>
		<div class="container" id="endorsed-footer">
			<div class="row">

				<div class="col-md" id="endorsed-logo">
					<?php uds_wp_render_footer_logo(); ?>
				</div>

				<div class="col-md" id="social-media">
					<div class="social-media-wrapper">
						<?php

							// Enhanced multisite check. Do we want to use the "root" social media menu?
							if( (is_multisite()) && ( $multisite_enhance ) && ( $multisite_enhance_social ) ) {
								// Switch our database context to the 'main' blog of our multisite.
								switch_to_blog( get_main_site_id() );
							}

							if ( has_nav_menu( 'social-media' ) ) {
								wp_nav_menu(
									array(
										'theme_location'  => 'social-media',
										// 'container' => 'div',
										// 'container_class' => 'col-md',
										// 'container_id' => 'social-media',
										'menu_class'  => '',
										'items_wrap' => '<nav aria-label="Social Media" class="nav">%3$s</nav>',
										'walker' => new WP_Social_Media_Walker(),
									)
								);
							}

							/**
							 * Because we may have switched blog IDs earlier, switch back to the current
							 * blog, just in case.
							 */
							if( is_multisite() && ms_is_switched() ) {
								restore_current_blog();
							}
						?>
					</div>
				</div>
			</div> <!-- row -->
		</div> <!-- endorsed-footer -->
		<?php
	}
}

/**
 * Render 'Contact Us' link in the footer
 *
 * Takes the value of the 'contact_url' setting and, if it is not empty,
 * renders a link with that value as the URL.
 */
function uds_wp_render_contact_link() {
	$contact_url = get_theme_mod( 'contact_url' );
	$contact_template = '<p class="contact-link"><a href="%1$s">Contact Us</a></p>';

	if ( $contact_url && '' !== $contact_url ) {
		echo wp_kses( sprintf( $contact_template, $contact_url ), wp_kses_allowed_html( 'post' ) );
	}
}


/**
 * Render the info+menu links row in the footer
 *
 * Determines whether or not we render the info+menu row of the footer.
 * When this is set to 'disabled' we skip generating the markup altogether,
 * meaning that individual settings for contact, contribute, and the menu
 * items are ignored altogether.
 */
function uds_wp_render_footer_action_row() {
	$action_row_status = get_theme_mod( 'footer_row_actions' );

	$multisite_enhance = false;
	$multisite_enhance = get_field('pitchfork_options_enhanced_multisite', 'option');

	$multisite_enhance_footer = false;
	$multisite_enhance_footer = get_field('pitchfork_options_root_footer', 'option');

	// Enhanced multisite check. Do we want to use the "root" footer links menu?
	if( (is_multisite()) && ( $multisite_enhance ) && ( $multisite_enhance_footer ) ) {
		// Switch our database context to the 'main' blog of our multisite.
		switch_to_blog( get_main_site_id() );
	}

	if ( 'enabled' === $action_row_status ) {
		?>
		<nav aria-label="Footer">
			<div class="container" id="footer-columns">
				<div class="row">

					<div class="col-xl-3" id="info-column">
						<h5><span class="footer-site-name" id="footer-unit-text"><?php uds_wp_render_footer_unit_name(); ?></span></h5>
						<div class="contact-wrapper">
							<?php uds_wp_render_contact_link(); ?>
						</div>

						<div class="contribute-wrapper">
							<?php uds_wp_render_contribute_button(); ?>
						</div>
					</div>
					<?php include get_template_directory() . '/template-parts/asu-footer-menu.php'; ?>
				</div> <!-- row -->
			</div> <!-- footer-columns -->
		</nav>
		<?php
	}

	/**
	 * Because we may have switched blog IDs earlier, switch back to the current
	 * blog, just in case.
	 */
	if( is_multisite() && ms_is_switched() ) {
		restore_current_blog();
	}

}

/**
 * Renders the ASU logo for the footer.
 */
function uds_wp_render_asu_footer_logo() {
	$logo_template = '<a href="%3$s"><img src="%1$s" alt="%2$s" /></a>';

	echo wp_kses(
		sprintf(
			$logo_template,
			get_template_directory_uri() . '/src/unity-bootstrap-theme/img/asu-logo/asu-university-horiz-white.png',
			get_bloginfo( 'name' ) . ' Logo',
			'https://asu.edu'
		),
		wp_kses_allowed_html( 'post' )
	);
}

/**
 * Renders text below the footer logo: either the site name, or some custom text.
 */
function uds_wp_render_footer_unit_name() {
	$footer_unit_name_type = get_theme_mod( 'footer_unit_name_type' );

	if ( 'custom' === $footer_unit_name_type ) {
		$footer_unit_name_text = get_theme_mod( 'footer_unit_name_text' );
		echo $footer_unit_name_text;
	} else {
		echo get_bloginfo( 'name' );
	}
}
