<?php
/**
 * WP Bootstrap Navwalker
 *
 * @package WP-Bootstrap-Navwalker
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/*
 * Class Name: WP_Social_Media_Walker
 * Description: A custom WordPress nav walker class to implement social media links in the ASU Web Standards 2.0 footer.
 */

/* Check if Class Exists. */
if ( ! class_exists( 'WP_Social_Media_Walker' ) ) {
	/**
	 * WP_Social_Media_Walker class.
	 *
	 * @extends Walker_Nav_Menu
	 */
	class WP_Social_Media_Walker extends Walker_Nav_Menu {

		/**
		 * Starts the element output.
		 *
		 * @since WP 3.0.0
		 * @since WP 4.4.0 The {@see 'nav_menu_item_args'} filter was added.
		 *
		 * @see Walker_Nav_Menu::start_el()
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param WP_Post  $item   Menu item data object.
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 * @param int      $id     Current item ID.
		 */
		public function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$classes     = empty( $item->classes ) ? array() : (array) $item->classes;

			$class_names = join(
				' ',
				apply_filters(
					'nav_menu_css_class',
					array_filter( $classes ),
					$item
				)
			);

			if ( ! empty( $class_names ) ) {
				$class_names = ' class="nav-link"';
			}

			$attributes  = '';

			if ( ! empty( $item->description ) ) {
				$attributes .= ' title="' . esc_attr( $item->description ) . '"';
			}
			if ( ! empty( $item->target ) ) {
				$attributes .= ' target="' . esc_attr( $item->target ) . '"';
			}
			if ( ! empty( $item->xfn ) ) {
				$attributes .= ' rel="' . esc_attr( $item->xfn ) . '"';
			}
			if ( ! empty( $item->url ) ) {
				$attributes .= ' href="' . esc_attr( $item->url ) . '"';
			}

			$output .= '';

			$title = apply_filters( 'the_title', $item->title, $item->ID );

			/**
			 * Get ACF dropdown setting for FA icon.
			 * Configured to return an array with both the label and the value.
			 * Value of selection from ACF = icon class name from Font Awesome.
			 * The label of the ACF field = part of the ARIA label for the icon.
			 */
			$icon_class = '';
			$icon_label = '';
			$icon = get_field( 'menu_social_media_icon', $item->ID );

			if (is_array ($icon)) {
				$icon_class = $icon['value'];
				$icon_label = $icon['label'];
			}

			if ('fa-square' == $icon_class) {
				$icon_class = 'fas ' . $icon_class;
			} else {
				$icon_class = 'fab ' . $icon_class;
			}

			// Temporary fix for X (formerly Twitter) icon rebranding
			if ('fa-square-twitter' == $icon_class) {
				$icon_class = 'fa-brands fa-square-x-twitter';
			}

			$item_output = $args->before
				. "<a id='menu-item-$item->ID' $class_names $attributes ><span title='$icon_label Social Media Icon' class='$icon_class'>"
				. '</span></a> '
				. $args->after;

			$output .= apply_filters(
				'walker_nav_menu_start_el',
				$item_output,
				$item,
				$depth,
				$args
			);
		}
	}
}
