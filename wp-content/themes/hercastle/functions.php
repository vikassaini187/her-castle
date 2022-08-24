<?php
/**
 * Twenty Nineteen functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

/**
 * Twenty Nineteen only works in WordPress 4.7 or later.
 */
if ( version_compare( $GLOBALS['wp_version'], '4.7', '<' ) ) {
	require get_template_directory() . '/inc/back-compat.php';
	return;
}

if ( ! function_exists( 'twentynineteen_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function twentynineteen_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Twenty Nineteen, use a find and replace
		 * to change 'twentynineteen' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'twentynineteen', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 1568, 9999 );

		// This theme uses wp_nav_menu() in two locations.
		register_nav_menus(
			array(
				'menu-1' => __( 'Primary', 'twentynineteen' ),
				'footer' => __( 'Footer Menu', 'twentynineteen' ),
				'social' => __( 'Social Links Menu', 'twentynineteen' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 190,
				'width'       => 190,
				'flex-width'  => false,
				'flex-height' => false,
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// Add custom editor font sizes.
		add_theme_support(
			'editor-font-sizes',
			array(
				array(
					'name'      => __( 'Small', 'twentynineteen' ),
					'shortName' => __( 'S', 'twentynineteen' ),
					'size'      => 19.5,
					'slug'      => 'small',
				),
				array(
					'name'      => __( 'Normal', 'twentynineteen' ),
					'shortName' => __( 'M', 'twentynineteen' ),
					'size'      => 22,
					'slug'      => 'normal',
				),
				array(
					'name'      => __( 'Large', 'twentynineteen' ),
					'shortName' => __( 'L', 'twentynineteen' ),
					'size'      => 36.5,
					'slug'      => 'large',
				),
				array(
					'name'      => __( 'Huge', 'twentynineteen' ),
					'shortName' => __( 'XL', 'twentynineteen' ),
					'size'      => 49.5,
					'slug'      => 'huge',
				),
			)
		);

		// Editor color palette.
		add_theme_support(
			'editor-color-palette',
			array(
				array(
					'name'  => __( 'Primary', 'twentynineteen' ),
					'slug'  => 'primary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 33 ),
				),
				array(
					'name'  => __( 'Secondary', 'twentynineteen' ),
					'slug'  => 'secondary',
					'color' => twentynineteen_hsl_hex( 'default' === get_theme_mod( 'primary_color' ) ? 199 : get_theme_mod( 'primary_color_hue', 199 ), 100, 23 ),
				),
				array(
					'name'  => __( 'Dark Gray', 'twentynineteen' ),
					'slug'  => 'dark-gray',
					'color' => '#111',
				),
				array(
					'name'  => __( 'Light Gray', 'twentynineteen' ),
					'slug'  => 'light-gray',
					'color' => '#767676',
				),
				array(
					'name'  => __( 'White', 'twentynineteen' ),
					'slug'  => 'white',
					'color' => '#FFF',
				),
			)
		);

		// Add support for responsive embedded content.
		add_theme_support( 'responsive-embeds' );
	}
endif;
add_action( 'after_setup_theme', 'twentynineteen_setup' );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function twentynineteen_widgets_init() {

	register_sidebar(
		array(
			'name'          => __( 'Footer', 'twentynineteen' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'Add widgets here to appear in your footer.', 'twentynineteen' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
	
	register_sidebar(
		array(
			'name'          => __( 'Contact Form Success Message', 'twentynineteen' ),
			'id'            => 'contact-form-success-message',
			'description'   => __( 'Contact Form Success Message.', 'twentynineteen' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

}
add_action( 'widgets_init', 'twentynineteen_widgets_init' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width Content width.
 */
function twentynineteen_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'twentynineteen_content_width', 640 );
}
add_action( 'after_setup_theme', 'twentynineteen_content_width', 0 );

/**
 * Enqueue scripts and styles.
 */
function twentynineteen_scripts() {
	wp_enqueue_style( 'twentynineteen-style', get_stylesheet_uri(), array(), wp_get_theme()->get( 'Version' ) );

	wp_style_add_data( 'twentynineteen-style', 'rtl', 'replace' );

	if ( has_nav_menu( 'menu-1' ) ) {
		wp_enqueue_script( 'twentynineteen-priority-menu', get_theme_file_uri( '/js/priority-menu.js' ), array(), '1.1', true );
		wp_enqueue_script( 'twentynineteen-touch-navigation', get_theme_file_uri( '/js/touch-keyboard-navigation.js' ), array(), '1.1', true );
	}

	wp_enqueue_style( 'twentynineteen-print-style', get_template_directory_uri() . '/print.css', array(), wp_get_theme()->get( 'Version' ), 'print' );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'twentynineteen_scripts' );

/**
 * Fix skip link focus in IE11.
 *
 * This does not enqueue the script because it is tiny and because it is only for IE11,
 * thus it does not warrant having an entire dedicated blocking script being loaded.
 *
 * @link https://git.io/vWdr2
 */
function twentynineteen_skip_link_focus_fix() {
	// The following is minified via `terser --compress --mangle -- js/skip-link-focus-fix.js`.
	?>
	<script>
	/(trident|msie)/i.test(navigator.userAgent)&&document.getElementById&&window.addEventListener&&window.addEventListener("hashchange",function(){var t,e=location.hash.substring(1);/^[A-z0-9_-]+$/.test(e)&&(t=document.getElementById(e))&&(/^(?:a|select|input|button|textarea)$/i.test(t.tagName)||(t.tabIndex=-1),t.focus())},!1);
	</script>
	<?php
}
add_action( 'wp_print_footer_scripts', 'twentynineteen_skip_link_focus_fix' );

/**
 * Enqueue supplemental block editor styles.
 */
function twentynineteen_editor_customizer_styles() {

	wp_enqueue_style( 'twentynineteen-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	if ( 'custom' === get_theme_mod( 'primary_color' ) ) {
		// Include color patterns.
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'twentynineteen-editor-customizer-styles', twentynineteen_custom_colors_css() );
	}
}
add_action( 'enqueue_block_editor_assets', 'twentynineteen_editor_customizer_styles' );

/**
 * Display custom color CSS in customizer and on frontend.
 */
function twentynineteen_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && 'default' === get_theme_mod( 'primary_color', 'default' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = 199;
	if ( 'default' !== get_theme_mod( 'primary_color', 'default' ) ) {
		$primary_color = get_theme_mod( 'primary_color_hue', 199 );
	}
	?>

	<style type="text/css" id="custom-theme-colors" <?php echo is_customize_preview() ? 'data-hue="' . absint( $primary_color ) . '"' : ''; ?>>
		<?php echo twentynineteen_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'twentynineteen_colors_css_wrap' );

/**
 * SVG Icons class.
 */
require get_template_directory() . '/classes/class-twentynineteen-svg-icons.php';

/**
 * Custom Comment Walker template.
 */
require get_template_directory() . '/classes/class-twentynineteen-walker-comment.php';

/**
 * Enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * SVG Icons related functions.
 */
require get_template_directory() . '/inc/icon-functions.php';

/**
 * Custom template tags for the theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';


add_action( 'wp_ajax_get_all_post_per_page', 'get_all_post_per_page' );
add_action( 'wp_ajax_nopriv_get_all_post_per_page', 'get_all_post_per_page' );

function get_all_post_per_page()
{
	global $wpdb;
	$paged1 = $_POST['paged'];
	$args = array(
		'posts_per_page' => 9,
		'paged' => $paged1,
		'orderby'=> array('ID'=>'ASC'),
		'post_type' => 'post',
	);
	$post_query = new WP_Query( $args );
	
	while ( $post_query->have_posts() ) : $post_query->the_post();
	$postid = get_the_id();
	$taxonomy = 'category';
	$args1 = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
	$terms = wp_get_post_terms( $postid, $taxonomy, $args1 );
	
	?>
	<div class="col-lg-4 col-md-4 text-center mb-5">
		<div class="card border-0">
			<img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="" class="img-fluid rounded w-100">
			<div class="card-body">
				<p class="font-weight-bold text-uppercase text_brown py-3 mb-0 p-brown-title"><?php echo $terms[0]->name ; ?></p>
				<p class="avn_bold blog-desc"> <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
			</div>
		</div>
	</div>
	<?php endwhile;
	wp_reset_postdata();
	die;
}

add_action( 'wp_ajax_get_post_per_page_by_cat', 'get_post_per_page_by_cat' );
add_action( 'wp_ajax_nopriv_get_post_per_page_by_cat', 'get_post_per_page_by_cat' );

function get_post_per_page_by_cat()
{
	global $wpdb;
	$paged1 = $_POST['paged'];
	$slug = $_POST['slug'];
	$args1 = array(
		'posts_per_page' => 9,
		'paged' => $paged1,
		'orderby'=> array('ID'=>'ASC'),
		'post_type'        => 'post',
		'tax_query' => array(
			array(
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $slug
			)
		 )
	);
	$post_query1 = new WP_Query( $args1 );
	
	while ( $post_query1->have_posts() ) : $post_query1->the_post();
	
	?>
	<div class="col-lg-4 col-md-4 text-center mb-5">
		<div class="card border-0">
			<img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="" class="img-fluid rounded w-100">
			<div class="card border-0">	
				<p class="font-weight-bold text-uppercase text_brown py-3 mb-0 p-brown-title"><?php echo $taxonomy1->name; ?></p>
				<p class="avn_bold blog-desc"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo the_title() ; ?></a></p>
			</div>
		</div>
	</div>
	<?php endwhile;
	wp_reset_postdata();
	die;
}

add_action( 'wp_ajax_get_all_projects_per_page', 'get_all_projects_per_page' );
add_action( 'wp_ajax_nopriv_get_all_projects_per_page', 'get_all_projects_per_page' );

function get_all_projects_per_page()
{
	global $wpdb;
	$paged1 = $_POST['paged'];
	$args = array(
		'posts_per_page' => 3,
		'paged' => $paged1,
		'orderby'=> array('ID'=>'ASC'),
		'post_type' => 'projects',
	);
	$post_query = new WP_Query( $args );
	
	while ( $post_query->have_posts() ) : $post_query->the_post();
	$postid = get_the_id();
	$taxonomy = 'projectcity';
	$args1 = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
	$terms = wp_get_post_terms( $postid, $taxonomy, $args1 );
	
	?>
	<div class="col-lg-4 col-sm-4 text-center mb-5">
		<a href="<?php the_permalink(); ?>"><img class="img-fluid w-100" src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt=""></a>
		<img class="img-fluid w-100" src="<?php echo get_field( "project_logo", $postid ); ?>" alt="">
		<h3 class="mt-0 my-2 text-capitalize"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p class="text-dark"><?php echo $terms[0]->name ; ?></p>
		<a class="btn btn_more_details badge-pill" href="<?php the_permalink(); ?>">More Details</a>
	</div>
	<?php endwhile;
	wp_reset_postdata();
	die;
}

add_action( 'wp_ajax_get_projects_per_page_by_cat', 'get_projects_per_page_by_cat' );
add_action( 'wp_ajax_nopriv_get_projects_per_page_by_cat', 'get_projects_per_page_by_cat' );

function get_projects_per_page_by_cat()
{
	global $wpdb;
	$paged1 = $_POST['paged'];
	$slug = $_POST['slug'];
	$args1 = array(
		'posts_per_page' => 9,
		'paged' => $paged1,
		'orderby'=> array('ID'=>'ASC'),
		'post_type'        => 'projects',
		'tax_query' => array(
			array(
				'taxonomy' => 'projectcity',
				'field' => 'slug',
				'terms' => $slug
			)
		 )
	);
	$post_query1 = new WP_Query( $args1 );
	
	while ( $post_query1->have_posts() ) : $post_query1->the_post();
	
	?>
	<div class="col-lg-4 col-sm-4 text-center mb-5">
		<a href="<?php the_permalink(); ?>"><img class="img-fluid w-100" src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt=""></a>
		<img class="img-fluid w-100" src="<?php echo get_field( "project_logo", $postid1 ); ?>" alt="">
		<h3 class="mt-0 my-2 text-capitalize"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<p class="text-dark"><?php echo $taxonomy1->name; ?></p>
		<a class="btn btn_more_details badge-pill" href="<?php the_permalink() ?>">More Details</a>
	</div>
	<?php endwhile;
	wp_reset_postdata();
	die;
}

function success_message_contact_form()
{
	dynamic_sidebar('contact-form-success-message');
	
	die;
}

function register_ashcodes(){
    add_shortcode('success_message_contact_form','success_message_contact_form');
}

# I'm guessing init has already run by this point
# add_action( 'init', 'register_ashcodes');
# Use a different hook or just register your code
register_ashcodes();

add_action( 'wp_footer', 'mycustom_wp_footer' );
function mycustom_wp_footer() {
?>
     <script type="text/javascript">
         document.addEventListener( 'wpcf7mailsent', function( event ) {
         //if ( '34' == event.detail.contactFormId ) { // Change 123 to the ID of the form 
         jQuery('#myModal2').modal('show'); //this is the bootstrap modal popup id
       //}
        }, false );
         </script>
       <?php  }
