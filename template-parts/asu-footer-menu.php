<?php
/**
 * The footer navigation menu
 *
 * @package uds-wordpress-theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$menu_name = 'footer';
$menu_items = uds_wp_get_menu_formatted_array( $menu_name );

if (! empty($menu_items)) {
	foreach ( $menu_items as $item ) :
		// A top-level menu item with children is formatted as a column with a header.
		if ( empty( $item['menu_item_parent'] ) && ! empty( $item['children'] ) ) :
			?>
			<div class="col-xl flex-footer">
				<div class="card accordion-item desktop-disable-xl">
					<div class="accordion-header">
						<h5>
							<a id="footlink-header-<?php echo sanitize_title( $item['title'] ); ?>" class="collapsed" data-bs-toggle="collapse" href="#footlink-<?php echo sanitize_title( $item['title'] ); ?>" role="button" aria-expanded="false" aria-controls="footlink-<?php echo sanitize_title( $item['title'] ); ?>">
								<?php echo $item['title']; ?>
								<span class="fas fa-chevron-up"></span>
							</a>
						</h5>
					</div>
					<div id="footlink-<?php echo sanitize_title( $item['title'] ); ?>" class="collapse accordion-body" aria-labelledby="footlink-header-<?php echo sanitize_title( $item['title'] ); ?>">
						<?php
						$footer_column = '';
						foreach ( $item['children'] as $child ) :
							$child['external_link'] = '';
							$is_target_blank    = $child['target_blank'];
							// Add external link icon if it has been requested. Using extra-small size here.
							$footer_link = '<a class="nav-link" href="%1$s" title="%2$s">%2$s%3$s</a>';
							$footer_external = get_post_meta( $child['ID'], 'menu_external_link', true );
							if ( $footer_external ) {
								if ( $is_target_blank ) {
									$is_target_blank = 'target=_blank';
								}
								$child['external_link'] .= '&nbsp;&nbsp;<i class="fas fa-external-link-alt fa-xs"></i>';
								$footer_link = '<a class="nav-link" href="%1$s" title="%2$s" rel="noreferrer noopener" ' . $is_target_blank . '>%2$s%3$s</a>';
							}
							$footer_column .= wp_kses( sprintf( $footer_link, $child['url'], $child['title'], $child['external_link'] ), wp_kses_allowed_html( 'post' ) );
						endforeach;
						echo $footer_column;
						?>
					</div>
				</div>
			</div>
			<?php
		endif;

	endforeach;
} else {
	// There are no menu items. Silence is golden.
}
