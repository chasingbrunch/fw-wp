<?php
/*
Template Name: Simple Page
*/

$id = get_queried_object_id();
$parents = get_post_ancestors($id);
 
$page_title = get_field('title');
$date = get_field('date');
$content = get_field('content');

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

<?php if( $page_title ): ?>

	<div class="page-title grid-x">
			
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 cell">
				
			<h1><?php echo $page_title; ?></h1>
			
			<?php if( $date ):?><h6><?php echo $date; ?></h6><?php endif; ?>
							 
		</div>
			
	</div>

<?php endif; ?>

<?php if( $content ): ?>

	<div class="page-content grid-x">
			
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 cell">
				
			<?php echo $content; ?>
				 
		</div>
			
	</div>

<?php endif; ?>

<?php get_footer(); ?>