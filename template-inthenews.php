<?php
/*
Template Name: In The News
*/


 $id = get_queried_object_id();
 $parents = get_post_ancestors($id);

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

<div class="post-archive grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<div class="grid-x">
	
			<div class="archive-title small-12 medium-8 medium-offset-4 cell">
		
				<h1><?php the_title(); ?></h1>
				
			</div>
			
			<div class="side-nav small-12 medium-3 cell">
				
				<?php $i = 0; ?>
				
				<?php if( have_rows( 'season' ) ): while ( have_rows( 'season' ) ) : the_row(); ?>
				
				<?php $i++; ?>
				
					<?php $title = get_sub_field('title'); $term = sanitize_title($title); ?>

					<button class="<?php if( $i == 1 ):?>active<?php endif; ?>" data-term="<?php echo $term; ?>"><h4><?php the_sub_field('title'); ?></h4></button>
						
				<?php endwhile; endif; ?>
				
			</div>
			
			<div class="archive-content small-12 medium-offset-1 medium-7 cell">
				
				<?php if( have_rows( 'season' ) ): while ( have_rows( 'season' ) ) : the_row(); ?>
				
					<?php $title = get_sub_field('title'); $term = sanitize_title($title); ?>
				
					<div class="archive-group" data-term="<?php echo $term; ?>">
						
						<?php if( have_rows( 'articles' ) ): while ( have_rows( 'articles' ) ) : the_row(); ?>
						
						<a class="archive-result" href="<?php the_sub_field('url'); ?>">
								
							<h3><?php the_sub_field('title'); ?> <i class="fa fa-external-link" aria-hidden="true"></i></h3>
							<p><?php the_sub_field('source'); ?></p>
							<h6><?php the_sub_field('date'); ?></h6>
								
						</a>
		
						<?php endwhile; endif; ?>
													
					</div>
				
				<?php endwhile; endif; ?>
				
			</div>
			
		</div>	
		
	</div>	
	
</div>

<?php get_footer(); ?>
