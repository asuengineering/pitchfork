<?php
/**
 * Used any time that get_search_form() is called.
 *
 * @package pitchfork
 */

$pitchfork_unique_id = wp_unique_id( 'search-' );

?>

<form class="uds-form" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $pitchfork_unique_id ); ?>" class="form-label">Enter your search term</label>
	<div class="d-flex">
		<input type="search" name="s" id="<?php echo esc_attr( $pitchfork_unique_id ); ?>" class="form-control me-4" />
		<input type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'pitchfork' ); ?>" class="btn btn-maroon btn-md" />
	</div>
</form>
