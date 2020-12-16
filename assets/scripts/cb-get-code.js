function get_code() {
	
	var access_code = jQuery( "#access-code" ).val();
	
	var resource = jQuery( ".submit-access-code" ).data('resource');
		
	var data = {
			action: 'cb_get_code',
			access_code: access_code,
			resource: resource
	}
	
	jQuery( ".full-length-widget" ).addClass('loading');
	
	jQuery.post( cb_get_code.ajax_url, data, function( results ) { 
		
		if( results ) {
				
			jQuery( ".full-length-widget" ).removeClass('loading');
			jQuery('.results').html( results );
						
		}
					 
		else {	
			
			jQuery( "#sorting" ).removeClass('loading');

								
		}	
			
	});
	
	
}