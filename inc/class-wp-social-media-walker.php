<?php
/*
 * Class Name: WP_Social_Media_Walker
 * Description: A custom WordPress nav walker class to implement social media links in the ASU Web Standards 2.0 footer.
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WP_Social_Media_Walker' ) ) {
	class WP_Social_Media_Walker extends Walker_Nav_Menu {

		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			$classes = empty( $item->classes ) ? [] : (array) $item->classes;

			$class_names = join(
				' ',
				apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item )
			);

			// keep your .nav-link intent; add any existing classes too
			$class_attr = ' class="' . esc_attr( trim( 'nav-link ' . $class_names ) ) . '"';

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
				$attributes .= ' href="' . esc_url( $item->url ) . '"';
			}

			// Title if you ever need it later
			$title = apply_filters( 'the_title', $item->title, $item->ID );

			/**
			 * ACF icon field may be array, string, or empty.
			 * Expecting array with ['value' => 'fa-...', 'label' => '...'].
			 */
			$icon_class = '';
			$icon_label = '';

			$icon = function_exists( 'get_field' ) ? get_field( 'menu_social_media_icon', $item->ID ) : null;

			if ( is_array( $icon ) ) {
				$fa_value = isset( $icon['value'] ) ? (string) $icon['value'] : '';
				$icon_label = isset( $icon['label'] ) ? (string) $icon['label'] : '';
			} elseif ( is_string( $icon ) ) {
				$fa_value = $icon;
			} else {
				$fa_value = '';
			}

			// Choose FA style prefix first
			if ( $fa_value === 'fa-square' ) {
				$icon_class = 'fas ' . $fa_value;
			} else {
				$icon_class = 'fab ' . $fa_value;
			}

			// Temporary fix for X (formerly Twitter) rebrand — check base value
			if ( $fa_value === 'fa-square-twitter' ) {
				$icon_class = 'fa-brands fa-square-x-twitter';
			}

			// Fallback label if ACF label missing
			if ( $icon_label === '' ) {
				$icon_label = $title ?: 'Social';
			}

			// Safely normalize $args->before / $args->after across object/array/null
			$before = '';
			$after  = '';
			if ( is_object( $args ) ) {
				$before = isset( $args->before ) ? (string) $args->before : '';
				$after  = isset( $args->after )  ? (string) $args->after  : '';
			} elseif ( is_array( $args ) ) {
				$before = isset( $args['before'] ) ? (string) $args['before'] : '';
				$after  = isset( $args['after'] )  ? (string) $args['after']  : '';
			}

			$item_output = $before
				. "<a id='menu-item-" . esc_attr( $item->ID ) . "'$class_attr$attributes>"
				. "<span title='" . esc_attr( $icon_label . ' Social Media Icon' ) . "' class='" . esc_attr( $icon_class ) . "'></span>"
				. '</a>'
				. $after;

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
