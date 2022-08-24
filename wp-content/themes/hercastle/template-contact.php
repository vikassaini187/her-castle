<?php
/* Template Name: Contact us Page */
get_header();
global $post;
$post_id = $post->ID ;
 ?>
 <!-- sectin starts -->
<section class="pt-100">
	<div class="container-fluid">
    	<div class="row">
        
        	<!-- left section -->
        	<div class="col-lg-7 py-5">
            	<div class="col-lg-10 offset-lg-1">
                	<!-- address starts here -->
					<?php echo get_field( "left_section_contact_page", $post_id ); ?>
                	
                </div>
            </div>
            
            
            <!-- right section -->
            <div class="col-lg-5 pt-100 pb-5 bg-light">
            	<div class="col-lg-8 offset-lg-1">
                	<div class="alert">
                	
					<?php echo do_shortcode('[contact-form-7 id="58" html_id="dark_inputfields" title="Contact us form"]'); ?>
                </div>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- sectin ends -->
 <?php
get_footer();
?>