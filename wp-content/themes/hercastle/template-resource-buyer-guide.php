<?php
/* Template Name: Resource Buyer Guide */
get_header();
global $post;
$post_id = $post->ID ;
 ?>
 <!-- start body conetent area -->
<section class="pt-150 pb-150 sm-pb-0 h-100 light_pink_bg position-relative">
	<div class="col-lg-9 m-auto pt-70 pb-70 bg-white rounded">
    
    	<!-- resources_buyers_guide container -->
		<div class="col-lg-9 m-auto px-0">
        	<h2 class="text-center" style="font-family: 'PT Serif', serif !important; font-weight:bold;"><?php the_title(); ?></h2>
            
            <!-- unique border cont -->
            <div class="buyers_guide_unique_border_wrap">
            	<div class="buyers_guide_unique_circle"></div> <hr/> <div class="buyers_guide_unique_circle circle_right"></div>
            </div>
            
            <section class="pb-40 pt-0">
            <h3 class="avn_bold pb-2"><?php echo get_field( "section_one_heading_one", $post_id ); ?></h3>
            <h4 class="intro_para_inner avn_medium pb-2"><?php echo get_field( "section_one_heading_two", $post_id ); ?></h4>
            <p class="buyers-guide py-2 pt-font size18"><?php echo get_field( "section_one_text", $post_id ); ?></p>
            </section>
            
            <section class="pb-40 pt-0">
            <h3 class="avn_bold pb-2"><?php echo get_field( "section_two_heading_one", $post_id ); ?></h3>
            <h4 class="intro_para_inner avn_medium pb-2"><?php echo get_field( "section_two_heading_two", $post_id ); ?></h4>
            <ul id="articlepoints" class="intro_para py-2 pt-font">
            	<?php echo get_field( "section_two_text", $post_id ); ?>
            </ul>
            </section>
            
        </div>
		
    	
    </div>

	
    
    
    
    
</section>
<!-- ends body content area -->
 <?php
get_footer();
?>