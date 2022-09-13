AOS.init({
	// once: true
	// disable: 'mobile'
	disable: window.innerWidth < 767
});

$.noConflict();

(function($){
'use strict';




if( $('.hero')[0] ){

	$('.hero .discover').on('click', function(e){
		e.preventDefault();

		$('html, body').animate({
			scrollTop: $(window).height()
		}, 800);
	});

}







/*---------------------------------------------------------*/
/*	HERO SLIDER
/*---------------------------------------------------------*/
if( $('.news-slider')[0] ){

	$('.news-slider').owlCarousel({
		items:              1,
		loop:               true,
		nav: 								true,
		dots: 							false,
		smartSpeed:         1200,
		autoplay:           false,
		// autoplay:           true,
		autoplayTimeout:    4000,
		autoplayHoverPause: true,
		animateOut: 				'fadeOut',
    // animateIn: 'fadeIn',
	});

}





/*---------------------------------------------------------*/
/*	EVENTS SLIDER
/*---------------------------------------------------------*/
if( $('.events-slider')[0] ){

	$('.events-slider').owlCarousel({
		items:              1,
		loop:               true,
		nav: 								true,
		dots: 							false,
		smartSpeed:         1200,
		// autoplay:           false,
		autoplay:           true,
		autoplayTimeout:    3000,
		autoplayHoverPause: true,
    margin: 						20,
    responsive:{
			0:{
				items: 1,
				stagePadding: 15,
			},
			440:{
				items: 2
			},
			768:{
				items: 3
			},
			991:{
				items: 3
			}
		}
	});

}






/*---------------------------------------------------------*/
/*	MAP
/*---------------------------------------------------------*/
if( $('.gmap')[0] ){

	var _map = $('.gmap'),
			_lat = _map.data('lat'),
			_lng = _map.data('lng'),
			_zoom = _map.data('zoom');

	_map.gmap3({
		center:[_lat, _lng],
		zoom: _zoom,
		scrollwheel: false
	})
	.marker({
		position:[_lat, _lng],
		icon: window.location.origin + '/wp-content/themes/aprh/assets/images/marker.png'
	});

}//$('.default-map')







/*---------------------------------------------------------*/
/*	POSTS NAVIGATION
/*---------------------------------------------------------*/
if( $('.nav-posts')[0] ){

	var _top = Math.round( $('.nav-posts').offset().top );

	$('.nav-posts')
	.affix({
		offset: {
			top: _top
		}
	})
	.on('affix.bs.affix', function(){

		if( $(window).width() > 991 ){
			$(this).css({'marginTop': 142});
		}else if( $(window).width() <= 991 ){
			$(this).css({'marginTop': 95});
		}

	})
	.on('affix-top.bs.affix', function(){
		$(this).css('marginTop', 0);
	});

	$('.nav-posts').width( $('.nav-posts').parent().width() );

}






/*---------------------------------------------------------*/
/*	GALLERY
/*---------------------------------------------------------*/
if( $('.gallery')[0] ){

	$('.gallery .gallery-item')
	.simpleLightbox({
		history: false
	})
	.on('open.simplelightbox', function(){

	});

}






/*---------------------------------------------------------*/
/*	MASONRY
/*---------------------------------------------------------*/
if( $('.masonry-layout')[0] ){
	$(window).load(function(){
		$('.masonry-layout').masonry();
	});

}






/*---------------------------------------------------------*/
/*	GALLERY PAGE
/*---------------------------------------------------------*/
if( $('.gallery-page')[0] ){
	$('.gallery-page .gallery-item a').on('click', function(e){
		e.preventDefault();

		var _id = $(this).attr('href');


		$.getJSON('/wp-json/wp/v2/galerias/'+_id, function(_data){

			$('.gallery-lightbox').html('');

			$.map(_data.acf.gallery, function(v,i){
				$('.gallery-lightbox').append('<a href="'+ v.url +'">'
					+'<img src="'+ v.url +'"  title="'+ v.title +'" />'
				+'</a>');
			});


			$('.gallery-lightbox a').simpleLightbox({
				history: false,
				// captionsData: 'data-title'
			})
			.on('close.simplelightbox', function () {
			  $('.gallery-lightbox').html('');
			});

			$('.gallery-lightbox a:eq(0)').trigger('click');

		});

	});
}











function hideAddThisOnScroll(){

	if( $(window).width() < 991 ){

		if( $(window).scrollTop() > 200 ){
			$('.addthis_inline_share_toolbox_3dez').css({opacity: 0, visibility: 'hidden'});
		}else{
			$('.addthis_inline_share_toolbox_3dez').css({opacity: 1, visibility: 'visible'});
		}

	}

}


hideAddThisOnScroll();


$(window).scroll(function(){
	hideAddThisOnScroll();
});







// Subnav function on responsive viewports
function subnav(){

	if( $(window).width() <= 767 ){
		$('.menu-item-has-children button').on('click', function(){
			// console.log('xoxo');

			var _b = $(this);

			if( _b.find('span').hasClass('ti-angle-down') ){
				_b.parent().addClass('has-children-active');
				_b.find('span').attr('class','ti-close');
			}else{
				_b.parent().removeClass('has-children-active');				
				_b.find('span').attr('class','ti-angle-down');
			}

		});
	}

}



subnav();

$(window).resize(function(){
	subnav();
});



})(jQuery)












