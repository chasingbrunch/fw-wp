jQuery( document ).ready(function() {
    
    if( jQuery( 'body' ).hasClass('page-template-template-events') || jQuery( 'body' ).hasClass('page-template-template-eventscurated-php')) {
	    
	    get_events();
	    
	    if (jQuery(window).width() < 760) {
		    
			jQuery( "h3" ).click();
			
		}
		
	    
    }
    
});

jQuery( ".hide-filters" ).click( function() {
	
	jQuery( "#sorting" ).addClass('hide-filters');
	

});	

jQuery( ".show-filters" ).click( function() {
	
	jQuery( "#sorting" ).removeClass('hide-filters');

});	

jQuery( "button.show-grid" ).click( function() {
	
	if( jQuery(this).hasClass('active') ) {
		
		
	}
	
	else {
		
		//jQuery( "#sorting" ).addClass('show-grid');
		//jQuery( "#sorting" ).removeClass('show-list');
		
		jQuery('#layout').val('cards');
		
		jQuery( 'button.show-grid' ).toggleClass('active');
		jQuery( 'button.show-list' ).toggleClass('active');
		
		get_events();
	
	}

});	

jQuery( "button.show-list" ).click( function() {
	
	if( jQuery(this).hasClass('active') ) {
		
		
	}
	
	else {
		
		//jQuery( "#sorting" ).removeClass('show-grid');
		//jQuery( "#sorting" ).addClass('show-list');
		
		jQuery('#layout').val('default');
		
		jQuery( 'button.show-grid' ).toggleClass('active');
		jQuery( 'button.show-list' ).toggleClass('active');
		
		get_events();
		
	}

});	

jQuery(document).on("click", ".events-sorting .tag", function(){

	var text = jQuery( this ).data('for');
		
	var input_id = "#" + text;
	
	jQuery( input_id ).prop('checked', false);
	
	jQuery(this).remove();
			
	if ( ! jQuery( '.tag' ).length ) {
			
		jQuery( ".tags" ).removeClass('has-tags');
			
	}
	
	var current_val = jQuery( input_id ).parent().siblings( "input[type=hidden]" ).val();
	var list = current_val.split(",");
	var first = list[0];
	
	if( first == "" ) {
		
		list.shift();
		
	}
	
	if( jQuery.inArray( text, list ) !== -1 ) {
		    
		var index = list.indexOf( text );
			
		list.splice( index, 1 );
			
	}

	var list_str = list.toString();
    
    jQuery( input_id ).parent().siblings( "input[type=hidden]" ).val( list_str );
	
	get_events();
	    
});

jQuery( ".events-sorting .clear-tags" ).click( function() { 
	
	jQuery( '.tag' ).remove();
	//jQuery( 'input[type="hidden"]' ).val('');
	
	jQuery( "#stage > input[type='hidden']" ).val('');
	jQuery( "#genre > input[type='hidden']" ).val('');
	jQuery( "#event-series > input[type='hidden']" ).val('');

	
	jQuery( "#sorting input" ).prop('checked', false);
	jQuery( ".tags" ).removeClass('has-tags');
	
	get_events();
});

jQuery(document).on("click", ".events-sorting .page-button", function(){
	
	var page = jQuery( this ).data('value');
	
	jQuery( "#current_page" ).val( page );	
		
	get_events();
});

jQuery(document).on("click", ".events-sorting .cb-prev", function(e){
	
	e.preventDefault();
	
	var current_page = jQuery( "#current_page" ).val();
	
	var new_page = parseInt( current_page ) - 1;
	
	console.log(new_page);
		
	jQuery( "#current_page" ).val( new_page );	
		
	get_events();
	
});

jQuery(document).on("click", ".events-sorting .cb-next", function(e){
	
	e.stopPropagation();
	
	var current_page = jQuery( "#current_page" ).val();
	
	var new_page = parseInt( current_page ) + 1;
	
	jQuery( "#current_page" ).val( new_page );	
		
	get_events();
	
});

//INPUT CLICK FUNCTIONS

jQuery( "#stage > label" ).click( function(evt) {

	var collection = jQuery(this).children('input').val();
	
	jQuery(this).children('input').prop('checked', true);
	
	jQuery( "#stage > input[type='hidden']" ).val(collection);
	
	add_tag( collection );
				
	jQuery( this ).siblings().each(function() {
			
		var sib = jQuery( this ).children('input').val();
			
		if( collection != sib ) {
				
			remove_tag( sib );
			
		}
					
	});
	
	get_events();
	
	evt.stopPropagation();
	evt.preventDefault();
    
});

jQuery( "#event-series > label" ).click( function(evt) {

	var material = jQuery(this).children('input').val();
	
	jQuery(this).children('input').prop('checked', true);
	
	jQuery( "#event-series > input[type='hidden']" ).val(material);
	
	add_tag( material );
				
	jQuery( this ).siblings().each(function() {
			
		var sib = jQuery( this ).children('input').val();
			
		if( material != sib ) {
				
			remove_tag( sib );
			
		}
					
	});
	
	get_events();
	
	evt.stopPropagation();
	evt.preventDefault();
    
});

jQuery( "#genre > label" ).unbind('click').bind('click', function(evt) {
    
    var cat = jQuery(this).children('input').val();	    
	var selected = jQuery( "#genre > input[type='hidden']" );
	var existing = selected.val();
	var list = existing.split(",");
	var first = list[0];
	
	jQuery(this).children('input').prop('checked', true);
	
	if( first == "" ) {
		
		list.shift();
		
	}	
   
    if( jQuery(this).children('input').is(':checked') ) {
	    		
		if(jQuery.inArray(cat, list) !== -1) {
			
			// item already in array, do nothing
			
		}
		
		else {
			
			list.push( cat );
			
			add_tag( cat );
									
		}
			

    }
    
    else {
	    
	    if( jQuery.inArray( cat, list ) !== -1 ) {
		    
		    var index = list.indexOf( cat );
			
			list.splice( index, 1 );
			
			remove_tag( cat );
			
		}
		
		else {
			
			// item already removed from array, do nothing
									
		}
	    
    }
    
    var list_str = list.toString();
        
    selected.val( list_str );
    
    get_events();
    
    evt.stopPropagation();
	evt.preventDefault();
  
});