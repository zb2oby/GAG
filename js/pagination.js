$(document).ready(function(){
	
	$('.multiple-items').slick({
	  infinite:false,
    vertical: true,
	  slidesToShow: 4,
  	slidesToScroll: 2,
    initialSlide: 3,
	  prevArrow: $('.prev'),
    nextArrow: $('.next'),
    responsive: [{
      breakpoint: 800,
      settings: {
        vertical:false,
        initialSlide: 3,
        slidesToShow: 3,
        slick: true,
      }
    }]
	});


});