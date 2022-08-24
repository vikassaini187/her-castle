<?php
/* Template Name: About us Page */
get_header();
global $post;
$post_id = $post->ID ;
 ?>
 <!-- start body conetent area -->
 <!-- start body conetent area -->
    <section class="pt-170">
        <div class="container pt-100">

            <!-- content body starts here -->
            <div class="col-lg-11 m-auto">
                <div class="col-lg-7 px-0" id="intro_text">
                    <h2 class="avn_bold"><?php echo get_field( "about_heading", $post_id ); ?></h2>
                </div>
                <hr class="border_brown my-5">


                <div class="col-lg-6 px-0 offset-lg-6">
                  <?php echo get_field( "section_one_right_text_one", $post_id ); ?>
                </div>

                <div class="row py-5 px-0">
                    <div class="col-lg-5"><img class="img-fluid w-100" src="<?php echo get_field( "section_one_left_image_one", $post_id ); ?>" alt=""></div>

                    <div class="col-lg-5"><img class="img-fluid w-100 about_img_topgap" src="<?php echo get_field( "section_one_left_image_two", $post_id ); ?>" alt=""></div>
                </div>
                <div class="col-lg-11 m-auto zero">
                    <div class="col-lg-6 pt-5 px-0 pb-30" id="intro_text">
                        <h2 class="avn_bold""><?php echo get_field( "section_two_heading", $post_id ); ?></h2>
                    </div>
                    <hr class="border_brown my-5">

                    <div class="col-lg-6 px-0 offset-lg-6 pb-5 zero">
                        <?php echo get_field( "section_two_text_middle", $post_id ); ?>
                    </div>
                 </div>



            </div>

            <!-- content body ends here -->

            <div class="col-lg-8 m-auto pt-5">
              <h5 class="text_brown pb-3 small-title"><?php echo get_field( "our_client_heading", $post_id ); ?></h5>
                <?php echo get_field( "our_client_text", $post_id ); ?>
            </div>


            <!-- client review section starts -->
            <div class="row pt-3">
                <div class="col-lg-4">
                    <div class="card border-0 pt-90">
                        <div class="card-body testimonial_bg text-center">
                            <img src="<?php bloginfo('template_url'); ?>/img/raquel-dasilva.jpg" class="testimonial_img rounded-circle" alt="">
                            <h5 class="card-title font-weight-bold">Raquel Dasilva</h5>
                            <p class="card-text text-muted"><i>Phibrows Artist & Eyebrow Specialist</i></p>
                            <p class="card-text px-4">Libertad was an outstanding agent. As first-time home buyers, there was a lot that my husband and I didn't know and were nervous about. Libertad was very patient and took the time to explain various legal and financial matters to us...</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 pt-90">
                        <div class="card-body testimonial_bg text-center">
                            <img src="<?php bloginfo('template_url'); ?>/img/alicia.jpg" class="testimonial_img rounded-circle" alt="">
                            <h5 class="card-title font-weight-bold">Alicia Henry</h5>
                            <p class="card-text text-muted"><i> Cosmetic Nurse Injector</i></p>
                            <p class="card-text px-4">Libertad is a very well organized, target oriented individual who get things done right and on time. She was in charge of helping me buy my first condo and has been managing it for me the last few years...</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="card border-0 pt-90">
                        <div class="card-body testimonial_bg text-center">
                            <img src="<?php bloginfo('template_url'); ?>/img/malinda-chohan.jpg" class="testimonial_img rounded-circle" alt="">
                            <h5 class="card-title font-weight-bold">Malinda Chohan</h5>
                            <p class="card-text text-muted"><i>Founder</i></p>
                            <p class="card-text px-4">Libertad helped us to buy our first home! In addition to having been a client, I've known Libertad in a professional capacity for about ten years. She is always sincere, caring, professional and very knowledgeable about the market...</p>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-2 m-auto py-5 text-center">
                <a href="<?php echo site_url(); ?>/testimonial/" class="btn btn_more_details badge-pill"><i class="fa fa-rotate-left"></i> More Reviews</a>
            </div>

            <!-- client review section ends -->

            <div class="col-lg-12 m-auto">
  

  

                    <!-- two image section -->
                    <div class="row py-5 px-0">
                        <div class="col-lg-6 zero"><img class="img-fluid w-100  img-gap" src="<?php echo get_field( "about_libertad_martinez_left_image", $post_id ); ?>" alt=""></div>

                        <div class="col-lg-6 zero">
							<h5 class="text_brown pb-3 small-title"><?php echo get_field( "about_libertad_martinez_heading", $post_id ); ?></h5>
							<?php echo get_field( "about_libertad_martinez_text", $post_id ); ?>
						</div>
                     </div>
                </div>
            </div>


<div class="container">
    <div class="row">
        <div class="our-team"> 
            <div class="col-lg-12 m-auto pt-5 zero">
                <h5 class="text_brown pb-3 small-title">Our Team</h5>
				<div class="team-section">
					<?php
					$paged1 = get_query_var('paged') ? get_query_var('paged') : 1;
					$args = array(
						'posts_per_page' => 3,
						'paged' => $paged1,
						'orderby'=> array('ID'=>'ASC'),
						'post_type' => 'ourclients',
					);
					$post_query = new WP_Query( $args );
					while ( $post_query->have_posts() ) : $post_query->the_post(); 
						$postid = get_the_id();
						$position = get_post_meta( $postid, 'position', 'true' );
					?>
					<div class="team-thumb">
						<img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="" class="img-fluid">
						<div class="team-info">
							<h3><?php the_title(); ?></h3>
							<p><?php echo $position ; ?></p>
						</div>
					</div>
					<?php endwhile; wp_reset_postdata() ?>
                </div>
            </div>
        </div>




        <div class="col-lg-11 m-auto we-support">
        	
                <div class="col-lg-6 pt-5 px-0 pb-100" id="intro_text">
                   <h2 class="avn_bold"><?php echo get_field( "bottom_heading", $post_id ); ?></h2>
					<a href="#" class="btn btn-outline-brown mt-4">Read More</a>
                    </div>


                </div>






            </div>
        </div>

    
    <div class="container px-0">
    <div class="row">
    	<div class="col-lg-10 px-0 m-auto">
    	<div id="invite_box" class="light_pink_bg text-center py-5 px-5 position-relative h-100" style="border-radius:20px;">
        	<h1 class="avn_bold"><?php echo get_field( "contact_section_heading", $post_id ); ?></h1>
            <p class="intro_para mt-3"><?php echo get_field( "contact_section_text", $post_id ); ?></p>
             <a class="btn btn-brown mt-4" href="<?php echo site_url();?>/contact-us">Contact Us</a>
        </div>
        </div>
     </div>
    </div>
</section>
<!-- ends body content area -->
 <?php
get_footer();
?>