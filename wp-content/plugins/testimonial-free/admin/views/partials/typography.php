<?php
/**
 * This file is to display typography.
 *  @since 2.0
 * @package testimonial-free
 */
?>
<div id="sp-tfree-tab-4" class="sp-tfree-mbf-tab-content sp-tfree-mbf-tab-typography">
	<div class="sp-tpro-notice">These Typography (840+ Google Fonts) options are available in the <b><a href="https://shapedplugin.com/plugin/testimonial-pro" target="_blank">Pro Version</a></b>.</div>
	<?php
	$this->metaboxform->checkbox_disabled( array(
		'id'      => 'tfree_load_section_title_font',
		'name'    => __( 'Load Section Title Font', 'testimonial-free' ),
		'desc'    => __( 'On/Off google font for the section title.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->typography_type( array(
		'id'      => 'tfree_section_title_font',
		'name'    => __( 'Section Title Font', 'testimonial-free' ),
		'desc'    => __( 'Set testimonial section title font properties.', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox_disabled( array(
		'id'      => 'tfree_load_testimonial_title_font',
		'name'    => __( 'Load Testimonial Title Font', 'testimonial-free' ),
		'desc'    => __( 'On/Off google font for the testimonial tagline or title.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->typography_type( array(
		'id'      => 'tfree_testimonial_title_font',
		'name'    => __( 'Testimonial Title Font', 'testimonial-free' ),
		'desc'    => __( 'Set testimonial tagline or title font properties.', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox_disabled( array(
		'id'      => 'tfree_load_testimonial_content_font',
		'name'    => __( 'Load Testimonial Content Font', 'testimonial-free' ),
		'desc'    => __( 'On/Off google font for the testimonial content.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->typography_type( array(
		'id'      => 'tfree_testimonial_content_font',
		'name'    => __( 'Testimonial Content Font', 'testimonial-free' ),
		'desc'    => __( 'Set testimonial content font properties.', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox_disabled( array(
		'id'      => 'tfree_load_name_font',
		'name'    => __( 'Load Name Font', 'testimonial-free' ),
		'desc'    => __( 'On/Off google font for the name.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->typography_type( array(
		'id'      => 'tfree_name_font',
		'name'    => __( 'Name Font', 'testimonial-free' ),
		'desc'    => __( 'Set name font properties.', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox_disabled( array(
		'id'      => 'tfree_load_identity_font',
		'name'    => __( 'Load Identity or Position & Company Name Font', 'testimonial-free' ),
		'desc'    => __( 'On/Off google font for the identity or position & company name.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->typography_type( array(
		'id'      => 'tfree_identity_font',
		'name'    => __( 'Identity or Position & Company Name Font', 'testimonial-free' ),
		'desc'    => __( 'Set identity or position & company name font properties.', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox_disabled( array(
		'id'      => 'tfree_load_location_font',
		'name'    => __( 'Load Location Font', 'testimonial-free' ),
		'desc'    => __( 'On/Off google font for the location.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->typography_type( array(
		'id'      => 'tfree_location_font',
		'name'    => __( 'Location Font', 'testimonial-free' ),
		'desc'    => __( 'Set location font properties.', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox_disabled( array(
		'id'      => 'tfree_load_mobile_font',
		'name'    => __( 'Load Phone or Mobile Font', 'testimonial-free' ),
		'desc'    => __( 'On/Off google font for the phone or mobile.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->typography_type( array(
		'id'      => 'tfree_mobile_font',
		'name'    => __( 'Phone or Mobile Font', 'testimonial-free' ),
		'desc'    => __( 'Set phone or mobile font properties.', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox_disabled( array(
		'id'      => 'tfree_load_email_font',
		'name'    => __( 'Load Email Address Font', 'testimonial-free' ),
		'desc'    => __( 'On/Off google font for the email address.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->typography_type( array(
		'id'      => 'tfree_email_font',
		'name'    => __( 'Email Address Font', 'testimonial-free' ),
		'desc'    => __( 'Set email address font properties.', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox_disabled( array(
		'id'      => 'tfree_load_email_font',
		'name'    => __( 'Load Date Font', 'testimonial-free' ),
		'desc'    => __( 'On/Off google font for the date.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->typography_type( array(
		'id'      => 'tfree_email_font',
		'name'    => __( 'Date Font', 'testimonial-free' ),
		'desc'    => __( 'Set date font properties.', 'testimonial-free' ),
	) );
	$this->metaboxform->checkbox_disabled( array(
		'id'      => 'tfree_load_website_font',
		'name'    => __( 'Load Website Font', 'testimonial-free' ),
		'desc'    => __( 'On/Off google font for the website.', 'testimonial-free' ),
		'default' => 'on',
	) );
	$this->metaboxform->typography_type( array(
		'id'      => 'tfree_website_font',
		'name'    => __( 'Website Font', 'testimonial-free' ),
		'desc'    => __( 'Set website font properties.', 'testimonial-free' ),
	) );

	?>
</div>