<?php
/**
 * Activate ASU favicons in the theme
 *
 * @package pitchfork
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Theme favicons header hook, provides links to the favicons from the UDS WordPress Theme
 */
function pitchfork_add_favicons_to_header() {
	?>
<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/apple-touch-icon-57x57.png" />
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/apple-touch-icon-114x114.png" />
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/apple-touch-icon-72x72.png" />
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/apple-touch-icon-144x144.png" />
<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/apple-touch-icon-60x60.png" />
<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/apple-touch-icon-120x120.png" />
<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/apple-touch-icon-76x76.png" />
<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/apple-touch-icon-152x152.png" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/favicon-196x196.png" sizes="196x196" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/favicon-96x96.png" sizes="96x96" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/favicon-32x32.png" sizes="32x32" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/favicon-16x16.png" sizes="16x16" />
<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/favicon-128.png" sizes="128x128" />
<meta name="application-name" content="<?php echo bloginfo( 'name' ); ?>"/>
<meta name="msapplication-TileColor" content="#FFFFFF" />
<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/mstile-144x144.png" />
<meta name="msapplication-square70x70logo" content="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/mstile-70x70.png" />
<meta name="msapplication-square150x150logo" content="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/mstile-150x150.png" />
<meta name="msapplication-wide310x150logo" content="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/mstile-310x150.png" />
<meta name="msapplication-square310x310logo" content="<?php echo get_template_directory_uri(); ?>/src/unity-bootstrap-theme/img/favicon/mstile-310x310.png" />

	<?php
}

add_action( 'wp_head', 'pitchfork_add_favicons_to_header' );


/**
 * Prevent iframing except when we are in the WordPress Admin interface.
 */
function pitchfork_prevent_iframes() {
	/*
	 * Verify the page is not being rendered in the customizer,
	 * which is a legitimate iframe for viewing the site
	 */
	if ( ! is_customize_preview() ) {
		// Prevent pages from being iframed.
		?>
		<style id="antiClickjack">
			body {
				display: none !important;
			}
		</style>
		<script type="text/javascript">
			if (self === top) {
				var antiClickjack = document.getElementById("antiClickjack");
				antiClickjack.parentNode.removeChild(antiClickjack);
			} else {
				top.location = self.location;
			}
		</script>
		<?php
	}
}
add_action( 'wp_head', 'pitchfork_prevent_iframes' );

/**
 * Prevent iframes by adding response header
 * This is a recommended primary layer of protection, with the anti-clickjack script
 * used as a reliable failback for legacy browsers.
 *
 * TODO: Review in future to replace X-Frame-Options header with
 * frame-ancestors directive (https://www.owasp.org/index.php/Clickjacking_Defense_Cheat_Sheet)
 */
function pitchfork_add_x_frame_options_header() {
	if ( ! is_customize_preview() ) {
		// Prevent pages from being iframed.
		header( 'X-Frame-Options: DENY' );
		// Add CSP frame ancestors for browsers that support this.
		header( "Content-Security-Policy: frame-ancestors 'none'" );
	}
}
add_action( 'send_headers', 'pitchfork_add_x_frame_options_header' );

/**
 * Remove oembed <link> tags from <head> so that LinkedIn previews will work
 */
remove_action( 'wp_head', 'wp_oembed_add_discovery_links' );

add_action( 'wp_head', 'pitchfork_mobile_web_app_meta' );
if ( ! function_exists( 'pitchfork_mobile_web_app_meta' ) ) {
	/**
	 * Add mobile-web-app meta.
	 */
	function pitchfork_mobile_web_app_meta() {
		echo '<meta name="mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-capable" content="yes">' . "\n";
		echo '<meta name="apple-mobile-web-app-title" content="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '">' . "\n";
	}
}
