<?php
/**
 * Footer widgets.
 *
 * @package multisite_Ab
 */

if ( is_active_sidebar( 'footer_newsletter' ) ||
	 is_active_sidebar( 'footer_social_link' ) ) :
?>

	<aside id="footer-newsletter" class="widget-area" role="complementary">
		<div class="outer-wrapper">
			<div class="container">
				<div class="inner-wrapper">
					<div class="footer_newsletter vc_col-md-8">
						<?php dynamic_sidebar( 'footer_newsletter' ); ?>
					</div>
					<div class="footer_social_link vc_col-md-4">
						<?php dynamic_sidebar( 'footer_social_link' ); ?>
					</div>
				</div><!-- .inner-wrapper -->
			</div><!-- .container -->
		</div>
	</aside><!-- #footer-widgets -->

<?php endif;
