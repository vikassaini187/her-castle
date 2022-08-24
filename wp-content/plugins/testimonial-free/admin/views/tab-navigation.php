<?php
/**
 * This file display meta box tab
 * @package testimonial-free
 */

$current_screen        = get_current_screen();
$the_current_post_type = $current_screen->post_type;
if ( $the_current_post_type == 'sp_tfree_shortcodes' ) {
	?>
	<div class="sp-tfree-metabox-framework">
		<div class="sp-tfree-mbf-banner">
			<div class="sp-tfree-mbf-logo"><img src="<?php echo SP_TFREE_URL ?>admin/assets/images/logo.png" alt="<?php esc_html_e('Testimonial', 'Testimonial'); ?>"></div>
			<div class="sp-tfree-mbf-short-links">
				<a href="https://shapedplugin.com/support-forum/" target="_blank"><i class="sp-tfree-font-icon fa fa-life-ring"></i> Support</a>
			</div>
		</div>
		<div class="sp-tfree-mbf text-center">

			<div class="sp-tfree-col-lg-3">
				<div class="sp-tfree-mbf-shortcode">
					<h2 class="sp-tfree-mbf-shortcode-title"><?php _e( 'Shortcode', 'testimonial-free' ); ?> </h2>
					<p><?php _e( 'Copy and paste this shortcode into your posts or pages:', 'testimonial-free' );
						global $post;
						?></p>
					<div class="tfree-sc-code selectable" >[sp_testimonial <?php echo 'id="' . $post->ID . '"';
					?>]</div>
				</div>


			</div>
			<div class="sp-tfree-col-lg-3">
				<div class="sp-tfree-mbf-shortcode">
					<h2 class="sp-tfree-mbf-shortcode-title"><?php _e( 'Template Include', 'testimonial-free' ); ?> </h2>

					<p><?php _e( 'Paste the PHP code into your template file:', 'testimonial-free' ); ?></p>
					<div class="tfree-sc-code selectable">
						&lt;?php
                        echo do_shortcode('[sp_testimonial <?php echo 'id="' . $post->ID . '"'; ?>]');
						?&gt;</div>
				</div>
			</div>
			<div class="sp-tfree-col-lg-3">
				<div class="sp-tfree-mbf-shortcode">
					<h2 class="sp-tfree-mbf-shortcode-title"><?php _e( 'Post or Page editor', 'testimonial-free' ); ?> </h2>

					<p><?php _e( 'Insert the shortcode with the TinyMCE button:', 'testimonial-free' ); ?></p>
					<img class="back-image"
					     src="<?php echo SP_TFREE_URL . 'admin/assets/images/tiny-mce.png' ?>"
					     alt="">
				</div>
			</div>

		</div>
		<div class="sp-tfree-shortcode-divider"></div>

		<div class="sp-tfree-mbf-nav nav-tab-wrapper current">
			<a class="nav-tab nav-tab-active" data-tab="sp-tfree-tab-1"><i class="sp-tfree-font-icon fa fa-wrench"></i>General Settings</a>
			<a class="nav-tab" data-tab="sp-tfree-tab-2"><i class="sp-tfree-font-icon fa fa-sliders"></i>Slider Settings</a>
			<a class="nav-tab" data-tab="sp-tfree-tab-3"><i class="sp-tfree-font-icon fa fa-paint-brush"></i>Stylization</a>
			<a class="nav-tab" data-tab="sp-tfree-tab-4"><i class="sp-tfree-font-icon fa fa-font"></i>Typography</a>
			<a class="nav-tab sp-tfree-upgrade-to-pro" data-tab="sp-tfree-tab-5"><i class="sp-tfree-font-icon fa fa-rocket"></i>Upgrade to Pro</a>
		</div>

		<?php
		include_once 'partials/general-settings.php';
		include_once 'partials/slider-settings.php';
		include_once 'partials/stylization.php';
		include_once 'partials/typography.php';
		include_once 'partials/upgrade-to-pro.php';
		?>
	</div>
	<?php
}