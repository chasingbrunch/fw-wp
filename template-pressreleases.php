<?php
/*
Template Name: Press Release Archive
*/

 $id = get_queried_object_id();
 $parents = get_post_ancestors($id);
 
 $header_image = get_field('header_image');
 $page_title = get_field('page_title');
 $content = get_field('content');
 
 $terms = get_terms( array( 'taxonomy' => 'release', 'hide_empty' => true, ) );

get_header(); ?>

<?php if ( $parents ): ?>
	
<div class="cb-breadcrumbs grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<?php foreach( $parents as $parent ): ?>
				
			<a href="<?php echo get_permalink( $parent ); ?>"><?php echo get_the_title( $parent ); ?></a> / 
					
		<?php endforeach; ?>
			
		<a href="<?php the_permalink(); ?>"><?php the_field('page_title'); ?></a>
		
	</div>
	
</div>

<?php endif; ?>

<div class="post-archive grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<div class="grid-x">
	
			<div class="archive-title small-12 medium-8 medium-offset-4 cell">
		
				<h1><?php echo $page_title; ?></h1>
				
			</div>
			
			<div class="side-nav small-12 medium-3 cell">
				
				<?php $i = 0; ?>
				
				<?php foreach( $terms as $term ) : ?>
					
					<?php $i++; ?>
		
					<button class="<?php if( $i == 1 ):?>active<?php endif; ?>" data-term="<?php echo $term->slug; ?>"><h4><?php echo $term->name; ?></h4></button>
						
				<?php endforeach; ?>
				
			</div>
			
			<div class="archive-content small-12 medium-offset-1 medium-7 cell">
				
				<?php foreach( $terms as $term ) : ?>
				
					<div class="archive-group" data-term="<?php echo $term->slug; ?>">
						
						<?php $tax_query = array(
				
							array(
								'taxonomy' => 'release',
								'field'    => 'slug',
								'terms'    => $term->slug,
							),
												
						); 
							
						$args = array(
							'post_type' => 'press-release',
							'tax_query' => $tax_query,	
							'posts_per_page' => -1,
									
						);
							
						$query = new WP_Query( $args );
			
						while ( $query->have_posts() ) : $query->the_post(); ?>

						<a class="archive-result" href="<?php the_permalink(); ?>">
								
							<h3><?php the_field('title'); ?></h3>
							<h6><?php the_field('date'); ?></h6>
								
						</a>
		
						<?php endwhile; ?>
							
						<?php wp_reset_postdata(); ?>
						
					</div>
				
				<?php endforeach; ?>
				
			</div>
			
		</div>	
		
	</div>	
	
</div>

<?php get_footer(); ?>
