<?php 
/**
 * The template for displaying press release singles
 */
 
$press_release_archive = get_page_by_title('Press Releases');
$archive_url = get_permalink( $press_release_archive );
$parents = get_post_ancestors( $press_release_archive );
 
$page_title = get_field('title');
$date = get_field('date');
$content = get_field('content');

$season = get_term( $id, 'year' );

get_header(); ?>


<?php if ( $parents ): ?>
	
<div class="cb-breadcrumbs grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<?php foreach( $parents as $parent ): ?>
				
			<a href="<?php echo get_post_permalink( $parent ); ?>"><?php echo get_the_title( $parent ); ?></a> / 
					
		<?php endforeach; ?>
			
		<a href="<?php echo $archive_url; ?>">Press Releases</a>
		
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

<?php if( have_rows( 'download_links' ) ): ?>
	
	<div class="grid-x link-table">
		
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 cell">
			
			<div class="grid-x">
									
				<?php while( have_rows( 'download_links' ) ): the_row(); ?>
				
					<?php $file = get_sub_field('file'); ?>
										
					<a class="small-12 cell link-row" <?php if( $file ) : ?>href="<?php echo $file['url']; ?>"<?php endif; ?>>
											
						<h4><?php the_sub_field( 'title' ); ?></h4>
							
						<div class="icon"><i class="fa fa-file-pdf-o"></i></div>
											
					</a>
										
				<?php endwhile; ?>
									
			</div>
			
		</div>
		
	</div>
	
<?php endif; ?>

<?php get_footer(); ?>