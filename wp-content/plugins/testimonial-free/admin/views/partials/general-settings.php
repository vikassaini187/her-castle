<?php
/**
 * Provides the 'Resources' view for the corresponding tab in the Shortcode Meta Box.
 *
 * @since 2.0
 *
 * @package    testimonial-free
 */
?>

<div id="sp-tfree-tab-1" class="sp-tfree-mbf-tab-content nav-tab-active">

	<?php
	$this->metaboxform->select_layout( array(
		'id'      => 'tfree_slider_layout',
		'name'    => __( 'Layout', 'testimonial-free' ),
		'desc'    => __( 'Select a layout to display the testimonials.', 'testimonial-free' ),
		'default' => 'slider',
	) );
	$this->metaboxform->select( array(
		'id'      => 'tfree_themes',
		'name'    => __( 'Select Theme', 'testimonial-free' ),
		'desc'    => __( 'Select which theme you want to display.', 'testimonial-free' ),
		'options' => array(
			'theme-one' => __( 'Theme One', 'testimonial-free' ),
		),
		'default' => 'theme-one',
	) );
	$this->metaboxform->select_testimonials_from( array(
		'id'      => 'tfree_testimonials_from',
		'name'    => __( 'Display Testimonials from', 'testimonial-free' ),
		'desc'    => __( 'Select an option to display the testimonials.', 'testimonial-free' ),
		'default' => 'latest',
	) );
	$this->metaboxform->number( array(
		'id'      => 'tfree_number_of_total_testimonials',
		'name'    => __( 'Total Testimonials', 'testimonial-free' ),
		'desc'    => __( 'Number of total testimonials to display.', 'testimonial-free' ),
		'default' => 10,
	) );
	$this->metaboxform->number( array(
		'id'      => 'tfree_number_of_column',
		'name'    => __( 'Testimonial Column(s)', 'testimonial-free' ),
		'desc'    => __( 'Set number of column(s) for the screen larger than 1280px.', 'testimonial-free' ),
		'default' => 1,
	) );
	$this->metaboxform->number( array(
		'id'      => 'tfree_number_of_column_desktop',
		'name'    => __( 'Testimonial Column(s) on Desktop', 'testimonial-free' ),
		'desc'    => __( 'Set number of column on desktop for the screen smaller than 1280px.', 'testimonial-free' ),
		'default' => 1,
	) );
	$this->metaboxform->number( array(
		'id'      => 'tfree_number_of_column_small_desktop',
		'name'    => __( 'Testimonial Column(s) on Small Desktop', 'testimonial-free' ),
		'desc'    => __( 'Set number of column on small desktop for the screen smaller than 980px.', 'testimonial-free' ),
		'default' => 1,
	) );
	$this->metaboxform->number( array(
		'id'      => 'tfree_number_of_column_tablet',
		'name'    => __( 'Testimonial Column(s) on Tablet', 'testimonial-free' ),
		'desc'    => __( 'Set number of column on tablet for the screen smaller than 736px.', 'testimonial-free' ),
		'default' => 1,
	) );
	$this->metaboxform->number( array(
		'id'      => 'tfree_number_of_column_mobile',
		'name'    => __( 'Testimonial Column(s) on Mobile', 'testimonial-free' ),
		'desc'    => __( 'Set number of column on mobile for the screen smaller than 480px.', 'testimonial-free' ),
		'default' => 1,
	) );
	$this->metaboxform->select( array(
		'id'      => 'tfree_order_by',
		'name'    => __( 'Order By', 'testimonial-free' ),
		'desc'    => __( 'Select an order by option.', 'testimonial-free' ),
		'options' => array(
			'ID'    => __( 'ID', 'testimonial-free' ),
			'date'     => __( 'Date', 'testimonial-free' ),
			'title'    => __( 'Title', 'testimonial-free' ),
			'modified' => __( 'Modified', 'testimonial-free' ),
		),
		'default' => 'date',
	) );
	$this->metaboxform->select( array(
		'id'      => 'tfree_order',
		'name'    => __( 'Order', 'testimonial-free' ),
		'desc'    => __( 'Select an order option.', 'testimonial-free' ),
		'options' => array(
			'ASC'  => __( 'Ascending', 'testimonial-free' ),
			'DESC' => __( 'Descending', 'testimonial-free' ),
		),
		'default' => 'DESC',
	) );

	?>
</div>
