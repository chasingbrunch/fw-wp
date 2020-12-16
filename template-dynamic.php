<?php
/*
Template Name: Dynamic (Row Elements)
*/

get_header(); ?>
			
<?php if( have_rows( 'dynamic_elements' ) ): while ( have_rows( 'dynamic_elements' ) ) : the_row(); ?>
			
	<?php if( get_row_layout() == 'hero_banner' ): ?>
	
		<?php $alignment = get_sub_field('alignment');
			  $background_type = get_sub_field('background_type');
			  $background_image = get_sub_field('background_image');
			  $background_video = get_sub_field('background_video');
			  preg_match('/src="(.+?)"/', $background_video, $url);
			  $video_source = parse_video_uri( $url[1] );
			  $title = get_sub_field('title'); ?>
			  
			  <div class="hero-banner grid-x">
				  
				  <?php if( $background_type == 'video' && $video_source['type'] == 'youtube' ): ?><div data-youtube="https://www.youtube.com/watch?v=<?php echo $video_source['id']; ?>"></div>
				  
				  <?php else: ?>
				 	 <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" />
				  <?php endif; ?>
				  
				  <?php if( $alignment == 'left' ): ?>
				  
				  <div class="small-10 small-offset-1 medium-5 cell">
					  
				  <?php else : ?>
				  
				  <div class="small-10 small-offset-1 medium-offset-6 medium-5 cell">
					  
				  <?php endif; ?>
					  
				  	<h1><?php echo $title; ?></h1>
				  
				  	<?php the_sub_field('caption'); ?>
					  
				  </div>
				  
			  </div>
					
	<?php elseif( get_row_layout() == 'hero_slider' ): ?>
	
		<div class="hero-slider">
	
		<?php if( have_rows( 'slides' ) ): while ( have_rows( 'slides' ) ) : the_row(); ?>
		
			<?php $alignment = get_sub_field('alignment');
				  $background_type = get_sub_field('background_type');
				  $background_image = get_sub_field('background_image');
				  $background_video = get_sub_field('background_video');
				  preg_match('/src="(.+?)"/', $background_video, $url);
				  $video_source = parse_video_uri( $url[1] );
				  $title = get_sub_field('title');
				  $content = get_sub_field('content');
				  $caption = get_sub_field('caption'); ?>
				  
				  <div class="hero-slide hero-banner grid-x">
					  
					  <?php if( $background_type == 'video' && $video_source['type'] == 'youtube' ): ?><div data-youtube="https://www.youtube.com/watch?v=<?php echo $video_source['id']; ?>"></div>
					  
					  <?php else: ?>
					  
					 	 <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" />
					 	 
					  <?php endif; ?>
					  
					  <?php if( $alignment == 'left' ): ?>
					  
					  <div class="small-10 small-offset-1 medium-5 cell">
						  
					  <?php else : ?>
					  
					  <div class="small-10 small-offset-1 medium-offset-6 medium-5 cell">
						  
					  <?php endif; ?>
						  
					  	<h3><?php echo $content; ?></h3>
						  
					  </div>
					  
					 <div class="slide-caption">
						
						<?php if( $slide_type == 'video' && $video_source['type'] == 'youtube' ): ?>
						
							<button class="pause"><i class="fa fa-pause-circle-o"></i></button> 
							
						<?php endif;?>
						
						<?php echo $caption; ?>
						
					</div>
					  
				  </div>
		
		<?php endwhile; endif; ?>
		
		</div>
		
	<?php elseif( get_row_layout() == 'banner_text' ): ?>
	
		<?php $color_scheme = get_sub_field('color_scheme');
			  $content = get_sub_field('content'); ?>
			  
			 <div class="banner-text grid-x <?php echo $color_scheme; ?>">
				 
				 <div class="small-10 small-offset-1 medium-6 medium-offset-3 cell">
					 
					 <h3><?php echo $content; ?></h3>
					 
				 </div>
				 
			 </div>
			 
		
	<?php elseif( get_row_layout() == 'image_half' ): ?>
	
		<?php $alignment = get_sub_field('alignment');
			  $image = get_sub_field('image');
			  $header = get_sub_field('header');
			  $content = get_sub_field('content');
			  $call_to_action = get_sub_field('call_to_action');
			  $url = get_sub_field('url'); ?>
			  
			  
			  <div class="image-half grid-x <?php echo $alignment; ?>">
				  
				  <div class="small-10 small-offset-1 medium-5 cell half-image">
					  
					  <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
					  
				  </div>
				  
				  <div class="small-10 small-offset-1 medium-4 cell half-content">
					  
					  <h3><?php echo $header; ?></h3>
					  
					  <?php echo $content; ?>
					  
					  <a class="inline-cta" href="<?php echo $url; ?>"><?php echo $call_to_action; ?></a>
					  
				  </div>
				  
			  </div>
		
	<?php elseif( get_row_layout() == 'image_full' ): ?>
	
		<?php $image = get_sub_field('image'); ?>
		
		<div class="image-full grid-x">
			
			<div class="small-10 small-offset-1 cell">
				
				 <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				 
			</div>
			
		</div>
		
	<?php elseif( get_row_layout() == 'video_full' ): ?>
	
		<?php $caption = get_sub_field('caption');
			  $video = get_sub_field('video'); ?>
			  
			  <div class="video-full grid-x">
				  
				  <div class="small-10 small-offset-1 cell">
					  
					  <div class="video-frame">
						  
						  <?php echo $video; ?>
						  
					  </div>
					  
				  </div>
				  
			  </div>
		
	<?php elseif( get_row_layout() == 'text_full' ): ?>
	
		<?php $content = get_sub_field('content'); ?>
		
		<div class="text-full grid-x">
				  
			<div class="small-10 small-offset-1 medium-8 medium-offset-2 cell">
						  
				<?php echo $content; ?>
						  
			</div>
				  
		</div>
		
	<?php elseif( get_row_layout() == 'artist_highlight_reels' ): ?>
	
		<div class="artist-highlight-reels grid-x">
	
		<?php if( have_rows( 'reel' ) ): while ( have_rows( 'reel' ) ) : the_row(); ?>
		
			<?php $artist = get_sub_field('artist');
			  	  $title = get_sub_field('title');
			  	  $artist = get_term( $artist, 'artist' );
			  	  $image = get_field('headshot', $artist);
			  	  $cards = get_sub_field('content_blocks'); 
				  $count = count( $cards ); ?>
		
			<div class="artist small-10 small-offset-1 cell">
				
				<div class="grid-x">
					
					<div class="small-12 medium-4 cell artist-info">
						
						<div class="artist-headshot">
							 <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						</div>
						
						<h3><?php echo $artist->name; ?></h3>
						
						<h5><?php echo $title; ?></h5>
						
					</div>
					
					<div class="small-12 medium-8 cell">
						
						<div class="grid-x highlight-reel <?php if( $count < 4 ): ?>no-slider<?php endif;?>">
							
							<?php if( have_rows( 'content_blocks' ) ): while ( have_rows( 'content_blocks' ) ) : the_row(); ?>
							 
							<?php $content_type = get_sub_field('content_type');
								$image = get_sub_field('image');
								$video = get_sub_field('video');
								$page_link = get_sub_field('page_link');
								$title = get_sub_field('title');
								$content = get_sub_field('content'); ?>
							
							<a class="small-12 medium-4 cell" href="<?php echo $page_link; ?>">
								
								<?php if( $content_type == 'image' ): ?>
								
									<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
								
								<?php elseif( $content_type == 'video' ): ?>
								
									<?php echo $video; ?>
								
								<?php endif; ?>
								
								<h4><?php echo $title; ?></h4>
								
								<?php echo $content; ?>
								
							</a>
							
							<?php endwhile; endif; ?>	 
							
						</div>
						
					</div>
					
				</div>
			  
			</div>
		
		<?php endwhile; endif; ?>
		
		</div>
		
	<?php elseif( get_row_layout() == 'banner_cta' ): ?>
	
		<?php $page_link = get_sub_field('page_link');
			  $background_type = get_sub_field('background_type');
			  $background_image = get_sub_field('background_image');
			  $background_video = get_sub_field('background_video');
			  $title = get_sub_field('title');
			  $content = get_sub_field('content');
			  $button_text = get_sub_field('button_text'); ?>
			  
			  <a class="banner-cta hero-banner grid-x" href="<?php echo $page_link; ?>">
				  
				  <?php if( $background_type == 'video' && $video_source['type'] == 'youtube' ): ?><div data-youtube="https://www.youtube.com/watch?v=<?php echo $video_source['id']; ?>"></div>
				  
				  <?php else: ?>
				  
				 	 <img src="<?php echo esc_url($background_image['url']); ?>" alt="<?php echo esc_attr($background_image['alt']); ?>" />
				 	 
				  <?php endif; ?>
				  
				  <div class="small-10 small-offset-1 medium-5 cell">
					  
				  	<h3><?php echo $title; ?></h3>
				  
				  	<h4><?php echo $content; ?></h4>
				  	
				  	<h5><?php echo $button_text; ?></h5>
					  
				  </div>
				  
			  </a>

		
	<?php elseif( get_row_layout() == 'content_cards_group' ): ?>
	
		<?php $row_title = get_sub_field('row_title'); ?>
		
		<div class="content-cards-group grid-x">
			
			<div class="small-10 small-offset-1 cell row-title">
				
				<h5><?php echo $row_title; ?></h5>
				
			</div>
			
			<div class="small-10 small-offset-1 cell">
				
				<div class="grid-x grid-margin-x grid-margin-y">
			
				<?php if( have_rows( 'content_cards' ) ): while ( have_rows( 'content_cards' ) ) : the_row(); ?>
			
					<?php $image = get_sub_field('image');
					  	$page_link = get_sub_field('page_link');
					  	$title = get_sub_field('title');
					  	$content = get_sub_field('content');
					  	$call_to_action = get_sub_field('call_to_action'); ?>
					  
					<div class="small-12 medium-4 cell">
						  
						<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
						  
						<h5><?php echo $title; ?></h5>
						  
						<?php echo $content; ?>
						  
						 <a href="<?php echo $page_link; ?>"><h6><?php echo $call_to_action; ?></h6></a>
						  
					</div>
					
				<?php endwhile; endif; ?>	
					  
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
		
	<?php endif; ?>
		
<?php endwhile; endif; ?>

<?php get_footer(); ?>
