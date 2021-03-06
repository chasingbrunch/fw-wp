<?php
/*
Template Name: Events (Landing)
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

<div class="page-title grid-x">
			
	<div class="small-10 small-offset-1 cell">
				
		<h1><?php the_title(); ?></h1>
										 
	</div>
			
</div>

<?php if( have_rows( 'content_blocks' ) ): ?>
			
	<div class="grid-x content-blocks">
		
		<div class="small-10 small-offset-1 cell">
			
			<div class="grid-x grid-margin-x">
				
				<? while ( have_rows( 'content_blocks' ) ) : the_row(); ?>
				
					<a class="small-12 medium-4 cell content-block" href="<?php the_sub_field('page_link'); ?>">
						
						<div class="image-frame">
							
							<?php $image = get_sub_field( 'image' ); ?>
							
							<?php if( $image ): ?>
								
								<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
							
							<?php else : ?>
							
								<h5><?php the_sub_field('title'); ?></h5>
							
							<?php endif; ?>
							
						</div>
						
						<?php if( $image ): ?>
						
							<h4><?php the_sub_field('title'); ?></h4>
							
						<?php endif; ?>
						
					</a>
				
				<?php endwhile; ?>
				
			</div>
			
		</div>
		
	</div>
		
<? endif; ?> 

<div class="events-sorting post-sorting grid-x">
	
	<div class="small-10 small-offset-1 cell">

		<div class="grid-x show-list" id="sorting">
			
			<div class="filters small-12 medium-3 large-3 cell">
								
				<div class="mobile-scroll-nav">
					
				<h6>Refine Your Search</h6>
					
				<ul id="series">
						
					<?php $children = get_field('featured_pages', 363); ?>
					
					<?php foreach( $children as $child ): ?>
					
						<li><a <?php if( is_page( $child->ID ) ): ?>class="active"<?php endif;?> href="<?php echo get_permalink( $child->ID ); ?>"><?php echo get_the_title( $child->ID ); ?></a></li>
					
					<?php endforeach; ?>
					
					<li><a <?php if( is_page( $id ) ): ?>class="active"<?php endif;?> href="<?php echo get_permalink( 356 ); ?>">All Events</a></li>
												
				</ul>
				
				<input type="hidden" id="current_page" value="1">
				<input type="hidden" id="template" value="events-landing">
				<input type="hidden" id="layout" value="default">
				
				<input type="hidden" id="sorting-type" value="all">
				
				</div>
				
				<hr/>
				
				<h3>Event Stage</h3>
				
				<div id="stage">
					
					<?php $i = 0; ?>
					
					<?php $terms = get_terms( array( 'taxonomy' => 'stage', 'hide_empty' => false, 'orderby' => 'name' ) ); foreach( $terms as $term ) : $i++; ?>
					
						<label for="<?php echo $term->slug; ?>">
						
							<input<?php if( $term_id == $term->term_id ): ?><?php $current_col = $term->slug; ?> checked="checked" <?php endif; ?> name="type" type="radio" value="<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>">
							
							<span></span>
							
							<?php echo $term->name; ?>
							
						</label>
					
					<?php endforeach; ?>
					
					 <input type="hidden" value="">
					
				</div>
				
				<?php if( $i > 5 ): ?><button class="show-more"><i class="fa fa-plus" aria-hidden="true"></i><span></span></button><?php endif; ?>
				
				<hr/>
				
				<h3>Genre</h3>
				
				<div id="genre" class="check">
					
					<?php $i = 0; ?>
					
					<?php $terms = get_terms( array( 'taxonomy' => 'genre', 'hide_empty' => false, 'orderby' => 'name' ) ); foreach( $terms as $term ) : $i++; ?>
					
						<label for="<?php echo $term->slug; ?>">
						
							<input<?php if( $term_id == $term->term_id ): ?><?php $current_cat = $term->slug; ?> checked <?php endif; ?>  name="subject" type="checkbox" value="<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>">
							
							<span></span>
							
							<?php echo $term->name; ?>
							
						</label>
					
					<?php endforeach; ?>
				
					<input type="hidden" value="">
					
				
				</div>
				
				<?php if( $i > 5 ): ?><button class="show-more"><i class="fa fa-plus" aria-hidden="true"></i><span></span></button><?php endif; ?>
				
				<hr/>
				
				<h3>Series</h3>
				
				<div id="event-series">
					
					<?php $i = 0; ?>
					
					<?php $terms = get_terms( array( 'taxonomy' => 'series', 'hide_empty' => false, 'orderby' => 'name' ) ); foreach( $terms as $term ) : $i++; ?>
					
						<label for="<?php echo $term->slug; ?>">
						
							<input<?php if( $term_id == $term->term_id ): ?><?php $current_col = $term->slug; ?> checked="checked" <?php endif; ?> name="type" type="radio" value="<?php echo $term->slug; ?>" id="<?php echo $term->slug; ?>">
							
							<span></span>
							
							<?php echo $term->name; ?>
							
						</label>
					
					<?php endforeach; ?>
					
					 <input type="hidden" value="">
					
				</div>
				
				<?php if( $i > 5 ): ?><button class="show-more"><i class="fa fa-plus" aria-hidden="true"></i><span></span></button><?php endif; ?>
				
				<hr/>
												
				<a class="clear-tags button">Clear All</a>
				
			</div>
			
			<div class="posts small-11 medium-8 large-9 cell">
				
				<div class="grid-x grid-margin-x utility">
					
					<div class="small-10 small-offset-1 medium-offset-0 medium-6 large-8 cell text-right">
				
					View
				
						<button class="show-list active"><i class="fa fa-list" aria-hidden="true"></i></button>
						
						<button class="show-grid"><i class="fa fa-th" aria-hidden="true"></i></button>
						
						<button class="hide-filters">Hide Filters <i class="fa fa-sliders" aria-hidden="true"></i></button>
						
						<button class="show-filters">Show Filters <i class="fa fa-sliders" aria-hidden="true"></i></button>
				
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
