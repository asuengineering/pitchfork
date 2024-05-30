<?php
/**
 * Extending class for a unique ID field.
 * Based on work done here, available via composer.
 * - https://github.com/philipnewcomer/ACF-Unique-ID-Field/blob/master/src/ACF_Field_Unique_ID.php
 *
 * 01-Sept-2023: ACF class doesn't have an outside repository just yet.
 */
namespace ASUEngineering\ACF_Unique_ID_Field;

use acf_field;

class ACF_Field_Unique_ID extends acf_field {

	/**
	 * Initialize the class.
	 */
	public static function init() {
		add_action(
			'acf/include_field_types',
			function() {
				if ( ! class_exists( 'acf_field' ) ) {
					return;
				}

				new static();
			}
		);
	}

	/**
	 * Initialize the field.
	 */
	public function __construct() {
		$this->name     = 'unique_id';
		$this->label    = 'Unique ID';
		$this->category = 'basic';

		parent::__construct();
	}

	/**
	 * Render the HTML field.
	 * In the original render statement the field was readonly. It's editable here.
	 *
	 * @param array $field The field data.
	 */
	public function render_field( $field ) {
		printf(
			'<input type="text" name="%s" value="%s">',
			esc_attr( $field['name'] ),
			esc_attr( $field['value'] )
		);
	}

	/**
	 * Define the unique ID if one does not already exist.
	 *
	 * @param string $value   The field value.
	 * @param int    $post_id The post ID.
	 * @param array  $field   The field data.
	 *
	 * @return string The filtered value.
	 */
	public function update_value( $value, $post_id, $field ) {

		if ( ! empty( $value ) ) {
			return $value;
		}

		return uniqid();
	}
}
