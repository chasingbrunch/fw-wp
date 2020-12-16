<?php
/*
Template Name: Careers
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

<div class="page-title grid-x">
			
	<div class="small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 cell">
				
		<h1><?php the_title(); ?></h1>
				 
	</div>
			
</div>

<?php if( $content ): ?>

	<div class="page-content grid-x">
			
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 cell">
				
			<?php echo $content; ?>
				 
		</div>
			
	</div>

<?php endif; ?>

<?php if( have_rows( 'careers' ) ): ?>

	<div class="careers grid-x">
	
	<?php while ( have_rows( 'careers' ) ) : the_row(); ?>
	
		<div class="career-post small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 cell">
			
			<h3 class="title"><?php the_sub_field('title'); ?></h3>
			
			<h4><?php the_sub_field('job_type'); ?></h4>
			
			<p>POSTED: <?php the_sub_field('date'); ?></p>
			
			<?php the_sub_field('description'); ?>
			
			<div class="more-content">
				
				<?php the_sub_field('additional_information'); ?>
				
			</div>
			
		</div>
	
	<?php endwhile; ?>
	
	</div>
	
<?php endif; ?>

<?php get_footer(); ?>