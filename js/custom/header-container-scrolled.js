// Adding "scrolled" event listener to header wrapper to make CSS rule for adjacent siblings easier.
jQuery(document).ready(function($){
	$(window).on('scroll', function(e) {
		if ($(window).scrollTop() == 0) {
			$('#header-container').removeClass();
		} else {
			$('#header-container').addClass('scrolled');
		}
	});
});
