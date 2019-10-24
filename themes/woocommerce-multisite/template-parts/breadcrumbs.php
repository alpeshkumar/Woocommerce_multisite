<?php
/**
 * Breadcrumbs.
 *
 * @package multisite_Ab
 */

// Bail if front page.
if ( is_front_page() || is_page_template( 'templates/home.php' ) ) {
	return;
}

$breadcrumb_type = ecommerce_gem_get_option( 'breadcrumb_type' );
if ( 'disable' === $breadcrumb_type ) {
	return;
}

if ( ! function_exists( 'ecommerce_gem_breadcrumb_trail' ) ) {
	require_once trailingslashit( get_template_directory() ) . '/assets/vendor/breadcrumbs/breadcrumbs.php';
}
?>

<div id="breadcrumb">
	<div class="container">
		<?php

		$breadcrumb_text = ecommerce_gem_get_option( 'breadcrumb_text' );

		$breadcrumb_args = array(
			'container'   => 'div',
			'show_browse' => false,
			
		);

		if( !empty( $breadcrumb_text ) ){

			$breadcrumb_args['labels']['home'] = esc_html( $breadcrumb_text );
		}

		ecommerce_gem_breadcrumb_trail( $breadcrumb_args );
		
		?>
	</div><!-- .container -->
</div><!-- #breadcrumb -->
<?php
if(is_shop() || is_product_category()){
	dynamic_sidebar( 'shop-category-banner' );
}
