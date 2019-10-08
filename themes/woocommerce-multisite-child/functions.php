<?php
/**
 * Woocommerce Multisite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package eCommerce_Gem
 */

function chile_theme_enqueue_styles()
{
    wp_enqueue_style( 'woocommerce-multisite-child-style', get_stylesheet_uri() );
}

add_action('wp_enqueue_scripts', 'chile_theme_enqueue_styles',999);

