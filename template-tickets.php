<?php
/*
Template Name: Tickets
*/

$id = get_queried_object_id();
$parents = get_post_ancestors($id);

$taxonomy = get_query_var( 'taxonomy' );
$term_id = get_queried_object()->term_id; 
$term_slug = get_queried_object()->slug;

$args = array(
	'post_type' => 'events',
	'posts_per_page' => '-1',
	'order' => 'ASC',
	'orderby' => 'meta_value',
	'meta_query' => array(
        array(
            'key'     => 'event_information_start_time',
            'value'   => date('m/d/Y g:i a'),
            'compare' => '>=',
        ),
    ),    			
);

get_header(); ?>

<?php if ( $parents ): ?>
	
<div class="cb-breadcrumbs grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<?php foreach( $parents as $parent ): ?>
				
			<a href="<?php echo get_permalink( $parent ); ?>"><?php echo get_the_title( $parent ); ?></a> / 
					
		<?php endforeach; ?>
		
	</div>
	
</div>

<?php endif; ?>

<div class="page-title grid-x">
			
	<div class="small-10 small-offset-1 cell">
				
		<h1><?php the_title(); ?></h1>
										 
	</div>
			
</div>

<div class="tickets-grid grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<div class="grid-x grid-margin-x grid-margin-y">
			
			<?php $query = new WP_Query( $args ); while ( $query->have_posts() ) : $query->the_post(); ?>
			
				<?php $primary = get_field('primary');
					  $event_info = get_field('event_information');
					  $id = get_the_id();
				  
					  $date = $event_info['start_time'];
					  $date = DateTime::createFromFormat('m/d/Y g:i a', $date);
					  $month = $date->format( 'F j' );
					  $time = $date->format( 'g:iA' ); ?>
					  
					<?php if( get_event_status( $id ) != 'past' ): ?>
					  
						<div class="featured-event small-12 medium-4 cell">
												
							<a class="grid-x" href="<?php echo get_permalink(); ?>">
									
								<div class="small-12 cell image-frame feature-frame">
											
									<?php $image = $primary['featured_image']; ?>
											
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
									
									<?php if( get_event_status( $id ) == 'live' ): ?><span class="live-tag"><h6>Live Now</h6></span><?php endif; ?>
											
								</div>
										
								<div class="small-12 cell result-info">
											
									<h5><?php echo get_the_title($event); ?></h5>
											
									<?php $artist = get_the_terms( $event, 'artist' ); ?>
											
									<?php foreach( $artist as $tag ): ?>
											
										<p><?php echo $tag->name; ?></p>
												
									<?php endforeach; ?>
																										
									<div class="event-date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
											
								</div>
										
							</a>
							
							<?php 
								
								$event_type = $event_info['registration_type'];
								
								if( $event_type == 'tickets' ) {
									
									$button_url = get_permalink(373) . '?event=' . $id;
									$target = '';
									$button_text = 'Purchase Tickets';
									
								}
								
								elseif( $event_type == 'form' ) {
									
									$button_url = get_permalink() . '#register';
									$target = '';
									$button_text = 'Register Now';
									
								}
								
								elseif( $event_type == 'external' ) {
									
									$button_url = $event_info['ticket_url'];
									$target = 'target="blank"';
									$button_text = $event_info['button_text'];
									
								}
								
								?>							
							
							<a class="button" href="<?php echo $button_url; ?>" <?php echo $target; ?> ><?php echo $button_text; ?> <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
								
						</div>

					
					<?php endif; ?>
					
			<?php endwhile; ?>
			
			<?php wp_reset_query(); ?>
			
		</div>	
		
	</div>
	
</div>

<div class="secondary-content grid-x grid-padding-y">
	
	<div class="small-10 small-offset-1 medium-7 cell">
		
		<?php the_field('page_content'); ?>
		
	</div>
	
</div>

<?php get_footer(); ?>
