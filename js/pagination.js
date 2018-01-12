$(document).ready(function(){
	
	$('.multiple-items').slick({
	  mobilefirst:true,
	  infinite:false,
	  slidesToShow: 3,
  	  slidesToScroll: 1,
	  zIndex = '1000',
	  prevArrow: $('.prev'),
      nextArrow: $('.next'),
       responsive: [
    {
      breakpoint: 800,
      settings: {
      mobilefirst:true,
      slidesToShow: 2,
  	  slidesToScroll: 1,
      }
    },
    ]
	});


});