<?php
	
add_action( 'wp_ajax_cb_coupon_code', 'cb_coupon_code' );
add_action( 'wp_ajax_nopriv_cb_coupon_code', 'cb_coupon_code' );
add_action( 'wp_enqueue_scripts', 'cb_enqueue_coupon' );
	
function cb_enqueue_coupon() {
	
	wp_enqueue_script( 'coupon_code', get_template_directory_uri() . '/assets/scripts/coupon.js', array('jquery'), NULL );
	
	wp_localize_script( 'coupon_code', 'cb_coupon_code', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ), NULL );
	
};


function cb_coupon_code() {
	
	global $wpdb;
	
	$code = $_POST['CODE'];
	
	$valid_codes = get_field( 'coupon_codes', 373 );
	
	$valid = false;
	
	while( have_rows( 'coupon_codes', 373 ) ) : the_row();
		
		$row = get_sub_field('code');
		
		$row = strtoupper( $row );
		$code = strtoupper( $code );
		
		if( $row == $code ) :
		
			$valid = true;
			$discount = get_sub_field('discount');
					
		endif;
		
	endwhile;
	
	if ( $valid ) {
		
		echo $discount;
		
	}
	
	wp_die();
		
};
