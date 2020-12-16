function ticket_totals() {
	
	var tickets = [];
	
	jQuery( '.ticket-type' ).each(function( index ) {
		
		var name = jQuery(this).data('name');
		var price = jQuery(this).data('price');
		var fee = jQuery(this).data('fee');
		var quantity = jQuery(this).children('.price').children('.number').val();
		
		var keys = ['name', 'price', 'quantity', 'fee'];
		var values = [name, price, quantity, fee]
		
		var result = {};
		keys.forEach((key, i) => result[key] = values[i]);
		
		tickets.push( result );
	
	});
	
	var json = JSON.stringify( tickets );

	jQuery('#ticket-totals').val(json);
		
}

jQuery('.price span').click(function() {
	
	var quantity_input = jQuery(this).parent().children('.number');
	
	var current = quantity_input.val();

	if( jQuery(this).hasClass('sub') ) {
		
		if ( parseInt( current ) > 0 ) {
			
			quantity_input.val( parseInt( current ) - 1 );
			
		}
		
	}
	
	if( jQuery(this).hasClass('add') ) {
		
		quantity_input.val( parseInt( current ) + 1 );
		
	}
	
	ticket_totals();

});

jQuery('.purchase-tickets' ).click(function() {
	
	if( parseInt( jQuery( ".price input" ).val() ) > 0 ) {
	
		get_event_checkout();
	
	}
	
	else {
		
		alert('Select a Ticket');
		
	}
	
});
	
jQuery(document).on("click", ".submit-buttons button", function(){
	
	var page = jQuery(this).data('section');

	if( page == '1' ) {
		
		jQuery('.event-checkout-form').removeClass('page-1');
		jQuery('.event-checkout-form').addClass('page-2');
		
	}
	
	if( page == '3' ) {
		jQuery('.event-checkout-form').removeClass('page-3');
		jQuery('.event-checkout-form').addClass('page-4');
		
		var init_subtotal = jQuery('#subtotal').val();
		var init_fees = jQuery('#fee').val();
		var init_donation = jQuery('#donation').val();
		var init_total = jQuery('#total').val();
		var init_coupon = jQuery('#coupon').val();
		var init_discount = jQuery('#discount').val();
		var init_event = jQuery('.your-order h5').text();
		var init_tickets = jQuery('#ticket_info').val();
		
		jQuery("#gform_wrapper_3").appendTo(".order-form .form");
			
		//subtotal
		jQuery('#ginput_base_price_3_9').val( init_subtotal );
		
		//fees
		jQuery('#ginput_base_price_3_10').val( init_fees );
		
		//donation
		jQuery('#ginput_base_price_3_11').val( init_donation );
		
		//true total
		jQuery('#input_3_12').val( init_total );
		
		//Coupon
		jQuery('#input_3_13').val( init_coupon );
		
		//Discount
		jQuery('#input_3_14').val( init_discount );
		
		//Event Name
		jQuery('#input_3_15').val( init_event );
		
		//Ticket Info
		jQuery('#input_3_16').val( init_tickets );
		
		jQuery(document).trigger('gform_post_render', [3, 1]);

	}
	
	if( page == '4' ) {
		
		var firstname = jQuery('#input_3_3').val();
		var lastname = jQuery('#input_3_4').val();
		var email = jQuery('#input_3_6').val();
		var email2 = jQuery('#input_3_6_2').val(); 
		var street = jQuery('#input_3_5_1').val();
		var street2 = jQuery('#input_3_5_2').val();
		var city = jQuery('#input_3_5_3').val();
		var state = jQuery('#input_3_5_4').val();
		var zip = jQuery('#input_3_5_5').val();
		
		if( email == email2 ) {
			
			jQuery('span.first-name').text(firstname);
			jQuery('span.last-name').text(lastname);
			jQuery('span.street-1').text(street);
			jQuery('span.street-2').text(street2);
			jQuery('span.city').text(city);
			jQuery('span.state').text(state);
			jQuery('span.zip').text(zip);
			jQuery('span.email').text(email);

			jQuery('.event-checkout-form').removeClass('page-4');
			jQuery('.event-checkout-form').addClass('page-5');
			
			jQuery(document).trigger('gform_post_render', [3, 1]);
			
		}
		
		else {
			
			alert('emails must match');
			
		}

		
	}
	
	if( page == '5' ) {
		
		jQuery('.event-checkout-form').removeClass('page-5');
		jQuery('.event-checkout-form').addClass('thankyou');
		jQuery('.status-bar').hide();
		jQuery('.event-checkout-title h1').text('Thank you for your purchase');
		
		
	}
		

});

jQuery(document).on("click", ".no-thanks", function(){
	
	jQuery('.event-checkout-form').removeClass('page-2');
	jQuery('.event-checkout-form').addClass('page-3');
	
});

jQuery(document).on("click", ".make-donation", function(){
	
	var donation = jQuery('.donation-form input:checked').val();
	
	if( jQuery('.donation-form input:checked').length ) {
		
		if ( donation == 'Custom') {
		
			donation = jQuery('#Amount').val();
			
		}

		jQuery('#donation').val(donation);
		
		var current = jQuery('#total').val();
		
		var updated = parseInt( current ) + parseInt( donation );
		
		var donate_html = '<div class="small-6 cell"><h6>Donation</h6></div><div class="small-6 cell text-right"><h6>$' +  donation + '</h6></div>';
				
		jQuery( donate_html ).insertBefore( ".order-summary .grid-x .small-12" );
		
		jQuery('#total').val( updated );
		jQuery('.order-total h3').text( '$' + updated );
		
		jQuery('.event-checkout-form').removeClass('page-2');
		jQuery('.event-checkout-form').addClass('page-3');
		
			
	}
	
	else {
		
		alert('Please select an option');
		
	}
		
});

jQuery(document).on("click", "#Amount", function(){

	jQuery('#Custom').attr('checked', 'checked');
	
});


jQuery(document).on("click", ".submit-coupon-code", function(){

	var code = jQuery('#access-code').val();
	
	if( code == '' ) {
		
		alert('please enter a code');
		
	}
	
	else {
		
		check_coupon();
		
	}
	
		
});
