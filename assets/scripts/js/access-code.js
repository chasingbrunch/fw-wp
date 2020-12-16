jQuery('.submit-access-code').click(function() {

	var code = jQuery('.submit-access-code').val();
	
	if( code == '' ) {
		
		alert('please enter a code');
		
	}
	
	else {
		
		get_code();
		
	}
	
		
});