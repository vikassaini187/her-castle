
jQuery(document).ready(function(){
	"use strict";

	var window_width 	 = jQuery(window).width(),
	window_height 		 = window.innerHeight,
	header_height 		 = jQuery(".default-header").height(),
	header_height_static = jQuery(".site-header.static").outerHeight(),
	fitscreen 			 = window_height - header_height;


	jQuery(".fullscreen").css("height", window_height)
	jQuery(".fitscreen").css("height", fitscreen);

     if(document.getElementById("default-select")){
         jQuery('select').niceSelect();
    };

    jQuery('.img-pop-up').magnificPopup({
        type: 'image',
        gallery:{
        enabled:true
        }
    });


    jQuery('.play-btn').magnificPopup({
        type: 'iframe',
        mainClass: 'mfp-fade',
        removalDelay: 160,
        preloader: false,
        fixedContentPos: false
    });


    //  Counter Js 

    jQuery('.counter').counterUp({
        delay: 10,
        time: 1000
    });    


  // Initiate superfish on nav menu
  jQuery('.nav-menu').superfish({
    animation: {
      opacity: 'show'
    },
    speed: 400
  });

  // Mobile Navigation
  if (jQuery('#nav-menu-container').length) {
    var $mobile_nav = jQuery('#nav-menu-container').clone().prop({
      id: 'mobile-nav'
    });
    $mobile_nav.find('> ul').attr({
      'class': '',
      'id': ''
    });
    jQuery('body').append($mobile_nav);
    jQuery('body').prepend('<button type="button" id="mobile-nav-toggle"><i class="lnr lnr-menu"></i></button>');
    jQuery('body').append('<div id="mobile-body-overly"></div>');
    jQuery('#mobile-nav').find('.menu-has-children').prepend('<i class="lnr lnr-chevron-down"></i>');

   jQuery(document).on('click', '.menu-has-children i', function(e) {
      jQuery(this).next().toggleClass('menu-item-active');
      jQuery(this).nextAll('ul').eq(0).slideToggle();
      jQuery(this).toggleClass("lnr-chevron-up lnr-chevron-down");
    });

    jQuery(document).on('click', '#mobile-nav-toggle', function(e) {
      jQuery('body').toggleClass('mobile-nav-active');
      jQuery('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
      jQuery('#mobile-body-overly').toggle();
    });

    jQuery(document).click(function(e) {
      var container = jQuery("#mobile-nav, #mobile-nav-toggle");
      if (!container.is(e.target) && container.has(e.target).length === 0) {
        if (jQuery('body').hasClass('mobile-nav-active')) {
          jQuery('body').removeClass('mobile-nav-active');
          jQuery('#mobile-nav-toggle i').toggleClass('lnr-cross lnr-menu');
          jQuery('#mobile-body-overly').fadeOut();
        }
      }
    });
  } else if ($("#mobile-nav, #mobile-nav-toggle").length) {
    jQuery("#mobile-nav, #mobile-nav-toggle").hide();
  }

  // Smooth scroll for the menu and links with .scrollto classes
  jQuery('.nav-menu a, #mobile-nav a, .scrollto').on('click', function() {
    if (location.pathname.replace(/^\//, '') == this.pathname.replace(/^\//, '') && location.hostname == this.hostname) {
      var target = $(this.hash);
      if (target.length) {
        var top_space = 0;

        if (jQuery('#header').length) {
          top_space = jQuery('#header').outerHeight();

          if( ! jQuery('#header').hasClass('header-fixed') ) {
            top_space = top_space;
          }
        }

        jQuery('html, body').animate({
          scrollTop: target.offset().top - top_space
        }, 1500, 'easeInOutExpo');

        if (jQuery(this).parents('.nav-menu').length) {
          jQuery('.nav-menu .menu-active').removeClass('menu-active');
          jQuery(this).closest('li').addClass('menu-active');
        }

        if (jQuery('body').hasClass('mobile-nav-active')) {
          jQuery('body').removeClass('mobile-nav-active');
          jQuery('#mobile-nav-toggle i').toggleClass('lnr-times lnr-bars');
          jQuery('#mobile-body-overly').fadeOut();
        }
        return false;
      }
    }
  });


    jQuery(document).ready(function() {

    jQuery('html, body').hide();

        if (window.location.hash) {

        setTimeout(function() {

        jQuery('html, body').scrollTop(0).show();

        jQuery('html, body').animate({

        scrollTop: jQuery(window.location.hash).offset().top-129

        }, 1000)

        }, 0);

        }

        else {

        jQuery('html, body').show();

        }

    });
  

  // Header scroll class
  jQuery(window).scroll(function() {
    if (jQuery(this).scrollTop() > 100) {
      jQuery('#header').addClass('header-scrolled');
    } else {
      jQuery('#header').removeClass('header-scrolled');
    }
  });


    /* $('.active-realated-carusel').owlCarousel({
        items:1,
        loop:true,
        margin: 100,
        dots: true,
        nav:true,
        navText: ["<span class='lnr lnr-arrow-up'></span>","<span class='lnr lnr-arrow-down'></span>"],                
        autoplay:true,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1,
            },
            768: {
                items: 1,
            }
        }
    });


    $('.active-about-carusel').owlCarousel({
        items:1,
        loop:true,
        margin: 100,
        nav:true,
        navText: ["<span class='lnr lnr-arrow-up'></span>",
        "<span class='lnr lnr-arrow-down'></span>"],
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1,
            },
            768: {
                items: 1,
            }
        }
    });


    $('.active-offered-carusel').owlCarousel({
        items:3,
        loop:true,
        autoplay:true,
        margin:30,
        dots: true,
        responsive:{    
        0:{
          items: 1
        },
        480:{
          items: 1
        },
        801:{
          items: 3
        }
    }
    });

    $('.active-info-carusel').owlCarousel({
        items:1,
        loop:true,
        margin: 100, 
        dots: true,    
        autoplay:true,
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1,
            },
            768: {
                items: 1,
            }
        }
    });


    $('.active-review-carusel').owlCarousel({
        items:2,
        margin:30,
        autoplay:true,
        loop:true,
        dots: true,       
            responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1,
            },
            768: {
                items: 2,
            }
        }
    });


        $('.active-testimonials-slider').owlCarousel({
        items:3,
        loop:true,
        margin: 30,
        dots: true,
        autoplay:true,    
        responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1,
            },
            768: {
                items: 2,
            },
            801: {
                items: 3,
            }            
        }
    });


    $('.active-fixed-slider').owlCarousel({
        items:3,
        loop:true,
        dots: true,
        nav:true,
        navText: ["<span class='lnr lnr-arrow-up'></span>",
        "<span class='lnr lnr-arrow-down'></span>"],        
            responsive: {
            0: {
                items: 1
            },
            480: {
                items: 1,
            },
            768: {
                items: 2,
            },
            900: {
                items: 3,
            }

        }
    }); */




    //  Start Google map 

            // When the window has finished loading create our google map below

            if(document.getElementById("map")){
            
            google.maps.event.addDomListener(window, 'load', init);
        
            function init() {
                // Basic options for a simple Google Map
                // For more options see: https://developers.google.com/maps/documentation/javascript/reference#MapOptions
                var mapOptions = {
                    // How zoomed in you want the map to start at (always required)
                    zoom: 11,

                    // The latitude and longitude to center the map (always required)
                    center: new google.maps.LatLng(40.6700, -73.9400), // New York

                    // How you would like to style the map. 
                    // This is where you would paste any style found on Snazzy Maps.
                    styles: [{"featureType":"water","elementType":"geometry","stylers":[{"color":"#e9e9e9"},{"lightness":17}]},{"featureType":"landscape","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":20}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"},{"lightness":17}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"color":"#ffffff"},{"lightness":29},{"weight":0.2}]},{"featureType":"road.arterial","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":18}]},{"featureType":"road.local","elementType":"geometry","stylers":[{"color":"#ffffff"},{"lightness":16}]},{"featureType":"poi","elementType":"geometry","stylers":[{"color":"#f5f5f5"},{"lightness":21}]},{"featureType":"poi.park","elementType":"geometry","stylers":[{"color":"#dedede"},{"lightness":21}]},{"elementType":"labels.text.stroke","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"lightness":16}]},{"elementType":"labels.text.fill","stylers":[{"saturation":36},{"color":"#333333"},{"lightness":40}]},{"elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"geometry","stylers":[{"color":"#f2f2f2"},{"lightness":19}]},{"featureType":"administrative","elementType":"geometry.fill","stylers":[{"color":"#fefefe"},{"lightness":20}]},{"featureType":"administrative","elementType":"geometry.stroke","stylers":[{"color":"#fefefe"},{"lightness":17},{"weight":1.2}]}]
                };

                // Get the HTML DOM element that will contain your map 
                // We are using a div with id="map" seen below in the <body>
                var mapElement = document.getElementById('map');

                // Create the Google Map using our element and options defined above
                var map = new google.maps.Map(mapElement, mapOptions);

                // Let's also add a marker while we're at it
                var marker = new google.maps.Marker({
                    position: new google.maps.LatLng(40.6700, -73.9400),
                    map: map,
                    title: 'Snazzy!'
                });
            }
    }


        /* $(document).ready(function() {
            $('#mc_embed_signup').find('form').ajaxChimp();
        });  */     








 });
