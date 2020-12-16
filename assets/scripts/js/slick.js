jQuery(document).ready(function(){
	
	
	jQuery('.hero-slider').slick({
	  slidesToShow: 1,
	  infinite: true,
	  arrows: false,
	  autoplay: true,
	  dots: true,
	  pauseOnHover: false,
	  pauseOnFocus: false,
	  fade: true,
	  cssEase: 'linear'
	  
	});
	
	jQuery('.highlight-reel').slick({
	  slidesToShow: 3,
	  infinite: false,
	  arrows: true,
	  autoplay: false,
	  dots: false,
	  nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>'
	  
	});
	
	jQuery('.filmstrip-slider').slick({
	  slidesToShow: 5,
	  infinite: false,
	  arrows: true,
	  autoplay: false,
	  dots: false,
	  nextArrow: '<button type="button" class="slick-next"><i class="fa fa-chevron-right"></i></button>'
	  
	});
	
	jQuery('.highlight-slider').slick({
	  centerMode: true,
	  centerPadding: '180px',
	  slidesToShow: 1,
	  infinite: true,
	  arrows: true,
	  prevArrow:'<button type="button" class="slick-prev"><h6><i class="fa fa-long-arrow-left"></i> Previous</h6></button>',
	  nextArrow:'<button type="button" class="slick-next"><h6>Next <i class="fa fa-long-arrow-right"></i></h6></button>'/*,
	  responsive: [
	    {
	      breakpoint: 1200,
	      settings: {
	        centerMode: false,
	        centerPadding: '40px',
	        slidesToShow: 1
	      }
	    },
	    {
	      breakpoint: 480,
	      settings: {
	        centerMode: false,
	        centerPadding: '0',
	        slidesToShow: 1
	      }
	    }
	  ]*/
	});

});