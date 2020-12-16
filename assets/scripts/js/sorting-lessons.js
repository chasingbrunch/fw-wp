jQuery( document ).ready(function() {
    
    if( jQuery( 'body' ).hasClass('resource-archive') ) {
	    
	    get_resources();
	    
	    if (jQuery(window).width() < 760) {
		    
			jQuery( "h3" ).click();
			
		}
		
	    
    }
    
});

jQuery('#orderby').on('change', function () {
    
    get_resources();
    
});

jQuery( ".show-more" ).click( function() {
	
	jQuery( this ).prev().toggleClass('expanded');
	jQuery ( this ).toggleClass('less');

});	

jQuery( ".filters > h3" ).click( function() {
	
	jQuery( this ).next().toggleClass('hide');
	
	if( jQuery( this ).next().next().hasClass('show-more') ) {
		
		jQuery( this ).next().next().toggleClass('hide');
				
	}
	
	jQuery ( this ).toggleClass('closed');

});	

jQuery(document).on("click", ".resource-sorting .tag", function(){

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
	
	get_resources();
	    
});

jQuery( ".resource-sorting .clear-tags" ).click( function() { 
	
	jQuery( '.tag' ).remove();
	//jQuery( 'input[type="hidden"]' ).val('');
	
	jQuery( "#subject > input[type='hidden']" ).val('');
	jQuery( "#type > input[type='hidden']" ).val('');
	jQuery( "#grade > input[type='hidden']" ).val('');

	
	jQuery( "#sorting input" ).prop('checked', false);
	jQuery( ".tags" ).removeClass('has-tags');
	
	get_resources();
});

jQuery(document).on("click", ".resource-sorting .page-button", function(){
	
	var page = jQuery( this ).data('value');
	
	jQuery( "#current_page" ).val( page );	
		
	get_resources();
});

jQuery(document).on("click", ".resource-sorting .cb-prev", function(e){
	
	e.preventDefault();
	
	var current_page = jQuery( "#current_page" ).val();
	
	var new_page = parseInt( current_page ) - 1;
	
	console.log(new_page);
		
	jQuery( "#current_page" ).val( new_page );	
		
	get_resources();
	
});

jQuery(document).on("click", ".resource-sorting .cb-next", function(e){
	
	e.stopPropagation();
	
	var current_page = jQuery( "#current_page" ).val();
	
	var new_page = parseInt( current_page ) + 1;
	
	jQuery( "#current_page" ).val( new_page );	
		
	get_resources();
	
});

//INPUT CLICK FUNCTIONS

jQuery( "#type > label" ).click( function(evt) {

	var collection = jQuery(this).children('input').val();
	
	jQuery(this).children('input').prop('checked', true);
	
	jQuery( "#type > input[type='hidden']" ).val(collection);
	
	add_tag( collection );
				
	jQuery( this ).siblings().each(function() {
			
		var sib = jQuery( this ).children('input').val();
			
		if( collection != sib ) {
				
			remove_tag( sib );
			
		}
					
	});
	
	get_resources();
	
	evt.stopPropagation();
	evt.preventDefault();
    
});

jQuery( "#grade > label" ).click( function(evt) {

	var material = jQuery(this).children('input').val();
	
	jQuery(this).children('input').prop('checked', true);
	
	jQuery( "#grade > input[type='hidden']" ).val(material);
	
	add_tag( material );
				
	jQuery( this ).siblings().each(function() {
			
		var sib = jQuery( this ).children('input').val();
			
		if( material != sib ) {
				
			remove_tag( sib );
			
		}
					
	});
	
	get_resources();
	
	evt.stopPropagation();
	evt.preventDefault();
    
});

jQuery( ".grade-btn" ).click( function(evt) {
		
	var grade_input = jQuery( "#grade > input[type='hidden']" );
	var grades = [];
		
	jQuery(this).toggleClass('selected');
	
	jQuery('.grade-btn.selected').each(function() {
		
		var selected = jQuery(this).data('grade');
		
    	grades.push( selected );
    	    
	});
	
	var grades_list = grades.toString();
        
    grade_input.val( grades_list );
	
	get_resources();
    
    evt.stopPropagation();
	evt.preventDefault();
	  
});

jQuery( "#subject > label" ).unbind('click').bind('click', function(evt) {
    
    var cat = jQuery(this).children('input').val();	    
	var selected = jQuery( "#subject > input[type='hidden']" );
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
    
    get_resources();
    
    evt.stopPropagation();
	evt.preventDefault();
  
});