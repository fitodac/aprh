/*---------------------------------------------------------*/
/*  NITRO v.1.0.0 (Beta)
/*  Author: Smartpixl
/*---------------------------------------------------------*/
(function($){



/*---------------------------------------------------------*/
/*  SCROLL TO TOP
/*---------------------------------------------------------*/
$('.scroll-to-top').addClass('opacity-0 invisible');

$(window).scroll(function(){
	var $winHeight = $(window).height();

	if( $(window).scrollTop() >= $winHeight/2 ){
		$('.scroll-to-top').removeClass('opacity-0 invisible');
	}else{
		$('.scroll-to-top').addClass('opacity-0 invisible');
	}
});





/*---------------------------------------------------------*/
/*	OPEN EXTERNAL LINKS IN NEW WINDOW
/*---------------------------------------------------------*/
$('a[href^="http"], a[href^="//"]').each(function(){
	var _this = $(this);
	if( _this.attr('target') != '_self' && _this.attr('href').indexOf(location.origin) < 0 )
		_this.attr('target', '_blank');
});

$('a[href^="' + window.location.origin + '"]').each(function(){
	var _this = $(this);
	if( _this.attr('target') != '_blank' )
		_this.attr('target', '_self');
});






/*---------------------------------------------------------*/
/*  MODALS (Bootstrap modals)
/*---------------------------------------------------------*/
if( $('.modal')[0] )
	$('.modal').each(function(){
		var _this = $(this);

		_this.on('show.bs.modal',function(e){
			_this.addClass('modal-showing');
		});

		_this.on('shown.bs.modal',function(e){
			_this.removeClass('modal-showing');
		});
	});





/*---------------------------------------------------------*/
/*  INITIALIZE TOOLTIPS (Bootstrap tooltips)
/*---------------------------------------------------------*/
if( $('[data-toggle="tooltip"]')[0] )
	$('[data-toggle="tooltip"]').tooltip();	




/*---------------------------------------------------------*/
/*  INITIALIZE POPOVERS (Bootstrap popovers)
/*---------------------------------------------------------*/
if( $('[data-popover-alone]')[0] ){

	var _popoverEl = $('[data-popover-alone]');
	// var _popoverEl = $('[data-toggle="popover"]');
	_popoverEl.on('click', function(e){
		console.log('coso');
		$('[data-toggle="popover"]').popover('destroy').popover({container: 'body'});
		$(this).popover('show');
	});

}


	


})(jQuery);










/*-----------------------------------------------*/
/*	BROWSER DETECT
/*-----------------------------------------------*/
(function($){
	var _prefix = 'browser-',
			_is_chrome = navigator.userAgent.indexOf('Chrome') > -1,
			_is_explorer = navigator.userAgent.indexOf('MSIE') > -1,
			_is_explorer_9 = navigator.userAgent.indexOf('9') > -1,
			_is_explorer_10 = navigator.userAgent.indexOf('10') > -1,
			_is_explorer_11 = navigator.userAgent.indexOf('11') > -1,
			_is_edge = navigator.userAgent.indexOf('Edge') > -1,
			_is_firefox = navigator.userAgent.indexOf('Firefox') > -1,
			_is_safari = navigator.userAgent.indexOf("Safari") > -1,
			_is_opera = navigator.userAgent.toLowerCase().indexOf("op") > -1;

	if( (_is_chrome)&&(_is_safari) )
		_is_safari = false;

	if( (_is_chrome)&&(_is_opera) )
		_is_chrome = false;

	if( (_is_chrome) )
		$('body').addClass(_prefix + 'chrome');

	if( (_is_explorer) )
		$('body').addClass(_prefix + 'msie');   

	if( (_is_edge) )
		$('body').addClass(_prefix + 'edge');   

	if( (_is_firefox) )
		$('body').addClass(_prefix + 'firefox');

	if( (_is_safari) )
		$('body').addClass(_prefix + 'safari'); 

	if( (_is_opera) )
		$('body').addClass(_prefix + 'opera');  

	if( (_is_explorer)&&(_is_explorer_9) )
			$('body').addClass(_prefix + 'msie-9');

	if( (_is_explorer)&&(_is_explorer_10) )
		$('body').addClass(_prefix + 'msie-10');

	if( (_is_explorer)&&(_is_explorer_11) )
		$('body').addClass(_prefix + 'msie-11');

}(jQuery));




/*-----------------------------------------------*/
/*	FAKE SCROLL
/*	Based on https://github.com/yairEO/fakescroll
/*-----------------------------------------------*/
(function($, win){
	"use strict";

	var docElm = document.documentElement,
			$doc   = $(document),
			raf = win.requestAnimationFrame
				 || win.webkitRequestAnimationFrame
				 || win.mozRequestAnimationFrame
				 || win.msRequestAnimationFrame
				 || function(cb) { return win.setTimeout(cb, 1000 / 60); },

			defaults = {};

	jQuery.fn.fakeScroll = function(settings){
		return this.each(function(idx, selector){
			var $el = $(this), // convert window to the HTML element
					fakeScroll;


			if(settings === 'destroy'){
				$el.removeData('_fakeScroll');
				$el.find('.fakeScrollBar').detach();
				var _content = $el.find('.scrollWrap > .scrollContent').children().clone(true,true);
				$el.html(_content);
				return;
			}


			// if element already the pluging bound to it, return
			if( $el.data('_fakeScroll') )
					return;

			// create a new FakeScroll instance
			fakeScroll = new FakeScroll($el, settings || {});
			// bind the FakeScroll instance to the DOM component
			$el.data('_fakeScroll', fakeScroll);
		});
	}

	// Mouse drag handler
	function dragDealer($el, FS_context){
		var lastPageY;

		$el.on('mousedown.drag', function(e) {
			lastPageY = e.pageY;
			$el.add(document.body).addClass('fakescroll-grabbed');
			$doc.on('mousemove.drag', drag).on('mouseup.drag', stop);
			return false;
		});

		function drag(e){
			var delta     = e.pageY - lastPageY;
					lastPageY = e.pageY;

			raf(function(){
				FS_context.el[0].scrollTop += delta / FS_context.scrollRatio;
			});
		}

		function stop() {
			$el.add(document.body).removeClass('fakescroll-grabbed');
			$doc.off("mousemove.drag mouseup.drag");
		}
	}

	// Constructor
	function FakeScroll($el, settings){
		// this.id = new Array(8).join((Math.random().toString(36)+'00000000000000000').slice(2, 18)).slice(0, 7); // generate an UID for each instance
		this.target = $el;
		this.bar = $('<div class="fakeScrollBar">');
		this.settings = $.extend({}, settings, defaults);
		this.callback = settings.callback ? settings.callback : null;
		this.maxScrollSoFar = 0;

		// wrap with needed DOM structure
		this.el = this.target.wrapInner('<div class="scrollWrap"><div class="scrollContent"></div></div>').find('.scrollContent');

		// insert the fake scroll bar into the container
		this.bar.appendTo(this.el.closest(this.target));
		// initiate drag controller on the instance
		dragDealer(this.bar, this);
		// run "moveBar" once
		this.moveBar();

		this.el.on('scroll.fakeScroll mouseenter.fakeScroll', this.moveBar.bind(this) );
	 	// $(win).on('resize.fakeScroll.' + this.id, this.moveBar.bind(this) );
	}

	FakeScroll.prototype = {
		destroy : function(){
			$el.off('scroll.fakeScroll mousedown.drag').removeData('_fakeScroll');
		},

		moveBar: function(e){
			var totalHeight = this.el[0].scrollHeight,
					ownHeight   = this.el[0].clientHeight,
					that        = this;

			this.scrollRatio = ownHeight / totalHeight;
			// update fake scrollbar location on the Y axis using requestAnimationFrame
			raf(function(){
				that.bar[0].style.cssText = 'height:' + (ownHeight / totalHeight) * 100 + '%; top:' + (that.el[0].scrollTop / totalHeight ) * 100 + '%';
			});
		}
	}



	$('.fake-scroll').fakeScroll();


})(jQuery, window);





/*---------------------------------------------------------*/
/*	SCROLL TO
/*---------------------------------------------------------*/
(function($){

	$.fn.scrollTo = function(options){
		return this.each(function(){
			
			var _this = $(this),

					opt = $.extend({
							target 		: _this.attr('href'),
							speed 		: 800,
							offset 		: 0,
							easing 		: 'easeInOutCubic'
					}, options);


			if( !opt.target )
				opt.target = _this.data('target');

			if( _this.data('speed') )
				opt.speed = _this.data('speed');

			if( _this.data('offset') )
				opt.offset = _this.data('offset');

			if( _this.data('easing') )
				opt.easing = _this.data('easing');


			if( opt.target )
				_this.on('click', function(e){
					e.preventDefault();

					if( $(opt.target).length > 0 )
						$('html, body').stop().animate({
							scrollTop: $(opt.target).offset().top + opt.offset,
							easing: opt.easing
						}, opt.speed);
					// }//if

					// console.log( '.scrollto' );
				});

		});
	}//scrollTo()


	if( jQuery('.scrollto')[0] )
		jQuery('.scrollto').scrollTo();

}(jQuery));





/*---------------------------------------------------------*/
/*	IMG to SVG
/*---------------------------------------------------------*/
(function($){

	if( $('img.svg')[0] ){

		$('img.svg').each(function(){
			var _img = $(this),
					_imgID = _img.attr('id'),
					_imgClass = _img.attr('class'),
					_imgURL = _img.attr('src'),
					_imgStyle = _img.attr('style');

			$.get(_imgURL, function(data){
				// Get the SVG tag, ignore the rest
				var _svg = jQuery(data).find('svg');

				// Add replaced image's ID to the new SVG
				if(typeof _imgID !== 'undefined')
					_svg = _svg.attr('id', _imgID);

				// Add replaced image's classes to the new SVG
				if(typeof _imgClass !== 'undefined')
					_svg = _svg.attr('class', _imgClass+' replaced-svg');


				// Remove any invalid XML tags as per http://validator.w3.org
				_svg = _svg.removeAttr('xmlns:a').attr('style', _imgStyle);

				// Replace image with new SVG
				_img.replaceWith(_svg);
			}, 'xml');

		});

	}

})(jQuery);




/*---------------------------------------------------------*/
/*  GROWL - Alerts plugin
/*  https://github.com/ifightcrime/bootstrap-growl
/*---------------------------------------------------------*/
// (function(){
// 	var $;

// 	$ = jQuery;

// 	$.nitroAlert = function(message, options){
// 		var _alert, css, offsetAmount;
		
// 		options = $.extend({}, $.nitroAlert.default_options, options);
		
// 		_alert = $('<div>');
		
// 		_alert.attr('class', 'nitro-alert alert fade');
// 		if( options.type ){
// 			_alert.addClass('alert-' + options.type);
// 		}

// 		if( options.allow_dismiss ){
// 			_alert.addClass('alert-dismissible');
// 			_alert.append('<button class="close" data-dismiss="alert" type="button"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>');
// 		}

// 		_alert.append(message);
// 		if( options.top_offset ){
// 			options.offset = {
// 				from: 'top',
// 				amount: options.top_offset
// 			};
// 		}

// 		offsetAmount = options.offset.amount;
		
// 		$('.nitro-alert').each(function(){
// 			return offsetAmount = Math.max(offsetAmount, parseInt($(this).css(options.offset.from)) + $(this).outerHeight() + options.stackup_spacing);
// 		});

// 		css = {
// 			'position': (options.container === 'body' ? 'fixed' : 'absolute'),
// 			'margin': 0,
// 			'z-index': '9999'
// 		};

// 		css[options.offset.from] = offsetAmount + 'px';

// 		_alert.css(css);
// 		if( options.width !== 'auto' ){
// 			_alert.css('width', options.width + 'px');
// 		}

// 		$(options.container).append(_alert);
// 		switch( options.align ){
// 			case 'center':
// 				_alert.css({
// 					'left': '50%',
// 					'margin-left': '-' + (_alert.outerWidth() / 2) + 'px'
// 				});
// 				break;
// 			case 'left':
// 				_alert.css('left', '20px');
// 				break;
// 			default:
// 				_alert.css('right', '20px');
// 		}

// 		setTimeout(function(){
// 			_alert.addClass('in');
// 		}, 200);

// 		if( options.delay > 0 ){
// 			setTimeout(function(){
// 				// return $(this).alert('close');
// 				_alert.alert('close');
// 			}, options.delay);
// 		}

// 		return _alert;
// 	};

// 	$.nitroAlert.default_options = {
// 		container: 'body',
// 		type: 'info', // info, success, warning, danger
// 		offset: {
// 			from: 'top',
// 			amount: 20
// 		},
// 		align: 'right',
// 		width: 250,
// 		autoHide: true,
// 		delay: 5000,
// 		allow_dismiss: true,
// 		stackup_spacing: 10
// 	};

// }).call(this);




/*---------------------------------------------------------*/
/*  MOUSE MOVE PARALLAX
/*---------------------------------------------------------*/
(function($){
	$.fn.mouseMoveParallax = function(options){

		this.each(function(){

			var _this = $(this),

					opt = $.extend({
						wrapper: _this
					}, options)

					_window = $(window);


			_window.on('mousemove', function(_e){
				var _w = _window.width(),
						_h = _window.height(),
						_offsetX = 0.5 - _e.pageX / _w,
						_offsetY = 0.5 - _e.pageY / _h;


				_this.find('.mmp-item').each(function(i, _el){

					if( $(_el).data('offset') ){
						var _offset = parseInt( $(_el).data('offset') );
					}else{
						var _offset = 10;
					}

					if( $(_el).data('index') ){
						$(_el).css('z-index', parseInt( $(_el).data('index') ) );
					}

					var _translate = 'translate3d(' + Math.round(_offsetX * _offset) + 'px,' + Math.round(_offsetY * _offset) + 'px, 0px)';


					$(_el).css({
					'transformStyle': 'preserve-3d',
					'-webkit-transform': _translate,
					'transform': _translate,
					'moz-transform': _translate
					});
				});
			});//mousemove


			// DESTROY
			if( options === 'destroy' ){
				_window.unbind('mousemove');

				// _this.find('.mmp-item').each(function(_index, _el){
				// 	console.log($(_el));
				// 	// $(_el).css('');
				// });
			}

		});//this

	};//mouseMoveParallax
}(jQuery));







/*---------------------------------------------------------*/
/*	AJAX SUBMIT
/*---------------------------------------------------------*/
(function($){
	'use strict';

	$.fn.ajaxForm = function(options){
		return this.each(function(){

			var form = $(this);

			var settings = $.extend({
					data 				: '',
					urlBin 			: location.origin + '/assets/bin/sendmail.php',
					onSuccess 	: function(){ 
						alert('Form Submitted!')
					},
					type 				: 'POST'
			}, options);


			$.ajax({
				type: settings.type,
				url: settings.urlBin,
				data: settings.data,
				success: function(){
					settings.onSuccess;
				}
			});

		});
	}//ajaxForm()

}(jQuery));
(function($){

	/*---------------------------------------------------------*/
	/*	NAVBAR TOGGLE
	/*---------------------------------------------------------*/
	$.fn.navbarToggle = function(options){
		return this.each(function(){

			$(window).unbind('scroll');


			var _this = $(this),

					opt = $.extend({
						class 		: _this.data('navbar-toggle'),
						offset 		: _this.data('navbar-offset'),
					}, options),

				_top = parseInt(_this.offset().top),
				_height = parseInt(_this.outerHeight(true));

				if( !opt.offset ){ opt.offset = 20; }

				var _limit = parseInt(_top + _height + opt.offset),
						_spacer = $('<div class="spacer"/>'),
						_spacer_css = {
							'height': _height,
							'marginBottom': -(_height),
							'position': 'relative',
							'zIndex': -2
						};


			

			if( _this.prev('.spacer').length === 0 ){
				_spacer.css(_spacer_css);
				_this.before(_spacer);
			}else{
				_this.prev('.spacer').css(_spacer_css);
			}





			function scrollEvent(){

				var _scrollTop = $(window).scrollTop();

				if( _scrollTop >= (_limit + 20) ){
					_this.removeClass('out').addClass('in');
				}else{
					_this.addClass('out');
				}

				if( _scrollTop >= _limit ){	
					_this.addClass(opt.class);
				}else{	
					_this.removeClass(opt.class);
					_this.removeClass('in');
					_this.removeClass('out');
				}

			}//scrollEvent()




			scrollEvent();


			$(window).scroll(function(){
				scrollEvent();
			});


		});
	}//navbarToggle()



	if( $('[data-navbar-toggle]')[0] )
		$('[data-navbar-toggle]').navbarToggle();








	/*---------------------------------------------------------*/
	/*	NAV STACKED
	/*---------------------------------------------------------*/
	$.fn.navbarStacked = function(options){
		return this.each(function(){
			
			var _this = $(this);


			_this.find('.nav-item').each(function(){
				
				var _navItem = $(this),
						_childrenStaked = _navItem.find('.nav-stacked');


				if( _childrenStaked[0] ){

					var _subNavStacked = _navItem.find('> .nav-stacked');


					// Navigate
					_navItem.find('> .nav-link').on('click', function(e){
						e.preventDefault();

						_subNavStacked.addClass('in');
						_this.addClass('active');
					});



					// Create a back element
					if( _subNavStacked.is('ul') ){
						_subNavStacked.prepend('<li class="nav-back"><a href="#"></a></li>');
					}else{
						_subNavStacked.prepend('<div class="nav-back"><a href="#"></a></div>');
					}



					// Back method
					_subNavStacked.find('.nav-back a').on('click', function(e){
						e.preventDefault();
						$(this).closest('.in').removeClass('in');
						$(this).closest('.nav-stacked-push').removeClass('active');

						if( _subNavStacked.find('.scrollContent')[0] )
							_subNavStacked.find('.scrollContent').scrollTop(0);
					});



					// Use fakeScroll if height of the children subnav is greater than its parent
					var _navItem = _subNavStacked.find('> .nav-item'),
							_navItemHeight = _navItem.height(),
							_elHeight = _navItemHeight * _navItem.length;

					_subNavStacked.find('.nav-back').height(_elHeight);

					if( _elHeight > _this.height() ){
						_subNavStacked.fakeScroll();
						_subNavStacked.find('.scrollContent').scrollTop(0);
					}

				}

			});

		});
	}//navbarStacked()



	if( $('.nav-stacked-push')[0] )
		$('.nav-stacked-push').navbarStacked();



})(jQuery);











(function($){

	/*---------------------------------------------------------*/
	/*	OFF CANVAS
	/*---------------------------------------------------------*/
	$.fn.offCanvas = function(options){
		return this.each(function(){

			var _this = $(this),
					_sidebar = _this.find('> .off-canvas-sidebar');



			if( _this.data('__offcanvas') )
				return;
			else
				_this.data('__offcanvas', true)



			// OVERLAY
			var _overlay = $('<div class="off-canvas-overlay"></div>');
			_this.append(_overlay);

			_overlay.on('click', function(){
				_this.removeClass('in');
			});


			// OFFSET
			if( _this.data('offset') )
				var _offset = _sidebar.outerWidth() - _this.data('offset');
				_sidebar.css({'transform': 'translate3d(-'+ _offset +'px,0,0)'});


			// HOVER
			if( _this.hasClass('off-canvas-hover') )
				_sidebar.on('mouseenter', function(e){
					e.stopPropagation();
					_this.addClass('in');
				})
				.on('mouseleave', function(e){
					e.stopPropagation();
					_this.removeClass('in');
				});



			// BUTTONS
			if( $('[data-offcanvas-target]')[0] )
				$('[data-offcanvas-target]').each(function(){

					var _btn = $(this),
							_target = _btn.data('offcanvasTarget');

					if( $(_target)[0] )
						_btn.on('click', function(){

							$(_target).addClass('in');

						});

				});

		});
	}//offCanvas()





	if($('.off-canvas-wrapper')[0])
		$('.off-canvas-wrapper').offCanvas();


})(jQuery);





