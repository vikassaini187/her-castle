<?php
/* Template Name: Blog Page */
get_header();
 ?>

<section class="pt-150 pb-150 sm-pb-0 h-100 light_pink_bg position-relative">

	<div class="container pt-70 pb-70 bg-white rounded">
		<div class="row">
			<!-- blog container starts here -->
			<div class="col-lg-11 m-auto px-0 col-md-10">    
				<div id="newdev_nav">
					<ul class="text-left nav nav-tabs" role="tablist">
						<li><a href="#allarticles" class="active" data-toggle="tab">all articles</a></li>
						<?php
						$terms = get_terms( array(
							'taxonomy' => 'category',
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
			
				<!-- blog items container starts here -->	
				<div class="tab-content">
					<div id="allarticles" class="tab-pane active">
						<div class="row pt-70" id="allposts">
							<?php 
								$paged1 = get_query_var('paged') ? get_query_var('paged') : 1;
								$args = array(
									'posts_per_page' => 9,
									'paged' => $paged1,
									'orderby'=> array('ID'=>'ASC'),
									'post_type' => 'post',
								);
								$post_query = new WP_Query( $args );
								
								while ( $post_query->have_posts() ) : $post_query->the_post();
								$postid = get_the_id();
								$taxonomy = 'category';
								$args1 = array('orderby' => 'name', 'order' => 'ASC', 'fields' => 'all');
								$terms = wp_get_post_terms( $postid, $taxonomy, $args1 );
								
							?>
							<div class="col-lg-4 col-md-4 text-center mb-5">
								<div class="card border-0">
									<img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="" class="img-fluid rounded w-100">
									<div class="card-body">
										<p class="font-weight-bold text-uppercase text_brown py-3 mb-0 p-brown-title"><?php echo $terms[0]->name ; ?></p>
										<p class="avn_bold blog-desc"> <a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a></p>
									</div>
								</div>
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
									<li><a href="javascript:void(0);" class="<?php if($j== 1){ echo 'active'; } ; ?> getpost1" id="page_<?php echo $j ; ?>" rel="<?php echo $j ; ?>"><?php echo $j; ?></a></li>
									<?php } ?>
								</ul>
							</div>
						<?php } wp_reset_postdata(); ?>
					</div>
					<?php
						$terms1 = get_terms( array(
							'taxonomy' => 'category',
							'hide_empty' => true,
						) );
						if  ($terms1) {
						 foreach ($terms1  as $taxonomy1 ) {
					?>
						<div id="<?php echo trim($taxonomy1->slug) ; ?>" class="tab-pane fade">
							<div class="row pt-70" id="allcatposts">
							<?php 
								$paged = get_query_var('paged') ? get_query_var('paged') : 1;
								$args1 = array(
									'posts_per_page' => 9,
									'paged' => $paged,
									'orderby'=> array('ID'=>'ASC'),
									'post_type'        => 'post',
									'tax_query' => array(
										array(
											'taxonomy' => 'category',
											'field' => 'slug',
											'terms' => $taxonomy1->slug
										)
									 )
								);
								$post_query1 = new WP_Query( $args1 );
								
								while ( $post_query1->have_posts() ) : $post_query1->the_post();
								
							?>
							<div class="col-lg-4 col-md-4 text-center mb-5">
								<div class="card border-0">
									<img src="<?php echo the_post_thumbnail_url( 'full' ); ?>" alt="" class="img-fluid rounded w-100">
									<div class="card border-0">	
										<p class="font-weight-bold text-uppercase text_brown py-3 mb-0 p-brown-title"><?php echo $taxonomy1->name; ?></p>
										<p class="avn_bold blog-desc"><a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>"><?php echo the_title() ; ?></a></p>
									</div>
								</div>
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
					<?php
						}
						}
					?>
				</div>
				 <!-- bottom pagination starts here -->
			</div>
		</div>
    </div>

	
    
    
    
    
</section>
<!-- ends body content area -->
 <?php
get_footer();
?>