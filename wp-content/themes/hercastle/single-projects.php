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

	<!-- start tour btns option -->
<section class="pt-100">
	<div class="container-fluid bg-white" id="search_bar_property">
    	<div class="row pt-3">
        	<div class="col-lg-10 align-center">
            	<i class="fa fa-angle-left fa-pull-left pc_view_only p-3"></i>
            	<span class="float-left">
                	<h5 style="font-weight:normal"><?php echo get_the_title(); ?></h5>
                </span>
        	</div>
            
            <div class="col-lg-2 text-center" id="booktoursection">
            	<button class="btn btn-outline-secondary badge-pill px-3 col-lg-8 col-12">Register Now</button>
            </div>
    </div>
    </div>
  
</section>
<!-- End tour btns option --> 

<!-- object slider starts here -->
<section class="pt-1">
  <div class="container-fluid" id="slider">
    <div id="sliderbanner" class="carousel slide" data-ride="carousel"> 
        <ol class="carousel-indicators">
			<li data-target="#sliderbanner" data-slide-to="0" class="active"></li>
			<li data-target="#sliderbanner" data-slide-to="1"></li>
			<li data-target="#sliderbanner" data-slide-to="2"></li>
			<li data-target="#sliderbanner" data-slide-to="3"></li>
		</ol>
        
        <div class="carousel-inner" id="inner_page_slider" role="listbox">
          <div class="carousel-item text-center active"> <img src="<?php echo get_field( "slider_1", $post_id ); ?>" class="img-fluid w-100"></div>
          <div class="carousel-item text-center"> <img src="<?php echo get_field( "slider_2", $post_id ); ?>" class="img-fluid w-100"></div>
          <div class="carousel-item text-center"> <img src="<?php echo get_field( "slider_3", $post_id ); ?>" class="img-fluid w-100"></div>
          <div class="carousel-item text-center"> <img src="<?php echo get_field( "slider_4", $post_id ); ?>" class="img-fluid w-100"></div>
        </div>
        <!--<a class="carousel-control-prev" href="#sliderbanner" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
        <a class="carousel-control-next" href="#sliderbanner" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> -->
        </div>
  </div>
</section>
<!-- object slider ends here -->


<!-- start property result search area -->
<section class="pt-60">
	<div class="container-fluid">
    	<div class="row">
        
        	<!-- left section -->
           
        	<div class="col-lg-8">
            	<div class="project-div"><div class="project-content">
                	<?php

						/* Start the Loop */
						while ( have_posts() ) :
							the_post();

							echo the_content();
						 endwhile; // End of the loop.
						?>
                        </div>
                 </div>
                
               <div class="project-div py-5">
                	<h4 class="text-uppercase pb-5">additional information</h4>
                    	<div class="row" id="additional_info">
                    		<div class="col-lg-6">
                            	<h5><span class="float-left">Developers : </span> <span class="float-right text-right"><?php echo get_field( "developers", $post_id ); ?></span></h5>
                            </div>
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Builder : </span> <span class="float-right text-right"><?php echo get_field( "builder", $post_id ); ?></span></h5>
                            </div>
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Architect : </span> <span class="float-right text-right"><?php echo get_field( "architects", $post_id ); ?></span></h5>
                            </div>
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Interior Desiger : </span> <span class="float-right text-right"><?php echo get_field( "interior_desiger", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Location : </span> <span class="float-right text-right"><?php echo get_field( "location", $post_id ); ?></span></h5>
                            </div>
                            
							<div class="col-lg-6">
                            	<h5><span class="float-left">Suite Size Range : </span> <span class="float-right text-right"><?php echo get_field( "suite_size_range", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Maintenance Fee : </span> <span class="float-right text-right"><?php echo get_field( "maintenance_fee", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Parking Maintenance Fee : </span> <span class="float-right text-right"><?php echo get_field( "parking_maintenance_fee", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Estimated Occupancy : </span> <span class="float-right text-right"><?php echo get_field( "expected_occupancy", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Number of Storeys : </span> <span class="float-right text-right"><?php echo get_field( "_number_of_storeys", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Total Number of Suites : </span> <span class="float-right text-right"><?php echo get_field( "total_number_of_suites", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Price / sqft from : </span> <span class="float-right text-right"><?php echo get_field( "price_sqft_from", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Parking Price : </span> <span class="float-right text-right"><?php echo get_field( "parking_price", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Locker Price : </span> <span class="float-right text-right"><?php echo get_field( "locker_price", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Status : </span> <span class="float-right text-right"><?php echo get_field( "status", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Est. Property tax : </span> <span class="float-right text-right"><?php echo get_field( "est_property_tax", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Main Intersection : </span> <span class="float-right text-right"><?php echo get_field( "main_intersection", $post_id ); ?></span></h5>
                            </div>
                            
                            <div class="col-lg-6">
                            	<h5><span class="float-left">Maintenance expected at : </span> <span class="float-right text-right"><?php echo get_field( "maintenance_expected_at", $post_id ); ?></span></h5>
                            </div>
							
                    	</div>
                </div>
                
                <div class="project-div py-5">
                	<h4 class="text-uppercase pb-5">gallery</h4>
                    <div id="inner_thumb_gallery">
						<div class="row">
							 <?php $gallery1 = get_field( "gallery_1", $post_id );
							if($gallery1 != "")
							{
							?>
							<div class="col-md-4 col-6">
							 <div class="img-wrap">
                             <a href="<?php echo get_field( "gallery_1", $post_id ); ?>" data-toggle="lightbox" data-gallery="gallery">
							  <img class="img-fluid" src="<?php echo get_field( "gallery_1", $post_id ); ?>" alt="">
							</a>
                            </div>
                            </div>
							<?php } ?>
							 <?php $gallery2 = get_field( "gallery_2", $post_id );
							if($gallery2 != "")
							{
							?>
                            <div class="col-md-4 col-6">
							 <div class="img-wrap">
							<a href="<?php echo get_field( "gallery_2", $post_id ); ?>" data-toggle="lightbox" data-gallery="gallery">
							 <img class="img-fluid" src="<?php echo get_field( "gallery_2", $post_id ); ?>" alt="">
							</a>
                            </div></div>
							<?php } ?>
                             <?php $gallery3 = get_field( "gallery_3", $post_id );
							if($gallery3 != "")
							{
							?>
                            <div class="col-md-4 col-6">
							 <div class="img-wrap">
							<a href="<?php echo get_field( "gallery_3", $post_id ); ?>" data-toggle="lightbox" data-gallery="gallery">
							  <img class="img-fluid" src="<?php echo get_field( "gallery_3", $post_id ); ?>" alt="">
							</a>
						  </div></div>
						  <?php } ?>
                           <?php $gallery4 = get_field( "gallery_4", $post_id );
							if($gallery4 != "")
							{
							?>
                          <div class="col-md-4 col-6">
							 <div class="img-wrap">
							<a href="<?php echo get_field( "gallery_4", $post_id ); ?>" data-toggle="lightbox" data-gallery="gallery">
							  <img class="img-fluid" src="<?php echo get_field( "gallery_4", $post_id ); ?>" alt="">
							</a>
                            </div>
                            </div>
							<?php } ?>
							 <?php $gallery5 = get_field( "gallery_5", $post_id );
							if($gallery5 != "")
							{
							?>
                            <div class="col-md-4 col-6">
							 <div class="img-wrap">
							<a href="<?php echo get_field( "gallery_5", $post_id ); ?>" data-toggle="lightbox" data-gallery="gallery">
							  <img class="img-fluid" src="<?php echo get_field( "gallery_5", $post_id ); ?>" alt="">
							</a>
                            </div></div>
							<?php } ?>
                            <?php $gallery6 = get_field( "gallery_6", $post_id );
							if($gallery6 != "")
							{
							?>
                            <div class="col-md-4 col-6">
							 <div class="img-wrap">
							<a href="<?php echo get_field( "gallery_6", $post_id ); ?>" data-toggle="lightbox" data-gallery="gallery">
							  <img class="img-fluid" src="<?php echo get_field( "gallery_6", $post_id ); ?>" alt="">
							</a>
                            </div>
							</div>
							<?php } ?>
                            <?php $gallery7 = get_field( "gallery_7", $post_id );
							if($gallery7 != "")
							{
							?>
                            <div class="col-md-4 col-6">
							 <div class="img-wrap">
							<a href="<?php echo get_field( "gallery_6", $post_id ); ?>" data-toggle="lightbox" data-gallery="gallery">
							  <img class="img-fluid" src="<?php echo get_field( "gallery_6", $post_id ); ?>" alt="">
							</a>
                            </div>
							</div>
                            <?php } ?>
							<?php $gallery8 = get_field( "gallery_8", $post_id );
							if($gallery8 != "")
							{
							?>
                            <div class="col-md-4 col-6">
							 <div class="img-wrap">
							<a href="<?php echo get_field( "gallery_8", $post_id ); ?>" data-toggle="lightbox" data-gallery="gallery">
							  <img class="img-fluid" src="<?php echo get_field( "gallery_8", $post_id ); ?>" alt="">
							</a>
                            </div>
							</div>
                            <?php } ?>
							<?php $gallery9 = get_field( "gallery_9", $post_id );
							if($gallery9 != "")
							{
							?>
                            <div class="col-md-4 col-6">
								<div class="img-wrap">
									<a href="<?php echo get_field( "gallery_9", $post_id ); ?>" data-toggle="lightbox" data-gallery="gallery">
										<img class="img-fluid" src="<?php echo get_field( "gallery_9", $post_id ); ?>" alt="">
									</a>
								</div>
							</div>
                            <?php } ?>
						</div>
                    </div>
                </div>
            </div>
            <!-- right section -->
            <div class="col-lg-3">
                
                <div class="alert border">
                	<?php echo do_shortcode('[contact-form-7 id="325" title="Project Detail Page Form"]'); ?>
                </div>
                
            </div>
        </div>
    </div>
</section>
<!-- ends property result search area -->

<?php
get_footer();
