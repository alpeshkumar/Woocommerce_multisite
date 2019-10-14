<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package multisite_Ab
 */

	/**
	 * Hook - ecommerce_gem_after_content.
	 *
	 * @hooked ecommerce_gem_after_content_action - 10
	 */
	do_action( 'ecommerce_gem_after_content' );

?>

	<?php get_template_part( 'template-parts/footer-newsletter' ); ?>
	
	<?php get_template_part( 'template-parts/footer-widgets' ); ?>

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="container">
			<div class="site-footer-wrap">
				<?php 

				$copyright_text = ecommerce_gem_get_option( 'copyright_text' ); 
				$powered_by_text = ecommerce_gem_get_option( 'powered_by_text' ); 

				if ( ! empty( $copyright_text ) ) : ?>

					<div class="copyright">

						<?php echo $copyright_text; ?>

					</div><!-- .copyright -->

					<?php 

				endif; 
				?>
				<div class="site-info">
				<?php echo wp_kses_data( $powered_by_text ); ?>
				</div><!-- .site-info -->
					</div>
		</div><!-- .container -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
