<?php if ( ! defined( 'ABSPATH' ) ) { die; } // Cannot access pages directly.
/**
 *
 * Field: Rating
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
class SP_TPRO_Framework_Option_rating extends SP_TPRO_Framework_Options {

  public function __construct( $field, $value = '', $unique = '' ) {
    parent::__construct( $field, $value, $unique );
  }

  public function output(){

    echo $this->element_before();

    if( isset( $this->field['options'] ) ) {

      $options = $this->field['options'];
      $options = ( is_array( $options ) ) ? $options : array_filter( $this->element_data( $options ) );

      if( ! empty( $options ) ) {

        echo '<div'. $this->element_class('sp-tpro-client-rating') .'>';
        foreach ( $options as $key => $value ) {
          echo '<input type="radio" name="'. $this->element_name() .'" id="'. $key .'" value="'. $key .'"'. $this->element_attributes( $key ) . $this->checked( $this->element_value(), $key ) .'/><label for="'. $key .'" title="'. $value .'"><i class="fa fa-star"></i></label>';
        }
        echo '</div>';
      }

    } else {
      $label = ( isset( $this->field['label'] ) ) ? $this->field['label'] : '';
      echo '<label><input type="radio" name="'. $this->element_name() .'" value="1"'. $this->element_class() . $this->element_attributes() . checked( $this->element_value(), 1, false ) .'/> '. $label .'</label>';
    }

    echo $this->element_after();

  }

}