<?php
/*
Template Name: Past Seasons
*/

$id = get_queried_object_id();
$parents = get_post_ancestors($id);

$taxonomy = get_query_var( 'taxonomy' );
$term_id = get_queried_object()->term_id; 
$term_slug = get_queried_object()->slug;

get_header(); ?>

<?php if ( $parents ): ?>
	
<div class="cb-breadcrumbs grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<?php foreach( $parents as $parent ): ?>
				
			<a href="<?php echo get_permalink( $parent ); ?>"><?php echo get_the_title( $parent ); ?></a> / 
					
		<?php endforeach; ?>
			
		<a href="<?php the_permalink(); ?>">Archive</a>
		
	</div>
	
</div>

<?php endif; ?>

<div class="page-title grid-x">
			
	<div class="small-10 small-offset-1 cell">
				
		<h1><?php the_title(); ?></h1>
										 
	</div>
			
</div>

<?php if( have_rows( 'season' ) ): ?>
			
	<div class="grid-x past-seasons">
		
		<div class="small-10 small-offset-1 cell">
			
			<?php while ( have_rows( 'season' ) ) : the_row(); ?>
			
				<?php $season = get_sub_field('title'); ?>
				
				<?php $events = get_sub_field( 'featured_events' ); ?>
			
				<div class="season grid-x grid-margin-x grid-margin-y">
				
					<div class="small-12 cell">
						
						<h2><?php echo get_term( $season, 'season' )->name; ?> Season</h2>
					
					</div>
					
					<?php foreach( $events as $event ): ?>
					
						<?php $primary = get_field('primary', $event);
							  $event_info = get_field('event_information', $event);
				  
							  $date = $event_info['start_time'];
							  $date = DateTime::createFromFormat('m/d/Y g:i a', $date);
							  $month = $date->format( 'F j' );
							  $time = $date->format( 'g:iA' ); ?>
					
						<a class="featured-event small-12 medium-4 cell" href="<?php echo get_permalink($event); ?>">
												
							<div class="grid-x">
									
								<div class="small-12 cell image-frame feature-frame">
											
									<?php $image = $primary['featured_image']; ?>
											
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
											
								</div>
										
								<div class="small-12 cell result-info">
											
									<h4><?php echo get_the_title($event); ?></h4>
											
									<?php $artist = get_the_terms( $event, 'artist' ); ?>
											
									<?php foreach( $artist as $tag ): ?>
											
										<p><?php echo $tag->name; ?></p>
												
									<?php endforeach; ?>
																										
									<div class="event-date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
											
								</div>
										
							</div>
								
						</a>
					
					<?php endforeach; ?>
					
					<a class="event-card small-12 medium-4 cell" href="<?php the_sub_field( 'page_link' ); ?>">
			
						<h5>View All <?php echo get_term( $season, 'season' )->name; ?> Events</h5>
			
					</a>
					
				</div>
				
			<?php endwhile; ?>
			
		</div>
		
	</div>
				
<?php endif; ?>




<?php get_footer(); ?>
