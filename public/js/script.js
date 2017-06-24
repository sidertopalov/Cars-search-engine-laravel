$(function(){
	// 'use strict';
	//Slider
	// var $owl = $('.owl');
	// $owl.each( function() {
	// 	var $carousel1 = $(this);
	// 	$carousel1.owlCarousel({
	// 		items : $carousel1.attr('data-items'),
	// 		itemsDesktop : [1199,$carousel1.attr('data-itemsDesktop')],
	// 		itemsDesktopSmall : [979,$carousel1.attr('data-itemsDesktopSmall')],
	// 		itemsTablet:  [797,$carousel1.attr('data-itemsTablet')],
	// 		itemsMobile :  [640,$carousel1.attr('data-itemsMobile')],
	// 		navigation : JSON.parse($carousel1.attr('data-buttons')),
	// 		pagination: JSON.parse($carousel1.attr('data-pag')),
	// 		slideSpeed: 1000,
	// 		paginationSpeed : 1000,
	// 		navigationText : false
	// 	});
	//  });
	// $(window).load(function()
	// {
	// 	$('.preloader p').fadeOut();
	// 	$('.preloader').delay(500).fadeOut('slow');
	// 	$('body').delay(600).css({'overflow':'visible'});
	// });
	//Counterup
	// $('.counter').counterUp({
	// 	delay: 10,
	// 	time: 2000
	// });
	// function height_w()
	// {
	// 	$('.navbar-nav').css('max-height',$(window).height()-165);
	// }
	// window.onresize = function()
	// {
	// 	height_w();
	// }
	//Slider
	$( ".slider-range" ).slider({
      range: true,
      min: 0,
      max: 200000,
	  step: 1000,
      values: [ 20000, 120000 ],
      slide: function( event, ui ) {
         $( ".slider_amount" ).val( "BGN " + ui.values[ 0 ].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + "- BGN " + ui.values[ 1 ].toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
      }
    });
    $( ".slider_amount" ).val( "BGN " + $( ".slider-range" ).slider( "values", 0 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") + " - BGN " + $( ".slider-range" ).slider( "values", 1 ).toString().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") );
	

});