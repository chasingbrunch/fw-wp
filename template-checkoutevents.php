<?php
/*
Template Name: Checkout (Events)
*/

$event = $_GET['event'];

if( $event && get_post( $event ) !== null && get_event_status( $event ) != 'past' ) {

} 

else {
	
	$tickets = get_permalink(372);
	
	wp_redirect( $tickets );
	
	exit;
}

$event = get_post($event);
$primary = get_field('primary', $event);
$event_info = get_field('event_information', $event);
$image = $primary['featured_image'];
$artist = get_the_terms( $event, 'artist' );

$date = $event_info['start_time'];
$date = DateTime::createFromFormat('m/d/Y g:i a', $date);
$month = $date->format( 'F j' );
$time = $date->format( 'g:iA' );

$end_time = $event_info['end_time'];
$end_time = DateTime::createFromFormat('m/d/Y g:i a', $end_time);

get_header(); ?>
			
<div class="page-frame grid-x checkout-events">
	
	<?php echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true" tabindex="49"]'); ?>
	
	<div class="content small-10 small-offset-1 cell">
		
		<div class="grid-x">
			
			<div class="small-10 small-offset-1 cell">

				<div class="grid-x grid-margin-y grid-margin-x checkout-header">
			
					<div class="small-12 cell circle-image">
				
						<div class="circle">
							
							<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
									
						</div>
						
					</div>
					
					<div class="small-12 cell checkout-title">
						
						<h1><?php echo get_the_title($event); ?></h1>
						
						<?php foreach( $artist as $tag ): ?>
									
							<h2><?php echo $tag->name; ?></h2>
										
						<?php endforeach; ?>
						
					</div>
		
				</div>
				
				<div class="lower-content grid-x grid-margin-x">
					
					<div class="small-7 cell">
						
						<h3><?php echo $date->format( 'l F j, Y' ); ?></h3>
						<h6><?php echo $date->format( 'g:iA' ) . ' - ' . $end_time->format( 'g:iA' ); ?></h6>
						
						<?php if( $event_info['address'] ): ?>
						
							<?php $map = $event_info['address']; ?>
											
							<p><?php echo $map['name'] . '<br/>' . $map['street_number'] . ' ' . $map['street_name'] . '<br/>' . $map['city'] . ' ' . $map['state_short'] . ' ' . $map['post_code']; ?></p>
							
							<hr/>
							
							<br/>
						
						<?php endif; ?>
						
						<?php echo $event_info['checkout_information']; ?>
						
					</div>
					
					<div class="ticket-quantity small-5 cell">
						
						<h4>Tickets</h4>
										
						<?php if( have_rows( 'event_information', $event ) ): while ( have_rows( 'event_information', $event ) ) : the_row(); ?>
						
							<?php if( have_rows( 'ticket_types' ) ): while ( have_rows( 'ticket_types' ) ) : the_row(); ?>
								
								<div class="grid-x grid-margin-y ticket-type" data-fee="<?php the_sub_field('fee'); ?>" data-price="<?php the_sub_field('ticket_price'); ?>" data-name="<?php the_sub_field('label'); ?>">
										
									<div class="small-6 cell">
											
										<h6><?php the_sub_field('label'); ?></h6>
											
									</div>
		
									<div class="small-3 cell price">
											
										<h6>$<?php the_sub_field('ticket_price'); ?></h6>
											
									</div>
										
									<div class="small-3 cell price">
											
										<span class="sub"><i class="fa fa-minus" aria-hidden="true"></i></span>
	
										<input class="number" type="number" name="quantity" min="0" value="0">
			
										<span class="add"><i class="fa fa-plus" aria-hidden="true"></i></span>
											
									</div>
										
								</div>
								
							<?php endwhile; endif; ?>
							
						<?php endwhile; endif; ?>		
							
						<br/>
						
						<hr/>
						
						<br/>		
						
						<div class="cta-frame">
						
							<button class="purchase-tickets button">Purchase Tickets</button>
							
						</div>
						
						<input type="hidden" id="ticket-totals" data-event="<?php echo $event->ID; ?>">
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	</div>
	
</div>

<?php get_footer(); ?>
