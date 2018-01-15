$(document).ready(function(){
	
	$('.multiple-items').slick({
	  // mobilefirst:true,
	  infinite:false,
    vertical: true,
	  slidesToShow: 3,
  	slidesToScroll: 1,
	  prevArrow: $('.prev'),
    nextArrow: $('.next'),
    responsive: [{
      breakpoint: 800,
      settings: {
        vertical:false,
        slidesToShow: 2,
        slick: true,
      }
    }]
	});


});