<?php

/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Byvex
 */

// Add a pingback url auto-discovery header for single posts, pages, or attachments
function byvex_pingback_header()
{
	if (is_singular() && pings_open()) {
		echo '<link rel="pingback" href="', esc_url(get_bloginfo('pingback_url')), '">';
	}
}
add_action('wp_head', 'byvex_pingback_header');
