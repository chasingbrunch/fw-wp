<?php
/*
Template Name: Our Team
*/
			
 $id = get_queried_object_id();
 $parents = get_post_ancestors($id);
 
 $current_page = get_permalink($id);

get_header(); ?>

<?php if ( $parents ): ?>
	
<div class="cb-breadcrumbs grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<?php foreach( $parents as $parent ): ?>
				
			<a href="<?php echo get_permalink( $parent ); ?>"><?php echo get_the_title( $parent ); ?></a> / 
					
		<?php endforeach; ?>
		
	</div>
	
<?php endif; ?>

</div>

<div class="team-header grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<h1>Our Team</h1>
		
	</div>
	
	<div class="about-menu small-10 small-offset-1 cell">
		
		<ul class="menu">
			
			<?php $about_menu = get_field('about_menu', 'option'); ?>
			
			<?php foreach( $about_menu as $menu_item ): ?>
			
				<li>
				
					<a <?php if( $current_page == get_permalink( $menu_item->ID ) ): ?>class="active"<?php endif;?> href="<?php echo get_permalink( $menu_item->ID ); ?>"><?php echo get_the_title( $menu_item->ID ); ?></a>
						
				</li>
			
			<?php endforeach; ?>
			
		</ul>
		
	</div>
	
</div>

<?php if( have_rows( 'team' ) ): ?>

<div class="team-roster grid-x">
	
	<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
		
		<?php while ( have_rows( 'team' ) ) : the_row(); ?>
		
		<div class="team-member grid-x">
			
			<div class="team-headshot small-12 medium-4 cell">
				
				<?php $image = get_sub_field('headshot'); ?>
				
				<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				
			</div>
			
			<div class="team-info small-12 medium-8 cell">
				
				<h3 class="title"><?php the_sub_field('name'); ?></h3>
				
				<h4><?php the_sub_field('title'); ?></h4>
				
				<p><?php the_sub_field('email'); ?></p>
				
				<div class="bio">
					
					<?php the_sub_field('bio'); ?>
					
				</div>
				
			</div>
			
		</div>
		
		<?php endwhile; ?>
		
	</div>
	
</div>

<?php endif; ?>

<?php get_footer(); ?>
