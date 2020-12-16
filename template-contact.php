<?php
/*
Template Name: Contact
*/

$id = get_queried_object_id();
$parents = get_post_ancestors($id);

$content = get_field( 'general_information' );
$shortcode = get_field( 'form_shortcode' );

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
			
			<?php echo do_shortcode( $shortcode ); ?>
				 
		</div>
			
	</div>

<?php endif; ?>

<?php if( have_rows( 'contacts' ) ): ?>

	<div class="contact-posts careers grid-x">
	
	<?php while ( have_rows( 'contacts' ) ) : the_row(); ?>
	
		<div class="career-post small-10 small-offset-1 medium-8 medium-offset-2 large-6 large-offset-3 cell">
			
			<h3 class="title"><?php the_sub_field( 'name' ); ?></h3>
			
			<div class="more-content">
				
				<?php the_sub_field( 'information' ); ?>
				
			</div>
			
		</div>
	
	<?php endwhile; ?>
	
	</div>
	
<?php endif; ?>


<?php get_footer(); ?>