// remap jQuery to $
(function($){})(window.jQuery);


/* trigger when page is ready */
$(document).ready(function (){

	$('datepicker').datepicker();
	$('.textarea').wysihtml5();

	// your functions go here

});


/* optional triggers

$(window).load(function() {
	
});

$(window).resize(function() {
	
});

*/