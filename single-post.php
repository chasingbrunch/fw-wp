<?php 
/**
 * The template for displaying posts
 */
 
$archive = get_page_by_title('Messages');
$archive_url = get_permalink( $archive );
$parents = get_post_ancestors( $archive );
 
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
			
		<a href="<?php echo $archive_url; ?>">Messages</a>
		
	</div>
	
</div>

<?php endif; ?>

<?php if( $page_title ): ?>

	<div class="page-title grid-x">
			
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 cell">
				
			<h1><?php echo $page_title; ?></h1>
			
			<?php if( $date ):?><h4><?php echo $date; ?></h4><?php endif; ?>
							 
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