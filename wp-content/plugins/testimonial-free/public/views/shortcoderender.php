<?php
/**
 * This file render the shortcode to the frontend
 * @package testimonial-free
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Testimonial - Shortcode Render class
 * @since 2.0
 */
if ( ! class_exists( 'TFREE_Shortcode_Render' ) ) {
	class TFREE_Shortcode_Render {

		public $tfree_five_star = '<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					';
		public $tfree_four_star = '
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					';
		public $tfree_three_star = '
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					';
		public $tfree_two_star = '
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					';
		public $tfree_one_star = '
					<i class="fa fa-star" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					<i class="fa fa-star-o" aria-hidden="true"></i>
					';

		/**
		 * @var TFREE_Shortcode_Render single instance of the class
		 *
		 * @since 2.0
		 */
		protected static $_instance = null;


		/**
		 * TFREE_Shortcode_Render Instance
		 *
		 * @since 2.0
		 * @static
		 * @return self Main instance
		 */
		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		/**
		 * TFREE_Shortcode_Render constructor.
		 */
		public function __construct() {
			add_shortcode( 'sp_testimonial', array( $this, 'shortcode_render' ) );
		}

		/**
		 * @param $attributes
		 *
		 * @return string
		 * @since 2.0
		 */
		public function shortcode_render( $attributes ) {
			extract( shortcode_atts( array(
				'id' => '',
			), $attributes, 'sp_testimonial' ) );

			$post_id = $attributes['id'];

			$theme_style                    = get_post_meta( $post_id, 'tfree_themes', true );
			$number_of_total_testimonials   = get_post_meta( $post_id, 'tfree_number_of_total_testimonials', true );
			$order_by                       = get_post_meta( $post_id, 'tfree_order_by', true );
			$order                          = get_post_meta( $post_id, 'tfree_order', true );
			$number_of_column               = get_post_meta( $post_id, 'tfree_number_of_column', true );
			$number_of_column_desktop       = get_post_meta( $post_id, 'tfree_number_of_column_desktop', true );
			$number_of_column_small_desktop = get_post_meta( $post_id, 'tfree_number_of_column_small_desktop', true );
			$number_of_column_mobile        = get_post_meta( $post_id, 'tfree_number_of_column_mobile', true );
			$number_of_column_tablet        = get_post_meta( $post_id, 'tfree_number_of_column_tablet', true );
			$auto_play_speed                = get_post_meta( $post_id, 'tfree_auto_play_speed', true );
			$scroll_speed                   = get_post_meta( $post_id, 'tfree_scroll_speed', true );
			$nav_arrow_color                = get_post_meta( $post_id, 'tfree_nav_arrow_color', true );
			$nav_arrow_hover                = get_post_meta( $post_id, 'tfree_nav_arrow_hover', true );
			$pagination_color               = get_post_meta( $post_id, 'tfree_pagination_color', true );
			$pagination_active_color        = get_post_meta( $post_id, 'tfree_pagination_active_color', true );
			$star_rating_color              = get_post_meta( $post_id, 'tfree_star_rating_color', true );
			$position_color                 = get_post_meta( $post_id, 'tfree_position_color', true );
			$reviewer_name_color            = get_post_meta( $post_id, 'tfree_reviewer_name_color', true );
			$testimonial_content_color      = get_post_meta( $post_id, 'tfree_testimonial_content_color', true );
			$testimonial_title_color        = get_post_meta( $post_id, 'tfree_testimonial_title_color', true );
			$section_title_color            = get_post_meta( $post_id, 'tfree_section_title_color', true );

			$section_title       = $this->get_meta( $post_id, 'tfree_section_title', 'true' );
			$testimonial_title   = $this->get_meta( $post_id, 'tfree_testimonial_title', 'true' );
			$testimonial_content = $this->get_meta( $post_id, 'tfree_testimonial_content', 'true' );
			$reviewer_name       = $this->get_meta( $post_id, 'tfree_reviewer_name', 'true' );
			$reviewer_position   = $this->get_meta( $post_id, 'tfree_position', 'true' );
			$star_rating         = $this->get_meta( $post_id, 'tfree_star_rating', 'true' );
			$auto_play           = $this->get_meta( $post_id, 'tfree_auto_play', 'true' );
			$pause_on_hover      = $this->get_meta( $post_id, 'tfree_pause_on_hover', 'true' );
			$infinite_loop       = $this->get_meta( $post_id, 'tfree_infinite_loop', 'true' );
			$navigation          = $this->get_meta( $post_id, 'tfree_navigation', 'true' );
			$pagination          = $this->get_meta( $post_id, 'tfree_pagination', 'true' );
			$adaptive_height     = $this->get_meta( $post_id, 'tfree_adaptive', 'true' );
			$swipe_on            = $this->get_meta( $post_id, 'tfree_swipe', 'true' );
			$mouse_draggable     = $this->get_meta( $post_id, 'tfree_mouse_draggable', 'true' );
			$rtl_mode            = $this->get_meta( $post_id, 'tfree_rtl', 'true' );

			// Enqueue Script.
			wp_enqueue_script( 'tfree-slick-min-js' );
			wp_enqueue_script( 'tfree-slick-active' );

			$outline = '';

			// Style.
			$outline .= '<style>';
			$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-dots li button{
				background: ' . $pagination_color . ';
			}
			#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-dots li.slick-active button{
                background: ' . $pagination_active_color . ';
            }
            #sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-prev,
			#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-next{
				color: ' . $nav_arrow_color . ';
			}
            #sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-prev:hover,
			#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .slick-next:hover{
				color: ' . $nav_arrow_hover . ';
			}
			';
			if ( $navigation == 'true' ) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section{
					padding: 0 50px;
				}';
			}
			if ( $star_rating == 'true' ) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .tfree-client-rating{
					color: ' . $star_rating_color . ';
				}';
			}
			if ( $reviewer_position == 'true' ) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .tfree-client-designation{
					color: ' . $position_color . ';
				}';
			}
			if ( $reviewer_name == 'true' ) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section h2.tfree-client-name{
					color: ' . $reviewer_name_color . ';
				}';
			}
			if ( $testimonial_content == 'true' ) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .tfree-client-testimonial{
					color: ' . $testimonial_content_color . ';
				}';
			}
			if ( $testimonial_title == 'true' ) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .tfree-testimonial-title h3{
					color: ' . $testimonial_title_color . ';
				}';
			}
			if ( $section_title == 'true' ) {
				$outline .= '#sp-testimonial-free-wrapper-' . $post_id . ' .sp-testimonial-free-section .tfree-testimonial-title h3{
					color: ' . $section_title_color . ';
				}';
			}

			$outline .= '</style>';

			$args = array(
				'post_type'      => 'spt_testimonial',
				'orderby'        => $order_by,
				'order'          => $order,
				'posts_per_page' => $number_of_total_testimonials,
			);

			$post_query = new WP_Query( $args );

			$outline .= '<div id="sp-testimonial-free-wrapper-' . $post_id . '" class="sp-testimonial-free-wrapper">';

			if ( 'true' == $section_title ) {
				$outline .= '<h2 class="sp-testimonial-free-section-title">' . get_the_title( $post_id ) . '</h2>';
			}

			$outline .= '<div id="sp-testimonial-free-' . $post_id . '" class="sp-testimonial-free-section tfree-style-' . $theme_style . '" data-slick=\'{"dots": ' . $pagination . ', "adaptiveHeight": ' . $adaptive_height . ', "pauseOnHover": ' . $pause_on_hover . ', "slidesToShow": ' . $number_of_column . ', "speed": ' . $scroll_speed . ', "arrows": ' . $navigation . ', "autoplay": ' . $auto_play . ', "autoplaySpeed": ' . $auto_play_speed . ', "swipe": ' . $swipe_on . ', "draggable": ' . $mouse_draggable . ', "rtl": ' . $rtl_mode . ', "infinite": ' . $infinite_loop . ', "responsive": [ {"breakpoint": 1280, "settings": { "slidesToShow": ' . $number_of_column_desktop . ' } }, {"breakpoint": 980, "settings": { "slidesToShow": ' . $number_of_column_small_desktop . ' } }, {"breakpoint": 736, "settings": { "slidesToShow": ' . $number_of_column_tablet . ' } }, {"breakpoint": 480, "settings": { "slidesToShow": ' . $number_of_column_mobile . ' } } ] }\'>';

			if ( $post_query->have_posts() ) {
				while ( $post_query->have_posts() ) :
					$post_query->the_post();
					$testimonial_data   = get_post_meta( get_the_ID(), 'sp_tpro_meta_options', true );
					$tfree_designation  = ( isset( $testimonial_data['tpro_designation'] ) ? $testimonial_data['tpro_designation']: '' );
					$tfree_name         = ( isset( $testimonial_data['tpro_name'] ) ? $testimonial_data['tpro_name']: '' );
					$tfree_rating_star = ( isset( $testimonial_data['tpro_rating'] ) ? $testimonial_data['tpro_rating']: '' );

					if ( 'theme-one' == $theme_style ) {
						include SP_TFREE_PATH . '/public/views/templates/theme-one.php';
					}

				endwhile;
			} else {
				$outline .= '<h2 class="sp-not-testimonial-found">' . esc_html__( 'No testimonials found', 'testimonial-free' ) . '</h2>';
			}

			$outline .= '</div>';
			$outline .= '</div>';

			wp_reset_query();

			return $outline;

		}

		/**
		 * Get post meta by id and key
		 *
		 * @param $post_id
		 * @param $key
		 * @param $default
		 *
		 * @return string|void
		 */
		public function get_meta( $post_id, $key, $default = null ) {
			$meta = get_post_meta( $post_id, $key, true );
			if ( empty( $meta ) && $default ) {
				$meta = $default;
			}

			if ( 'zero' == $meta ) {
				$meta = '0';
			}
			if ( 'on' == $meta ) {
				$meta = 'true';
			}
			if ( 'off' == $meta ) {
				$meta = 'false';
			}

			return esc_attr( $meta );
		}

	}

	new TFREE_Shortcode_Render();
}
