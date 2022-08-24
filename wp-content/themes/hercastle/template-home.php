<?php
/*
Template Name: Home Page
 */

get_header();
?>
<!-- start banner Area -->
<section class="">
  <div class="container-fluid" id="slider">
    <div class="row">
      <div id="sliderbanner" class="carousel slide" data-ride="carousel"> 
        <!--<ol class="carousel-indicators">
								<li data-target="#sliderbanner" data-slide-to="0" class="active"></li>
								<li data-target="#sliderbanner" data-slide-to="1"></li>
								<li data-target="#sliderbanner" data-slide-to="2"></li>
							</ol>-->
        
        <div class="carousel-inner" role="listbox">
			<?php 
				$args = array(
					'posts_per_page'   => 3,
					'post_type'        => 'homeslider',
				);
				$post_query = query_posts( $args );
				$i = 1 ;
				while ( have_posts() ) : the_post();
				$postid = get_the_id();
			?>
				  <div class="carousel-item text-center <?php if($i == 1){ echo "active" ; } ?>"> <img src="<?php echo get_field( "slider_image", $postid ); ?>" class="img-fluid" />
					<div class="carousel-caption d-md-block">
					  <h1 class="text-white AvenirNextCyr-Bold slider_title"><?php echo get_field( "slider_heading", $postid ); ?></h1>
					  <div class="col-lg-6 m-auto ">
						<div class="row my-5">
						  <div class="col-lg-6">
							<a href="http://listings.hercastle.ca/idx/search/advanced"><button class="btn btn-block btn-light badge-pill find_property_btns text_black">
							<svg class="float-left ml-3 mt-1" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M9 17C13.4183 17 17 13.4183 17 9C17 4.58172 13.4183 1 9 1C4.58172 1 1 4.58172 1 9C1 13.4183 4.58172 17 9 17Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M18.9999 18.9999L14.6499 14.6499" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
</svg>
							<?php echo get_field( "slider_button_one_text", $postid ); ?></button></a>
						  </div>
						  <div class="col-lg-6">
							  <a href="http://hercastle.ca/new-development/"><button class="btn btn-block btn-outline-light badge-pill find_property_btns"><?php echo get_field( "slider_button_two_text", $postid ); ?></button></a>
						  </div>
						</div>
					  </div>
					</div>
				  </div>
		  <?php $i++; endwhile; wp_reset_query(); ?>
		  
        </div>
        <!--<a class="carousel-control-prev" href="#sliderbanner" role="button" data-slide="prev"> <span class="carousel-control-prev-icon" aria-hidden="true"></span> <span class="sr-only">Previous</span> </a>
        <a class="carousel-control-next" href="#sliderbanner" role="button" data-slide="next"> <span class="carousel-control-next-icon" aria-hidden="true"></span> <span class="sr-only">Next</span> </a> -->
        </div>
    </div>
  </div>
</section>
<!-- End banner Area --> 


<!-- start body conetent area -->
<section class="pt-150">
	<div class="container">
    	<div class="col-lg-9 offset-lg-1" id="intro_text">
    		<h2 class="avn_bold text_default_color "><?php echo get_field( "top_heading", $post_id ); ?></h2>
        </div>
        
        <div class="col-lg-7 offset-lg-1 pt-80" id="intro_text">
        	<p class="fz-16 text_default_color">Choose your purpose</p>
    		<h3 class="avn_bold intro_links"><a href="#">Find property to buy</a></h3>
            <h3 class="avn_bold intro_links"><a href="#">Find property to rent</a></h3>
            <h3 class="avn_bold intro_links"><a href="#">Find new developments</a></h3>
        </div>
     </div>
</section>
<!-- ends body content area -->

<!-- starts middle content area -->
<section class="pt-170">
	<div class="container">
    	<div class="row" id="middle_sec_content">
         <div class="col-lg-6 order-sm-2 text-center">
            	<img src="<?php echo get_field( "right_image", $post_id ); ?>" alt="" class="img-fluid">
            </div>
            
        	<div class="col-lg-6 order-sm-1 pb-5">
            <div class="col-lg-10 pt-90">
            	<p class="intro_para-two"><?php echo get_field( "left_text_one", $post_id ); ?></p>
                
                <p class="intro_para-two"><?php echo get_field( "left_text_two", $post_id ); ?></p>
                
             <p class="fz-16 text_default_color pt-100">Need more info?</p>
    		<h3 class="avn_bold intro_links"><a href="#">Read more about HC</a></h3>
            <h3 class="avn_bold intro_links"><a href="#">Ask us your question</a></h3>
            </div>
            </div>
            
           
        </div>
    </div>
</section>
<!-- ends middle content area -->

<!-- starts bottom section -->
<section class="pt-150 pb-150">
	<div class="container-fluid">
    <div class="row">
    	<div class="light_pink_bg"></div>
    </div>
    	<div class="container">
    	<div class="row pt-150">
		<?php 
				$args = array(
					'posts_per_page'   => 3,
					'post_type'        => 'post',
				);
				$post_query = query_posts( $args );
				
				while ( have_posts() ) : the_post();
				$postid = get_the_id();
				$taxonomy = 'category';
				$args1 = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
				$terms = wp_get_post_terms( $postid, $taxonomy, $args1 );
			?>
        	<div class="col-lg-4 text-center mb-5">
            	<img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="" class="rounded">
                <p class="text-uppercase text_brown py-3 mb-0 p-brown-title"><?php echo $terms[0]->name ?></p>
                <p class="avn_bold blog-desc"><?php the_title(); ?>.</p>
            </div>
             <?php endwhile; wp_reset_query(); ?>
        </div>
        
        <h3 class="avn_bold intro_links mb-2 text-center"><a href="<?php echo site_url(); ?>/blog/">Read more articles</a></h3>
        </div>
        
    </div>
</section>
<!-- ends bottom section -->
<?php
get_footer();
