function get_resources() {
	
	var subject_input = jQuery( "#subject > input[type='hidden']" ).val();
	var type_input = jQuery( "#type > input[type='hidden']" ).val();
	var grade_input = jQuery( "#grade > input[type='hidden']" ).val();
	var sort_by = jQuery( "#orderby option:selected" ).val();
	var current_page = jQuery( "#current_page" ).val();
	var audience_input = jQuery( "#audience" ).val();
	
	var no_posts = '<div class="no-posts">No Resources Found</div>'
	
	var data = {
			action: 'cb_get_resources',
			subject: subject_input,
			type: type_input,
			grade: grade_input,
			sort_by: sort_by,
			current_page: current_page,
			audience: audience_input
	}
	
	jQuery( "#sorting" ).addClass('loading');
	
	jQuery.post( cb_get_resources.ajax_url, data, function( results ) { 
		
		if( results ) {
				
			jQuery( "#sorting" ).removeClass('loading');
			jQuery('.results').html( results );
			
			
				
				var current = jQuery('.page-button.active'),
				next = current.nextAll(':lt(3)'),
    			prev = current.prevAll(':lt(3)'),
    			all = current.add(next).add(prev);
			
			
				all.show();
						
		}
					 
		else {	
					
			jQuery('.results').html( no_posts );
			jQuery( "#sorting" ).removeClass('loading');

								
		}	
			
	});
	
	
}

function add_tag( tag ) {
	
	var tag_id = "#" + tag + "-tag";
	var label_id = "label[for='" + tag + "']";
	var text = jQuery( label_id ).text();
	var div = '<button data-for="' + tag + '" class="tag" id="' + tag + '-tag">' + text + '</button>';

	if ( ! jQuery( '.tag' ).length ) {
		
		jQuery( ".tags" ).addClass('has-tags');
	
	}

	if ( ! jQuery( tag_id ).length ) {
		
		jQuery('.tags').prepend( div );
	
	}
	
}

function remove_tag( tag ) {
	
	var tag_id = "#" + tag + "-tag";
	
	jQuery( tag_id ).remove();
	
}
