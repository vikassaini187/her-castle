<?php
/**
 * Theme One
 */

$outline .= '<div class="sp-testimonial-free-item" itemscope itemtype="http://schema.org/Review">';

$outline .= '<div class="sp-testimonial-free">';

$outline .= '<div itemprop="itemReviewed" itemscope itemtype="http://schema.org/Thing">
							<meta itemprop="name" content="Testimonials">
						</div>';

if ( has_post_thumbnail( $post_query->post->ID ) ) {
	$outline .= '<div class="sp-tfree-client-image" itemprop="image">';
	$outline .= get_the_post_thumbnail( $post_query->post->ID, 'tf-client-image-size', array( 'class' => "tfree-client-image" ) );
	$outline .= '</div>';
}

if ( $testimonial_title == 'true' && get_the_title() !== '' ) {
	$outline .= '<div class="tfree-testimonial-title"><h3>' . get_the_title() . '</h3></div>';
}

if ( $testimonial_content == 'true' && get_the_content() !== '' ) {
	$outline .= '<div class="tfree-client-testimonial" itemprop="reviewBody">';

		$outline .= '<p class="tfree-testimonial-content">' . apply_filters( 'the_content', get_the_content() ) . '</p>';

	$outline .= '</div>';
}

if ( $reviewer_name == 'true' && $tfree_name !== '' ) {
	$outline .= '<div itemprop="author" itemscope itemtype="http://schema.org/Person">';
	$outline .= '<meta itemprop="name" content="' . $tfree_name . '">';
	$outline .= '<h2 class="tfree-client-name">' . $tfree_name . '</h2>';
	$outline .= '</div>';
}

if ( $star_rating == 'true' && $tfree_rating_star !== '' ) {

	switch ( $tfree_rating_star ) {
		case 'five_star':
			$rating_value = '5';
			break;
		case 'four_star':
			$rating_value = '4';
			break;
		case 'three_star':
			$rating_value = '3';
			break;
		case 'two_star':
			$rating_value = '2';
			break;
		case 'one_star':
			$rating_value = '1';
			break;
	}

	$outline .= '<div class="tfree-client-rating" itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">';
	$outline .= '<meta itemprop="worstRating" content="1"><meta itemprop="ratingValue" content="' . $rating_value . '"><meta itemprop="bestRating" content="5">';
	if ( $tfree_rating_star == 'five_star' ) {
		$outline .= $this->tfree_five_star;
	} elseif ( $tfree_rating_star == 'four_star' ) {
		$outline .= $this->tfree_four_star;
	} elseif ( $tfree_rating_star == 'three_star' ) {
		$outline .= $this->tfree_three_star;
	} elseif ( $tfree_rating_star == 'two_star' ) {
		$outline .= $this->tfree_two_star;
	} elseif ( $tfree_rating_star == 'one_star' ) {
		$outline .= $this->tfree_one_star;
	}
	$outline .= '</div>';
}

if ( $reviewer_position == 'true' && $tfree_designation !== '' ) {
	$outline .= '<div class="tfree-client-designation">';
		$outline .= $tfree_designation;
	$outline .= '</div>';
}

$outline .= '</div>'; // sp-testimonial-free.

$outline .= '</div>'; // sp-testimonial-free-item.
