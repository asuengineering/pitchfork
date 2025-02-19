<?php
/**
 * Analytics Tracking Code for Microsoft Clarity
 *
 * @package pitchfork
 */

// Retrieve additional settings from ACF theme options page.
$clarity_site_id        = get_option('options_pitchfork_options_ms_clarity_site_id', 'option') ?? '';

if ( $clarity_site_id  && '' !== $clarity_site_id  ) : ?>
	<!-- MS Clarity tracking code -->
	<script type="text/javascript">
		(function(c,l,a,r,i,t,y){
			c[a]=c[a]||function(){(c[a].q=c[a].q||[]).push(arguments)};
			t=l.createElement(r);t.async=1;t.src="https://www.clarity.ms/tag/"+i;
			y=l.getElementsByTagName(r)[0];y.parentNode.insertBefore(t,y);
		})(window, document, "clarity", "script", "<?php echo wp_kses( $clarity_site_id, wp_kses_allowed_html( 'strip' ) ); ?>");
	</script>

	<?php
endif;
