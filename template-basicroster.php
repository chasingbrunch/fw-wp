<?php
/*
Template Name: Basic Roster
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

<div class="basic-roster grid-x">
	
	<div class="small-10 small-offset-1 cell">
		
		<div class="grid-x">
		
		<?php while ( have_rows( 'team' ) ) : the_row(); ?>
		
			<?php $headshot = get_sub_field('headshot');
				  $name = get_sub_field('name');
			      $title = get_sub_field('title');
				  $bio = get_sub_field('bio');?>
		
			<div class="small-12 medium-3 cell">
				
				<?php if( $headshot ): ?>
				
					<img src="<?php echo esc_url($headshot['url']); ?>" alt="<?php echo esc_attr($headshot['alt']); ?>" />
				
				<?php endif; ?>
				
				<?php if( $name ): ?>
				
					<h5><?php echo $name; ?></h5>
				
				<?php endif; ?>
				
				<?php if( $title ): ?>
				
					<h6><?php echo $title; ?></h6>
				
				<?php endif; ?>
				
				<?php if( $bio ): ?>
				
					<?php echo $bio; ?>
				
				<?php endif; ?>				
				
			</div>
		
		<?php endwhile; ?>
		
		</div>
		
	</div>
	
</div>
		
<?php endif; ?>

<?php get_footer(); ?>
