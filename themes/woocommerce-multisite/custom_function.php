<?php
/**
 * Woocommerce Multisite functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package multisite_Ab
 */
 
add_action('wp_enqueue_scripts', 'theme_enqueue_styles', 20);
function theme_enqueue_styles()
{
    wp_enqueue_style('owl_carousel_min_style', get_template_directory_uri() . '/assets/third-party/owlcarousel/owl.carousel.min.css');
    wp_enqueue_style('owl_theme_default_min_style', get_template_directory_uri() . '/assets/third-party/owlcarousel/owl.theme.default.min.css');
    wp_enqueue_style('custom_style', get_template_directory_uri() . '/custom_style.css');
	
	
	wp_enqueue_script('owl_carousel_min_script', get_template_directory_uri() . '/assets/third-party/owlcarousel/owl.carousel.min.js', '', '', true);
	wp_enqueue_script('custom_script', get_template_directory_uri() . '/custom_script.js', '', '', true);
	
	/*
	* added below for all pages 
	*/
	if ( is_plugin_active( 'js_composer/js_composer.php' ) ) 
	{
		wp_enqueue_script( 'wpb_composer_front_js' );
		wp_enqueue_style( 'js_composer_front' );
		wp_enqueue_style( 'js_composer_custom_css' );
	}
}

add_filter('wp_nav_menu_items', 'add_search_form', 10, 2);
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
		$items .= '<li class="menu-item custom_search_menu">';
				
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


//=============================================================
// Top header hook of the theme
//=============================================================
add_action( 'ecommerce_gem_top_header', 'ecommerce_gem_top_header_action' );
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
					 
                    if( true == $show_wishlist && !empty( $wishlist_icon ) && class_exists( 'YITH_WCWL' ) && is_user_logged_in() ){ ?>
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
                            $register_text  = ecommerce_gem_get_option( 'register_text' );
							$register_page_link  = get_site_url() . '/register';
                            ?>
                            <div class="top-account-wrapper logged-out">
                                <a href="<?php echo esc_url( get_permalink( get_option( 'woocommerce_myaccount_page_id' ) ) ); ?>">
                                    <i class="fa <?php echo esc_attr( $login_icon ); ?>" aria-hidden="true"></i>
                                    <span class="top-log-in"><?php echo esc_html( $login_text ); ?></span>
                                </a>
								<a href="<?php echo $register_page_link; ?>">
                                    <span class="top-log-in"> / <?php echo esc_html( $register_text ); ?></span>
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
                                <a href="#">
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


//=============================================================
// Store Information hook of the theme
//=============================================================
add_action( 'ecommerce_gem_top_header_store_information', 'ecommerce_gem_top_header_store_information_action' );
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


add_shortcode('custom_cart', 'custom_cart_callback');
function custom_cart_callback()
{
	ob_start();
	the_widget( 'WC_Widget_Cart', '' );
	return ob_get_clean();
}


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

/*
* change title posstion in product list
*/
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_product_title', 6);


add_filter( 'woocommerce_get_script_data', 'change_view_cart_text_to_icon', 10, 2 );
function change_view_cart_text_to_icon( $params, $handle ){
	global $wp;
	
	if(!is_product())
	{		
		switch ( $handle ) {
			case 'woocommerce':
				$params = array(
					'ajax_url'    => WC()->ajax_url(),
					'wc_ajax_url' => WC_AJAX::get_endpoint( '%%endpoint%%' ),
				);
				break;
			case 'wc-geolocation':
				$params = array(
					'wc_ajax_url'  => WC_AJAX::get_endpoint( '%%endpoint%%' ),
					'home_url'     => home_url(),
					'is_available' => ! ( is_cart() || is_account_page() || is_checkout() || is_customize_preview() ) ? '1' : '0',
					'hash'         => isset( $_GET['v'] ) ? wc_clean( wp_unslash( $_GET['v'] ) ) : '', // WPCS: input var ok, CSRF ok.
				);
				break;
			case 'wc-single-product':
				$params = array(
					'i18n_required_rating_text' => esc_attr__( 'Please select a rating', 'woocommerce' ),
					'review_rating_required'    => wc_review_ratings_required() ? 'yes' : 'no',
					'flexslider'                => apply_filters(
						'woocommerce_single_product_carousel_options',
						array(
							'rtl'            => is_rtl(),
							'animation'      => 'slide',
							'smoothHeight'   => true,
							'directionNav'   => false,
							'controlNav'     => 'thumbnails',
							'slideshow'      => false,
							'animationSpeed' => 500,
							'animationLoop'  => false, // Breaks photoswipe pagination if true.
							'allowOneSlide'  => false,
						)
					),
					'zoom_enabled'              => apply_filters( 'woocommerce_single_product_zoom_enabled', get_theme_support( 'wc-product-gallery-zoom' ) ),
					'zoom_options'              => apply_filters( 'woocommerce_single_product_zoom_options', array() ),
					'photoswipe_enabled'        => apply_filters( 'woocommerce_single_product_photoswipe_enabled', get_theme_support( 'wc-product-gallery-lightbox' ) ),
					'photoswipe_options'        => apply_filters(
						'woocommerce_single_product_photoswipe_options',
						array(
							'shareEl'               => false,
							'closeOnScroll'         => false,
							'history'               => false,
							'hideAnimationDuration' => 0,
							'showAnimationDuration' => 0,
						)
					),
					'flexslider_enabled'        => apply_filters( 'woocommerce_single_product_flexslider_enabled', get_theme_support( 'wc-product-gallery-slider' ) ),
				);
				break;
			case 'wc-checkout':
				$params = array(
					'ajax_url'                  => WC()->ajax_url(),
					'wc_ajax_url'               => WC_AJAX::get_endpoint( '%%endpoint%%' ),
					'update_order_review_nonce' => wp_create_nonce( 'update-order-review' ),
					'apply_coupon_nonce'        => wp_create_nonce( 'apply-coupon' ),
					'remove_coupon_nonce'       => wp_create_nonce( 'remove-coupon' ),
					'option_guest_checkout'     => get_option( 'woocommerce_enable_guest_checkout' ),
					'checkout_url'              => WC_AJAX::get_endpoint( 'checkout' ),
					'is_checkout'               => is_checkout() && empty( $wp->query_vars['order-pay'] ) && ! isset( $wp->query_vars['order-received'] ) ? 1 : 0,
					'debug_mode'                => defined( 'WP_DEBUG' ) && WP_DEBUG,
					'i18n_checkout_error'       => esc_attr__( 'Error processing checkout. Please try again.', 'woocommerce' ),
				);
				break;
			case 'wc-address-i18n':
				$params = array(
					'locale'             => wp_json_encode( WC()->countries->get_country_locale() ),
					'locale_fields'      => wp_json_encode( WC()->countries->get_country_locale_field_selectors() ),
					'i18n_required_text' => esc_attr__( 'required', 'woocommerce' ),
					'i18n_optional_text' => esc_html__( 'optional', 'woocommerce' ),
				);
				break;
			case 'wc-cart':
				$params = array(
					'ajax_url'                     => WC()->ajax_url(),
					'wc_ajax_url'                  => WC_AJAX::get_endpoint( '%%endpoint%%' ),
					'update_shipping_method_nonce' => wp_create_nonce( 'update-shipping-method' ),
					'apply_coupon_nonce'           => wp_create_nonce( 'apply-coupon' ),
					'remove_coupon_nonce'          => wp_create_nonce( 'remove-coupon' ),
				);
				break;
			case 'wc-cart-fragments':
				$params = array(
					'ajax_url'        => WC()->ajax_url(),
					'wc_ajax_url'     => WC_AJAX::get_endpoint( '%%endpoint%%' ),
					'cart_hash_key'   => apply_filters( 'woocommerce_cart_hash_key', 'wc_cart_hash_' . md5( get_current_blog_id() . '_' . get_site_url( get_current_blog_id(), '/' ) . get_template() ) ),
					'fragment_name'   => apply_filters( 'woocommerce_cart_fragment_name', 'wc_fragments_' . md5( get_current_blog_id() . '_' . get_site_url( get_current_blog_id(), '/' ) . get_template() ) ),
					'request_timeout' => 5000,
				);
				break;
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
			case 'wc-add-to-cart-variation':
				// We also need the wp.template for this script :).
				wc_get_template( 'single-product/add-to-cart/variation.php' );

				$params = array(
					'wc_ajax_url'                      => WC_AJAX::get_endpoint( '%%endpoint%%' ),
					'i18n_no_matching_variations_text' => esc_attr__( 'Sorry, no products matched your selection. Please choose a different combination.', 'woocommerce' ),
					'i18n_make_a_selection_text'       => esc_attr__( 'Please select some product options before adding this product to your cart.', 'woocommerce' ),
					'i18n_unavailable_text'            => esc_attr__( 'Sorry, this product is unavailable. Please choose a different combination.', 'woocommerce' ),
				);
				break;
			case 'wc-country-select':
				$params = array(
					'countries'                 => wp_json_encode( array_merge( WC()->countries->get_allowed_country_states(), WC()->countries->get_shipping_country_states() ) ),
					'i18n_select_state_text'    => esc_attr__( 'Select an option&hellip;', 'woocommerce' ),
					'i18n_no_matches'           => _x( 'No matches found', 'enhanced select', 'woocommerce' ),
					'i18n_ajax_error'           => _x( 'Loading failed', 'enhanced select', 'woocommerce' ),
					'i18n_input_too_short_1'    => _x( 'Please enter 1 or more characters', 'enhanced select', 'woocommerce' ),
					'i18n_input_too_short_n'    => _x( 'Please enter %qty% or more characters', 'enhanced select', 'woocommerce' ),
					'i18n_input_too_long_1'     => _x( 'Please delete 1 character', 'enhanced select', 'woocommerce' ),
					'i18n_input_too_long_n'     => _x( 'Please delete %qty% characters', 'enhanced select', 'woocommerce' ),
					'i18n_selection_too_long_1' => _x( 'You can only select 1 item', 'enhanced select', 'woocommerce' ),
					'i18n_selection_too_long_n' => _x( 'You can only select %qty% items', 'enhanced select', 'woocommerce' ),
					'i18n_load_more'            => _x( 'Loading more results&hellip;', 'enhanced select', 'woocommerce' ),
					'i18n_searching'            => _x( 'Searching&hellip;', 'enhanced select', 'woocommerce' ),
				);
				break;
			case 'wc-password-strength-meter':
				$params = array(
					'min_password_strength' => apply_filters( 'woocommerce_min_password_strength', 3 ),
					'stop_checkout'         => apply_filters( 'woocommerce_enforce_password_strength_meter_on_checkout', false ),
					'i18n_password_error'   => esc_attr__( 'Please enter a stronger password.', 'woocommerce' ),
					'i18n_password_hint'    => esc_attr( wp_get_password_hint() ),
				);
				break;
			default:
				$params = false;
		}
	}
	
	return $params;
}

//add_filter( 'woocommerce_product_add_to_cart_text', 'replace_add_to_cart_text', 10, 2 );
function replace_add_to_cart_text() 
{
    return __( "<i class='fa fa-plus-square'></i> &nbsp; Add to cart", 'woocommerce' );
}


add_action( 'woocommerce_after_shop_loop_item_title', 'add_excerpt_in_product_archives', 7 );
function add_excerpt_in_product_archives() 
{     
	global $product;
	if ( ! $product->get_short_description() ) return;
	?>
	<div itemprop="description" class="short_description">
		<?php echo apply_filters( 'woocommerce_short_description', $product->get_short_description() ) ?>
	</div>
	<?php     
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


add_action('wp_ajax_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
add_action('wp_ajax_nopriv_woocommerce_ajax_add_to_cart', 'woocommerce_ajax_add_to_cart');
        
function woocommerce_ajax_add_to_cart() 
{
	$product_id = apply_filters('woocommerce_add_to_cart_product_id', absint($_POST['product_id']));
	$quantity = empty($_POST['quantity']) ? 1 : wc_stock_amount($_POST['quantity']);
	$variation_id = absint($_POST['variation_id']);
	$passed_validation = apply_filters('woocommerce_add_to_cart_validation', true, $product_id, $quantity);
	$product_status = get_post_status($product_id);

	if ($passed_validation && WC()->cart->add_to_cart($product_id, $quantity, $variation_id) && 'publish' === $product_status) {

		do_action('woocommerce_ajax_added_to_cart', $product_id);

		if ('yes' === get_option('woocommerce_cart_redirect_after_add')) {
			wc_add_to_cart_message(array($product_id => $quantity), true);
		}

		WC_AJAX :: get_refreshed_fragments();
	} else {

		$data = array(
			'error' => true,
			'product_url' => apply_filters('woocommerce_cart_redirect_after_error', get_permalink($product_id), $product_id));

		echo wp_send_json($data);
	}

	wp_die();
}

//add_action( 'woocommerce_after_shop_loop_item', 'add_wishlist_icon_after_add_to_cart_button', 10, 0 ); 

function add_wishlist_icon_after_add_to_cart_button() { 
	echo '<div class="add-to-wishlist-wrap custom_wishlist">';
	echo do_shortcode('[yith_wcwl_add_to_wishlist]');
	echo '</div>';
}

add_action('add_meta_boxes', 'multisite_title_metabox');

function multisite_title_metabox()
{
    add_meta_box('page_title_setting', 'Page Title Setting', 'multisite_title_metabox_callback', 'page', 'side');
}

function multisite_title_metabox_callback($post)
{
    global $wpdb;
	
	$arrData = [
		'left' => 'Left',
		'center' => 'Center',
		'right' => 'Right',
	];
	
	echo '<select name="page_title_align">';
	echo '<option value="">Default</option>';

	$page_title_align = get_post_meta($post->ID, 'page_title_align', true);

	foreach ($arrData as $key => $value)
	{
	    $slt = '';

	    if ($page_title_align == $key)
	    {
			$slt = ' Selected ';
	    }

	    echo '<option ' . $slt . ' value="' . $key . '">' . $value . '</option>';
	}

	echo '</select>';
}

add_action('save_post', 'save_multisite_title_metabox');

function save_multisite_title_metabox($post_id)
{
    update_post_meta($post_id, 'page_title_align', $_POST['page_title_align']);
}

add_filter( 'woocommerce_widget_cart_is_hidden', 'always_show_cart', 40, 0 );
function always_show_cart() {
    return false;
}

add_action('wp_head', 'my_custom_styles', 100);
function my_custom_styles()
{
	echo "<style>
		.widget_price_filter .price_slider_amount input#min_price,
		.widget_price_filter .price_slider_amount input#max_price,
		.widget_price_filter .price_slider_amount button.button{
			display:none;
		}
	</style>";
}

add_filter( 'woocommerce_product_tabs', 'woo_new_product_tab' );
function woo_new_product_tab( $tabs ) 
{
	$tabs['wc_return_and_shipping_policies'] = array(
		'title' 	=> __( 'Return and Shipping Policies', 'woocommerce' ),
		'priority' 	=> 50,
		'callback' 	=> 'woo_return_and_shipping_policies_tab_content'
	);

	return $tabs;
}

function woo_return_and_shipping_policies_tab_content() 
{
	global $product;
	$product_id = $product->get_id();
	
	//echo '<h2>Return and Shipping Policies</h2>';
	
	$show_this_policy = get_post_meta($product_id, 'wc_return_and_shipping_policies_details', true);
	if(!empty($show_this_policy))
	{
		$wc_return_and_shipping_policies_details = get_post_meta($product_id, 'wc_return_and_shipping_policies_details', true);
		$wc_return_and_shipping_policies_details = stripslashes($wc_return_and_shipping_policies_details);
		echo $wc_return_and_shipping_policies_details;
	}
	else
	{
		$wc_globle_return_and_shipping_policies_details = get_option('wc_globle_return_and_shipping_policies_details', false);
		$wc_globle_return_and_shipping_policies_details = stripslashes($wc_globle_return_and_shipping_policies_details);
		echo $wc_globle_return_and_shipping_policies_details;
	}
}

add_action('add_meta_boxes', 'wc_return_and_shipping_policies_metabox');
function wc_return_and_shipping_policies_metabox()
{
    add_meta_box('wc_return_and_shipping_policies', 'Return and Shipping Policies', 'wc_return_and_shipping_policies_metabox_callback', 'product', 'normal');
}
function wc_return_and_shipping_policies_metabox_callback($product)
{
	// $show_this_policy = get_post_meta($product->ID, 'show_this_policy', true);
	// $checked = '';
	// if($show_this_policy == 'yes')
	// {
	// 	$checked = 'checked';
	// }
	// echo '<p>Show Below Policies Details in this Product :: <input '. $checked .' type="checkbox" name="show_this_policy" value="yes"></p>';
	
    $settings = array(
		'textarea_name' => 'wc_return_and_shipping_policies_details',
		'quicktags'     => array( 'buttons' => 'em,strong,link' ),
		'tinymce'       => array(
			'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
			'theme_advanced_buttons2' => '',
		),
		'editor_css'    => '<style>#wp-wc_return_and_shipping_policies_details-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
	);
	
	$wc_return_and_shipping_policies_details = get_post_meta($product->ID, 'wc_return_and_shipping_policies_details', true);
	$wc_return_and_shipping_policies_details = stripslashes($wc_return_and_shipping_policies_details);
	
	wp_editor( htmlspecialchars_decode( $wc_return_and_shipping_policies_details, ENT_QUOTES ), 'wc_return_and_shipping_policies_details', $settings );
}


add_action('save_post', 'save_wc_return_and_shipping_policies_metabox');
function save_wc_return_and_shipping_policies_metabox($product_id)
{
    //update_post_meta($product_id, 'show_this_policy', $_POST['show_this_policy']);
    update_post_meta($product_id, 'wc_return_and_shipping_policies_details', $_POST['wc_return_and_shipping_policies_details']);
}


add_action('woocommerce_settings_tabs_array', 'woocommerce_return_and_shipping_policies_tabs_array', 51);
function woocommerce_return_and_shipping_policies_tabs_array($tabs)
{
	$tabs['return_and_shipping_policies'] = __('Return and Shipping Policies', 'woocommerce_return_and_shipping_policies');
    return $tabs;
}

add_action( 'woocommerce_settings_tabs_return_and_shipping_policies', 'return_and_shipping_policies_content' );
function return_and_shipping_policies_content() 
{	
	echo '<table class="form-table">';
	
	$wc_description_tab_title = get_option('wc_description_tab_title', false);
	echo '<tr>';
	echo '<th class="titledesc">Description tab title</th>';
	echo '<td class="forminp forminp-text"><input name="wc_description_tab_title" value="' . $wc_description_tab_title . '"></td>';
	echo '</tr>';
	
	$wc_additional_information_tab_title = get_option('wc_additional_information_tab_title', false);
	echo '<tr>';
	echo '<th class="titledesc">Additional Information tab title</th>';
	echo '<td class="forminp forminp-text"><input name="wc_additional_information_tab_title" value="' . $wc_additional_information_tab_title . '"></td>';
	echo '</tr>';
	
	$wc_reviews_tab_title = get_option('wc_reviews_tab_title', false);
	echo '<tr>';
	echo '<th class="titledesc">Reviews tab title</th>';
	echo '<td class="forminp forminp-text"><input name="wc_reviews_tab_title" value="' . $wc_reviews_tab_title . '"></td>';
	echo '</tr>';
	
	$wc_return_and_shipping_policies_tab_title = get_option('wc_return_and_shipping_policies_tab_title', false);
	echo '<tr>';
	echo '<th class="titledesc">Return and Policies tab title</th>';
	echo '<td class="forminp forminp-text"><input name="wc_return_and_shipping_policies_tab_title" value="' . $wc_return_and_shipping_policies_tab_title . '"></td>';
	echo '</tr>';
	
	echo '<tr>';
	echo '<th colspan="2" class="titledesc">Return and Policies tab content</th>';	
	echo '</table>';
	
	
	$editor_settings = array(
		'textarea_name' => 'wc_globle_return_and_shipping_policies_details',
		'quicktags'     => array( 'buttons' => 'em,strong,link,p' ),
		'tinymce'       => array(
			'theme_advanced_buttons1' => 'bold,italic,strikethrough,separator,bullist,numlist,separator,blockquote,separator,justifyleft,justifycenter,justifyright,separator,link,unlink,separator,undo,redo,separator',
			'theme_advanced_buttons2' => '',
		),
		'editor_css'    => '<style>#wp-wc_globle_return_and_shipping_policies_details-editor-container .wp-editor-area{height:175px; width:100%;}</style>',
	);
	
	$wc_globle_return_and_shipping_policies_details = get_option('wc_globle_return_and_shipping_policies_details', false);
	$wc_globle_return_and_shipping_policies_details = stripslashes($wc_globle_return_and_shipping_policies_details);
	
	wp_editor( htmlspecialchars_decode( $wc_globle_return_and_shipping_policies_details, ENT_QUOTES ), 'wc_globle_return_and_shipping_policies_details', $editor_settings );
}

add_action( 'woocommerce_update_options_return_and_shipping_policies', 'update_return_and_shipping_policies_content' );
function update_return_and_shipping_policies_content() {
    update_option('wc_globle_return_and_shipping_policies_details', $_POST['wc_globle_return_and_shipping_policies_details']);
	
    update_option('wc_description_tab_title', $_POST['wc_description_tab_title']);
    update_option('wc_additional_information_tab_title', $_POST['wc_additional_information_tab_title']);
    update_option('wc_reviews_tab_title', $_POST['wc_reviews_tab_title']);
    update_option('wc_return_and_shipping_policies_tab_title', $_POST['wc_return_and_shipping_policies_tab_title']);
}
add_filter( 'woocommerce_ship_to_different_address_checked', '__return_false' );


add_filter( 'woocommerce_product_tabs', 'woo_rename_tabs', 98 );
function woo_rename_tabs( $tabs ) {
	
	$wc_description_tab_title = get_option('wc_description_tab_title', false);
	$wc_description_tab_title = $wc_description_tab_title != '' ? $wc_description_tab_title : 'Description';
	
	$wc_additional_information_tab_title = get_option('wc_additional_information_tab_title', false);
	$wc_additional_information_tab_title = $wc_additional_information_tab_title != '' ? $wc_additional_information_tab_title : 'Additional information';
	
	$wc_reviews_tab_title = get_option('wc_reviews_tab_title', false);
	$wc_reviews_tab_title = $wc_reviews_tab_title != '' ? $wc_reviews_tab_title : 'Reviews';
	
	$wc_return_and_shipping_policies_tab_title = get_option('wc_return_and_shipping_policies_tab_title', false);
	$wc_return_and_shipping_policies_tab_title = $wc_return_and_shipping_policies_tab_title != '' ? $wc_return_and_shipping_policies_tab_title : 'Return and Shipping Policies';

	$tabs['description']['title'] = $wc_description_tab_title;		// Rename the description tab	
	$tabs['additional_information']['title'] = $wc_additional_information_tab_title;	// Rename the additional information tab
	$tabs['reviews']['title'] = str_replace("Reviews", $wc_reviews_tab_title, $tabs['reviews']['title']);				// Rename the reviews tab
	$tabs['wc_return_and_shipping_policies']['title'] = $wc_return_and_shipping_policies_tab_title;	// Rename the additional information tab

	return $tabs;
}

remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
add_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 5 );

if( defined( 'YITH_WCWL' ) && ! function_exists( 'yith_wcwl_ajax_update_count' ) ){
	function yith_wcwl_ajax_update_count(){
		wp_send_json( array(
		'count' => yith_wcwl_count_all_products()
		) );
	}
	add_action( 'wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
	add_action( 'wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count' );
}

add_action( 'wp_login', 'my_login_redirect' );

function my_login_redirect(	) {
    //is there a user to check?
    if ($_GET['redirect_to'] != '') {
		$redirect_to = $_GET['redirect_to'];
		wp_redirect($redirect_to);
		exit();
    }
}