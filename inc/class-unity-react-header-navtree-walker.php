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

			// Unserialize contatenated $output string as array.
			// If this is the first object, it'll be empty. Set it up with default structure.

			if ( empty($output)) {
				$start_navTree = new stdClass();
				$start_navTree->href = get_home_url();
				$start_navTree->text = 'Home';
				$start_navTree->type = 'icon-home';

				// There is not normally a menu item associated with the home page, but the
				// home icon can still be underlined if we are on the home page.
				// Use is_front_page() and assign selected class to home icon if true.

				if (is_front_page()) {
					$start_navTree->selected = true;
				}

				$prop = [ $start_navTree ];

			} else {

                $tmp_prop  = maybe_unserialize( $output );
				$prop = is_array( $tmp_prop ) ? $tmp_prop : [];

			}

            // Bail early if $item isn't a menu item object (extra hardening).
			if ( ! is_object( $item ) ) {
				$output = maybe_serialize( $prop );
				return;
			}

			// Gather ACF properties from the menu item. Works without ACF active.
			$isCTA    = (bool) get_post_meta( $item->ID, 'menu_cta_button', true );
			$btnColor = get_post_meta( $item->ID, 'menu_cta_button_color', true );
			$exIcon   = (bool) get_post_meta( $item->ID, 'menu_external_link', true );

			// Create $entry object from $item data. Prep to insert into the correct place.
			$entry           = new stdClass();
			$entry->id       = isset( $item->ID ) ? $item->ID : 0;
			$entry->href     = isset( $item->url ) ? $item->url : '';
			$entry->text     = isset( $item->title ) ? $item->title : '';
			$entry->target   = isset( $item->target ) ? $item->target : '';
			$entry->title    = isset( $item->attr_title ) ? $item->attr_title : '';
			$entry->exIcon   = $exIcon;

			/**
			 * Depth 0: First level
			 * - If CTA button = true, skip. Create additional walker to output separate prop.
			 * - If has children, create empty items property (array, array) to receive addtl links.
			 *
			 * Depth 1: Second level
			 * - If has children, treat as a type:headline. It's a column header.
			 * - If no children, check if CTA. IF true, treat as mega menu CTA. (The odd one.)
			 * - If no children and no CTA, treat as link in dropdown or mega menu column.
			 * - Find menu item parent and place in the correct place.
			 *
			 * Depth 2: Third level
			 * - Check if CTA. If true, it's a CTA that ends a column in a mega menu. type=button.
			 * - If not, treat as link in mega menu column.
			 * - In either case, push back into ->items of grandparent.
			 *
			 * Depth > 2: Invalid. Ignore the entry.
			 */
			if ( $depth == 0 ) {

                // Top-level CTAs are handled by a separate walker; skip them here.
				if ( $isCTA ) {
					$output = maybe_serialize( $prop );
					return;
				}

				// Check for the presence of children. Add array wrapper for future depth.
				if ( $args->walker->has_children ) {
					$entry->items = [];
				}

				// Add active menu class if $item is the current menu item or is the current item's ancestor.
				if ( ! empty( $item->current ) || ! empty( $item->current_item_ancestor ) ) {
					$entry->selected = true;
				}

				// All good. Push this to the main array.
				$prop[] = $entry;

			} else if ( $depth == 1 ) {

				$parentKey = array_key_last($prop);

				/**
				 * This is either a CTA at the bottom of a 1col dropdown or the oddball CTA
				 * at the bottom of the mega menu. Mechanically, the oddball will have at least
				 * three additional sibling links (mega menu, not a dropdown) and all of those siblings
				 * should have children. (Siblings are col heads, children are links.)
				 *
				 * For now, leave mega menu CTA button option unsupported. Render all level 2 CTA buttons
				 * as column "footer" buttons instead.
				 */

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

				/**
				 * Checking "has children" second. Will override the CTA button choice above if
				 * user made a mistake and wanted a CTA button that should be a col header instead.
				 *
				 * If it has direct children, this entry needs to be column header.
				 */
				if ( $args->walker->has_children ) {
					// Set the type.
					$entry->type = 'heading';

					// Also, we'll need to wrap this in another empty array.
					// The children will be pushed into this array later in the script.
					$entry = [ $entry ];

					// Put it where it belongs.
					// array_key_last will provide the last array key for $prop.
					// Should work since we're building this in sequence.
					$prop[$parentKey]->items[] = $entry;

				} else {

					// Even if this isn't a heading (has children = false)
					// we may still need that extra array. If this is the first item
					// in a single col dropdown, we still need it.
					// Otherwise, push $entry into array created by this $items previous sibling.

					if ( empty($prop[$parentKey]->items)) {
						$entry = [ $entry ];
						$prop[$parentKey]->items[] = $entry;
					} else {
						$prop[$parentKey]->items[0][] = $entry;
					}

				}

			} else if ( $depth == 2 ) {

				// Check for column footer button presence.
				if ( $isCTA ) {
					$entry->type = 'button';
				}

				// Find the grandparent last key, and the parent->items last index key.
				$grandparentKey = array_key_last($prop);

                // Ensure we have a valid grandparent object to attach to.
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

				$parentItems = $prop[$grandparentKey]->items;
				$parentItemsKey = array_key_last($parentItems);

                // Final check against data corruption
                if ( $parentItemsKey === null ) {
					$prop[ $grandparentKey ]->items[] = [];
					$parentItemsKey = 0;
				}

				// Push $entry into correct place.
				$prop[$grandparentKey]->items[$parentItemsKey][] = $entry;

			} else {
				// Depth > 2: ignore.
			}

			// Convert $prop back to a string so it can be passed to the next iteration of start_el.
			$output = maybe_serialize($prop);

        }

		public function end_el( &$output, $item, $depth = 0, $args = null ) {
			$output .= '';
		}
    }
}
