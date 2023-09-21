<?php
/**
 * Helper functions for building ASU Web Standards 2.0 menus.
 *
 * @package uds-wordpress-theme
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'uds_react_get_menu_formatted_array' ) ) {
	/**
	 * Load requested menu object and format into hierarchical array
	 * for the custom WP nav menu builders.
	 *
	 * @param string $menu_name Slug name of desired menu.
	 */
	function uds_react_get_menu_formatted_array( $menu_name ) {

		$mobile_menu_breakpoint = get_option('options_mobile_menu_breakpoint');

		$current_uri = null;

		// attempt to retrieve the current page's URL.
		if ( isset( $_SERVER['REQUEST_URI'] ) ) {
			$current_uri = sanitize_text_field( wp_unslash( $_SERVER['REQUEST_URI'] ) );
		}

		$subsite_base_folder = '';
		if ( get_theme_mod( 'subsite_base_folder' ) > '' ) {
			$subsite_base_folder = '/' . get_theme_mod( 'subsite_base_folder' );
		}

		$locations = get_nav_menu_locations();

		if ( isset( $locations[ $menu_name ] ) ) {

			$menu_object = wp_get_nav_menu_object( $locations[ $menu_name ] );

			/**
			 * UDS Header: Menu settings
			 * ACF options defined in options page located at options-general.php?page=pitchfork-settings
			 */
			$animate_title = get_option('options_animate_title');
			$expand_on_hover = get_option('options_expand_on_hover');
			$mobile_menu_breakpoint = get_option('options_mobile_menu_breakpoint');

			/**
			 * UDS Header: Logo settings
			 * Same options location as above. Both overrides are "opt-in" by design.
			 *
			 * Get each logo field. If checked, build formatted array, add to object - in enqueue, pull in from object
			 */
			if(get_option('options_asu_logo_override')) {
				$asu_logo_override_array =
				[
					'alt' => get_option('options_asu_logo_override_alt_text'),        // default: 'Arizona State University'
					'src' => get_option('options_asu_logo_override_url'),        // default: 'arizona-state-university-logo-vertical.png'
					'mobileSrc' => get_option('options_asu_logo_override_mobile_logo_url'),  // default: 'arizona-state-university-logo.png'
					'brandLink' => get_option('options_asu_logo_override_link'),  // default: 'https://asu.edu'
				];
			}
			$show_partner_logo = get_option('options_add_partner_logo');
			if(get_option('options_add_partner_logo')) {
				$add_partner_logo_array =
				[
					'alt' => get_option('options_partner_logo_alt_text'),        // default: 'Arizona State University'
					'src' => get_option('options_partner_logo_url'),        // default: 'arizona-state-university-logo-vertical.png'
					'mobileSrc' => get_option('options_partner_logo_mobile_url'),  // default: 'arizona-state-university-logo.png'
					'brandLink' => get_option('options_partner_logo_link'),  // default: 'https://asu.edu'
				];
			}

			$array_menu  = wp_get_nav_menu_items( $menu_object->term_id );

			// array_menu will return false if there are no menu options.
			if ( ! $array_menu ) {
				$array_menu = array();
			}

			/**
			 * Construct a preliminary menu array
			 */

			/**
			 * Step 1: Loop through ALL source menu items we retreived from WordPress,
			 * and add any that DO NOT HAVE a parent item. These would then be
			 * the top-level menu items. We call our menu holding array $menu.
			 */
			$pre_menu = array();
			$cta_buttons = array();

			foreach ( $array_menu as $m ) {
				if ( empty( $m->menu_item_parent ) ) {

					$pre_menu[ $m->ID ]                  = array();
					//CTA boolean from ACF. Buttons need cta_button=TRUE and type=button. Set in WP admin menu area
					$pre_menu[ $m->ID ]['cta_button']    = get_post_meta( $m->ID, 'menu_cta_button', true );
					$pre_menu[ $m->ID ]['text']          = $m->title;

					// If this is a CTA button, push it onto our top-level CTA button array.
					// Remove it from this array and skip any further processing of this item.
					if ( $pre_menu[ $m->ID ]['cta_button'] ) {
						//button color from WP admin menu builder - dropdown field
						$pre_menu[ $m->ID ]['cta_color'] = get_post_meta( $m->ID, 'menu_cta_button_color', true );
						$cta_target_link = get_post_meta( $m->ID, 'menu_target_blank', true );

						$temp_cta = array();
						$temp_cta['href']  = $m->url;
						$temp_cta['text']  = $pre_menu[ $m->ID]['text'];
						$temp_cta['color'] = $pre_menu[ $m->ID ]['cta_color'];
						if($cta_target_link){
							$temp_cta['target'] = '_blank';
						}
						array_push( $cta_buttons, $temp_cta ); // pushing all items. Could be fewer.
						unset( $pre_menu[ $m->ID ] );
					} else {
						$pre_menu[ $m->ID ]['ID']          = $m->ID;
						$pre_menu[ $m->ID ]['href']        = $m->url;
						$pre_menu[ $m->ID ]['has_current'] = false;
						$pre_menu[ $m->ID ]['parent']      = $m->menu_item_parent;
						$pre_menu[ $m->ID ]['items']       = array();
						$pre_menu[ $m->ID ]['cta-buttons']       = array();


						// The menu link can be relative or absolute.
						// Format menu link and remove absolute base url from link
						$prefix = get_home_url();
						$menu_url = rtrim( $m->url, '/' ) . '/';
						if ( 0 === strpos( $menu_url, $prefix ) ) {
								$menu_url = substr( $menu_url, strlen( $prefix ) );
						}
						$menu_url = $subsite_base_folder . $menu_url;

						if ( $current_uri === $menu_url ) {
							$pre_menu[ $m->ID ]['has_current'] = true;
						}
					}
				}

			}
			/**
			 * Step 2: Loop through ALL source menu items again. If an item has a parent, AND
			 * that parent is in the array we just made in step 1, it is a child item of
			 * a top-level menu item. We place that item's information as a new element in
			 * the $dropdown array.
			 *
			 * The item's information will have the id of the parent item as well.
			 */
			$dropdown = array();
			foreach ( $array_menu as $m ) {
				if ( ! empty( $m->menu_item_parent ) && array_key_exists( $m->menu_item_parent, $pre_menu ) ) {

					$dropdown[ $m->ID ]                = array();
					$dropdown[ $m->ID ]['ID']          = $m->ID;
					$dropdown[ $m->ID ]['type']        = get_post_meta( $m->ID, 'uds_menu_item_type', true );
					$dropdown[ $m->ID ]['text']        = $m->title;
					$dropdown[ $m->ID ]['href']        = $m->url;
					$dropdown[ $m->ID ]['has_current'] = false;
					$dropdown[ $m->ID ]['parent']      = $m->menu_item_parent;
					$dropdown[ $m->ID ]['items']       = array();
					$dropdown[ $m->ID ]['cta_button']  = get_post_meta( $m->ID, 'menu_cta_button', true );
					$dropdown[ $m->ID ]['cta_color']   = get_post_meta( $m->ID, 'menu_cta_button_color', true );

					// The menu link can be relative or absolute.
					// Format menu link and remove absolute base url from link
					$prefix = get_home_url();
					$menu_url = rtrim( $m->url, '/' ) . '/';
					if ( 0 === strpos( $menu_url, $prefix ) ) {
							$menu_url = substr( $menu_url, strlen( $prefix ) );
					}
					$menu_url = $subsite_base_folder . $menu_url;

					if ( $current_uri === $menu_url ) {
						$pre_menu[ $m->menu_item_parent ]['has_current'] = true;
					}

					/**
					 * Add the current child's data to the existing $pre_menu array under 'items',
					 * and then under this item's ID, for that parent ID
					 */
					if($dropdown[ $m->ID ]['type'] == 'button'){

						$pre_menu[ $m->menu_item_parent ]['cta-buttons'][ $m->ID ] = $dropdown[ $m->ID ];

					} else {
						$pre_menu[ $m->menu_item_parent ]['items'][ $m->ID ] = $dropdown[ $m->ID ];

					}



				}
			}

			/**
			 * Step 3: Loop through every source menu item a third time. If this item has a
			 * parent value, but that value IS NOT IN the top-level menu array, build an array
			 * of data for this menu item
			 */
			$column = array();
			$our_array_menu = array();
			foreach ( $array_menu as $m ) {
				if ( $m->menu_item_parent && ! array_key_exists( $m->menu_item_parent, $pre_menu ) ) {

					$column[ $m->ID ]                = array();
					$column[ $m->ID ]['ID']          = $m->ID;
					$column[ $m->ID ]['type']        = get_post_meta( $m->ID, 'uds_menu_item_type', true );
					$column[ $m->ID ]['cta_color'] 	 = get_post_meta( $m->ID, 'menu_cta_button_color', true );
					$column[ $m->ID ]['text']        = $m->title;
					$column[ $m->ID ]['href']        = $m->url;
					$column[ $m->ID ]['has_current'] = false;

					/**
					 * Add this item's data as a child to the $dropdown array we created in step 2.
					 * Place it under the parent, then under 'items', in a new array with ID of this item's ID.
					 */
					$dropdown[ $m->menu_item_parent ]['items'][ $m->ID ] = $column[ $m->ID ];

					/**
					 * Determine this item's top-menu item (grandparent) by getting the parent ID of this item's parent.
					 * Adding a check here to ensure that there is a parent array in the parent of this item for us to
					 * add anything to.
					 */
					if ( array_key_exists( 'parent', $dropdown[ $m->menu_item_parent ] ) ) {
						$top_menu = $dropdown[ $m->menu_item_parent ]['parent'];
			 /* At step 3, if menu items are still leftover, we have a column header above our menu items
			  *	column headers are not processed in previous steps, they are available items in $pre_menu, but filtered out
			  *	of $menu in step 2. column headers are children of the top menu, menu items are children of column headers
			  */
						$middle_menu = $dropdown[ $m->menu_item_parent ];

			 if( ! in_array([ $middle_menu->ID ]['ID'], $our_array_menu) ) {
			   $middle_menu_column = array();
			   $middle_menu_column[ $middle_menu->ID ]               = array();
			   $middle_menu_column[ $middle_menu->ID ]['ID']          = $middle_menu['ID'];
			   $middle_menu_column[ $middle_menu->ID ]['type']        = "heading";
			   $middle_menu_column[ $middle_menu->ID ]['text']        = $middle_menu['text'];
			   //$middle_menu_column[ $middle_menu->ID ]['href']        = "#";
			   $middle_menu_column[ $middle_menu->ID ]['has_current'] = false;

			   $pre_menu[ $top_menu ]['items'][ $m->menu_item_parent ]['items'][ $middle_menu->ID ] = $middle_menu_column[ $middle_menu->ID ];

			 }

						// The menu link can be relative or absolute.
						// Format menu link and remove absolute base url from link
						$prefix = get_home_url();
						$menu_url = rtrim( $m->url, '/' ) . '/';
						if ( 0 === strpos( $menu_url, $prefix ) ) {
								$menu_url = substr( $menu_url, strlen( $prefix ) );
						}
						$menu_url = $subsite_base_folder . $menu_url;

						if ( $current_uri === $menu_url ) {
							$pre_menu[ $top_menu ]['has_current'] = true;
						}

						$pre_menu[ $top_menu ]['items'][ $m->menu_item_parent ]['items'][ $m->ID ] = $column[ $m->ID ];
					}
				}
			}
			// The UDS nav menu requires that we re-format our menu.
			// We must reset the menu IDs from the array keys to sequential array keys, 0 to x.
			// And the items[] nested arrays must be wrapped in an additional array.
			$menu['nav-items'] = array();
			$menu['cta-buttons'] = $cta_buttons;
			$menu['logo-override'] = $asu_logo_override_array;
			$menu['show-partner-logo'] = $show_partner_logo;
			$menu['partner-logo'] = $add_partner_logo_array;
			$menu['animate-title'] = $animate_title;
			$menu['expand-on-hover'] = $expand_on_hover;
			$menu['mobile-menu-breakpoint'] = $mobile_menu_breakpoint;
			$menu['nav-items'][] = array(
				'href'     => $subsite_base_folder . '/',
				'text'     => 'Home',
				'selected' => false,
				'type'     => 'icon-home',
				'class'    => 'home',
			);

			if ( $current_uri === $subsite_base_folder . '/' ) {
				$menu['nav-items'][0]['selected'] = true;
			}
			foreach ( $pre_menu as $m1 ) {
				$items = array();
				$m1['buttons'] = array();

				if ( ! empty( $m1['items'] ) ) {
					if ( ! empty( $m1['cta-buttons'] ) ) {

						foreach ( $m1['cta-buttons'] as $level2_button ) {
							$temp = array(
								'text'     => $level2_button['text'],
								'href'     => $level2_button['href'],
								'selected' => $level2_button['has_current'],
								'color' => $level2_button['cta_color'],
								'type' => $level2_button['type'],

							);
							array_push($m1['buttons'], $temp);
						}
					}
					$items2 = array();
					foreach ( $m1['items'] as $m2 ) {

						$items3 = array();
						if ( ! empty( $m2['items'] ) ) {
							foreach ( $m2['items'] as $m3 ) {

			 //column headers are an inbetween array, need to detect when there is an array above and below
			 //then we know we have column headers, apply type=heading to format correctly into menu
			 //for each item in array, check for parents
			 //if parent has a parent, add type: "heading", so it will be in menu
			 //add to beginning of children array
								$temp = array(
									'text'     => $m3['text'],
									'href'     => $m3['href'],
									'selected' => $m3['has_current'],
								);
								if ( $m3['type'] ) {

									$temp['type']  = $m3['type'];
									$temp['color'] = $m3['cta_color'];

								}
								$items3[] = $temp;
							}
							$items[] = (array) $items3;

						} else {

							$items2[] = array(
								'text'     => $m2['text'],
								'href'     => $m2['href'],
								'selected' => $m2['has_current'],
								'type'     => $m2['type'],
								'color'    => $m2['cta_color'],
							);
						}
					}
					if ( ! empty( $items2 ) ) {
						$items[] = (array) $items2;
					}

					$menu['nav-items'][] = array(
						'text'     => $m1['text'],
						'href'     => $m1['href'],
						'selected' => $m1['has_current'],
						'items'    => $items,
						'buttons'  => $m1['buttons'],
					);

				} else {
					$menu['nav-items'][] = array(
						'text'     => $m1['text'],
						'href'     => $m1['href'],
						'selected' => $m1['has_current'],
					);
				}
			}

			return $menu;

		} else {
			return;
		}
	}
}

if ( ! function_exists( 'uds_wp_get_menu_array' ) ) {
	/**
	 * Load requested menu object and format into hierarchical array
	 * for the custom WP nav menu builders.
	 *
	 * @param string $menu_name Slug name of desired menu.
	 */
	function uds_wp_get_menu_formatted_array( $menu_name ) {

		$locations = get_nav_menu_locations();
		if ( isset( $locations[ $menu_name ] ) ) {
			$menu_object = wp_get_nav_menu_object( $locations[ $menu_name ] );
			$array_menu  = wp_get_nav_menu_items( $menu_object->term_id );

			// array_menu will return false if there are no menu options.
			if ( ! $array_menu ) {
				$array_menu = array();
			}

			/**
			 * Constructing a menu array
			 */

			/**
			 * Step 1: Loop through ALL source menu items we retreived from WordPress,
			 * and add any that DO NOT HAVE a parent item. These would then be
			 * the top-level menu items. We call our menu holding array $menu.
			 */
			$menu = array();
			foreach ( $array_menu as $m ) {
				if ( empty( $m->menu_item_parent ) ) {
					$menu[ $m->ID ]                  = array();
					$menu[ $m->ID ]['ID']            = $m->ID;
					$menu[ $m->ID ]['order']         = $m->menu_order;
					$menu[ $m->ID ]['title']         = $m->title;
					$menu[ $m->ID ]['url']           = $m->url;
					$menu[ $m->ID ]['cta_button']    = get_post_meta( $m->ID, 'menu_cta_button', true );
					$menu[ $m->ID ]['cta_color']     = get_post_meta( $m->ID, 'menu_cta_button_color', true );
					$menu[ $m->ID ]['external_link'] = get_post_meta( $m->ID, 'menu_external_link', true );
					$menu[ $m->ID ]['target_blank']  = get_post_meta( $m->ID, 'menu_target_blank', true );
					$menu[ $m->ID ]['parent']        = $m->menu_item_parent;
					$menu[ $m->ID ]['children']      = array();
				}
			}


			/**
			 * Step 2: Loop through ALL source menu items again. If an item has a parent, AND
			 * that parent is in the array we just made in step 1, it is a child item of
			 * a top-level menu item. We place that item's information as a new element in
			 * the $dropdown array.
			 *
			 * The item's information will have the id of the parent item as well.
			 */
			$dropdown = array();
			foreach ( $array_menu as $m ) {
				if ( ! empty( $m->menu_item_parent ) && array_key_exists( $m->menu_item_parent, $menu ) ) {
					$dropdown[ $m->ID ]                  = array();
					$dropdown[ $m->ID ]['ID']            = $m->ID;
					$dropdown[ $m->ID ]['order']         = $m->menu_order;
					$dropdown[ $m->ID ]['title']         = $m->title;
					$dropdown[ $m->ID ]['url']           = $m->url;
					$dropdown[ $m->ID ]['cta_button']    = get_post_meta( $m->ID, 'menu_cta_button', true );
					$dropdown[ $m->ID ]['cta_color']     = get_post_meta( $m->ID, 'menu_cta_button_color', true );
					$dropdown[ $m->ID ]['external_link'] = get_post_meta( $m->ID, 'menu_external_link', true );
					$dropdown[ $m->ID ]['target_blank']  = get_post_meta( $m->ID, 'menu_target_blank', true );
					$dropdown[ $m->ID ]['parent']        = $m->menu_item_parent;
					$dropdown[ $m->ID ]['children']      = array();

					/**
					 * Add the current child's data to the existing $menu array under 'children',
					 * and then under this item's ID, for that parent ID
					 */
					$menu[ $m->menu_item_parent ]['children'][ $m->ID ] = $dropdown[ $m->ID ];
				}
			}

			/**
			 * Step 3: Loop through every source menu item a third time. If this item has a
			 * parent value, but that value IS NOT IN the top-level menu array, build an array
			 * of data for this menu item
			 */
			$column = array();

			foreach ( $array_menu as $m ) {
				if ( $m->menu_item_parent && ! array_key_exists( $m->menu_item_parent, $menu ) ) {
					$column[ $m->ID ]                  = array();
					$column[ $m->ID ]['ID']            = $m->ID;
					$column[ $m->ID ]['order']         = $m->menu_order;
					$column[ $m->ID ]['title']         = $m->title;
					$column[ $m->ID ]['url']           = $m->url;
					$column[ $m->ID ]['cta_button']    = get_post_meta( $m->ID, 'menu_cta_button', true );
					$column[ $m->ID ]['cta_color']     = get_post_meta( $m->ID, 'menu_cta_button_color', true );
					$column[ $m->ID ]['external_link'] = get_post_meta( $m->ID, 'menu_external_link', true );
					$column[ $m->ID ]['target_blank']  = get_post_meta( $m->ID, 'menu_target_blank', true );

					/**
					 * Add this item's data as a child to the $dropdown array we created in step 2.
					 * Place it under the parent, then under 'children', in a new array with ID of this item's ID.
					 */
					$dropdown[ $m->menu_item_parent ]['children'][ $m->ID ] = $column[ $m->ID ];

					/**
					 * Determine this item's top-menu item (grandparent) by getting the parent ID of this item's parent.
					 * Adding a check here to ensure that there is a parent array in the parent of this item for us to
					 * add anything to.
					 */
					if ( array_key_exists( 'parent', $dropdown[ $m->menu_item_parent ] ) ) {
						$top_menu = $dropdown[ $m->menu_item_parent ]['parent'];
						$menu[ $top_menu ]['children'][ $m->menu_item_parent ]['children'][ $m->ID ] = $column[ $m->ID ];
					}
				}
			}
			return $menu;
		} else {
			return;
		}
	}
}

if ( ! function_exists( 'uds_wp_get_menu_depth' ) ) {
	/**
	 * Get the depth of this particular top-level item's hierarchy by inspecting
	 * the 'children' sub-array at each level to determine whether or not
	 * it is empty.
	 *
	 * While we are here, we also compare each child/grandchild's URL to see if
	 * it matches the URL of the currently displayed page, so we can highlight
	 * the top-level menu item.
	 *
	 * @param Array  $item  Array of top-level menu items.
	 * @param String $this_page  The URL of the current page.
	 *
	 * @return Array $item_info Array containing info on the menu item
	 *    $item_info = [
	 *        'depth' => (string) depth of menu: single,children, or grandchildren
	 *        'has_current' => (bool) does this top-level item contain the current page?
	 *        'title'=> (string) text of the menu item
	 *    ]
	 */
	function uds_wp_get_menu_depth( $item = null, $this_page = null ) {

		// create local variable for the current page URL.
		$current_page = $this_page;

		// prepare the array will return with default values.
		$item_info = array(
			'depth'       => 'single',
			'has_current' => false,
			'title'       => $item['title'],
		);

		if ( empty( $item ) ) {
			wp_die( 'Cannot find depth of a menu item that was not provided, or is empty.' );
		}

		// compare the top-level item's URL with the current page URL.
		if ( $current_page === $item['url'] ) {
			$item_info['has_current'] = true;
		}

		// if we have child items under this top-level item, evaluate them.
		if ( ! empty( $item['children'] ) ) {

			// we have at least children, since the array is not empty.
			$item_info['depth'] = 'children';

			/**
			 * We have children. See if any of them are the current page
			 * or if any of them have grandchildren
			 */
			foreach ( $item['children'] as $child ) {

				// If this child's URL is the current URL, update our array.
				if ( $current_page === $child['url'] ) {
					$item_info['has_current'] = true;
				}

				// check to see if this child item also has children.
				if ( ! empty( $child['children'] ) ) {

					// if the child-level item has children, we have grandchildren.
					$item_info['depth'] = 'grandchildren';

					// check each grandchild to see if it is the current page.
					foreach ( $child['children'] as $grandchild ) {
						if ( $current_page === $grandchild['url'] ) {
							$item_info['has_current'] = true;
						}
					}
				}
			}
		}
		return $item_info;
	}
}

if ( ! function_exists( 'uds_wp_render_column_links' ) ) {
	/**
	 * Renders the individual links from the provided child/grandchild list
	 *
	 * @param array $children The array of links for one column.
	 *
	 * @return string A string containing all the <a> tags for the column.
	 */
	function uds_wp_render_column_links( $children = array() ) {

		if ( empty( $children ) ) {
			return 'No Menu Links';
		}

		$links = '';

		foreach ( $children as $child ) {
			// check if menu item is a CTA Button.
			$is_cta_button    = $child['cta_button'];
			$cta_button_color = $child['cta_color'];

			// check to see if the external link icon has been requested.
			$is_external_link    = $child['external_link'];
			$is_target_blank    = $child['target_blank'];
			$external_link_text = '';

			if ( $is_cta_button ) {
				$links .= uds_wp_render_nav_cta_button( $cta_button_color, $child );
			} else {
				$link   = '<a class="dropdown-item" href="%1$s" title="%2$s">%2$s %3$s</a>';
				if ( $is_external_link ) {
					$external_link_text = '&nbsp;&nbsp;<i class="fas fa-external-link-alt fa-sm"></i>';
					if ( $is_target_blank ) {
						$is_target_blank = 'target=_blank';
					}
					$link   = '<a class="dropdown-item" href="%1$s" title="%2$s" rel="noreferrer noopener" ' . $is_target_blank . '>%2$s %3$s</a>';
				}
				$links .= wp_kses( sprintf( $link, $child['url'], $child['title'], $external_link_text ), wp_kses_allowed_html( 'post' ) );
			}
		}

		return $links;
	}
}

if ( ! function_exists( 'uds_wp_render_nav_item_link' ) ) {
	/**
	 * Renders the top-level link, either as a normal nav link or a drop-down link
	 * Note that we're using the 'default:' case to render our actual default, and
	 * not testing explicitly for the 'single' case of menu depth.
	 *
	 * @param string $menu_type The type of menu, used in the markup id and class names.
	 * @param array  $item      The navigation item whose link we want to render.
	 * @param array  $item_data Array of information about the current top-level nav link.
	 * @return string            The rendered navigation link
	 */
	function uds_wp_render_nav_item_link( $menu_type, $item, $item_data = NULL ) {
		$link = '';
		$is_cta_button    = $item['cta_button'];
		$cta_button_color = $item['cta_color'];

		if ( ! is_null( $item_data ) && true === $item_data['has_current'] ) {
			$active_classname = 'active';
		} else {
			$active_classname = '';
		}

		switch ( $item['depth'] ) {

			case 'children':
			case 'grandchildren':
				$template = '<a class="nav-link" href="%1$s" id="%2$s-one-col" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			%3$s
			<span class="fa fa-chevron-down"></span>
			</a>';
				$link     = wp_kses( sprintf( $template, $item['url'], $menu_type, $item['title'] ), wp_kses_allowed_html( 'post' ) );
				return $link;

			default:
				// Check for external link and new tab options from our ACF fields.
				$external_link_text = '';
				$new_tab_text = 'rel="noopener noreferer"';

				if ( true === $item['external_link'] ) {
					$external_link_text = '&nbsp;&nbsp;<i class="fas fa-external-link-alt fa-sm"></i>';
				}

				if ( true === $item['target_blank'] ) {
					$new_tab_text = 'rel="noopener noreferer"';
				}

				$template = '<a class="nav-link %1$s" %5$s href="%2$s" title="%3$s">%3$s%4$s</a>';
				$link     = wp_kses( sprintf( $template, $active_classname, $item['url'], $item['title'], $external_link_text, $new_tab_text ), wp_kses_allowed_html( 'post' ) );
				if ( $is_cta_button ) {
					$link = uds_wp_render_nav_cta_button( $cta_button_color, $item );

				}
				return $link;
		}
	}
}

if ( ! function_exists( 'uds_wp_render_nav_cta_button' ) ) {
	/**
	 * Renders menu link as a CTA button.
	 *
	 * @param string $cta_color The color slug, used in the markup id and class names.
	 * @param array  $item      The navigation item whose CTA button we want to render.
	 *
	 * @return string           The rendered button
	 */
	function uds_wp_render_nav_cta_button( $cta_color, $item ) {
		$button = '';

		$template = '<a href="%1$s" class="btn btn-sm btn-%2$s">%3$s</a>';
		$button   = wp_kses( sprintf( $template, $item['url'], $cta_color, $item['title'] ), wp_kses_allowed_html( 'post' ) );
		return $button;
	}
}
