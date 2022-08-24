<?php
/* Template Name: Resource Page */
get_header();
 ?>
 <!-- start body conetent area -->
<section class="pt-100 pb-150 h-100 light_pink_bg position-relative">
	<div class="col-lg-7 m-auto pt-70">
    
    	<!-- square boxes container -->
    	<div class="row">
			<?php 
				$args = array(
					'posts_per_page'   => -1,
					'post_type'        => 'resources',
				);
				$post_query = query_posts( $args );
				
				while ( have_posts() ) : the_post();
				$postid = get_the_id()
			?>
        	<div class="col-lg-6 col-md-6">
            	<div class="p-4 alert bg-white" id="intro_text">
                	<h2 class="avn_bold"><?php the_title(); ?></h2>
                    <p class="resource-desc"><?php echo get_the_excerpt(); ?></p>
                    <a href="#" class="btn btn_more_details badge-pill">View Details <i><svg style="margin-left:15px;" width="23" height="12" viewBox="0 0 23 12" fill="none" xmlns="http://www.w3.org/2000/svg"> <path d="M1 6H21" stroke="#BC5F04" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> <path d="M17 1L22 6L17 11" stroke="#BC5F04" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/> </svg> </i></a>
                </div>
            </div>
            <?php endwhile; wp_reset_query(); ?>
            
        </div>
    </div>

	
    
    
    
    
</section>
<!-- ends body content area -->
 <?php
get_footer();
?>