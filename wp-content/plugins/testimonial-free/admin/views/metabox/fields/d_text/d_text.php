<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: D-Text
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class SP_TPRO_Framework_Option_d_text extends SP_TPRO_Framework_Options {

	public function __construct( $field, $value = '', $unique = '' ) {
		parent::__construct( $field, $value, $unique );
	}

	public function output(){

		echo $this->element_before();
		echo '<input disabled type="text" />';
		echo $this->element_after();

	}

}