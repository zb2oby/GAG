$(document).ready(function(){
    
  const $slider = $('.multiple-items');
  $slider
    .on('mouseover', () => {
      mouseWheel($slider)
    })
    .slick({
      infinite:false,
      vertical: true,
      verticalSwiping: true,
      slidesToShow: 3,
      slidesToScroll: 2,
      // initialSlide: initial,
      prevArrow: $('.prev'),
      nextArrow: $('.next'),
      responsive: [{
        breakpoint: 850,
        settings: {
          vertical:false,
          verticalSwiping: false,
          //initialSlide: 3,
          slidesToShow: 3,
          slick: true,
        }
      }]
    })
  function mouseWheel($slider) {

    $(window).on('wheel', { $slider: $slider }, mouseWheelHandler)
  }
  function mouseWheelHandler(event) {
    // event.preventDefault()
    const $slider = event.data.$slider
    const delta = event.originalEvent.deltaY
    if(delta > 0) {
      $slider.slick('slickPrev')
    }
    else {
      $slider.slick('slickNext')
    }
  }

  $slider.mouseleave(function(event) {
    $(window).off('wheel');
  });

  //on affiche le slide le plus proche de la date du jour
  var initial = $('.closest').parent().parent().data('slick-index');
  var linkActive = $('.link-active').parent().parent().data('slick-index');

  if (typeof linkActive != 'undefined') {
    $slider.slick('slickGoTo', linkActive, true);
  }else{
    $slider.slick('slickGoTo', initial, true);
  }
  
  


});