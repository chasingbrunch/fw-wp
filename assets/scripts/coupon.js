function check_coupon() {
		
	var code = jQuery('#access-code').val();
	
	var data = {
		'action' : 'cb_coupon_code',
		'CODE' : code
	}	
		
	if ( code.length > 0 ) {
		
		jQuery('.discount-code').addClass( 'load' );
			
		jQuery.post( cb_coupon_code.ajax_url, data, function( response ) { 
		
			if( response ) {
				
				var code_formatted = code.toUpperCase();
				
				var success_text = "Success! Enjoy " + response + "% off with code: " + code_formatted;
				
				var current = jQuery('#total').val();
		
				var removal = ( parseInt( response ) / 100 ) * parseInt( current );
				
				var coupon_html = '<div class="small-6 cell"><h6>Code: ' + code_formatted + '</h6></div><div class="small-6 cell text-right"><h6> - $' +  removal + '</h6></div>';
				
				var total = parseInt( current ) - removal;
				
				jQuery('#total').val( total );
				
				jQuery('.order-total h3').text( '$' + total );
				
				jQuery( coupon_html ).insertBefore( ".order-summary .grid-x .small-12" );
				
				jQuery('#discount').val( removal );
				
				jQuery('#coupon').val( code_formatted );
				
				jQuery('.results').text( success_text );
								
				jQuery('.discount-code').removeClass( 'load' );
				
			}
					 
			else {
				
				jQuery('.results').text( 'Invalid Code' );				
			}	
			
		});
		
	}

}