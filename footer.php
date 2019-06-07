<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after
 *
 * @package understrap
 */

$container = get_theme_mod( 'understrap_container_type' );
?>



<?php if ( is_active_sidebar('footer-branded') || is_active_sidebar('footer-flex') ) : ?>
	
	<!-- ******************* The ASU Super Footer Area ******************* -->
	<div class="wrapper" id="wrapper-super-footer">
		<div class="<?php echo esc_attr( $container ); ?>" id="footer-full-content" tabindex="-1">
			<div class="row">

				<?php 
					if ( is_active_sidebar( 'footer-branded' ) ) :
						echo '<div id="footer-branded-area" class="col-md-4">';
						dynamic_sidebar( 'footer-branded' );
						echo '</div>';
					endif;

					if ( is_active_sidebar( 'footer-flex' ) ) :
						dynamic_sidebar( 'footer-flex' );
					endif;
				?>

			</div>
		</div><!-- end #footer-full-content -->
	</div><!-- end #wrapper-super-footer -->

<?php endif; ?>

<div class="wrapper" id="wrapper-asu-footer">

	<?php asuwp_load_global_footer(); ?>

</div><!-- wrapper end -->

</div><!-- #page we need this extra closing tag here -->

<?php wp_footer(); ?>

</body>

</html>