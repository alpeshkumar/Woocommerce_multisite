<?php
/**
 * Footer widgets.
 *
 * @package eCommerce_Gem
 */

if ( is_active_sidebar( 'footer_newsletter' ) ||
	 is_active_sidebar( 'footer_social_link' ) ) :
?>

	<aside id="footer-newsletter" class="widget-area" role="complementary">
		<div class="outer-wrapper">
			<div class="container">
				<div class="inner-wrapper">
					<div class="footer_newsletter">
						<?php dynamic_sidebar( 'footer_newsletter' ); ?>
					</div>
					<div class="footer_social_link">
						<?php dynamic_sidebar( 'footer_social_link' ); ?>
					</div>
				</div><!-- .inner-wrapper -->
			</div><!-- .container -->
		</div>
	</aside><!-- #footer-widgets -->

<?php endif;
