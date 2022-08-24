<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */

get_header();
global $post;
$post_id = $post->ID ;
?>

	<!-- start body conetent area -->
<section class="pt-150 pb-150 sm-pb-0 h-100 light_pink_bg position-relative">
	<div class="col-lg-9 m-auto pt-70 pb-70 bg-white rounded">
    <div class="row">
    <!-- article container starts here -->
    <div class="col-lg-9 m-auto"> 
			<?php 
				$taxonomy1 = 'category';
				$args12 = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
				$terms2 = wp_get_post_terms( $post_id, $taxonomy1, $args12 );
			?>
    		<p class="fz-12 text-center text_brown AvenirNextCyr-Bold"><?php echo $terms2[0]->name ?> • <?php echo get_the_date(); ?></p>
			<?php

			/* Start the Loop */
			while ( have_posts() ) :
				the_post();
				?>
        	<h2 class="font-weight-bold text-center col-lg-9 m-auto px-0"><?php the_title(); ?></h2>
          
            
            <!-- unique border cont -->
            <div class="buyers_guide_unique_border_wrap">
            	<div class="buyers_guide_unique_circle"></div> <hr/> <div class="buyers_guide_unique_circle circle_right"></div>
            </div>
            <?php the_content(); ?>
            
            <?php endwhile; // End of the loop.
			?>
           <!-- share on social sites cont --> 
           <div class="bg-pink-light mb-50 p-4 rounded">
           		<div class="row">
            		<div class="col-lg-3 py-2">
                    	<h6 class="text-uppercase text-center pb-3">share this article</h6>
                    </div>
                    
                    <div class="col-lg-5 text-center">
                    	<button class="btn btn_facebook btn-primary"><i class="fa fa-facebook-square"></i> <span>FACEBOOK</span></button>
                        <button class="btn btn_twitter btn-info"><i class="fa fa-twitter"></i> <span>TWITTER</span></button>
                    </div>
            	</div>
           </div>
            
         
    	  
          <!-- article items container starts here --> 
		  <?php

			$related = get_posts( array( 'category__in' => wp_get_post_categories($post->ID), 'numberposts' => 3, 'post__not_in' => array($post->ID) ) );
			if( $related ){
			?>
          <h6 class="text-center text-uppercase">you may also like</h6>
          <div class="row pt-70">
			<?php
			 foreach( $related as $post ) {
				setup_postdata($post); 
				$postid = $post->ID ;
				$taxonomy = 'category';
				$args1 = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
				$terms = wp_get_post_terms( $postid, $taxonomy, $args1 );
			?>
        	<div class="col-lg-4 col-md-4 text-center mb-5">
            <div class="card border-0">	
            	<img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="" class="img-fluid rounded">
                	<div class="border-0">	
                		<p class="font-weight-bold text-uppercase text_brown py-3 mb-0"><?php echo $terms[0]->name ?></p>
               			<p class="font-weight-bold intro_para"> <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
               		</div>
            </div>
            </div>
            <?php } wp_reset_postdata(); ?>
            
        </div>
			<?php } ?>
        
        
          </div>
          </div>
          
     </div>
  
</section>
<!-- ends body content area -->

<?php
get_footer();
