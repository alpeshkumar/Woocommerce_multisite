<?php
/**
 * Woocommerce Multisite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package multisite_Ab
 */
 
function theme_enqueue_styles()
{
    wp_enqueue_style('custom_style', get_template_directory_uri() . '/custom_style.css');
}

add_action('wp_enqueue_scripts', 'theme_enqueue_styles', 20);

function add_search_form($items, $args) {
	
	/*
	echo '<pre>';
	print_r($args);
	echo '<pre>';
	*/
		
    if( $args->theme_location == 'primary' ){
		
		
		/*
		* Cart Icon Menu
		*/
		$cart_icon  = ecommerce_gem_get_option( 'cart_icon' );
		$items .= '<li class="menu-item custom_cart_menu">';		
		$items .= '<div class="top-cart-wrapper">';		
		$items .= '<div class="top-icon-wrap">';		
		$items .= '<a href="' . esc_url( wc_get_cart_url() ) . '">';
		$items .= '<i class="fa ' .  esc_attr( $cart_icon ) . '" aria-hidden="true"></i>';
		$items .= '<span class="cart-value ec-cart-fragment"> ' .  wp_kses_data( WC()->cart->get_cart_contents_count() ) . '</span>';
		$items .= '</a>';
		$items .= '</div>';		
		$items .= "<div class='top-cart-content'>" .   do_shortcode('[custom_cart]') . "</div>";
		$items .= '</div>';		
		$items .= '</li>';
		
		
		
		/*
		* Search Icon Menu
		*/
		$items .= '<li class="menu-item">';
				
		$items .= '<div class="search-holder">

					<a href="#" class="search-btn"><i class="fa fa-search"></i></a>

					<div class="search-box" style="display: none;">';				  
					  
		if ( class_exists( 'WooCommerce' ) ) {

			// For search products placeholder text
			$search_products_text  = ecommerce_gem_get_option( 'search_products_text' );

			if( !empty( $search_products_text ) ){

				$product_search_text = esc_attr( $search_products_text );

			}else{

				$product_search_text =  esc_attr_x( 'Search Products &hellip;', 'placeholder', 'woocommerce-multisite' );
			}

			// For select category text
			$select_category_text  = ecommerce_gem_get_option( 'select_category_text' );

			if( !empty( $select_category_text ) ){

				$product_category_text = esc_html( $select_category_text );

			}else{

				$product_category_text =  esc_html__( 'Select Category', 'woocommerce-multisite' );
						  
			}
			
			$items .= '<div class="product-search-wrapper">';
			
			$items .= '<form role="search" method="get" action="'. esc_url( home_url( '/' ) ) . '">';
			
			$items .= '<input type="hidden" name="post_type" value="product" />';			
			$items .= '<input type="text" class="search-field products-search" placeholder="'. $product_search_text . '" value="'. get_search_query() . '" name="s" />';			
			$items .= '<select class="product-cat" name="product_cat">';
			$items .= '<option value="">'. $product_category_text . '</option> ';
			$categories = get_categories( 'taxonomy=product_cat' );
			foreach ( $categories as $category ) {

				$items .= '<option value="' . esc_attr( $category->category_nicename ) . '"'.ecommerce_gem_selected_category( $category->category_nicename ).'>';

				$items .= esc_html( $category->cat_name );

				$items .= ' (' . absint( $category->category_count ) . ')';
				
				$items .= '</option>';
			}
			
			$items .= '</select>';
			
			$items .= '<button type="submit" class="search-submit"><span class="screen-reader-text">'. esc_attr_x( "Search", "submit button", "woocommerce-multisite" ). '</span><i class="fa fa-search" aria-hidden="true"></i></button>';
			
			$items .= '</form>';
			
			$items .= '</div>';
			
			
			
		}
					  
		$items .= '</li>';
	
    }
	
    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);


//=============================================================
// Top header hook of the theme
//=============================================================
if ( ! function_exists( 'ecommerce_gem_top_header_action' ) ) :
    /**
     * Header Start.
     *
     * @since 1.0.0
     */
    function ecommerce_gem_top_header_action() {

        // Top header status.
        $header_status = ecommerce_gem_get_option( 'show_top_header' );
        if ( 1 != $header_status ) {
            return;
        } ?>

        <div id="top-bar" class="top-header">
            <div class="container">
                <div class="top-left">

                    <?php

                    // Top Left type.
                    $top_left_type  = ecommerce_gem_get_option( 'top_left_type' );

                    if( 'current-date' === $top_left_type ) {
                        
                        do_action( 'ecommerce_gem_top_header_current_date' );

                    }elseif( 'menu' === $top_left_type ) {
                        
                        do_action( 'ecommerce_gem_top_header_menu' );

                    }elseif( 'social-icons' === $top_left_type && has_nav_menu( 'social' ) ){ ?>

                        <div class="top-social-menu menu-social-menu-container social-widget-left">

                            <?php the_widget( 'eCommerce_Gem_Social_Widget' ); ?>
                            
                        </div><!-- .social-widgets -->

                        <?php

                    }else{

                        do_action( 'ecommerce_gem_top_header_store_information' );

                    } ?>

                </div>
                
                <div class="top-right">
                    <?php 

                    $show_social_icons  = ecommerce_gem_get_option( 'show_social_icons' );

                    if( true === $show_social_icons && has_nav_menu( 'social' ) ){ ?>

                        <div class="top-social-menu menu-social-menu-container"> 

                            <?php the_widget( 'eCommerce_Gem_Social_Widget' ); ?>

                        </div>
                        <?php
                    }

                    // Wishlist details
                    $show_wishlist  = ecommerce_gem_get_option( 'show_wishlist' );
                    $wishlist_icon  = ecommerce_gem_get_option( 'wishlist_icon' );

                    if( true == $show_wishlist && !empty( $wishlist_icon ) && class_exists( 'YITH_WCWL' ) ){ ?>
                        <div class="top-wishlist-wrapper">
                            <div class="top-icon-wrap">
                                <?php 

                                $wishlist_page_id = yith_wcwl_object_id( get_option( 'yith_wcwl_wishlist_page_id' ) ); 

                                if ( absint( $wishlist_page_id ) > 0 ) : ?>
                            
                                    <a class="wishlist-btn" href="<?php echo esc_url( get_permalink( $wishlist_page_id ) ); ?>"><i class="fa <?php echo esc_attr( $wishlist_icon ); ?>" aria-hidden="true"></i><span class="wish-value"><?php echo absint( yith_wcwl_count_products() ); ?></span></a>
                                  
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php 
                    } 

                    // Login/Register
                    $show_login_logout  = ecommerce_gem_get_option( 'show_login_logout' );
                    $login_icon         = ecommerce_gem_get_option( 'login_icon' );

                    if( true == $show_login_logout ){

                        if (is_user_logged_in()) { ?> 

                            <div class="top-account-wrapper logged-in">
								<ul id="my-account-menu" class="menu nav-menu" aria-expanded="false">
									<li class="menu-item">
										<a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
											<i class="fa <?php echo esc_attr( $login_icon ); ?>" aria-hidden="true"></i>
											<span class="top-log-out"><?php esc_html_e('My Account', 'woocommerce-multisite'); ?></span>
										</a>
										<ul class="sub-menu">
											<li class="menu-item">
												<a href="<?php echo esc_url(wp_logout_url(home_url())); ?>">
													<i class="fa fa-power-off" aria-hidden="true"></i>
													<span class="top-log-out"><?php esc_html_e('Log Out', 'woocommerce-multisite'); ?></span>
												</a>
											</li>
										</ul>
									</li>
								</ul>
                                
                            </div>

                            <?php 
                        }else{ 

                            $login_text  = ecommerce_gem_get_option( 'login_text' );

                            ?>

                            <div class="top-account-wrapper logged-out">
                                <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                                    <i class="fa <?php echo esc_attr( $login_icon ); ?>" aria-hidden="true"></i>
                                    <span class="top-log-in"><?php echo esc_html( $login_text ); ?></span>
                                </a>
                            </div>

                            <?php

                        }
                    } // Login/Register ends

                    // Cart details
                    $show_cart  = ecommerce_gem_get_option( 'show_cart' );
                    $cart_icon  = ecommerce_gem_get_option( 'cart_icon' );

                    if( true == $show_cart && !empty( $cart_icon ) && class_exists( 'WooCommerce' ) ){ ?>
                        <div class="top-cart-wrapper">
                            <div class="top-icon-wrap">
                                <a href="<?php echo esc_url( wc_get_cart_url() ); ?>">
                                    <i class="fa <?php echo esc_attr( $cart_icon ); ?>" aria-hidden="true"></i>
                                    <span class="cart-value ec-cart-fragment"> <?php echo wp_kses_data( WC()->cart->get_cart_contents_count() );?></span>
                                </a>
                            </div>
                            <div class="top-cart-content">
                                <?php the_widget( 'WC_Widget_Cart', '' ); ?>
                            </div>
                        </div>
                        <?php 
                    } 

                    $show_top_search  = ecommerce_gem_get_option( 'show_top_search' );

                    if( true === $show_top_search && class_exists( 'WooCommerce' ) ){ ?>

                        <div class="search-holder">

                            <a href="#" class="search-btn"><i class="fa fa-search"></i></a>

                            <div class="search-box" style="display: none;">

                                <?php

                                if ( class_exists( 'WooCommerce' ) ) {

                                    // For search products placeholder text
                                    $search_products_text  = ecommerce_gem_get_option( 'search_products_text' );

                                    if( !empty( $search_products_text ) ){

                                        $product_search_text = esc_attr( $search_products_text );

                                    }else{

                                        $product_search_text =  esc_attr_x( 'Search Products &hellip;', 'placeholder', 'woocommerce-multisite' );
                                    }

                                    // For select category text
                                    $select_category_text  = ecommerce_gem_get_option( 'select_category_text' );

                                    if( !empty( $select_category_text ) ){

                                        $product_category_text = esc_html( $select_category_text );

                                    }else{

                                        $product_category_text =  esc_html__( 'Select Category', 'woocommerce-multisite' );
                                    }

                                 ?>

                                    <div class="product-search-wrapper">
                                        
                                        <form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                            <input type="hidden" name="post_type" value="product" />

                                            <input type="text" class="search-field products-search" placeholder="<?php echo $product_search_text; ?>" value="<?php echo get_search_query(); ?>" name="s" />

                                            <select class="product-cat" name="product_cat">

                                                <option value=""><?php echo $product_category_text; ?></option> 

                                                <?php

                                                $categories = get_categories( 'taxonomy=product_cat' );

                                                foreach ( $categories as $category ) {

                                                    $option = '<option value="' . esc_attr( $category->category_nicename ) . '"'.ecommerce_gem_selected_category( $category->category_nicename ).'>';

                                                    $option .= esc_html( $category->cat_name );

                                                    $option .= ' (' . absint( $category->category_count ) . ')';
                                                    
                                                    $option .= '</option>';

                                                    echo $option;

                                                } ?>

                                            </select>
                                            
                                            <button type="submit" class="search-submit"><span class="screen-reader-text"><?php echo _x( 'Search', 'submit button', 'woocommerce-multisite' ); ?></span><i class="fa fa-search" aria-hidden="true"></i></button>
                                        </form>

                                            
                                    </div> <!-- .product-search-wrapper -->
                                <?php } ?>

                            </div>
                        </div><!-- .search-holder -->
                        <?php
                    } ?>
                </div>
                
            </div>
        </div>
        <?php
    }
endif;

add_action( 'ecommerce_gem_top_header', 'ecommerce_gem_top_header_action' );


//=============================================================
// Store Information hook of the theme
//=============================================================
if ( ! function_exists( 'ecommerce_gem_top_header_store_information_action' ) ) :
    /**
     * Store Information Start.
     *
     * @since 1.0.0
     */
    function ecommerce_gem_top_header_store_information_action() { 

        $top_address    = ecommerce_gem_get_option( 'top_address' );
        $top_site_text    = ecommerce_gem_get_option( 'top_site_text' );
        $top_phone      = ecommerce_gem_get_option( 'top_phone' );
        $top_email      = ecommerce_gem_get_option( 'top_email' ); 
        if( !empty( $top_address ) || !empty( $top_phone ) || !empty( $top_email ) ){ ?>
            <div class="top-left-inner">
                <?php if( !empty( $top_address ) ){ ?>
                    <span class="address"><i class="fa fa-map-marker" aria-hidden="true"></i> <?php echo esc_html( $top_address ); ?></span>
                <?php } ?>
				
				<?php if( !empty( $top_site_text ) ){ ?>
                    <span class="site_text"><?php echo esc_html( $top_site_text ); ?></span>
                <?php } ?>

                <?php if( !empty( $top_phone ) ){ ?>
                    <span class="phone"><i class="fa fa-phone" aria-hidden="true"></i> <?php echo esc_html( $top_phone ); ?></span>
                <?php } ?>

                <?php if( !empty( $top_email ) ){ ?>
                    <span class="fax"><i class="fa fa-envelope-o" aria-hidden="true"></i> <?php echo esc_html( $top_email ); ?></span>
                <?php } ?>
                
            </div><?php 
        } 
    }
endif;

add_action( 'ecommerce_gem_top_header_store_information', 'ecommerce_gem_top_header_store_information_action' );

function custom_cart_callback()
{
	ob_start();
	the_widget( 'WC_Widget_Cart', '' );
	return ob_get_clean();
}
add_shortcode('custom_cart', 'custom_cart_callback');


add_filter('woocommerce_product_get_rating_html', 'product_rating_html', 10, 2);

function product_rating_html($rating_html, $rating) 
{
	/*
	* https://wordpress.org/support/topic/woocommerce-always-show-stars-even-with-no-reviews/
	*/
	
    $rating_html  = '<div class="star-rating">';
    $rating_html .= wc_get_star_rating_html( $rating, $count );
    $rating_html .= '</div>';
	
	return $rating_html;
}

add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_title', 6);


add_filter( 'woocommerce_get_script_data', 'change_view_cart_text_to_icon', 10, 2 );
function change_view_cart_text_to_icon( $params, $handle ){
	global $wp;
	
	switch ( $handle ) {
		case 'wc-add-to-cart':
			$params = array(
				'ajax_url'                => WC()->ajax_url(),
				'wc_ajax_url'             => WC_AJAX::get_endpoint( '%%endpoint%%' ),
				'i18n_view_cart'          => esc_attr__( "<i class='fa fa-shopping-cart'></i>", "woocommerce"),
				'cart_url'                => apply_filters( 'woocommerce_add_to_cart_redirect', wc_get_cart_url(), null ),
				'is_cart'                 => is_cart(),
				'cart_redirect_after_add' => get_option( 'woocommerce_cart_redirect_after_add' ),
			);
		break;
		default:
			$params = false;
	}
	return $params;
}

add_filter( 'woocommerce_product_add_to_cart_text', 'replace_add_to_cart_text', 10, 2 );
function replace_add_to_cart_text() 
{
    return __( "<i class='fa fa-plus-square'></i> &nbsp; Add to cart", 'woocommerce' );
}

register_sidebar(array(
    'name'          => __('Footer News Letter', 'multisite'),
    'id'            => 'footer_newsletter',
    'description'   => __('Footer News Letter widget area', 'multisite'),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title-topbar">',
    'after_title'   => '</h3>',
));

register_sidebar(array(
    'name'          => __('Footer Social Link', 'multisite'),
    'id'            => 'footer_social_link',
    'description'   => __('Footer Social Link area', 'multisite'),
    'before_widget' => '<div id="%1$s" class="%2$s">',
    'after_widget'  => '</div>',
    'before_title'  => '<h3 class="widget-title-topbar">',
    'after_title'   => '</h3>',
));
