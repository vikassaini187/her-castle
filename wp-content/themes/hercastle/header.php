<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Nineteen
 * @since 1.0.0
 */
?><!doctype html>
<html <?php language_attributes(); ?>>
<head>

 <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!--[if lt IE 9]>
  <script type='text/javascript' src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
  <script type='text/javascript' src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.js"></script>
<![endif]-->

	<meta name="" content=""/>
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="">
	<meta name="description" content="">
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<link rel="profile" href="https://gmpg.org/xfn/11" />
	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet">
<!--
			CSS
			============================================= -->
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/linearicons.css">
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/font-awesome.min.css">
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/bootstrap.css">
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/magnific-popup.css">
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/nice-select.css">
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/animate.min.css">
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/owl.carousel.css">
<link rel="stylesheet" href="<?php echo bloginfo('template_url'); ?>/css/main.css">
	<?php wp_head(); ?>
    
    
    
    
    <style type="text/css">
    
	#IDX-main{ font-family: 'AvenirNextCyr-Regular', sans-serif !important;}
		
    </style>
    
    
    
    
    
</head>

<body <?php body_class(); ?>>
<header id="header">
  <div class="container-fluid">
    <div class="row header-top align-items-center py-3">
      <div class="col-lg-3 menu-top-middle d-flex"> <a href="<?php echo site_url(); ?>"> 
	  <!-- <img class="img-fluid mobile_logo" src="<?php echo bloginfo('template_url'); ?>/img/logo.png" alt=""> -->
	  <svg class="mobile_logo" width="157" height="50" viewBox="0 0 157 50" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M52.0396 6.52297C52.0396 10.1809 54.7914 13.0459 58.4964 13.0459C60.9245 13.0459 62.3633 12.2891 63.6583 10.9016L61.8957 9.00962C60.9065 9.91058 60.0252 10.4872 58.5863 10.4872C56.4281 10.4872 54.9352 8.68528 54.9352 6.52297C54.9352 4.32462 56.464 2.55873 58.5863 2.55873C60.0252 2.55873 60.8525 3.08129 61.8238 3.96423L63.4784 2.05419C62.3094 0.900962 60.9784 0 58.6043 0C54.7374 0 52.0396 2.93714 52.0396 6.52297ZM93.9483 13.0459V7.98046H64.3879V5.30604H93.9483V0H96.8131V5.16246H102.096V0H104.961V13.0459H102.096V7.80892H96.8131V13.0459H93.9483Z" fill="#BC5F04"/>
<path fill-rule="evenodd" clip-rule="evenodd" d="M11.3881 49.2992H9.51244V42.4036H1.87569V49.2992H0V33.8513H1.87569V40.7469H9.51244V33.8513H11.3881V49.2992ZM29.2296 49.2992H19.2035V33.8513H29.2296V35.508H21.0792V40.7469H28.2694V42.4036H21.0792V47.5753H29.2296V49.2992ZM40.908 35.5528H38.2731V40.7469H41.1536C42.7613 40.6573 43.9225 39.7618 43.9225 38.1946C43.9225 36.5155 42.672 35.5528 40.908 35.5528ZM46.7137 49.3216H44.5477L40.5954 42.4484H38.2507V49.3216H36.3751V33.8736H40.8857C43.6099 33.8736 45.7758 35.4856 45.7758 38.217C45.7758 40.2319 44.4807 41.732 42.538 42.2021L46.7137 49.3216ZM68.9541 47.7768C71.0754 47.7768 72.6608 46.8813 73.5316 44.6201L75.2734 45.3365C74.1122 48.0679 71.8346 49.5231 68.9541 49.5231C64.1755 49.5231 61.9425 45.8962 61.9425 41.5752C61.9425 37.2543 64.1532 33.605 68.9317 33.605C71.8123 33.605 74.0676 35.0378 75.251 37.7692L73.5093 38.4856C72.8618 36.2244 71.0307 35.3513 68.9094 35.3513C65.3143 35.3513 63.7959 38.217 63.7959 41.4633C63.7959 44.8887 65.3143 47.7768 68.9541 47.7768ZM83.6693 45.941L82.4858 49.2992H80.4315L86.2596 33.8513H87.711L93.5167 49.2992H91.4847L90.3012 45.941H83.6693ZM84.2946 44.2395H89.676L86.9964 36.6274L84.2946 44.2395ZM103.967 49.4783C101.399 49.4783 98.9652 48.1126 98.5409 45.3141L100.327 44.7768C100.551 46.7917 102.136 47.7544 103.967 47.7544C105.753 47.7544 106.982 46.9037 106.982 45.0902C106.982 41.329 99.5681 42.2917 99.5681 37.5901C99.5681 35.1722 101.511 33.6274 103.833 33.6274C105.664 33.6274 107.205 34.3662 108.165 36.0901L106.714 37.0304C106.088 35.8438 104.994 35.2617 103.833 35.2617C102.56 35.2617 101.421 36.1125 101.421 37.4334C101.421 41.0155 108.835 40.0081 108.835 44.9783C108.835 47.7544 106.714 49.4783 103.967 49.4783ZM125.828 35.4408H120.67V49.2992H118.794V35.4408H113.636V33.8513H125.828V35.4408ZM140.208 49.2992H131.745V33.8513H133.621V47.5753H140.208V49.2992ZM156.71 49.2992H146.684V33.8513H156.71V35.508H148.559V40.7469H155.75V42.4036H148.559V47.5753H156.71V49.2992Z" fill="#2E2E2E"/>
</svg>
	  </a> </div>
	  
      <div class="col-lg-9">
		<?php 
			$slug1 = basename(get_permalink());
		?>
        <nav id="nav-menu-container">
          <ul class="nav-menu d-flex justify-content-around">
		  <li class="mobile_view_only"><a href="javascript:(void;)">Homepage</a></li>
            <li class="menu-has-children"><a href="javascript:(void;)">Properties</a>
              <ul class="p-2 rounded">
                <div class="row">
                  <div class="col-lg-12 AvenirNextCyr-Bold">
					   <li><a href="http://listings.hercastle.ca/idx/search/advanced">Advanced Search</a></li>
					  <li><a href="http://listings.hercastle.ca/idx/map/mapsearch">Map Search</a></li>
					   <li><a href="http://listings.hercastle.ca/idx/search/basic">Easy Search</a></li>
                    <li><a href="http://listings.hercastle.ca/i/home-for-sale-in-oakville-on">Properties to Buy</a></li>
                    <li><a href="http://listings.hercastle.ca/i/home-for-rent-in-oakville-on">Properties to Rent</a></li>
                  </div>
                </div>
              </ul>
            </li>
            <li><a href="<?php echo site_url(); ?>/new-development/" class="<?php if($slug1 == 'new-development'){ echo 'active'; } ?>">New Developments</a></li>
            <li><a href="<?php echo site_url(); ?>/about-us/" class="<?php if($slug1 == 'about-us'){ echo 'active'; } ?>">About us</a></li>
            <li><a href="<?php echo site_url(); ?>/resources/" class="<?php if($slug1 == 'resources'){ echo 'active'; } ?>">Resources</a></li>
            <li><a href="<?php echo site_url(); ?>/concierge-service/" class="<?php if($slug1 == 'concierge-service'){ echo 'active'; } ?>">Concierge</a></li>
            <li><a href="<?php echo site_url(); ?>/blog/" class="<?php if($slug1 == 'blog'){ echo 'active'; } ?>">Blog</a></li>
            <li><a href="<?php echo site_url(); ?>/contact-us/" class="<?php if($slug1 == 'contact-us'){ echo 'active'; } ?>">Contact Us</a></li>
            <li><a href="<?php echo site_url(); ?>/send-request/" class="badge-pill send_request_btn text-white">Send Request</a></li>
          </ul>
        </nav>
        <!-- #nav-menu-container --> 
      </div>
    </div>
  </div>
</header>
<!-- #header --> 