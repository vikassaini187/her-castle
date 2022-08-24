<?php if ( ! defined( 'ABSPATH' ) ) {
	die;
} // Cannot access pages directly.
/**
 *
 * Framework admin enqueue style and scripts
 *
 * @since 1.0.0
 * @version 1.0.0
 *
 */
if ( ! function_exists( 'sp_tfree_admin_enqueue_scripts' ) ) {
	function sp_tfree_admin_enqueue_scripts() {
		$current_screen        = get_current_screen();
		$the_current_post_type = $current_screen->post_type;
		if ( $the_current_post_type == 'spt_testimonial' ) {

			// framework core styles
			wp_enqueue_style( 'sp-tfree-framework', SP_TFREE_URL . 'admin/views/metabox/assets/css/sp-framework.css', array(),	SP_TFREE_VERSION, 'all' );
			wp_enqueue_style( 'sp-tfree-custom', SP_TFREE_URL . 'admin/views/metabox/assets/css/sp-custom.css', array(), SP_TFREE_VERSION, 'all' );
			wp_enqueue_style( 'tfree-font-awesome', SP_TFREE_URL . 'public/assets/css/font-awesome.min.css', array(), SP_TFREE_VERSION, 'all' );

			if ( is_rtl() ) {
				wp_enqueue_style( 'sp-framework-rtl', SP_TFREE_URL . 'admin/views/metabox/assets/css/sp-framework-rtl.css', array(), SP_TFREE_VERSION, 'all' );
			}

			// framework core scripts
			wp_enqueue_script( 'sp-tfree-plugins', SP_TFREE_URL . 'admin/views/metabox/assets/js/sp-plugins.js', array(), SP_TFREE_VERSION, true );
			wp_enqueue_script( 'sp-tfree-framework', SP_TFREE_URL . 'admin/views/metabox/assets/js/sp-framework.js', array( 'sp-tfree-plugins' ), SP_TFREE_VERSION, true );
		}

	}

	add_action( 'admin_enqueue_scripts', 'sp_tfree_admin_enqueue_scripts' );
}