<?php
	
add_action( 'wp_ajax_cb_get_events', 'cb_get_events' );
add_action( 'wp_ajax_nopriv_cb_get_events', 'cb_get_events' );
add_action( 'wp_enqueue_scripts', 'cb_enqueue_events' );
	
function cb_enqueue_events() {
	
	wp_enqueue_script( 'event_archive', get_template_directory_uri() . '/assets/scripts/sorting-events.js', array('jquery'), NULL );
	
	wp_localize_script( 'event_archive', 'cb_get_events', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ), NULL );
	
};


function cb_get_events() {
	
	global $wp_query;
	
	$stage = $_POST['stage'];
	$genre = $_POST['genre'];
	$series = $_POST['series'];
	
	$sort_by = $_POST['sort_by'];
	$relation = $_POST['relation'];
	$current_page = $_POST['current_page'];
	$template = $_POST['template'];
	$layout = $_POST['layout'];	
	
	$sorting_type = $_POST['sorting_type'];
	$artist = $_POST['artist'];
	$season = $_POST['season'];
	$curated_list = $_POST['curated_list'];
		
	if( $genre ) {
		
		$genre = explode(",", $genre);
	
	}
	
	if( $curated_list ) {
		
		$curated_list = explode(",", $curated_list);
	
	}
	
	if( $sorting_type == 'all' || $sorting_type == 'genre' || $sorting_type == 'past' || $sorting_type == 'series' || $sorting_type == 'stage' || $sorting_type == 'upcoming' ) {
		
		if( $_POST['stage'] || $_POST['genre'] || $_POST['series'] ) {
			
			$tax_query = array(
					    
				'relation' => 'OR',
			        	
			   	array(
			        'taxonomy' => 'stage',
					'field'    => 'slug',
					'terms'    => $stage,
				),
						
				array(
			        'taxonomy' => 'genre',
					'field'    => 'slug',
					'terms'    => $genre,
				),
					
				array(
			        'taxonomy' => 'series',
					'field'    => 'slug',
					'terms'    => $series,
		
				),
											
			);
					   
			$args = array(
					
				'post_type' => 'events',
				    
				'tax_query' => $tax_query,
					
				'posts_per_page' => 5,
					
				'order' => $order,
					
				'orderby' => $orderby,
				
				'paged' => $current_page,
			);
		
		}
			
		else {
			
			$args = array(
				
				'post_type' => 'events',
				
				'posts_per_page' => 5,
				
				'order' => $order,
				
				'orderby' => $orderby,
				
				'paged' => $current_page,
			
			);
		}
		
	}
	
	if( $sorting_type == 'artist' || $sorting_type == 'season' ) {
		
		if( $sorting_type == 'artist' ) {
			
			$term_name = 'artist';
			$term = get_term( $artist )->slug;
			
		}
		
		if( $sorting_type == 'season' ) {
			
			$term_name = 'season';
			$term = get_term( $season )->slug;
			
		}
		
		if( $_POST['collections'] || $_POST['category'] || $_POST['material'] ) {
			
			$tax_query = array(
			    
	        	'relation' => 'OR',
				
				array(
					
					'relation' => 'AND',
						
					array(
			            'taxonomy' => $term_name,
						'field'    => 'slug',
						'terms'    => $term,
					),
					
					array(
						'taxonomy' => 'stage',
						'field'    => 'slug',
						'terms'    => $stage,
					),
				),
				
				array(
					
					'relation' => 'AND',
						
					array(
			            'taxonomy' => $term_name,
						'field'    => 'slug',
						'terms'    => $term,
					),
					
					array(
						'taxonomy' => 'genre',
						'field'    => 'slug',
						'terms'    => $genre,
					),
				),
				
				array(
					
					'relation' => 'AND',
						
					array(
			            'taxonomy' => $term_name,
						'field'    => 'slug',
						'terms'    => $term,
					),
				
					array(
						'taxonomy' => 'series',
						'field'    => 'slug',
						'terms'    => $series,
					),

				),
									
			);
			
			$args = array(
					
				'post_type' => 'events',
				    
				'tax_query' => $tax_query,
					
				'posts_per_page' => 5,
					
				'order' => $order,
					
				'orderby' => $orderby,
				
				'paged' => $current_page,
			);
			
		}
		
		else {
			
			$tax_query = array(
				
				array(
	            	'taxonomy' => $term_name,
					'field'    => 'slug',
					'terms'    => $term,
				),
				
			);
			
			$args = array(
					
				'post_type' => 'events',
				    
				'tax_query' => $tax_query,
					
				'posts_per_page' => 5,
					
				'order' => $order,
					
				'orderby' => $orderby,
				
				'paged' => $current_page,
			);
			
		}
		
	}
	
	if( $sorting_type == 'curated' ) {
		
		if( $_POST['stage'] || $_POST['genre'] || $_POST['series'] ) {
			
			$tax_query = array(
					    
				'relation' => 'OR',
			        	
			   	array(
			        'taxonomy' => 'stage',
					'field'    => 'slug',
					'terms'    => $stage,
				),
						
				array(
			        'taxonomy' => 'genre',
					'field'    => 'slug',
					'terms'    => $genre,
				),
					
				array(
			        'taxonomy' => 'series',
					'field'    => 'slug',
					'terms'    => $series,
		
				),
											
			);
					   
			$args = array(
					
				'post_type' => 'events',
				    
				'tax_query' => $tax_query,
					
				'posts_per_page' => 5,
					
				'order' => $order,
					
				'orderby' => $orderby,
				
				'paged' => $current_page,
				
				'post__in' => $curated_list,
			);
		
		}
			
		else {
			
			$args = array(
				
				'post_type' => 'events',
				
				'posts_per_page' => 5,
				
				'order' => $order,
				
				'orderby' => $orderby,
				
				'paged' => $current_page,
				
				'post__in' => $curated_list,
			
			);
		}
		
	} ?>	
	
	<?php if( $template == 'events-landing' ): ?>
	
		<div class="small-12 cell">
			
			<h5>Upcoming Events</h5>
			
		</div>
	
		<?php $query = new WP_Query( $args ); while ( $query->have_posts() ) : $query->the_post(); ?>
		
			<?php $id = get_the_id(); ?>
			
			<?php $primary = get_field('primary');
				  $event_info = get_field('event_information');
				  
				  $date = $event_info['start_time'];
				  $date = DateTime::createFromFormat('m/d/Y g:i a', $date);
				  $month = $date->format( 'F j' );
				  $time = $date->format( 'g:iA' ); ?>

			
			<?php if( get_event_status( $id ) == 'upcoming' || get_event_status( $id ) == 'live' ): ?>
			
				<?php if( $layout == 'default' ): ?>
				
				<div class="small-12 cell">
			
					<a class="grid-x event-result resource-result" href="<?php the_permalink(); ?>">
					
						<div class="small-12 medium-4 cell feature-frame">
							
							<?php $image = $primary['featured_image']; ?>
							
							<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
							
							<?php if( get_event_status( $id ) == 'live' ): ?><span class="live-tag"><h6>Live Now</h6></span><?php endif; ?>
							
						</div>
						
						<div class="small-12 medium-8 cell result-info">
							
							<h5><?php the_title(); ?></h5>
							
							<?php $artist = get_the_terms( $id, 'artist' ); ?>
							
							<?php foreach( $artist as $tag ): ?>
							
								<h6><?php echo $tag->name; ?></h6>
								
							<?php endforeach; ?>
														
							<?php echo $primary['excerpt']; ?>
							
							<div class="event-date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
							
						</div>
						
					</a>
				
				</div>
				
				<?php elseif( $layout == 'cards' ): ?>
				
					<div class="small-4 cell">
			
						<a class="grid-x event-result resource-result cards" href="<?php the_permalink(); ?>">
						
							<div class="small-12 cell feature-frame">
								
								<?php $image = $primary['featured_image']; ?>
								
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								
								<?php if( get_event_status( $id ) == 'live' ): ?><span class="live-tag"><h6>Live Now</h6></span><?php endif; ?>
								
							</div>
							
							<div class="small-12 cell result-info">
								
								<h5><?php the_title(); ?></h5>
								
								<?php $artist = get_the_terms( $id, 'artist' ); ?>
								
								<?php foreach( $artist as $tag ): ?>
								
									<h6><?php echo $tag->name; ?></h6>
									
								<?php endforeach; ?>
																							
								<div class="event-date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
								
							</div>
							
						</a>
					
					</div>
				
				<?php endif; ?>
				
			<?php endif; ?>
		
		<?php endwhile; ?>
		
		<a class="event-card <?php if( $layout == 'default' ): ?>small-12<?php else : ?> medium-4 <?php endif; ?> cell" href="">
			
			<h4>View All Upcoming Events</h4>
			
		</a>

		<div class="small-12 cell">
			
			<h5>Past Events</h5>
			
		</div>
	
		<?php $query = new WP_Query( $args ); while ( $query->have_posts() ) : $query->the_post(); ?>
		
			<?php $id = get_the_id(); ?>
			
			<?php $primary = get_field('primary');
				  $event_info = get_field('event_information');
				  
				  $date = $event_info['start_time'];
				  $date = DateTime::createFromFormat('m/d/Y g:i a', $date);
				  $month = $date->format( 'F j' );
				  $time = $date->format( 'g:iA' ); ?>

			
			<?php if( get_event_status( $id ) == 'past' ): ?>
			
				<?php if( $layout == 'default' ): ?>
				
				<div class="small-12 cell">
			
					<a class="grid-x event-result resource-result" href="<?php the_permalink(); ?>">
					
						<div class="small-12 medium-4 cell feature-frame">
							
							<?php $image = $primary['featured_image']; ?>
							
							<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
							
							<?php if( get_event_status( $id ) == 'live' ): ?><span class="live-tag"><h6>Live Now</h6></span><?php endif; ?>
							
						</div>
						
						<div class="small-12 medium-8 cell result-info">
							
							<h5><?php the_title(); ?></h5>
							
							<?php $artist = get_the_terms( $id, 'artist' ); ?>
							
							<?php foreach( $artist as $tag ): ?>
							
								<h6><?php echo $tag->name; ?></h6>
								
							<?php endforeach; ?>
														
							<?php echo $primary['excerpt']; ?>
							
							<div class="event-date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
							
						</div>
						
					</a>
				
				</div>
				
				<?php elseif( $layout == 'cards' ): ?>
				
					<div class="small-4 cell">
			
						<a class="grid-x event-result resource-result cards" href="<?php the_permalink(); ?>">
						
							<div class="small-12 cell feature-frame">
								
								<?php $image = $primary['featured_image']; ?>
								
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								
								<?php if( get_event_status( $id ) == 'live' ): ?><span class="live-tag"><h6>Live Now</h6></span><?php endif; ?>
								
							</div>
							
							<div class="small-12 cell result-info">
								
								<h5><?php the_title(); ?></h5>
								
								<?php $artist = get_the_terms( $id, 'artist' ); ?>
								
								<?php foreach( $artist as $tag ): ?>
								
									<h6><?php echo $tag->name; ?></h6>
									
								<?php endforeach; ?>
																							
								<div class="event-date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
								
							</div>
							
						</a>
					
					</div>
				
				<?php endif; ?>
				
			<?php endif; ?>
		
		<?php endwhile; ?>
		
		<a class="event-card <?php if( $layout == 'default' ): ?>small-12<?php else : ?> medium-4 <?php endif; ?> cell" href="">
			
			<h4>View All Past Events</h4>
			
		</a>
	
	<?php elseif( $template == 'events-curated' ): ?>
		
		<?php $query = new WP_Query( $args ); while ( $query->have_posts() ) : $query->the_post();
		
			$id = get_the_id();
			
			$primary = get_field('primary');
			$event_info = get_field('event_information');
				  
			$date = $event_info['start_time'];
			$date = DateTime::createFromFormat('m/d/Y g:i a', $date);
			$month = $date->format( 'F j' );
			$time = $date->format( 'g:iA' );
				  
			if( $sorting_type == 'past' || $sorting_type == 'upcoming' || $sorting_type == 'live' ): ?>
			
				<?php if( get_event_status( $id ) == $sorting_type ): ?>

					<?php if( $layout == 'default' ): ?>
				
						<div class="small-12 cell">
					
							<a class="grid-x event-result resource-result" href="<?php the_permalink(); ?>">
							
								<div class="small-12 medium-4 cell feature-frame">
									
									<?php $image = $primary['featured_image']; ?>
									
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
									
									<?php if( get_event_status( $id ) == 'live' ): ?><span class="live-tag"><h6>Live Now</h6></span><?php endif; ?>
									
								</div>
								
								<div class="small-12 medium-8 cell result-info">
									
									<h5><?php the_title(); ?></h5>
									
									<?php $artist = get_the_terms( $id, 'artist' ); ?>
									
									<?php foreach( $tags as $tag ): ?>
									
										<h6><?php echo $tag->name; ?></h6>
										
									<?php endforeach; ?>
																
									<?php echo $primary['excerpt']; ?>
									
									<div class="event-date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
									
								</div>
								
							</a>
						
						</div>
						
					<?php elseif( $layout == 'cards' ): ?>
						
						<div class="small-4 cell">
					
							<a class="grid-x event-result resource-result cards" href="<?php the_permalink(); ?>">
								
								<div class="small-12 cell feature-frame">
										
									<?php $image = $primary['featured_image']; ?>
										
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
										
									<?php if( get_event_status( $id ) == 'live' ): ?><span class="live-tag"><h6>Live Now</h6></span><?php endif; ?>
										
								</div>
									
								<div class="small-12 cell result-info">
										
									<h5><?php the_title(); ?></h5>
										
									<?php $artist = get_the_terms( $id, 'artist' ); ?>
										
									<?php foreach( $tags as $tag ): ?>
										
										<h6><?php echo $tag->name; ?></h6>
											
									<?php endforeach; ?>
																									
								<div class="event-date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
										
								</div>
									
							</a>
							
						</div>
						
					<?php endif; ?>
						
				<?php endif; ?>
			
			<?php else : ?>
			
				<?php if( $layout == 'default' ): ?>
				
					<div class="small-12 cell">
					
						<a class="grid-x event-result resource-result" href="<?php the_permalink(); ?>">
							
							<div class="small-12 medium-4 cell feature-frame">
									
								<?php $image = $primary['featured_image']; ?>
									
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
									
								<?php if( get_event_status( $id ) == 'live' ): ?><span class="live-tag"><h6>Live Now</h6></span><?php endif; ?>
									
							</div>
								
							<div class="small-12 medium-8 cell result-info">
									
								<h5><?php the_title(); ?></h5>
									
								<?php $artist = get_the_terms( $id, 'artist' ); ?>
									
								<?php foreach( $tags as $tag ): ?>
									
									<h6><?php echo $tag->name; ?></h6>
										
								<?php endforeach; ?>
																
								<?php echo $primary['excerpt']; ?>
									
								<div class="event-date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
									
							</div>
								
						</a>
						
					</div>
						
				<?php elseif( $layout == 'cards' ): ?>
						
					<div class="small-4 cell">
					
						<a class="grid-x event-result resource-result cards" href="<?php the_permalink(); ?>">
								
							<div class="small-12 cell feature-frame">
										
								<?php $image = $primary['featured_image']; ?>
										
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
										
								<?php if( get_event_status( $id ) == 'live' ): ?><span class="live-tag"><h6>Live Now</h6></span><?php endif; ?>
										
							</div>
									
							<div class="small-12 cell result-info">
										
								<h5><?php the_title(); ?></h5>
										
								<?php $artist = get_the_terms( $id, 'artist' ); ?>
										
								<?php foreach( $tags as $tag ): ?>
										
									<h6><?php echo $tag->name; ?></h6>
											
								<?php endforeach; ?>
																									
								<div class="event-date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
										
							</div>
									
						</a>
							
					</div>
						
				<?php endif; ?>
					
			<?php endif; endwhile;
				
			$max_pages = $query->max_num_pages;		
	
			if( $max_pages > 1 ) {
		
				echo '<div class="small-12 cell cb-pagination">';
		
				if( $current_page > 1 ) {
				
					$prev = intval( $current_page ) - 1;
				
					echo '<button class="cb-prev" data-page="' . $prev . '"><i class="fa fa-long-arrow-left" aria-hidden="true"></i> Previous</button>'; 
				
				}	
			
				for ($page = 0 ; $page < $max_pages; $page++) {
				
					$page_num = intval( $page ) + 1;
				
					if( $page_num == $current_page ) {
					
						$active = 'active ';
					
					}
				
					else {
					
						$active = '';
					
					}
					
					echo '<button data-value="' . $page_num . '" class="' . $active . 'page-button">' . $page_num . '</button>'; 
				
				}
					
				if( $current_page != $max_pages ) {
				
					$next = intval( $current_page ) + 1;
				
					echo '<button class="cb-next" data-page="' . $next . '">Next <i class="fa fa-long-arrow-right" aria-hidden="true"></i></button>';
				
				}
		
				echo '</div>';
			
			}

	
	endif;
	
	wp_die();
	
}; 

function get_event_status( $event ) {
	
	$event_info = get_field('event_information', $event);
	
	$start_time = $event_info['start_time'];
	$end_time = $event_info['end_time'];
	
	$start_date = DateTime::createFromFormat('m/d/Y g:i a', $start_time);
	$end_date = DateTime::createFromFormat('m/d/Y g:i a', $end_time);
	
	$right_now = date('m/d/Y g:i a');
	$current_datetime = DateTime::createFromFormat('m/d/Y g:i a', $right_now);
	
	//if it hasn't happened yet
	
	if( $current_datetime < $start_date ) {
		
		$status = 'upcoming';
		
	}
	
	//if its currently live
	
	if( $current_datetime > $start_date && $current_datetime < $end_date) {
		
		$status = 'live';
		
	}
		
	//if it already happened
	
	if( $current_datetime > $end_date ) {
		
		$status = 'past';
		
	}
	
	return $status;
	
}