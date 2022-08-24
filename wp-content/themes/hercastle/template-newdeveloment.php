<?php
/* Template Name: New Development Page */
get_header();
global $post;
$post_id = $post->ID ;
 ?>

<script>
$('#btnReview').click(function(){
    $('#allprojects').tab('show')
});
</script>

<!-- start result option -->
<section class="pt-100">
	<div class="container bg-white py-5" id="search_bar_property">
		<div class="row">
			<div class="col-lg-3">
			
				<?php

					$argspage = array(
					'orderby'=> array('ID'=>'ASC'),
					'post_type' => 'projects',
				);
				$post_query_page = new WP_Query( $argspage );
				 $count = $post_query_page->found_posts;
				?>
				<h6 class="py-2">Result: <?php echo $count; ?> projects</h6>
			</div>
			
			<!-- navigation right -->
			<div class="col-lg-9">
            <div id="newdev_nav" style="margin-top:0;">
				<ul class="nav nav-tabs" role="tablist">
					<li class="active"><a href="#allprojects" class="active" data-toggle="tab">All projects</a></li>
					<?php
						$terms = get_terms( array(
							'taxonomy' => 'projectcity',
							'hide_empty' => true,
						) );
						if  ($terms) {
						foreach ($terms  as $taxonomy ) {
						?>
						<li><a href="#<?php echo trim($taxonomy->slug) ; ?>" data-filter="<?php echo trim($taxonomy->slug) ; ?>" data-toggle="tab"><?php echo $taxonomy->name ; ?></a></li>
						<?php
						}
					}
					?>
				</ul>
			</div>
			</div>
		</div>
	</div>
</section>
<!-- End result option --> 


<!-- start property result search area -->
<section class="pt-0">
<!-- property results display area -->
	<div class="container px-0">
    
    <div class="panel-body">
      <div class="tab-content vikas">
        <div class="tab-pane fade in active" id="allprojects">
			<div class="row" id="allcatprojects">
			<?php 
				$paged1 = get_query_var('paged') ? get_query_var('paged') : 1;
				$args = array(
					'posts_per_page' => 9,
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
				<?php endwhile; ?>
			</div>
			<?php
			$total_pages1 = $post_query->max_num_pages;
			if ($total_pages1 > 1){
			$current_page1 = max(1, get_query_var('paged'));
			?>
				<div id="prop_pagination">
					<ul class="pagination justify-content-center">
						<?php for($j = 1; $j <= $total_pages1; $j++ ){ ?>
						<li><a href="javascript:void(0);" class="<?php if($j== 1){ echo 'active'; } ; ?> getprojects1" id="page_<?php echo $j ; ?>" rel="<?php echo $j ; ?>"><?php echo $j; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			<?php } wp_reset_postdata(); ?>
        </div>
		
		<?php
			$terms1 = get_terms( array(
				'taxonomy' => 'projectcity',
				'hide_empty' => true,
			) );
			if  ($terms1) {
			 foreach ($terms1  as $taxonomy1 ) {
		?>
        <div class="tab-pane fade" id="<?php echo trim($taxonomy1->slug) ; ?>">
			<div class="" id="catprojects">
				<?php 
					$paged = get_query_var('paged') ? get_query_var('paged') : 1;
					$args1 = array(
						'posts_per_page' => 9,
						'paged' => $paged,
						'orderby'=> array('ID'=>'ASC'),
						'post_type'        => 'projects',
						'tax_query' => array(
							array(
								'taxonomy' => 'projectcity',
								'field' => 'slug',
								'terms' => $taxonomy1->slug
							)
						 )
					);
					$post_query1 = new WP_Query( $args1 );
					
					while ( $post_query1->have_posts() ) : $post_query1->the_post();
					$postid1 = get_the_id();
				?>
				<div class="col-lg-4 col-sm-4 text-center mb-5">
					<a href="<?php the_permalink(); ?>"><img class="img-fluid w-100" src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt=""></a>
					<img class="img-fluid w-100" src="<?php echo get_field( "project_logo", $postid1 ); ?>" alt="">
					<h3 class="mt-0 my-2 text-capitalize"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<p class="text-dark"><?php echo $taxonomy1->name; ?></p>
					<a class="btn btn_more_details badge-pill" href="<?php the_permalink() ?>">More Details</a>
				</div>
				<?php endwhile; ?>
			</div>
			<?php
			$total_pages = $post_query1->max_num_pages;
			if ($total_pages > 1){
			$current_page = max(1, get_query_var('paged'));
			?>
				<div id="prop_pagination">
					<ul class="pagination justify-content-center">
						<?php for($i = 1; $i <= $total_pages; $i++ ){ ?>
						<li><a href="javascript:void(0);" class="<?php if($i== 1){ echo 'active'; } ; ?> getpostbycat" id="catpage_<?php echo $i ; ?>" rel="<?php echo $i ; ?>" data-cat="<?php echo trim($taxonomy1->slug) ; ?>"><?php echo $i; ?></a></li>
						<?php } ?>
					</ul>
				</div>
			<?php } wp_reset_postdata(); ?>
        </div>
			<?php } } ?>
        </div>
    </div>
    
    
    
    
    
    
    
    
    
    
    
		<!--<div class="row">
			<div class="col-lg-4 col-sm-4 text-center mb-5">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd1.png" alt="">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd_logo1.png" alt="">
				<h3 class="mt-0 my-2 text-capitalize">Kingsway & Royal York</h3>
				<p class="text-dark">Toronto</p>
				<a class="btn btn_more_details badge-pill">More Details</a>
			</div>
			
			<div class="col-lg-4 col-sm-4 text-center mb-5">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd2.png" alt="">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd_logo2.png" alt="">
				<h3 class="mt-0 my-2 text-capitalize">Leslie & Eglinton</h3>
				<p class="text-dark">Etobicoke</p>
				<a class="btn btn_more_details badge-pill">More Details</a>
			</div>
			
			<div class="col-lg-4 col-sm-4 text-center mb-5">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd3.png" alt="">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd_logo3.png" alt="">
				<h3 class="mt-0 my-2 text-capitalize">Front & Spadina</h3>
				<p class="text-dark">North York</p>
				<a class="btn btn_more_details badge-pill">More Details</a>
			</div>
			
			<div class="col-lg-4 col-sm-4 text-center mb-5">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd4.png" alt="">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd_logo4.png" alt="">
				<h3 class="mt-0 my-2 text-capitalize">Queens Quay & Sherbourne</h3>
				<p class="text-dark">Scarborough</p>
				<a class="btn btn_more_details badge-pill">More Details</a>
			</div>
			
			<div class="col-lg-4 col-sm-4 text-center mb-5">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd5.png" alt="">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd_logo5.png" alt="">
				<h3 class="mt-0 my-2 text-capitalize">Eva & 427</h3>
				<p class="text-dark">Toronto</p>
				<a class="btn btn_more_details badge-pill">More Details</a>
			</div>
			
			<div class="col-lg-4 col-sm-4 text-center mb-5">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd6.png" alt="">
				<img class="img-fluid w-100" src="<?php echo bloginfo('template_url'); ?>/img/new_developments/nd_logo6.png" alt="">
				<h3 class="mt-0 my-2 text-capitalize">Leslie & Eglinton</h3>
				<p class="text-dark">Etobicoke</p>
				<a class="btn btn_more_details badge-pill">More Details</a>
			</div>
		</div>-->
		
		
		<!-- pagination -->
			<!--<div id="prop_pagination">
				<ul class="pagination justify-content-center">
					<li><a href="#" class="active">1</a></li>
					<li><a href="#">2</a></li>
					<li><a href="#">3</a></li>
					<li>...</li>
					<li><a href="#">12</a></li>
				</ul>
			</div>-->
		
		</div>
	   

</section>
<!-- ends property result search area -->
 <?php
get_footer();
?>