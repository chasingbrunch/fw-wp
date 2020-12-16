jQuery('.donation-type button').click(function() {

	jQuery('.donation-type button.active').removeClass('active');
	jQuery('.donation-select').removeClass('monthly');
	jQuery('.donation-select').removeClass('one-time');
	
	var donate = jQuery(this).data('donate');
	
	jQuery('.donation-select').addClass( donate );
	jQuery(this).addClass('active');
	
});

jQuery('.donation-tier').click(function() {

	jQuery('.selected').removeClass('selected');
	jQuery('#custom-amount').removeClass('selected');
	jQuery(this).addClass('selected');
	
});

jQuery('#custom-amount').keyup(function( event ) {
	
    var new_val = jQuery( '#custom-amount' ).val();
    jQuery( '#custom-amount' ).attr('data-amount', new_val);
    
});

jQuery('#custom-amount').click(function() {

	jQuery('.selected').removeClass('selected');
	jQuery(this).addClass('selected');
	
});

jQuery('.make-donation').click(function() {
	
	var amount = jQuery('.donation-select .selected').attr('data-amount');
	
	var url = jQuery(this).data('url');
	
	if( jQuery( '.donation-select' ).hasClass('monthly') ) {
	
		var type = "monthly";
	
	}
	
	else {
	
		var type = "one-time";
	
	}
		
	if( typeof amount === 'undefined' ) {
		
		alert('please select an option');
		
	}
		
	else {
		
		var string = url + '?amount=' + amount + '&type=' + type;
	
		window.location.href = string;
			
	}

});


jQuery(window).load(function() {
	
	if( jQuery('body').hasClass('page-template-template-checkoutdonation') ) {
	
		var type = jQuery( "#input_2_21 option:selected" ).val();
		var amount = jQuery('input#input_2_15').val();
		
		jQuery('.product-name span').text( type );
		jQuery('.donation-price span').text( amount );
	
	}


});


jQuery( '.review-purchase' ).click(function() {
	
	
	var type = jQuery( "#input_2_21 option:selected" ).val();
	var amount = jQuery('input#input_2_15').val();
		
	var first_name = jQuery('#input_2_3').val();
	var last_name = jQuery('#input_2_4').val();	
		
	var order_name = first_name + ' ' + last_name;
		
	var street_1 = jQuery('#input_2_5_1').val();
	var street_2 = jQuery('#input_2_5_2').val();
		
	if( typeof street_2 === 'undefined' ) { 
			
		var street = street_1;
			
	}
		
	else {
			
		var street = street_1 + '<br/>' + street_2;
			
	}
		
	var city = jQuery('#input_2_5_3').val();
	var state = jQuery('#input_2_5_4').val();
	var zip = jQuery('#input_2_5_5').val();
	var country = jQuery( "#input_2_5_6 option:selected" ).val();	
		
	var order_billing_address = street + '<br/>' + city + ', ' + state + ' ' + zip + '<br/>' + country;
				
	if ( jQuery( '#choice_2_7_1' ).is( ':checked' ) ) {
			
		var order_shipping_address = order_billing_address
			
	}
		
	else {
			
		var contact_street_1 = jQuery('#input_2_5_1').val();
		var contact_street_2 = jQuery('#input_2_5_2').val();
			
		if( typeof contact_street_2 === 'undefined' ) { 
				
			var contact_street = street_1;
				
		}
			
		else {
				
			var contact_street = street_1 + '<br/>' + street2;
				
		}
			
		var contact_city = jQuery('#input_2_5_3').val();
		var contact_state = jQuery('#input_2_5_4').val();
		var contact_zip = jQuery('#input_2_5_5').val();
		var contact_country = jQuery( "#input_2_5_6 option:selected" ).val();	
			
		var order_shipping_address = contact_street + '<br/>' + contact_city + ', ' + contact_state + ' ' + contact_zip + '<br/>' + contact_country;
	
			
	}
		
	var order_phone = jQuery('#input_2_9').val();
	var order_email = jQuery('#input_2_10').val();
		
		
	if ( first_name == '' || last_name == '' || street_1 == '' || city == '' || state == '' || zip == '' || country == '' || order_phone == '' || order_email == '' ) {
			
		alert('please fill in all the required fields');
			
	}
		
	else {
		
		jQuery('.order-name').html( order_name );
		jQuery('.order-billing-address').html( order_billing_address );
			
		jQuery('.order-shipping-address').html( order_shipping_address );
		jQuery('.order-phone').html( order_phone );
		jQuery('.order-email').html( order_email );
			
		jQuery('.checkout-donation').addClass( 'review' );
		
					
	}
	
});

jQuery( '.edit-order' ).click(function() { 
	
	jQuery('.checkout-donation').removeClass( 'review' );
	
});

jQuery( '.checkout-submit' ).click(function() { 
	
	jQuery('.checkout-donation').removeClass( 'review' );
	
	jQuery('#gform_submit_button_2').click();
	
	jQuery('.gform_fields').addClass('form-loading');
	
});


jQuery(document).on('gform_confirmation_loaded', function(event, formId){
 
 	if(formId == 2) {
	 
		jQuery('.checkout-donation').addClass('order-submitted');
	
	}
 
});

