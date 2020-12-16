<?php 
/**
 * The template for displaying resources
 */

$id = get_the_id();

$press_release_archive = get_page_by_title('Resources');
$archive_url = get_permalink( $press_release_archive );
$parents = get_post_ancestors( $press_release_archive );

get_header(); ?>


<?php if ( $parents ): ?>
	
<div class="cb-breadcrumbs grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<?php foreach( $parents as $parent ): ?>
				
			<a href="<?php echo get_permalink( $parent ); ?>"><?php echo get_the_title( $parent ); ?></a> / 
					
		<?php endforeach; ?>
			
		<a href="<?php echo $archive_url; ?>">Resources</a>
		
	</div>
	
</div>

<?php endif; ?>

<div class="resource-header grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<div class="grid-x">
			
			<div class="small-8 cell">
				
				<h1><?php the_title(); ?></h1>
				
			</div>
			
			<div class="small-8 cell">
				
				<?php $artist = get_field( 'artist' ); $artist = get_term( $artist, 'artist' ); ?>
				
				<?php if( has_term( 3, 'type' ) || has_term( 4, 'type') ): ?>
					
					<h2><?php echo $artist->name; ?></h2>
				
				<?php endif; ?>
				
				<?php the_field( 'description' ); ?>				
				
			</div>
			
			<div class="small-3 small-offset-1 cell">
				
				<h4><?php the_field('date'); ?></h4>
				
				<br/>
				
				<?php if( has_term( 9, 'type' ) ): ?>
				
					<h4>Artist</h4>
					
					<p><?php echo $artist->name; ?></p>
				
				<?php endif; ?>
				
				<?php if( has_term( 3, 'type' ) || has_term( 4, 'type') ): ?>
				
					<h4>Grades</h4>
					
					<?php $grades = wp_get_post_terms( $id, 'grade', array( 'orderby' => 'term_id', 'order' => 'DESC' ) ); ?>
					
					<?php $count = count( $grades ); $i = 1; ?>
					
					<p>
											
					<?php foreach( $grades as $grade ) {
					
						if( $count == 1 ) {
							
							echo $i . $grade->name;
							
						}
						
						else {
													
							if( $i == 1 ) {
								
								echo $grade->name . ' — ';
								
							}
							
							if( $i == $count ) {
								
								echo $grade->name;
								
							}
							
						}
						
						$i++;
					
					} ?>
					
					</p>
					
					<br/>
					
					<h4>Subjects</h4>
					
					<?php $subjects = wp_get_post_terms( $id, 'subject', array( 'orderby' => 'name', 'order' => 'DESC' ) ); ?>
					
					<p>
						
					<?php foreach( $subjects as $subject ): ?>
					
						<?php echo $subject->name . '<br/>'; ?>
					
					<?php endforeach; ?>
					
					</p>
				
				<?php endif; ?>
				
				<?php if( has_term( 5, 'type' ) ): ?>
				
					<h4>Host</h4>
					
					<p>
					
					<?php if( have_rows( 'hosts' ) ): while ( have_rows( 'hosts' ) ) : the_row(); ?>
					
						<?php if( get_sub_field( 'url' ) ): ?>
						
							<a href="<?php the_sub_field('url'); ?>" target="_blank"><?php the_sub_field( 'name' ); ?></a><br/>
						
						<?php else : ?>
						
							<?php the_sub_field( 'name' ); ?><br/>
						
						<?php endif; ?>
					
					<?php endwhile; endif; ?>
					
					</p>
					
					<h4>Guests</h4>
					
					<p>
					
					<?php if( have_rows( 'guests' ) ): while ( have_rows( 'guests' ) ) : the_row(); ?>
					
						<?php if( get_sub_field( 'url' ) ): ?>
						
							<a href="<?php the_sub_field('url'); ?>" target="_blank"><?php the_sub_field( 'name' ); ?></a><br/>
						
						<?php else : ?>
						
							<?php the_sub_field( 'name' ); ?><br/>
						
						<?php endif; ?>
					
					<?php endwhile; endif; ?>

				<?php endif; ?>
				
				</p>
						
			</div>
			
		</div>
		
	</div>
	
</div>

<?php if( has_term( 3, 'type' ) || has_term( 4, 'type') ): ?>

	<?php if( get_field( 'featured_image' ) ): ?>
	
		<?php $image = get_field( 'featured_image' ); ?>
				
		<div class="image-full grid-x">
					
			<div class="small-10 small-offset-1 cell">
						
				<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						 
			</div>
					
		</div>

	<?php endif; ?>

<?php endif; ?>

<?php if( have_rows( 'dynamic_elements' ) ): while ( have_rows( 'dynamic_elements' ) ) : the_row(); ?>
			
	<?php if( get_row_layout() == 'tab_section' ): ?>
	
		<div class="grid-x tab-groups">
			
			<div class="small-10 small-offset-1 cell">
				
				<div class="grid-x grid-margin-x">
					
					<div class="small-3 cell cb-tabs">
						
						<?php $tab_group = 1; ?>
						
						<?php if( have_rows( 'tab_group' ) ): while ( have_rows( 'tab_group' ) ) : the_row(); ?>
							
							<div class="tab-group">
								
								<h3><?php the_sub_field('title'); ?></h3>
								
								<?php $tab = 1; ?>
								
								<?php if( have_rows( 'tabs' ) ): while ( have_rows( 'tabs' ) ) : the_row(); ?>
								
									<button data-tab="<?php echo $tab_group . '-' . $tab; ?>"><h4><?php the_sub_field('title'); ?></h4></button>
									
									<?php $tab++; ?>
								
								<?php endwhile; endif; ?>
								
							</div>
							
							<?php $tab_group++; ?>
						
						<?php endwhile; endif; ?>
						
					</div>
					
					<div class="small-9 cell tab-content">
						
						<?php $tab_group = 1; ?>
								
						<?php if( have_rows( 'tab_group' ) ): while ( have_rows( 'tab_group' ) ) : the_row(); ?>
									
							<?php $tab = 1; ?>
										
							<?php if( have_rows( 'tabs' ) ): while ( have_rows( 'tabs' ) ) : the_row(); ?>
										
								<div class="tab-section" data-tab="<?php echo $tab_group . '-' . $tab; ?>">
											
									<?php $tab_type = get_sub_field('tab_type'); if( $tab_type == 'content' ): ?>
															
										<?php the_sub_field('content'); ?>
														
									<?php elseif( $tab_type == 'links' ): ?>
														
										<?php if( have_rows( 'links' ) ): ?>
															
											<div class="grid-x link-table">
																								
												<?php while( have_rows( 'links' ) ): the_row(); ?>
																												
													<a class="small-12 cell link-row" href="<?php the_sub_field('url'); ?>">
																												
														<h4><?php the_sub_field( 'title' ); ?></h4>
																									
														<div class="icon">
															
															<i class="fa fa-file-pdf-o"></i>
															
														</div>
																											
													</a>
																										
												<?php endwhile; ?>
						
											</div>
																
										<?php endif; ?>
														
										<?php $tab++; ?>
													
									<?php endif; ?>
								
								</div>
							
							<?php endwhile; endif; ?>
							
							<?php $tab_group++; ?>
								
						<?php endwhile; endif; ?>
						
					</div>
					
				</div>
				
			</div>
			
		</div>
		
	<?php elseif( get_row_layout() == 'session_highlights_reel' ): ?>
		
		<div class="session-highlights-reel grid-x">
			
			<div class="small-10 small-offset-1 cell">
				
				<h3><?php the_sub_field( 'title' ); ?></h3>
				
			</div>
			
			<?php $slider = get_sub_field('slider'); ?>
			
			<?php if( count($slider) > 1 ): ?>
			
				<div class="highlight-slider small-12 cell">
				
					<?php if( have_rows( 'slider' ) ): while ( have_rows( 'slider' ) ) : the_row(); ?>
					
						<div class="highlight-slide">
							
							<?php the_sub_field('video'); ?>
							
							<h5><?php the_sub_field('title'); ?></h5>
							
							<h6><?php the_sub_field('caption'); ?></h6>
							
						</div>
					
					<?php endwhile; endif; ?>
				
				</div>
			
			<?php else : ?>
			
				<div class="highlight-slide small-10 small-offset-1 cell">
					
					<?php the_sub_field('video'); ?>
							
					<h5><?php the_sub_field('title'); ?></h5>
							
					<h6><?php the_sub_field('caption'); ?></h6>
					
				</div>
			
			<?php endif; ?>
			
		</div>
		
	<?php elseif( get_row_layout() == 'full_width_content' ): ?>
	
		<div class="content-and-link grid-x grid-margin-x">
		
			<div id="main-content" class="small-10 small-offset-1 medium-7 cell">
				
				<?php if( has_term( 9, 'type' ) ): ?>
				
				<?php $image = get_field( 'featured_image' ); ?>
				
				<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				
				<?php endif; ?>
				
				<?php the_sub_field( 'content' ); ?>
				
			</div>
			
			<?php if( get_field( 'access_code' ) ): ?>
			
			<div class="small-3 cell full-length-widget" data-sticky-container>
				
				<div class="sticky" data-sticky data-top-anchor="main-content:top" data-btm-anchor="main-content:bottom">
				
					<h6>Access Full-Length Recording</h6>
					
					<p>Missed the live session? use your access code to watch the full-length recording.</p>
					
					<div class="input-group">
					  
					  <input id="access-code" class="input-group-field" type="text">
					  
					  <div class="input-group-button">
						  
					    <input type="submit" class="submit-access-code button" value="Watch" data-resource="<?php echo $id; ?>">
					    
					  </div>
					  
					</div>
					
					<hr />
					
					<p><small>To receive an access code, contact FirstWorks Education</small></p>
					
					<div class="results"></div>
				
				</div>
				
			</div>
			
			<?php endif; ?>
			
		</div>

	<?php elseif( get_row_layout() == 'related_content' ): ?>
	
		<div class="related-content grid-x">
			
			<div class="small-10 small-offset-1 cell">
				
				<h4>More <?php echo $artist->name; ?>:</h4>
				
				<div class="grid-x grid-margin-x grid-margin-y">
					
					<?php $related = get_sub_field('related_content'); ?>
					
					<?php foreach( $related as $post ): ?>
										
						<a class="related-post small-12 medium-4 cell" href="<?php echo get_permalink( $post ); ?>">
							
							<?php $id = get_the_id($post); 
								
							if( get_post_type($post) == 'events') {
								
								$primary = get_field('primary', $post);
								$event_info = get_field('event_information', $post);
								$date = $event_info['start_time'];
								$image = $primary['featured_image'];
								
								if( $date ) {
									
									$date = DateTime::createFromFormat('m/d/Y g:i a', $date);
									$month = $date->format( 'F j' );
									$time = $date->format( 'g:iA' );
									
								}
								
								$terms = $event_info['event_type'];
									
							}
							 
							elseif( get_post_type($post) == 'lessons' ) {
									
								$image = get_field( 'featured_image', $post );	
								
								$date = get_field( 'date', $post );
								
								if( $date ) {
									
									$date = DateTime::createFromFormat('F j, Y', $date);
									$month = $date->format( 'F j' );
									$time = $date->format( 'g:iA' );
									
								}						
								
								$all_terms = wp_get_post_terms( $id, 'type', array( 'orderby' => 'name', 'order' => 'DESC' ) );
													
								$terms = '';
								
								foreach( $all_terms as $term ) {
									
									$terms .= $term->name;
									
								}
									
							} ?>
																	
							<div class="image-frame">
								
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />					
								
							</div>
							
							<h4><?php the_title(); ?></h4>
							
							<p><?php echo $terms; ?></p>
							
							<div class="date"><h6><?php echo $month; ?> &bull; <?php echo $time; ?></h6></div>
						
						</a>
						
						<?php unset($date); unset($image); unset ($terms); ?>
					
					<?php endforeach; ?>
					
				</div>
				
			</div>
			
		</div>
		
	<?php elseif( get_row_layout() == 'column_list' ): ?>
	
	<div class="column-list grid-x">
			
		<div class="small-10 small-offset-1 cell">
				
			<h4><?php the_sub_field('list_title'); ?></h4>
				
			<div class="grid-x grid-margin-x grid-padding-y">

				<?php if( have_rows( 'list' ) ): while ( have_rows( 'list' ) ) : the_row(); ?>
				
					<div class="list-item small-12 cell">
						
						<div class="grid-x">
							
							<div class="small-2 cell">
								
								<h6><?php the_sub_field('title'); ?></h6>
								
							</div>
							
							<div class="small-10 cell">
								
								<?php the_sub_field('content'); ?>
								
							</div>
							
						</div>						
						
					</div>
				
				<?php endwhile; endif; ?>

			</div>
				
		</div>
			
	</div>
	
	<?php endif; ?>
	
<?php endwhile; endif; ?>










<?php get_footer(); ?>