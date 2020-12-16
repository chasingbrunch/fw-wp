//video pause button

jQuery('.slide-caption > .pause').click(function() {
	
	var player = jQuery(this).parent().prev().prev('.youtube-background').children('.widescreen').children('iframe');
	
	if( jQuery(this).hasClass('paused') ) {
		
		player.show();
		
		jQuery(this).removeClass('paused');
		
	}
	
	else {
		
		player.hide();
		
		jQuery(this).addClass('paused');
		
	}  
  
});

