<?php
/**
* Plugin Name: Popup Message for Contact Form 7
* Description: This plugin will show the popup when Contact Form 7 has been submitted.
* Version: 2.0 
* Author: Ocean Infotech
* Author URI: Author's website
*/



if (!defined('ABSPATH')) {
    die('-1');
}
if (!defined('CF7POPUP_PLUGIN_NAME')) {
    define('CF7POPUP_PLUGIN_NAME', 'Contact Form 7 Popup');
}
if (!defined('CF7POPUP_PLUGIN_VERSION')) {
    define('CF7POPUP_PLUGIN_VERSION', '1.0.0');
}
if (!defined('CF7POPUP_PLUGIN_FILE')) {
    define('CF7POPUP_PLUGIN_FILE', __FILE__);
}
if (!defined('CF7POPUP_PLUGIN_DIR')) {
    define('CF7POPUP_PLUGIN_DIR',plugins_url('', __FILE__));
}
if (!defined('CF7POPUP_DOMAIN')) {
    define('CF7POPUP_DOMAIN', 'cf7popup');
}


if (!class_exists('CF7POPUPMAIN')) {

    class CF7POPUPMAIN {

        protected static $CF7POPUPMAIN_instance;

        //Load all includes files
        function includes() {
            include_once('popup_panel.php');
            include_once('save_popup_setting.php');
            include_once('submit_popup_settings.php');
        }

        function init() {
            add_action( 'admin_init', array($this, 'CF7POPUPMAIN_load_plugin'), 11 );
            add_action( 'admin_enqueue_scripts', array($this, 'CF7POPUP_load_admin_script_style'));
            add_action( 'wp_enqueue_scripts',  array($this, 'CF7POPUP_load_front_script_style'));
            add_action( 'admin_enqueue_scripts',  array($this, 'CF7POPUP_load_front_script_style'));
        }

    	function CF7POPUPMAIN_load_plugin() {
            if ( ! ( is_plugin_active( 'contact-form-7/wp-contact-form-7.php' ) ) ) {
                add_action( 'admin_notices', array($this,'CF7POPUPMAIN_install_error') );
            }
        }

        function CF7POPUPMAIN_install_error() {
            deactivate_plugins( plugin_basename( __FILE__ ) );
            delete_transient( get_current_user_id() . 'cf7error' );
            echo '<div class="error"><p> This plugin is deactivated because it require <a href="plugin-install.php?tab=search&s=contact+form+7">Contact Form 7</a> plugin installed and activated.</p></div>';
        }

        //Add JS and CSS on Backend
        function CF7POPUP_load_admin_script_style() {
            wp_enqueue_media();
            wp_enqueue_script( 'pmfcf-wp-media-uploader', plugins_url( 'popup-message-for-contact-form-7-pro/js/wp_media_uploader.js', __DIR__ ) );
        }

        //Add JS and CSS on Frontend
        function CF7POPUP_load_front_script_style() {
            wp_enqueue_script( 'pmfcf-script-popupscript', plugins_url( '/js/popupscript.js', __FILE__ ) );
            wp_enqueue_script( 'pmfcf-script-sweetalert2', plugins_url( '/js/sweetalert2.all.min.js', __FILE__ ) );
            wp_enqueue_script( 'pmfcf-jscolor', plugins_url( '/js/jscolor.js', __FILE__ ) );
            wp_enqueue_style( 'pmfcf-sweetalert2-style', plugins_url( '/css/sweetalert2.min.css', __FILE__ ) );
            wp_enqueue_style( 'pmfcf-style', plugins_url( '/css/style.css', __FILE__ ) );
        }

        //Plugin Rating
        public static function do_activation() {
          set_transient('ocinsta-first-rating', true, MONTH_IN_SECONDS);
        }

        public static function CF7POPUPMAIN_instance() {
            if (!isset(self::$CF7POPUPMAIN_instance)) {
                self::$CF7POPUPMAIN_instance = new self();
                self::$CF7POPUPMAIN_instance->init();
                self::$CF7POPUPMAIN_instance->includes();
            }
            return self::$CF7POPUPMAIN_instance;
        }

    }

    add_action('plugins_loaded', array('CF7POPUPMAIN', 'CF7POPUPMAIN_instance'));
    register_activation_hook(CF7POPUP_PLUGIN_FILE, array('CF7POPUPMAIN', 'do_activation'));
}
