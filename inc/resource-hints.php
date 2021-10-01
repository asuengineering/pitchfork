<?php

/**
 * Preload & Preconnect External Resources
 *
 * @package pitchfork
 */

function pitchfork_preload( $hints, $relation_type ) {
	if ( 'preconnect' === $relation_type ) {

		// Google fonts CDN
		$hints[] = array(
			'href'        => 'https://fonts.googleapis.com',
		);
		$hints[] = array(
			'href'        => 'https://fonts.gstatic.com',
			'crossorigin' => 'anonymous',
		);
	}
	return $hints;
}

add_filter( 'wp_resource_hints', 'pitchfork_preload', 10, 2 );
