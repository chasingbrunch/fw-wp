<?php
/*
Template Name: Lessons (Archive)
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
			
		<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		
	</div>
	
</div>

<?php endif; ?>

<?php if( have_rows( 'dynamic_elements' ) ): while ( have_rows( 'dynamic_elements' ) ) : the_row(); ?>
			
	<?php if( get_row_layout() == 'hero' ): ?>
	
		<div class="grid-x resource-archive-header">
		
			<div class="small-10 small-offset-1 cell">
	
				<div class="hero-banner grid-x">
				
					<?php $background_image = get_sub_field('background_image'); ?>
						  
					<img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" />
						  
					<div class="small-10 small-offset-1 medium-offset-6 medium-5 cell">
						  					  
						<?php if( get_sub_field('tag') ): ?><span class="tagline"><h4><?php the_sub_field('tag'); ?></h4></span><?php endif; ?>
					  
						<?php the_sub_field('content'); ?>
						  
					</div>
					  
				</div>
				
			</div>
			
		</div>
			
	<?php elseif( get_row_layout() == 'filmstrip' ): ?>
			
		<div class="filmstrip grid-x">
				
			<div class="small-10 small-offset-1 cell">
					
				<div class="grid-x grid-margin-x">
						
					<div class="small-12 medium-3 cell">
							
						<h5><?php the_sub_field( 'tagline' ); ?></h5>
							
					</div>
						
					<div class="small-12 medium-9 cell filmstrip-slider">
						
						<?php $images = get_sub_field('images'); ?>
							
						<?php foreach( $images as $image ): ?>
							
							<div class="image-frame">
									
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								
							</div>
									
						<?php endforeach; ?>
					
					</div>
						
				</div>
					
			</div>
				
		</div>
	
	<?php endif; ?>
	
<?php endwhile; ?> 

<?php else: ?>

<div class="page-title grid-x">
			
	<div class="small-10 small-offset-1 cell">
				
		<h1><?php the_title(); ?></h1>
										 
	</div>
			
</div>

<?php endif; ?>

<div class="resource-sorting post-sorting grid-x">
	
	<div class="small-10 small-offset-1 cell">

		<div class="grid-x show-list" id="sorting">
			
			<div class="filters small-12 medium-3 large-3 cell">
								
				<div class="mobile-scroll-nav">
					
				<ul id="series">
					
					<li><a <?php if( is_page( 355 ) ): ?>class="active"<?php endif;?> href="<?php echo get_permalink( 355 ); ?>">For Students</a></li>
					
					<li><a <?php if( is_page( 356 ) ): ?>class="active"<?php endif;?> href="<?php echo get_permalink( 356 ); ?>">For Teachers</a></li>
												
				</ul>
				
				<input type="hidden" id="current_page" value="1">
				
				<input type="hidden" id="audience" value="<?php the_field('audience'); ?>">
				
				</div>
				
				<hr/>
				
				<h3>Subject</h3>
				
				<div id="subject" class="check">
					
					<?php $i = 0; ?>
					
					<?php $terms = get_terms( array( 'taxonomy' => 'subject', 'hide_empty' => false, 'orderby' => 'name' ) ); foreach( $terms as $term ) : $i++; ?>
					
						<label for="<?php echo $term->slug; ?>">
						
							<input<?php if( $term_id == $term->term_id ): ?><?php $current_cat = $term->slug; ?> checked <?php endif; ?>  name="subject" type="checkbox" value="<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>">
							
							<span></span>
							
							<?php echo $term->name; ?>
							
						</label>
					
					<?php endforeach; ?>
				
					<input type="hidden" value="<?php echo $current_cat; ?>">
					
				
				</div>
				
				<?php if( $i > 5 ): ?><button class="show-more"><i class="fa fa-plus" aria-hidden="true"></i><span></span></button><?php endif; ?>
				
				<hr/>
				
				<h3>Type</h3>
				
				<div id="type">
					
					<?php $i = 0; ?>
					
					<?php $terms = get_terms( array( 'taxonomy' => 'type', 'hide_empty' => false, 'orderby' => 'name' ) ); foreach( $terms as $term ) : $i++; ?>
					
						<label for="<?php echo $term->slug; ?>">
						
							<input<?php if( $term_id == $term->term_id ): ?><?php $current_col = $term->slug; ?> checked="checked" <?php endif; ?> name="type" type="radio" value="<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>">
							
							<span></span>
							
							<?php echo $term->name; ?>
							
						</label>
					
					<?php endforeach; ?>
					
					 <input type="hidden" value="<?php echo $current_col; ?>">
					
				</div>
				
				<?php if( $i > 5 ): ?><button class="show-more"><i class="fa fa-plus" aria-hidden="true"></i><span></span></button><?php endif; ?>
				
				<hr/>
					
				<h3>Grade</h3>
				
				<div id="grade" class="grid-x">
					
					<?php $i = 0; ?>
					
					<?php $terms = get_terms( array( 'taxonomy' => 'grade', 'hide_empty' => false, 'orderby' => 'term_id', 'order' => 'DESC' ) ); foreach( $terms as $term ) : $i++; ?>
					
					<div class="small-6 medium-4 cell">
					
						<button class="grade-btn" data-grade="<?php echo $term->slug; ?>"><?php echo $term->slug; ?></button>
						
					</div>
					
					<?php endforeach; ?>
					
					<input type="hidden" value="<?php echo $current_mat; ?>">
				
				</div>
								
				<a class="clear-tags button">Clear All</a>
				
			</div>
			
			<div class="posts small-11 medium-8 large-9 cell">
				
				<div class="grid-x grid-margin-x utility">
					
					<div class="show-for-medium medium-6 large-4 cell">
						
						<select name="orderby" id="orderby">
							
							<option value="most-recent">Most Recent</option>
							
		  					<option value="title-a-z">Title A to Z</option>
		  							  					
						</select>
						
					</div>
										
					<div class="small-12 cell tags">
						
						<button class="clear-tags">Clear All</button>
						
					</div>
					
				</div>
				
				<div class="grid-x grid-margin-x grid-margin-y results">
					
					
								
				</div>
				
			</div>
			
		</div>
		
	</div>
	
</div>


<?php get_footer(); ?>
