function get_events() {
	
	var stage_input = jQuery( "#stage > input[type='hidden']" ).val();
	var genre_input = jQuery( "#genre > input[type='hidden']" ).val();
	var series_input = jQuery( "#event-series > input[type='hidden']" ).val();
	
	var sort_by = jQuery( "#orderby option:selected" ).val();
	var current_page = jQuery( "#current_page" ).val();
	var template = jQuery( "#template" ).val();
	var layout = jQuery( "#layout" ).val();

	var sorting_type = jQuery( "#sorting-type" ).val();
	var artist = jQuery( "#artist" ).val();
	var season = jQuery( "#season" ).val();
	var curated_list = jQuery( "#curated-list" ).val();
	
	
	var no_posts = '<div class="no-posts">No Events Found</div>'
	
	var data = {
		action: 'cb_get_events',
		stage: stage_input,
		genre: genre_input,
		series: series_input,
		sort_by: sort_by,
		current_page: current_page,
		template: template,
		layout: layout,
		sorting_type: sorting_type,
		artist: artist,
		season: season,
		curated_list: curated_list
	}
	
	jQuery( "#sorting" ).addClass('loading');
	
	jQuery.post( cb_get_events.ajax_url, data, function( results ) { 
		
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
