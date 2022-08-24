<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}  // if direct access

/**
 * Admin Scripts and styles
 */
class SP_TFREE_Admin_Scripts {

	/**
	 * @var null
	 * @since 2.0
	 */
	protected static $_instance = null;

	/**
	 * @return SP_TFREE_Admin_Scripts
	 * @since 2.0
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	/**
	 * Initialize the class
	 */
	public function __construct() {

		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );
	}

	/**
	 * Enqueue admin scripts
	 */
	public function admin_scripts() {
		if ( 'spt_testimonial_page_tfree_help' === get_current_screen()->id ) {
			wp_enqueue_script( 'jquery-masonry');
			wp_enqueue_script( 'sp-tfree-help', SP_TFREE_URL . 'admin/assets/js/help.js', array( 'jquery' ), SP_TFREE_VERSION, true );
		}
		if ( 'sp_tfree_shortcodes' === get_current_screen()->id ) {
			//CSS Files
			wp_enqueue_style( 'wp-color-picker' );
			wp_enqueue_style( 'tfree-font-awesome', SP_TFREE_URL . 'public/assets/css/font-awesome.min.css', array(), SP_TFREE_VERSION );
			wp_enqueue_style( 'sp-tfree-chosen', SP_TFREE_URL . 'admin/assets/css/chosen.css', array(), SP_TFREE_VERSION );
			wp_enqueue_style( 'sp-tfree-admin-meta', SP_TFREE_URL . 'admin/assets/css/admin-meta.css', array(), SP_TFREE_VERSION );

			//JS Files
			wp_enqueue_script( 'sp-tfree-admin-meta', SP_TFREE_URL . 'admin/assets/js/admin-meta.js', array( 'jquery', 'wp-color-picker' ), SP_TFREE_VERSION, true );
			wp_enqueue_script( 'sp-tfree-chosen-js', SP_TFREE_URL . 'admin/assets/js/chosen.js', array( 'jquery' ), SP_TFREE_VERSION, false );

		}
		wp_enqueue_style( 'testimonial-free-admin', SP_TFREE_URL . 'admin/assets/css/admin.css', array(), SP_TFREE_VERSION );
	}

}

new SP_TFREE_Admin_Scripts();