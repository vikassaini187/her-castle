<?php
/* Template Name: Concierge Service Page */
get_header();
global $post;
$post_id = $post->ID ;
 ?>

<!-- start body conetent area -->
<section class="pt-100 pb-100">
<div class="concierge_room_img"><img class="img-fluid w-100" src="<?php echo get_field( "left_image", $post_id ); ?>" alt=""></div>
	<div class="container pt-100 sm-pt-0 mt-20">
    	<!-- content body starts here -->
    	
        <div class="col-lg-10 offset-lg-2" id="top_heading_cont">
    		<h1 class="avn_bold about_us_heading_big"><?php echo get_field( "top_heading", $post_id ); ?></h1>
        </div>
        
        <!-- right side container -->
        <div class="col-lg-8 offset-lg-4" id="right_cont">
        	<div class="col-lg-7 py-4">
            	<div class="row" id="concierge-service-intro">
				<?php
			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>
            		
				<?php the_content(); ?>
				
				<?php endwhile; // End of the loop.
			?>
            	</div>
           	</div>
        
			<!-- concierge details cont -->
			<div class="row pt-5">
				<?php 
					$args = array(
						'posts_per_page'   => -1,
						'orderby'=> array('ID'=>'ASC'),
						'post_type'        => 'concierge_service',
					);
					$post_query = query_posts( $args );
					
					while ( have_posts() ) : the_post();
					$postid = get_the_id();
					
				?>
				<div class="col-lg-6" id="concierge_service">
					<div class="card border-0">
					<?php echo get_field( "svg_icon", $postid ); ?>
					<h3 class="avn_bold"><?php echo the_title(); ?></h3>
					<?php echo the_content(); ?>
					</div>
				</div>
			   <?php endwhile; wp_reset_query(); ?> 
			</div>
        </div>
               
    </div>
    
    
    <!-- invite box cont -->
    <div class="container px-0">
    <div class="row">
    	<div class="col-lg-10 px-0 pt-60 m-auto">
    	<div id="invite_box" class="light_pink_bg text-center py-5 px-5 position-relative h-100" style="border-radius:20px;">
        	<h1 class="avn_bold">Have a question about your property? </h1>
            <p class="intro_para mt-3">We invite you to speak with anyone in our team</p>
             <a href="<?php echo site_url(); ?>/contact-us/" class="btn btn-brown mt-4">Contact Us</a>
        </div>
        </div>
     </div>
    </div>
</section>
<!-- ends body content area -->


 <?php
get_footer();
?>