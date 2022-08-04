jQuery(function ($) {
    if ($(window).width() > 769) {
        $('.navbar .dropdown').hover(function () {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(250).slideDown();

        }, function () {
            $(this).find('.dropdown-menu').first().stop(true, true).delay(100).slideUp();

        });

        $('.navbar .dropdown > a').click(function () {
            location.href = this.href;
        });

    }

	// Slider
    /*
    jQuery('.banner-one').slick({
          slidesToShow: 1,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 5000,
          infinite: true,
          dots: false,
          arrows: true,
          fade: true,
          responsive: [
                {
                  breakpoint: 1024,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                  }
                },
                {
                  breakpoint: 800,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                },
                {
                  breakpoint: 400,
                  settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                  }
                }
              ]
        });
        */

	// Owl sliders
    if (jQuery().owlCarousel) {

        $('.brands').owlCarousel({
			loop:true,
			margin:10,
			responsiveClass:true,
			nav:true,
			dots: false,
			navText: ['<i class="fa fa-angle-left fa-2x"></i>', '<i class="fa fa-angle-right fa-2x"></i>'],
			autoplay: true,
			responsive:{
				0:{
					items:2
				},
				600:{
					items:3
				},
				1000:{
					items:5
				}
			}
		})
    }



	// Sticky Navigation
    if (jQuery().sticky) {
        jQuery(".navbar").sticky({
            topSpacing: 0,
        });;
    }
    var shrinkHeader = 100;
    jQuery(window).scroll(function () {
        var scroll = getCurrentScroll();
        if (scroll >= shrinkHeader) {
            jQuery('.navbar').addClass('shrink');
        } else {
            jQuery('.navbar').removeClass('shrink');
        }
    });

    function getCurrentScroll() {
        return window.pageYOffset || document.documentElement.scrollTop;
    }


});

