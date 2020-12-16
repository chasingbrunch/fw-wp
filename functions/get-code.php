<?php
	
add_action( 'wp_ajax_cb_get_code', 'cb_get_code' );
add_action( 'wp_ajax_nopriv_cb_get_code', 'cb_get_code' );
add_action( 'wp_enqueue_scripts', 'cb_enqueue_code' );
	
function cb_enqueue_code() {
	
	wp_enqueue_script( 'access_code', get_template_directory_uri() . '/assets/scripts/cb-get-code.js', array('jquery'), NULL );
	
	wp_localize_script( 'access_code', 'cb_get_code', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ), NULL );
	
};


function cb_get_code() {
	
	global $wp_query;
	
	$code = $_POST['access_code'];
	
	$code = sanitize_text_field( $code );
	
	$resource = $_POST['resource'];
	
	$correct_code = get_field( 'access_code', $resource );
	
	if( $code == $correct_code ) {
		
		echo '<div class="responsive-embed widescreen">';
		
		the_field( 'full_length_video', $resource );
		
		echo '</div>';
		
	}
	
	else {
		
		echo '"' . $code . '" is not a valid access code'; 
		
	}
	
	wp_reset_postdata();
	
	wp_die();
	
};
