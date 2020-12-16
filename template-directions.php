<?php
/*
Template Name: Directions
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
					
	</div>
	
</div>

<?php endif; ?>

<div class="page-title grid-x">
			
	<div class="small-10 small-offset-1 cell">
				
		<h1>Directions To</h1>
							 
	</div>
			
</div>

<div class="locations grid-x">
	
	<?php if( have_rows( 'locations' ) ): ?>

		<div class="small-10 small-offset-1 cell">
			
			<div class="grid-x grid-margin-x">
	
				<?php while ( have_rows( 'locations' ) ) : the_row(); ?>
			
					<?php $image = get_sub_field('image'); ?>
					<?php $name = get_sub_field('name'); ?>
					<?php $map = get_sub_field('address'); ?>
			
					<a class="location-card small-6 medium-4 cell" href="#<?php echo sanitize_title( $name ); ?>">
						
						<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						
						<h5><?php the_sub_field('name'); ?></h5>
						
						<p><?php echo $map['street_number'] . ' ' . $map['street_name'] . '<br/>' . $map['city'] . ' ' . $map['state_short'] . ' ' . $map['post_code']; ?></p>
						
					</a>
			
				<?php endwhile; ?>
			
			</div>
			
		</div>
		
	<?php endif; ?>
	
</div>

<?php if( have_rows( 'locations' ) ): ?>

	<div class="directions-row">
	
		<?php while ( have_rows( 'locations' ) ) : the_row(); ?>
		
			<?php $image = get_sub_field('image'); ?>
			<?php $name = get_sub_field('name'); ?>
			<?php $map = get_sub_field('address'); ?>
	
			<div class="grid-x grid-margin-y" id="<?php echo sanitize_title( $name ); ?>">

				<div class="small-10 small-offset-1 cell">
					
					<h2><?php the_sub_field('name'); ?></h2>
					
					<h3><?php echo $map['street_number'] . ' ' . $map['street_name'] . '<br/>' . $map['city'] . ' ' . $map['state_short'] . ' ' . $map['post_code']; ?></h3>
					
				</div>
				
				<div class="small-10 small-offset-1 medium-5 cell">
					
					<?php if( have_rows( 'directions' ) ): while ( have_rows( 'directions' ) ) : the_row(); ?>
					
						<div class="direction-row">
					
							<h5><?php the_sub_field( 'title' ); ?></h5>
							
							<div class="more-content">
								
								<?php the_sub_field( 'content' ); ?>
								
							</div>
							
						</div>
						
					<?php endwhile; endif; ?> 
					
					<?php the_sub_field('additional_information'); ?>
					
				</div>
				
				<div class="small-offset-1 small-10 medium-4 cell">
					
					<div class="acf-map" data-zoom="16">
        
						<div class="marker" data-lat="<?php echo esc_attr($map['lat']); ?>" data-lng="<?php echo esc_attr($map['lng']); ?>"></div>
    
    				</div>
					
				</div>
				
			</div>
			
		<?php endwhile; ?>
		
	</div>

<?php endif; ?>


<?php get_footer(); ?>
