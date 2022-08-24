<?php
/**
 * Provides the 'Resources' view for the corresponding tab in the Shortcode Meta Box.
 *
 * @since 2.0
 *
 * @package    testimonial-free
 */
?>

<div id="sp-tfree-tab-2" class="sp-tfree-mbf-tab-content">
	<?php
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_auto_play',
		'name'    => __( 'AutoPlay', 'testimonial-free' ),
		'desc'    => __( 'Check to on autoplay.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->number( array(
		'id'      => 'tfree_auto_play_speed',
		'name'    => __( 'AutoPlay Speed', 'testimonial-free' ),
		'desc'    => __( 'Set autoplay speed.', 'testimonial-free' ),
		'after'   => __( '(Millisecond)', 'testimonial-free' ),
		'default' => 3000,
	) );
	$this->metaboxform->number( array(
		'id'      => 'tfree_scroll_speed',
		'name'    => __( 'Pagination Speed', 'testimonial-free' ),
		'desc'    => __( 'Set pagination/slide scroll speed.', 'testimonial-free' ),
		'after'   => __( '(Millisecond).', 'testimonial-free' ),
		'default' => 600,
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_pause_on_hover',
		'name'    => __( 'Pause on Hover', 'testimonial-free' ),
		'desc'    => __( 'Check to activate slider pause on hover.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_infinite_loop',
		'name'    => __( 'Infinite Loop', 'testimonial-free' ),
		'desc'    => __( 'Check to activate infinite loop mode.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->subheading( array(
		'id'      => 'subheading',
		'name'    => __( 'Navigation Settings', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_navigation',
		'name'    => __( 'Navigation', 'testimonial-free' ),
		'desc'    => __( 'Show/Hide slider navigation.', 'testimonial-free' ),
		'default' => 'on',
	) );

	$this->metaboxform->navigation_style( array(
		'id'      => 'tfree_nav_style',
		'name'    => __( 'Choose a Style', 'testimonial-free' ),
		'desc'    => __( 'Choose a slider navigation style.', 'testimonial-free' ),
	) );
	$this->metaboxform->color( array(
		'id'      => 'tfree_nav_arrow_color',
		'type'    => 'color',
		'name'    => __( 'Arrow Color', 'testimonial-free' ),
		'desc'    => __( 'Set the navigation arrow color.', 'testimonial-free' ),
		'default' => '#444444',
	) );
	$this->metaboxform->color( array(
		'id'      => 'tfree_nav_arrow_hover',
		'type'    => 'color',
		'name'    => __( 'Arrow Hover Color', 'testimonial-free' ),
		'desc'    => __( 'Set the navigation arrow hover color.', 'testimonial-free' ),
		'default' => '#52b3d9',
	) );

	$this->metaboxform->subheading( array(
		'id'      => 'subheading',
		'name'    => __( 'Pagination Settings', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_pagination',
		'name'    => __( 'Pagination', 'testimonial-free' ),
		'desc'    => __( 'Show/Hide pagination.', 'testimonial-free' ),
		'default' => 'on',
	) );

	$this->metaboxform->color( array(
		'id'      => 'tfree_pagination_color',
		'type'    => 'color',
		'name'    => __( 'Dots Color', 'testimonial-free' ),
		'desc'    => __( 'Set the pagination dots color.', 'testimonial-free' ),
		'default' => '#cccccc',
	) );
	$this->metaboxform->color( array(
		'id'      => 'tfree_pagination_active_color',
		'type'    => 'color',
		'name'    => __( 'Active Color', 'testimonial-free' ),
		'desc'    => __( 'Set the pagination active color.', 'testimonial-free' ),
		'default' => '#52b3d9',
	) );
	$this->metaboxform->subheading( array(
		'id'      => 'subheading',
		'name'    => __( 'Misc. Settings', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_adaptive',
		'name'    => __( 'Adaptive Height', 'testimonial-free' ),
		'desc'    => __( 'On/Off adaptive height for the slider.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_swipe',
		'name'    => __( 'Swipe', 'testimonial-free' ),
		'desc'    => __( 'On/Off swipe mode.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_mouse_draggable',
		'name'    => __( 'Mouse Draggable', 'testimonial-free' ),
		'desc'    => __( 'On/Off mouse draggable mode.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->checkbox( array(
		'id'      => 'tfree_rtl',
		'name'    => __( 'RTL', 'testimonial-free' ),
		'desc'    => __( 'On/Off right to left mode.', 'testimonial-free' ),
		'default' => 'off',
	) );
	?>
</div>
