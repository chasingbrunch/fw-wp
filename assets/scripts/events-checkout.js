function get_event_checkout() {
	
	var ticket_totals = jQuery( "#ticket-totals" ).val();
	var event_id = jQuery( "#ticket-totals" ).data('event');
		
	var no_posts = '<div class="no-posts">No Events Found</div>'
	
	var data = {
		action: 'checkout_events_init',
		tickets: ticket_totals,
		event_id: event_id
	}
	
	jQuery( "#sorting" ).addClass('loading');
	
	console.log(ticket_totals);
	
	jQuery.post( checkout_events_init.ajax_url, data, function( results ) { 
		
		if( results ) {
				
			jQuery( "#checkout-events" ).removeClass('loading');
			jQuery('.checkout-events > .content > .grid-x').html( results );
						
		}
					 
		else {	
					
			jQuery('.results').html( no_posts );
			jQuery( "#sorting" ).removeClass('loading');
								
		}	
			
	});
	
	
}
