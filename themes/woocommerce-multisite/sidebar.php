<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package multisite_Ab
 */

?>

<aside id="sidebar-primary" class="widget-area sidebar" role="complementary">
	<?php 

	if( class_exists( 'WooCommerce' ) && is_woocommerce() ){
		if(is_product()){
			dynamic_sidebar( 'single-product-page' ); 
		}
		else{
			dynamic_sidebar( 'shop-sidebar' ); 
		}
		

	}else{

		dynamic_sidebar( 'sidebar-1' ); 

	}

	?>
</aside><!-- #secondary -->
