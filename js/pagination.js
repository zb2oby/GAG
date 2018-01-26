$(document).ready(function(){
	
	$('.multiple-items').slick({
	  infinite:false,
    vertical: true,
	  slidesToShow: 4,
  	slidesToScroll: 2,
    initialSlide: 4,
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



  
const $slider = $('.multiple-items');
$slider
  .on('init', () => {
    mouseWheel($slider)
  })
  .slick({
    slidesToScroll: 4,
    vertical: true,
    infinite: false,
  })
function mouseWheel($slider) {
  $(window).on('wheel', { $slider: $slider }, mouseWheelHandler)
}
function mouseWheelHandler(event) {
  event.preventDefault()
  const $slider = event.data.$slider
  const delta = event.originalEvent.deltaY
  if(delta > 0) {
    $slider.slick('slickPrev')
  }
  else {
    $slider.slick('slickNext')
  }
}

});