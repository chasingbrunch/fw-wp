<?php
/*
Template Name: Make a Donation
*/

get_header(); ?>
			
<div class="page-frame grid-x">
	
	<div class="content small-10 small-offset-1 cell">
		
		<div class="page-title grid-x">
			
			<div class="small-10 small-offset-1 cell">
		
				<h1><?php the_title(); ?></h1>
				
			</div>
			
		</div>
		
		<div class="grid-x grid-margin-x make-a-donation">
		
			<div class="small-10 small-offset-1 medium-6 cell">
				
				<?php $image = get_field('featured_image'); ?>
				
				<img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
				
				<?php the_field('content'); ?>
				
			</div>
			
			<div class="donation-select monthly small-10 small-offset-1 medium-offset-0 medium-4 cell">
				
				<div class="donation-type">
					
					<button class="active" data-donate="monthly">Monthly</button>
					
					<button data-donate="one-time">One Time</button>
					
				</div>
				
				<?php if( have_rows( 'tiers' ) ): while ( have_rows( 'tiers' ) ) : the_row(); ?>
				
				<button class="donation-tier" data-amount="<?php the_sub_field('amount'); ?>">
				
					<h5>$<?php the_sub_field('amount'); ?></h5>
					
					<p><?php the_sub_field('description'); ?></p>
					
				</button>
				
				<?php endwhile; endif; ?>
				
				<label class="custom-label" for="custom-amount">Custom Amount</label>
				
				<input data-amount="" type="number" id="custom-amount" name="custom-amount">
				
				<div class="monthly-message"><i class="fa fa-info-circle" aria-hidden="true"></i> Your credit card will be charged automatically on the first of each month.</div>
				
				<div class="cta-frame">
					
					<button data-url="<?php echo get_site_url();?>/donate/checkout/" class="button make-donation">Make Donation</button>
					
				</div>
				
			</div>
			
		</div>
												 						
	</div>
	
</div>

<?php get_footer(); ?>
