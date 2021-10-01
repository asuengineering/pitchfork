<?php

/**
 * Preload & Preconnect External Resources
 *
 * @package Byvex
 */

function byvex_preload($hints, $relation_type)
{
	if ('preconnect' === $relation_type) {

		// Google fonts CDN
		$hints[] = [
			'href'        => 'https://fonts.googleapis.com',
		];
		$hints[] = [
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		];
	}
	return $hints;
}

add_filter('wp_resource_hints', 'byvex_preload', 10, 2);
