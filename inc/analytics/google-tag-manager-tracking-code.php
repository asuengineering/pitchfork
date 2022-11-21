<?php
/**
 * Analytics Tracking Code for Google Tag Manager
 *
 * @package uds-wordpress-theme
 */

// Retrieve additional settings from ACF theme options page.
$site_gtm_container_id = '';
$site_gtm_container_id = get_field('pitchfork_options_gtm_container', 'option');

if ( $site_gtm_container_id && '' !== $site_gtm_container_id ) : ?>

	<!-- Google Tag Manager -->
	<script>
		(function(w, d, s, l, i) {
			w[l] = w[l] || [];
			w[l].push({
				'gtm.start': new Date().getTime(),
				event: 'gtm.js'
			});
			var f = d.getElementsByTagName(s)[0],
				j = d.createElement(s),
				dl = l != 'dataLayer' ? '&l=' + l : '';
			j.async = true;
			j.src =
				'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
			f.parentNode.insertBefore(j, f);
		})(window, document, 'script', 'dataLayer', '<?php echo esc_html( trim( $site_gtm_container_id ) ); ?>');
	</script>
	<!-- End Google Tag Manager -->
	<?php
	endif; ?>
