<?php
	
add_action( 'wp_ajax_checkout_events_init', 'checkout_events_init' );
add_action( 'wp_ajax_nopriv_checkout_events_init', 'checkout_events_init' );
add_action( 'wp_enqueue_scripts', 'cb_enqueue_events_init' );
	
function cb_enqueue_events_init() {
	
	wp_enqueue_script( 'event_checkout', get_template_directory_uri() . '/assets/scripts/events-checkout.js', array('jquery'), NULL );
	
	wp_localize_script( 'event_checkout', 'checkout_events_init', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ), NULL );
	
	 gravity_form_enqueue_scripts (3, true); // Ajaxed form id = 16
	
};

	
function checkout_events_init( $event ) { 
	
	global $wp_query;
	
	gravity_form_enqueue_scripts( 3, true );
	
	$tickets = $_POST[ 'tickets' ];
	$tickets = json_decode( stripslashes( $tickets ) );

	$event_id = $_POST[ 'event_id' ];
	
	$event = get_post( $event_id );
	$primary = get_field('primary', $event);
	$event_info = get_field('event_information', $event);
	$image = $primary['featured_image'];
	$artist = get_the_terms( $event, 'artist' );
	
	$date = $event_info['start_time'];
	$date = DateTime::createFromFormat('m/d/Y g:i a', $date);	
	
	foreach( $tickets as $ticket ) {
					
		$i = 0;
		
		$quantity = intval( $ticket->quantity );
					
		if( intval( $quantity ) > 0 ) {
			
			$total = $total + $quantity;
			
			while( $i++ < $quantity ) {
				
				$subtotal = $subtotal + intval( $ticket->price );
				
				$fees = $fees + intval( $ticket->fee );
				
				$order_total = $subtotal + $fees;
				
			}
			
		}
		
	}
	
?>
				
	<div class="event-checkout-form small-10 small-offset-1 cell page-1">

		<div class="grid-x grid-margin-y grid-margin-x checkout-header">
								
			<div class="small-12 cell event-checkout-title">
						
				<h1>Checkout</h1>
				
				<h3>Confirmation: <span></span></h3>
												
			</div>
			
			<div class="small-12 cell status-bar">
				
				<div class="section-tag" data-section="1">
					
					<div class="status-circle"></div>
					
					<h4>Tickets</h4>
					
				</div>
				
				<div class="section-tag" data-section="2">
					
					<div class="status-circle"></div>
					
					<h4>Make a Donation</h4>
					
				</div>
				
				<div class="section-tag" data-section="3">
					
					<div class="status-circle"></div>
					
					<h4>Promo Code</h4>
					
				</div>
				
				<div class="section-tag" data-section="4">
					
					<div class="status-circle"></div>
					
					<h4>Contact Info</h4>
					
				</div>
				
				<div class="section-tag" data-section="5">
					
					<div class="status-circle"></div>
					
					<h4>Payment Info</h4>
					
				</div>
				
			</div>
		
		</div>
		
		<div class="lower-content grid-x grid-margin-x">
					
			<div class="small-7 cell">
			
				<div class="ticket-review checkout-section" data-section="1">
					
					<h4>Tickets (<?php echo $total; ?>)</h4>
										
					<h5><?php echo $event->post_title; ?></h5>
					
					<?php $map = $event_info['address']; ?>
			
					<h6><?php echo $date->format( 'D m/d/y @ g:iA' ); ?><?php if( $event_info['address'] ): ?>, <?php echo $map['name']; ?><?php endif; ?></h6>
					
					<br/>
					
					<div class="grid-x">
						
						<div class="small-6 cell"><h6>Type</h6></div>
												
						<div class="small-3 cell"><h6>Price</h6></div>
						
						<div class="small-3 cell"><h6>Fee</h6></div>
						
					</div>
										
					<?php foreach( $tickets as $ticket ): ?>
					
						<?php $i = 0; ?>
					
						<?php if( intval( $ticket->quantity ) > 0 ): ?>
						
							<?php $quantity = intval( $ticket->quantity ); ?>
														
							<?php while( $i++ < $quantity ): ?>
							
								<div class="grid-x">
							
									<div class="small-6 cell"><p><?php echo $ticket->name; ?></p></div>
							
									<div class="small-3 cell"><p>$<?php echo $ticket->price; ?></p></div>
							
									<div class="small-3 cell"><p>$<?php echo $ticket->fee; ?></p></div>
							
								</div>							
								
							<?php endwhile; ?>
						
						<?php endif; ?>
					
					<?php endforeach; ?>
					
					<hr/>
					
				</div>
				
				<div class="donation-message checkout-section" data-section="2">
					
					<h4><?php the_field( 'donation_title', 373  ); ?></h4>
					
					<?php the_field( 'donation_message', 373  ); ?>
					
				</div>
				
				<div class="discount-code checkout-section" data-section="3">
					
					<h4>Discounts</h4>
					
					<div class="input-group">
					  
					  <input id="access-code" class="input-group-field" type="text">
					  
					  <div class="input-group-button">
						  
					    <input type="submit" class="submit-coupon-code button" value="Apply">
					    
					  </div>
					  
					</div>
					
					<div class="results"></div>
					
				</div>
				
				<div class="order-form checkout-section" data-section="4">
					
					<h4>Contact Info</h4>
					
					<div class="form"></div>
					
				</div>
							
			</div>
			
			<div class="small-5 cell">
				
				<div class="buyer-info checkout-section" data-section="5">
					
					<h4>Buyer Information</h4>
					
					<p><span class="first-name"></span> <span class="last-name"></span><br/>
					<span class="street-1"></span> <span class="street-2"></span><br/>
					<span class="city"></span>, <span class="state"></span> <span class="zip"></span><br/>
					<span class="email"></span></p>
										
				</div>
				
				<div class="your-order checkout-section" data-section="2">
					
					<h4>Your Order</h4>
					
					<h5><?php echo $event->post_title; ?></h5>
					
					<?php $map = $event_info['address']; ?>
			
					<h6><?php echo $date->format( 'D m/d/y @ g:iA' ); ?><?php if( $event_info['address'] ): ?>, <?php echo $map['name']; ?><?php endif; ?></h6>
					
					<p>Quantity: <?php echo $total; ?></p>
					
				</div>
				
				<div class="donation-form checkout-section" data-section="2">
					
					<h4>Donation</h4>
					
					<label for="5">
						
						<input name="type" type="radio" value="5" id="5">
							
						<span></span>
							
						$5.00						
					
					</label>	
					
					<label for="10">
						
						<input name="type" type="radio" value="10" id="10">
							
						<span></span>
							
						$10.00						
					
					</label>	
					
					<label for="Custom">
						
						<input name="type" type="radio" value="Custom" id="Custom">
							
						<span></span>
							
						$<input name="type" type="number" min="0" id="Amount">						
					
					</label>
					
					<br/>
					<hr/>
					<br/>
					<div class="grid-x grid-margin-x">
						
						<div class="small-6 cell">
							
							<button class="no-thanks button">No Thanks</button>
							
						</div>
						
						<div class="small-6 cell">
							
							<div class="cta-frame">
								
								<button class="make-donation button">Make Donation</button>
							
							</div>
							
						</div>
						
					</div>					
										
				</div>
				
				<div class="order-summary checkout-section" data-section="1">
					
					<h4>Order Summary</h4>
					
					<div class="grid-x">
						
						<div class="small-6 cell"><h6>Subtotal</h6></div>
						
						<div class="small-6 cell text-right"><h6>$<?php echo $subtotal; ?></h6></div>
						
						<div class="small-6 cell"><h6>Order Fees</h6></div>
						
						<div class="small-6 cell text-right"><h6>$<?php echo $fees; ?></h6></div>
						
						<div class="small-12 cell"><hr/></div>
						
						<div class="small-6 cell"><h3>Total</h3></div>
						
						<div class="small-6 cell text-right order-total"><h3>$<?php echo $order_total; ?></h3></div>
						
					</div>
					
				</div>
				
				<div class="discover-more checkout-section" data-section="1">
					
					<h4>Order Summary</h4>
					
					<div class="grid-x">
						
						<div class="small-6 cell"><h6>Subtotal</h6></div>
						
						<div class="small-6 cell text-right"><h6>$<?php echo $subtotal; ?></h6></div>
						
						<div class="small-6 cell"><h6>Order Fees</h6></div>
						
						<div class="small-6 cell text-right"><h6>$<?php echo $fees; ?></h6></div>
						
						<div class="small-12 cell"><hr/></div>
						
						<div class="small-6 cell"><h3>Total</h3></div>
						
						<div class="small-6 cell text-right order-total"><h3>$<?php echo $order_total; ?></h3></div>
						
					</div>
					
				</div>
				
				<div class="submit-buttons checkout-section">
					
					<div class="cta-frame">
					
						<button class="button" data-section="1">Continue (1)</button>
						<button class="button" data-section="3">Continue (3)</button>
						<button class="button" data-section="4">Continue (4)</button>
						<button class="button" data-section="5">Complete</button>
					
					</div>
					
					<br/>
					
					<small><?php the_field( 'disclaimer_text', 373  ); ?></small>
					
				</div>
				
			</div>
		
	</div>
	
	<?php $json_raw = json_encode( $tickets ); 
		  $cleaned = str_replace([':', '[{', '}]', ',', '"' ], ' ', $json_raw); 
		  $cleaned = str_replace('} { ', ' // ', $cleaned); 
		  $cleaned = str_replace(['   ', '  ' ], ' ', $cleaned); 
		  $cleaned = str_replace('name ', 'Type: ', $cleaned); 
		  $cleaned = str_replace('price ', 'Price: ', $cleaned); 
		  $cleaned = str_replace('quantity ', 'Quantity: ', $cleaned); 
		  $cleaned = str_replace('fee ', 'Fee: ', $cleaned); 
		 ?>
	
	<input id="fee" type="hidden" value="<?php echo $fees; ?>">
	<input id="subtotal" type="hidden" value="<?php echo $subtotal; ?>">
	<input id="total" type="hidden" value="<?php echo $order_total; ?>">
	<input id="donation" type="hidden" value="">
	<input id="discount" type="hidden" value="">
	<input id="coupon" type="hidden" value="">
	<input id="event" type="hidden" value="<?php echo $event_id; ?>">
	<input id="ticket_info" type="hidden" value="<?php echo $cleaned; ?>">

				
<?php 
	
	wp_die();
	
	}
	
?>