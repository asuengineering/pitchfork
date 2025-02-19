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

$site_gtm_container_id = get_option('options_pitchfork_options_gtm_container');
$site_ga_tracking_id   = get_option('options_pitchfork_options_ga_tracking');
$hotjar_site_id        = get_option('options_pitchfork_options_hotjar_site_id');
$clarity_site_id       = get_option('options_pitchfork_options_ms_clarity_site_id');


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

	// ASU Hub analytics.
	if ( 'enabled' === $asu_hub_analytics ) {
		include get_template_directory() . '/inc/analytics/asu-hub-analytics-tracking-code.php';
	}

	// Site Google Tag Manager.
	if ( ! empty( $site_gtm_container_id ) ) {
		include get_template_directory() . '/inc/analytics/google-tag-manager-tracking-code.php';
	}

	// Site Google Aanalytics.
	if ( ! empty( $site_ga_tracking_id ) ) {
		include get_template_directory() . '/inc/analytics/google-analytics-tracking-code.php';
	}

	// Hotjar analytics.
	if ( ! empty( $hotjar_site_id ) ) {
		include get_template_directory() . '/inc/analytics/hotjar-tracking-code.php';
	}

	// Microsoft Clarity analytics
	if ( ! empty( $clarity_site_id ) ) {
		include get_template_directory() . '/inc/analytics/clarity-tracking-code.php';
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

	<div id="header-container"></div>

	<?php
	// Needs to be included after the <main> on a per page basis.
	// do_action( 'pitchfork_after_global_header' );
	?>
