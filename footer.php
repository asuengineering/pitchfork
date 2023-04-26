<?php
/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after.
 *
 * @package pitchfork
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;
?>

<footer id="asu-footer">

	<div class="wrapper" id="wrapper-endorsed-footer">
		<?php uds_wp_render_footer_branding_row(); ?>
	</div> <!-- wrapper-endorsed-footer -->

	<?php do_action( 'uds_wp_before_global_footer_columns' ); ?>

	<div class="wrapper" id="wrapper-footer-columns">
		<?php uds_wp_render_footer_action_row(); ?>
	</div>

</footer>

<div id="asu-react-footer"></div>

<div id="cookie-consent-container"></div>

<?php wp_footer(); ?>

</body>

</html>

