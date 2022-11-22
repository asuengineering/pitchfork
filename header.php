<?php
/**
 * The header for our theme
 *
 * Displays all of the <head> section and everything up till <main>
 *
 * @package pitchfork
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Retrieve settings from the theme mods entry in the options database table.
$c_options = array();
$c_options = get_theme_mods();

// Is navigation menu enabled?
$nav_menu_enabled = '';
if ( ! empty( $c_options['header_navigation_menu'] ) ) {
	$nav_menu_enabled = $c_options['header_navigation_menu'];
}

// Retrieve additional settings from ACF theme options page.
$site_gtm_container_id = '';
$site_ga_tracking_id   = '';
$hotjar_site_id        = '';

$site_gtm_container_id = get_field('pitchfork_options_gtm_container', 'option');
$site_ga_tracking_id   = get_field('pitchfork_options_ga_tracking', 'option');
$hotjar_site_id        = get_field('pitchfork_options_hotjar_site_id', 'option');


// Set ASU analytics option to enabled/disabled based on the URL for the site.
// Check of the active domain name. Enable as long as is within asu.edu
$siteurl = get_site_url();
$asu_hub_analytics = 'enabled';
if ( strpos ( $siteurl, 'asu.edu') === false ) {
	$asu_hub_analytics = 'disabled';
}
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php wp_head(); ?>

	<?php

	// ASU Hub Analytics.
	if ( 'enabled' === $asu_hub_analytics ) {
		include get_template_directory() . '/inc/analytics/asu-hub-analytics-tracking-code.php';
	}

	// Site Google Tag Manager.
	if ( ! empty( $site_gtm_container_id ) ) {
		include get_template_directory() . '/inc/analytics/google-tag-manager-tracking-code.php';
	}

	// Site Google Analytics.
	if ( ! empty( $site_ga_tracking_id ) ) {
		include get_template_directory() . '/inc/analytics/google-analytics-tracking-code.php';
	}

	// Hotjar Analytics.
	if ( ! empty( $hotjar_site_id ) ) {
		include get_template_directory() . '/inc/analytics/hotjar-tracking-code.php';
	}
	?>

</head>

<body <?php body_class(); ?> <?php pitchfork_body_attributes(); ?> id="back_to_top">

	<?php
	do_action( 'wp_body_open' );

	// Site Google Tag Manager (noscript).
	if ( ! empty( $site_gtm_container_id ) ) {
		include get_template_directory() . '/inc/analytics/google-tag-manager-noscript-code.php';
	}
	?>

	<header id="asu-header" class="fixed-top">
		<div id="wrapper-header-top">
			<div class="container-xl">
				<div class="row">
					<div id="header-top" class="col-12">
						<nav class="nav" aria-label="Top">
							<a class="nav-link sr-only sr-only-focusable" href="#skip-to-content">Skip to Content</a>
							<a class="nav-link sr-only sr-only-focusable" href="https://asu.edu/accessibility/feedback?a11yref=unity-design-system">Report an accessibility problem</a>
							<a class="nav-link" href="https://asu.edu" data-ga-header-section="topbar" data-ga-header="asu home">ASU Home</a>
							<a class="nav-link" href="https://my.asu.edu" data-ga-header-section="topbar" data-ga-header="my asu">My ASU</a>
							<a class="nav-link" href="https://asu.edu/about/colleges-and-schools" data-ga-header-section="topbar" data-ga-header="colleges and schools">Colleges and Schools</a>
							<div class="nav-link login-status">
								<a class="signin" href="https://my.asu.edu" data-ga-header-section="topbar" data-ga-header="sign in">Sign In</a>
							</div>
							<form class="form-inline" action="https://search.asu.edu/search" method="get" name="gs">
								<input class="form-control" type="search" name="q" aria-labelledby="header-top-search" required data-ga-input-header-event="search">
								<label id="header-top-search">Search ASU</label>
								<input name="site" value="default_collection" type="hidden">
								<input name="sort" value="date:D:L:d1" type="hidden">
								<input name="output" value="xml_no_dtd" type="hidden">
								<input name="ie" value="UTF-8" type="hidden">
								<input name="oe" value="UTF-8" type="hidden">
								<input name="client" value="asu_frontend" type="hidden">
								<input name="proxystylesheet" value="asu_frontend" type="hidden">
							</form>
						</nav>
					</div>
				</div>
			</div>
		</div>

		<div id="wrapper-header-main">
			<div class="container-xl">
				<div class="row">
					<div id="header-main" class="col-12">
						<div class="navbar navbar-expand-xl">

							<a class="navbar-brand" href="https://www.asu.edu" data-ga-header="asu logo">
								<img class="vert" src="<?php echo get_template_directory_uri(); ?>/src/img/asu-unity/asu-logo/asu-university-vert-maroongold.png" alt="Arizona State University" />
								<img class="horiz" src="<?php echo get_template_directory_uri(); ?>/src/img/asu-unity/asu-logo/asu-university-horiz-maroongold.png" alt="Arizona State University" />
							</a>

							<button class="navbar-toggler collapsed" type="button" data-toggle="collapse" data-target="#menubar" aria-controls="menubar" aria-expanded="false" aria-label="Toggle navigation" data-ga-header-event="collapse" data-ga-header-type="click" data-ga-header="menu button label">
								<span title="Open mobile menu" class="fa fa-bars"></span>
								<span title="Close mobile menu" class="fa-stack">
									<i class="fa fa-circle fa-stack-2x"></i>
									<i class="fa fa-times fa-stack-1x"></i>
								</span>
							</button>

							<?php
							// <div class="navbar-container"> +/- a "no-link" class.
							uds_wp_render_navbar_container();
							?>

								<?php
								// <div class="title"> +/- a utility class.
								uds_wp_render_title_wrapper();
								?>

									<?php uds_wp_render_parent_unit_name(); ?>
									<?php uds_wp_render_subdomain_name(); ?>

								</div><!-- .end .title -->

								<div class="collapse navbar-collapse w-100 justify-content-between" id="menubar">

									<div class="header-content-container">
										<?php uds_wp_render_main_nav_menu(); ?>
									</div>

									<div class="navbar-mobile-footer pinned">
										<form class="form-inline navbar-mobile-search" action="https://search.asu.edu/search" method="get" name="gs">
											<input class="form-control" type="search" name="q" aria-label="Search" placeholder="Search ASU">
											<input name="site" value="default_collection" type="hidden">
											<input name="sort" value="date:D:L:d1" type="hidden">
											<input name="output" value="xml_no_dtd" type="hidden">
											<input name="ie" value="UTF-8" type="hidden">
											<input name="oe" value="UTF-8" type="hidden">
											<input name="client" value="asu_frontend" type="hidden">
											<input name="proxystylesheet" value="asu_frontend" type="hidden">
										</form>
										<div class="nav-grid">
											<a class="nav-link" href="https://asu.edu" data-ga-header-section="topbar" data-ga-header="asu home">ASU Home</a>
											<a class="nav-link" href="https://my.asu.edu" data-ga-header-section="topbar" data-ga-header="my asu">My ASU</a>
											<a class="nav-link" href="https://asu.edu/about/colleges-and-schools" data-ga-header-section="topbar" data-ga-header="colleges and schools">Colleges and Schools</a>
											<div class="nav-link login-status">
												<a class="signin" href="https://my.asu.edu" data-ga-header-section="topbar" data-ga-header="sign in">Sign In</a>
											</div>
										</div>
									</div>
								</div>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

	</header>

	<?php do_action( 'uds_wp_after_global_header' ); ?>
