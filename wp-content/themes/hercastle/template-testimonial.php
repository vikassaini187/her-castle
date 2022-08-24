<?php
/* Template Name: Testimonial Page */
get_header();
global $post;
$post_id = $post->ID ;
 ?>
<!-- sectin starts -->

<?php 
$paged1 = get_query_var('paged') ? get_query_var('paged') : 1;
$args = array(
	'posts_per_page' => 9,
	'paged' => $paged1,
	'orderby'=> array('ID'=>'ASC'),
	'post_type' => 'spt_testimonial',
);
$post_query = new WP_Query( $args );
								
?>
<section class="pt-100">



  <div class="container">
    <div class="row">
	<div class="testimonial-title">
		<h2>Client Testimonials</h2>
	</div>
		<?php $i = 1; while ( $post_query->have_posts() ) : $post_query->the_post(); 
			
			$postid = get_the_id();
			$meta = get_post_meta($postid);
			$testimonial_meta = unserialize($meta['sp_tpro_meta_options'][0]);
			$reviewer_name = $testimonial_meta['tpro_name'];
			$reviewer_position = $testimonial_meta['tpro_designation'];
			$website_link = get_post_meta( $postid, 'website_link', 'true' );
			if($i%2 != 0){
		?>
        <div class="col-md-6">
      <div class="test-wrap">
        
          <?php if ( has_post_thumbnail() ) { ?>
          <div class="client-image"><img src="<?php echo the_post_thumbnail_url( 'thumbnail' ); ?>"alt="" /></div>
			<?php } ?>
        	<?php if($reviewer_name != ""){ ?>
              <div class="c-name"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $reviewer_name ; ?></div>
			  <?php } ?>
			  <?php if($reviewer_position != ""){ ?>
              <div class="b-name"> <?php echo $reviewer_position ; ?></div>
			   <?php } ?>
      
          <div class="test-content">
            <?php the_content(); ?>
            <div class="inn">
			
			   <?php if($website_link != ""){ ?>
              <div class="site-name"><a href="<?php echo $website_link ; ?>" target="_blank"><?php echo $website_link ; ?></a></div>
			   <?php } ?>
            </div>
          </div>
        
      </div>
      </div>
		<?php }  else { ?>
         <div class="col-md-6">
			<div class="test-wrap">
        
        <?php if($reviewer_name != ""){ ?>
					<div class="c-name"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <?php echo $reviewer_name ; ?></div>
				<?php } ?>
				<?php if($reviewer_position != ""){ ?>
					<div class="b-name"> <?php echo $reviewer_position ; ?></div>
			  <?php } ?>
          <div class="test-content">
            <?php the_content(); ?>
            <div class="inn">
				
			  <?php if($website_link != ""){ ?>
				<div class="site-name"><a href="<?php echo $website_link ; ?>" target="_blank"><?php echo $website_link ; ?></a></div>
			  <?php } ?>
            </div>
          </div>
        
        
        
			<?php if ( has_post_thumbnail() ) { ?>
          <div class="client-image"><img src="<?php echo the_post_thumbnail_url( 'thumbnail' ); ?>"alt="" /></div>
			<?php } ?>
        </div>
      
      </div>
		<?php } ?>
      <?php $i++; endwhile; wp_reset_postdata() ?>
    </div>
  </div>
</section>
<!-- sectin ends -->
<?php
get_footer();
?>
