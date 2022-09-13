AOS.init({
	once: true
});

$.noConflict();




(function($){
'use strict';


/*---------------------------------------------------------*/
/*	SCHEDULE
/*---------------------------------------------------------*/
$('#schedule .collapse')
.on('show.bs.collapse', function(){
	$('#schedule .collapse.in').collapse('hide');
	$(this).closest('.card').addClass('collapse-in');
})
.on('hide.bs.collapse', function(){
	$(this).closest('.card').removeClass('collapse-in');
});





})(jQuery)















