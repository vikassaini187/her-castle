<?php
/**
 * Provides the 'Resources' view for the corresponding tab in the Shortcode Meta Box.
 *
 * @since 2.0
 *
 * @package    testimonial-free
 */
?>

<div id="sp-tfree-tab-3" class="sp-tfree-mbf-tab-content">
	<?php
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_section_title',
		'name'    => __( 'Section Title', 'testimonial-free' ),
		'desc'    => __( 'Show/Hide the shortcode title as testimonial section title e.g. What Our Customers Saying.', 'testimonial-free' ),
		'default' => 'off',
	) );
	$this->metaboxform->color( array(
		'id'      => 'tfree_section_title_color',
		'type'    => 'color',
		'name'    => __( 'Section Title Color', 'testimonial-free' ),
		'desc'    => __( 'Set section title color.', 'testimonial-free' ),
		'default' => '#444444'
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_testimonial_title',
		'name'    => __( 'Testimonial Title', 'testimonial-free' ),
		'desc'    => __( 'Check to show testimonial title or tagline.', 'testimonial-free' ),
		'default' => 'on'
	) );
	$this->metaboxform->color( array(
		'id'      => 'tfree_testimonial_title_color',
		'type'    => 'color',
		'name'    => __( 'Testimonial Title Color', 'testimonial-free' ),
		'desc'    => __( 'Set testimonial title or tagline color.', 'testimonial-free' ),
		'default' => '#333333'
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_testimonial_content',
		'name'    => __( 'Testimonial Content', 'testimonial-free' ),
		'desc'    => __( 'Check to show testimonial content.', 'testimonial-free' ),
		'default' => 'on'
	) );
	$this->metaboxform->color( array(
		'id'      => 'tfree_testimonial_content_color',
		'type'    => 'color',
		'name'    => __( 'Testimonial Content Color', 'testimonial-free' ),
		'desc'    => __( 'Set testimonial content color.', 'testimonial-free' ),
		'default' => '#333333'
	) );
	$this->metaboxform->subheading( array(
		'id'      => 'subheading',
		'name'    => __( 'Reviewer Information Settings', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_reviewer_name',
		'name'    => __( 'Name', 'testimonial-free' ),
		'desc'    => __( 'Show/Hide reviewer name.', 'testimonial-free' ),
		'default' => 'on'
	) );
	$this->metaboxform->color( array(
		'id'      => 'tfree_reviewer_name_color',
		'type'    => 'color',
		'name'    => __( 'Name Color', 'testimonial-free' ),
		'desc'    => __( 'Set reviewer name color.', 'testimonial-free' ),
		'default' => '#333333'
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_star_rating',
		'name'    => __( 'Star Rating', 'testimonial-free' ),
		'desc'    => __( 'Show/Hide star ratings.', 'testimonial-free' ),
		'default' => 'on'
	) );
	$this->metaboxform->color( array(
		'id'      => 'tfree_star_rating_color',
		'type'    => 'color',
		'name'    => __( 'Star Rating Color', 'testimonial-free' ),
		'desc'    => __( 'Set color for star rating.', 'testimonial-free' ),
		'default' => '#f3bb00'
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_position',
		'name'    => __( 'Identity or Position', 'testimonial-free' ),
		'desc'    => __( 'Show/Hide identity or position.', 'testimonial-free' ),
		'default' => 'on'
	) );
	$this->metaboxform->color( array(
		'id'      => 'tfree_position_color',
		'type'    => 'color',
		'name'    => __( 'Identity or Position Color', 'testimonial-free' ),
		'desc'    => __( 'Set color for identity or position.', 'testimonial-free' ),
		'default' => '#444444'
	) );

	?>
</div>