<?php
/* Template Name: Send Request Page */
get_header();
global $post;
$post_id = $post->ID ;
 ?>
 <!-- sectin starts -->
<section class="pt-100 pb-100">
	<div class="container">
    	
        <!-- section starts -->
        	<div class="col-lg-7 py-5 offset-lg-2">
            		<h2 class="avn_bold fz-28 pb-5"><?php echo get_field( "form_heading", $post_id ); ?></h2>
                    
                    <!-- request form starts -->
                   <?php echo do_shortcode('[contact-form-7 id="62" title="Send Request Form"]'); ?>
            </div>
     </div>
</section>
<!-- sectin ends -->
 <?php
get_footer();
?>