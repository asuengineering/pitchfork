<?php
/**
 * Additional functions for Advanced Custom Fields.
 *
 * Contents:
 *   - Define and explicit load path for ACF groups from this theme.
 *   - (This can be overridden if a child theme also has an /acf-json folder.)
 *   - Define save points for ACF field definitions for the theme.
 *
 * @package pitchfork-blocks
 */

/**
 * Explicitly define /acf-json as load point using get_template_directory.
 *
 * @param  mixed $paths // path to ACF load point.
 * @return $paths
 */
function pitchfork_acf_json_load_point( $paths ) {
	$paths[] = get_template_directory_uri()  . '/acf-json';
	return $paths;
}
add_filter( 'acf/settings/load_json', 'pitchfork_acf_json_load_point' );


/**
 * Create a save point for specifc JSON files for the the theme's ACF groups.
 *
 * Key list
 * - UDS: Header – Logo settings - group_63780a409ecb6
 * - UDS: Header – Menu settings - group_637677713cbf6
 * - UDS: Header – Menu Item Options - group_5f3345f93ac4c
 * - UDS: Menu Social Icons - group_616de0a0c3714
 * - UDS: Options – Multisite - group_637bbc0f999d3
 * - UDS: Options – Analytics - group_637bcbd96a775
 *
 * @return $paths
 */
function pitchfork_field_groups( $path ) {
    $path = get_template_directory_uri()  . '/acf-json';
    return $path;
}
add_filter( 'acf/settings/save_json/key=group_63780a409ecb6', 'pitchfork_field_groups' );
add_filter( 'acf/settings/save_json/key=group_637677713cbf6', 'pitchfork_field_groups' );
add_filter( 'acf/settings/save_json/key=group_5f3345f93ac4c', 'pitchfork_field_groups' );
add_filter( 'acf/settings/save_json/key=group_616de0a0c3714', 'pitchfork_field_groups' );
add_filter( 'acf/settings/save_json/key=group_637bbc0f999d3', 'pitchfork_field_groups' );
add_filter( 'acf/settings/save_json/key=group_637bcbd96a775', 'pitchfork_field_groups' );

