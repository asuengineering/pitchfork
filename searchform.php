<?php

/**
 * Used any time that get_search_form() is called.
 *
 * @package Byvex
 */
$byvex_unique_id = wp_unique_id('search-');
?>

<form class="" method="get" action="<?php echo esc_url(home_url('/')); ?>">
	<label for="<?php echo esc_attr($byvex_unique_id); ?>" class="form-label mb-0">Enter your search term</label>
	<div class="d-flex">
		<input type="search" name="s" placeholder="..." id="<?php echo esc_attr($byvex_unique_id); ?>" class="form-control mb-2 me-1" />
		<input type="submit" value="<?php echo esc_attr_x('Search', 'submit button', 'byvex'); ?>" class="btn btn-primary mb-2" />
	</div>
</form>
