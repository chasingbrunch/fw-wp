<?php
/*
Template Name: Checkout (Donation)
*/

get_header(); ?>

<div class="page-frame grid-x">
	
	<div class="content small-10 small-offset-1 cell">
		
		<div class="checkout-donation grid-x grid-margin-y grid-margin-x">
			
			<div class="small-offset-5 small-2 cell">
				
				<img src="<?php echo get_template_directory_uri(); ?>/assets/images/FirstWorks-Web-Logo.png" alt="FirstWorks">
				
			</div>
			
			<div class="small-10 small-offset-1 medium-6 cell order-form">
						
				<?php echo do_shortcode('[gravityform id="2" title="false" description="false" ajax="true" tabindex="49"]'); ?>
				
				<div class="review-order">
			
					<h4>Billing Information</h4>
					
					<p><span class="order-name"></span></p>
					<p><span class="order-billing-address"></span></p>
					<br/>
					<p>Credit Card Payment</p>
					<br/>
					<h4>Contact Information</h4>
					<p><span class="order-shipping-address"></span></p>
					<br/>
					<p><span class="order-phone"></span></p>
					<p><span class="order-email"></span></p>
					<div class="cta-frame">
						<buton class="button edit-order">Edit Order</buton>
					</div>
					
				</div>
				
			</div>
			
			<div class="order-summary small-10 small-offset-1 medium-offset-0 medium-4 cell">
				
				<h4>Order Summary</h4>
				
				<div class="grid-x">
					
					<div class="small-6 cell"><h6 class="product-name">Donation (<span></span>)</h6></div>
					
					<div class="small-6 cell"><h6 class="donation-price">$<span></span></h6></div>
						
					<div class="small-12 cell"><hr/></div>
					
					<div class="small-6 cell total"><h3>Total</h3></div>
					
					<div class="small-6 cell total"><h3 class="donation-total"></h3></div>
					
				</div>
				
				<div class="cta-frame">
					
					<button class="review-purchase button">Review Purchase</button>
					<button class="checkout-submit button">Complete Payment</button>
					
				</div>
				
				<div class="disclaimer">
				
					<?php the_field('disclaimer'); ?>
				
				</div>
				
			</div>
			
		</div>
		
	</div>

</div>

<?php get_footer(); ?>
