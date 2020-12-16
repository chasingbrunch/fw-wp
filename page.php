<?php 
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 */
 
 $id = get_queried_object_id();
 $parents = get_post_ancestors($id);
 
 $header_image = get_field('header_image');
 $page_title = get_field('page_title');
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

<?php if( $header_image ): ?>

	<div class="image-full grid-x">
			
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
				
			<img src="<?php echo esc_url($header_image['url']); ?>" alt="<?php echo esc_attr($header_image['alt']); ?>" />
				 
		</div>
			
	</div>

<?php endif; ?>

<?php if( $page_title ): ?>

	<div class="page-title grid-x">
			
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
				
			<h1><?php echo $page_title; ?></h1>
				 
		</div>
			
	</div>

<?php endif; ?>

<?php if( $content ): ?>

	<div class="page-content grid-x">
			
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
				
			<?php echo $content; ?>
				 
		</div>
			
	</div>

<?php endif; ?>

<?php if( have_rows( 'dynamic_elements' ) ): while ( have_rows( 'dynamic_elements' ) ) : the_row(); ?>
			
	<?php if( get_row_layout() == 'image_gallery' ): ?>
	
	<?php $images = get_sub_field('image_gallery'); ?>
	
	<div class="image-gallery grid-x">
		
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
			
			<div class="grid-x grid-margin-x grid-margin-y">
				
				<?php foreach( $images as $image ): ?>
				 
					<div class="small-4 medium-3 cell">
						
						<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						
					</div> 
				 
				<?php endforeach; ?>
				
			</div>
			
		</div>
		
	</div>
	
	<?php elseif( get_row_layout() == 'button_cta' ): ?>
	
	<?php $url = get_sub_field('url');
		  $button_text = get_sub_field('button_text'); ?>
	
	<div class="button-cta grid-x">
		
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
			
			<div class="cta-frame">
				
				<a class="button" href="<?php echo $url; ?>"><?php echo $button_text; ?></a>
				
			</div>
						
		</div>
		
	</div>
	
	<?php elseif( get_row_layout() == 'sub_section' ): ?>
	
	<?php $image = get_sub_field('image');
		  $video = get_sub_field('video');
	      $title = get_sub_field('title');
		  $content = get_sub_field('content'); ?>
	
	<div class="sub-section grid-x">
		
		<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
			
			<?php if( $image ): ?>
			
				<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
			
			<?php endif; ?>
			
			<?php if ( $video ): ?>
			
				<?php echo $video; ?>
			
			<?php endif; ?>
			
			<h3><?php echo $title; ?></h3>
			
			<?php echo $content; ?>
						
		</div>
		
	</div>
	
	<?php endif; ?>
	
<?php endwhile; endif; ?>

<?php get_footer(); ?>