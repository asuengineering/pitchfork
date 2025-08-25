<?php
/**
 * Pitchfork Unity Header, Nav Walker, NavTree (prop)
 * Extends native Nav Walker.
 *
 * Returns a serialized array to be included in the navTree and mobileNavTree
 * props for the ASU React Header.
 *
 * @package Pitchfork
 */

if ( ! class_exists( 'Pitchfork_React_Header_Navtree' ) ) {

	class Pitchfork_React_Header_Navtree extends Walker_Nav_Menu {

		public function start_lvl( &$output, $depth = 0, $args = null ) {
			$output .= '';
		}

		public function end_lvl( &$output, $depth = 0, $args = null ) {
			$output .= '';
		}

		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

			// Unserialize concatenated $output string as array; seed with Home on first run.
			if ( empty( $output ) ) {
				$start_navTree        = new stdClass();
				$start_navTree->href  = get_home_url();
				$start_navTree->text  = 'Home';
				$start_navTree->type  = 'icon-home';
				if ( is_front_page() ) {
					$start_navTree->selected = true;
				}
				$prop = [ $start_navTree ];
			} else {
				$tmp  = maybe_unserialize( $output );
				$prop = is_array( $tmp ) ? $tmp : [];
			}

			// Bail early if $item isn't a menu item object (extra hardening).
			if ( ! is_object( $item ) ) {
				$output = maybe_serialize( $prop );
				return;
			}

			// Normalize $args.has_children (WP sets it directly on $args).
			$has_children = false;
			if ( is_object( $args ) && property_exists( $args, 'has_children' ) ) {
				$has_children = (bool) $args->has_children;
			} elseif ( is_array( $args ) && isset( $args['has_children'] ) ) {
				$has_children = (bool) $args['has_children'];
			}

			// Gather per-item meta (works w/o ACF).
			$isCTA    = (bool) get_post_meta( $item->ID, 'menu_cta_button', true );
			$btnColor = get_post_meta( $item->ID, 'menu_cta_button_color', true );
			$exIcon   = (bool) get_post_meta( $item->ID, 'menu_external_link', true );

			// Create entry object.
			$entry           = new stdClass();
			$entry->id       = isset( $item->ID ) ? $item->ID : 0;
			$entry->href     = isset( $item->url ) ? $item->url : '';
			$entry->text     = isset( $item->title ) ? $item->title : '';
			$entry->target   = isset( $item->target ) ? $item->target : '';
			$entry->title    = isset( $item->attr_title ) ? $item->attr_title : '';
			$entry->exIcon   = $exIcon;

			/**
			 * Depth handling:
			 * 0: top level (skip if CTA; add items[] if has children; mark selected)
			 * 1: second level (heading if has children; else link; CTA -> type=button)
			 * 2: third level (CTA -> type=button; else link; push under last column)
			 */

			if ( $depth === 0 ) {

				// Top-level CTAs are handled by a separate walker; skip them here.
				if ( $isCTA ) {
					$output = maybe_serialize( $prop );
					return;
				}

				// Prepare child container for dropdown/mega menus.
				if ( $has_children ) {
					$entry->items = [];
				}

				// Mark selected if current or ancestor.
				if ( ! empty( $item->current ) || ! empty( $item->current_item_ancestor ) ) {
					$entry->selected = true;
				}

				$prop[] = $entry;

			} elseif ( $depth === 1 ) {

				$parentKey = array_key_last( $prop );

				// Ensure we have a valid parent object to attach to.
				if ( $parentKey === null || ! isset( $prop[ $parentKey ] ) || ! is_object( $prop[ $parentKey ] ) ) {
					$output = maybe_serialize( $prop );
					return;
				}

				// Ensure ->items exists and is an array on the parent.
				if ( ! isset( $prop[ $parentKey ]->items ) || ! is_array( $prop[ $parentKey ]->items ) ) {
					$prop[ $parentKey ]->items = [];
				}

				// CTA at depth 1 -> treat as a column footer button.
				if ( $isCTA ) {
					$entry->type = 'button';
				}

				if ( $has_children ) {
					// Column header in a mega/dropdown column.
					$entry->type = 'heading';
					$entry       = [ $entry ]; // wrap header as first element of a column
					$prop[ $parentKey ]->items[] = $entry; // new column
				} else {
					// First link in a single-col dropdown still needs a column wrapper.
					if ( empty( $prop[ $parentKey ]->items ) ) {
						$entry = [ $entry ];
						$prop[ $parentKey ]->items[] = $entry;
					} else {
						// Push into first column.
						$prop[ $parentKey ]->items[0][] = $entry;
					}
				}

			} elseif ( $depth === 2 ) {

				// Column footer button?
				if ( $isCTA ) {
					$entry->type = 'button';
				}

				$grandparentKey = array_key_last( $prop );
				if ( $grandparentKey === null || ! isset( $prop[ $grandparentKey ] ) || ! is_object( $prop[ $grandparentKey ] ) ) {
					$output = maybe_serialize( $prop );
					return;
				}

				// Ensure items array exists and has at least one column.
				if ( ! isset( $prop[ $grandparentKey ]->items ) || ! is_array( $prop[ $grandparentKey ]->items ) ) {
					$prop[ $grandparentKey ]->items = [];
				}
				if ( empty( $prop[ $grandparentKey ]->items ) ) {
					$prop[ $grandparentKey ]->items[] = [];
				}

				$parentItems    = $prop[ $grandparentKey ]->items;
				$parentItemsKey = array_key_last( $parentItems );
				if ( $parentItemsKey === null ) {
					$prop[ $grandparentKey ]->items[] = [];
					$parentItemsKey = 0;
				}

				$prop[ $grandparentKey ]->items[ $parentItemsKey ][] = $entry;

			} else {
				// Depth > 2: ignore.
			}

			// Re-serialize for next iteration.
			$output = maybe_serialize( $prop );
		}

		public function end_el( &$output, $item, $depth = 0, $args = null ) {
			$output .= '';
		}
	}
}
