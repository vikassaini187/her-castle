<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
}
// Cannot access pages directly.
// ===============================================================================================
// -----------------------------------------------------------------------------------------------
// METABOX OPTIONS
// -----------------------------------------------------------------------------------------------
// ===============================================================================================
$options = array();

// -----------------------------------------
// Testimonial Meta Options
// -----------------------------------------
$options[] = array(
	'id'        => 'sp_tpro_meta_options',
	'title'     => __( 'Testimonial Options', 'testimonial-free' ),
	'post_type' => 'spt_testimonial',
	'context'   => 'normal',
	'priority'  => 'default',
	'sections'  => array(

		// begin: a section
		array(
			'name'   => 'sp_tpro_meta_option_1',
			'title'  => __( 'Reviewer Information', 'testimonial-free' ),

			// begin: fields
			'fields' => array(

				// begin: a field
				array(
					'id'    => 'tpro_name',
					'type'  => 'text',
					'title' => __( 'Name', 'testimonial-free' ),
					'desc'  => __( 'Type reviewer name here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_designation',
					'type'  => 'text',
					'title' => __( 'Identity or Position', 'testimonial-free' ),
					'desc'  => __( 'Type reviewer identity or position here.', 'testimonial-free' ),
				),
				array(
					'id'      => 'tpro_rating',
					'type'    => 'rating',
					'title'   => __( 'Rating Star', 'testimonial-free' ),
					'desc'    => __( 'Rating star along with testimonial.', 'testimonial-free' ),
					'options' => array(
						'five_star'  => __( '5 Stars', 'testimonial-free' ),
						'four_star'  => __( '4 Stars', 'testimonial-free' ),
						'three_star' => __( '3 Stars', 'testimonial-free' ),
						'two_star'   => __( '2 Stars', 'testimonial-free' ),
						'one_star'   => __( '1 Star', 'testimonial-free' ),
					),
					'default' => '',
				),
			), // end: fields
		), // end: a section

		// begin: a section
		array(
			'name'   => 'sp_tpro_meta_option_2',
			'title'  => __( 'Social Profiles', 'testimonial-free' ),

			// begin: fields
			'fields' => array(

				// begin: a field
				array(
					'type'       => 'notice',
					'class'      => 'notice',
					'content'    => __( 'These Social Profile options are available in the <b><a href="https://shapedplugin.com/plugin/testimonial-pro" target="_blank">Pro Version</a></b>.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_facebook_url',
					'type'  => 'd_text',
					'title' => __( 'Facebook', 'testimonial-free' ),
					'desc'  => __( 'Type facebook URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_twitter_url',
					'type'  => 'd_text',
					'title' => __( 'Twitter', 'testimonial-free' ),
					'desc'  => __( 'Type twitter URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_google_plus_url',
					'type'  => 'd_text',
					'title' => __( 'Google Plus', 'testimonial-free' ),
					'desc'  => __( 'Type google plus URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_linked_in_url',
					'type'  => 'd_text',
					'title' => __( 'LinkedIn', 'testimonial-free' ),
					'desc'  => __( 'Type linkedin URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_instagram_url',
					'type'  => 'd_text',
					'title' => __( 'Instagram', 'testimonial-free' ),
					'desc'  => __( 'Type Instagram URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_youtube_url',
					'type'  => 'd_text',
					'title' => __( 'YouTube', 'testimonial-free' ),
					'desc'  => __( 'Type youtube URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_pinterest_url',
					'type'  => 'd_text',
					'title' => __( 'Pinterest', 'testimonial-free' ),
					'desc'  => __( 'Type pinterest URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_skype_url',
					'type'  => 'd_text',
					'title' => __( 'Skype', 'testimonial-free' ),
					'desc'  => __( 'Type skype URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_stumble_upon_url',
					'type'  => 'd_text',
					'title' => __( 'StumbleUpon', 'testimonial-free' ),
					'desc'  => __( 'Type stumbleupon URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_reddit_url',
					'type'  => 'd_text',
					'title' => __( 'Reddit', 'testimonial-free' ),
					'desc'  => __( 'Type reddit URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_dribbble_url',
					'type'  => 'd_text',
					'title' => __( 'Dribbble', 'testimonial-free' ),
					'desc'  => __( 'Type dribbble URL here.', 'testimonial-free' ),
				),
				array(
					'id'    => 'tpro_social_snapchat_url',
					'type'  => 'd_text',
					'title' => __( 'SnapChat', 'testimonial-free' ),
					'desc'  => __( 'Type snapchat URL here.', 'testimonial-free' ),
				),

			), // end: fields
		), // end: a section

	),
);


SP_TPRO_Framework_Metabox::instance( $options );