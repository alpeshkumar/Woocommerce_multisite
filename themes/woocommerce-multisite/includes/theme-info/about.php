<?php
/**
 * About configuration
 *
 * @package eCommerce_Gem
 */

$config = array(
	'menu_name' => esc_html__( 'About Woocommerce Multisite', 'woocommerce-multisite' ),
	'page_name' => esc_html__( 'About Woocommerce Multisite', 'woocommerce-multisite' ),

	/* translators: theme version */
	'welcome_title' => sprintf( esc_html__( 'Welcome to %s - ', 'woocommerce-multisite' ), 'Woocommerce Multisite' ),

	/* translators: 1: theme name */
	'welcome_content' => sprintf( esc_html__( 'We hope this page will help you to setup %1$s with few clicks. We believe you will find it easy to use and perfect for your website development.', 'woocommerce-multisite' ), 'Woocommerce Multisite' ),

	// Quick links.
	'quick_links' => array(
		'theme_url' => array(
			'text' => esc_html__( 'Theme Details','woocommerce-multisite' ),
			'url'  => 'https://www.prodesigns.com/wordpress-themes/downloads/ecommerce-gem/',
			),
		'demo_url' => array(
			'text' => esc_html__( 'View Demo','woocommerce-multisite' ),
			'url'  => 'https://www.prodesigns.com/wordpress-themes/demo/ecommerce-gem/',
			),
		'documentation_url' => array(
			'text'   => esc_html__( 'View Documentation','woocommerce-multisite' ),
			'url'    => 'https://www.prodesigns.com/wordpress-themes/documentation/ecommerce-gem/',
			),
		'rate_url' => array(
			'text' => esc_html__( 'Rate This Theme','woocommerce-multisite' ),
			'url'  => 'https://wordpress.org/support/theme/ecommerce-gem/reviews/',
			),
		'pro_url' => array(
			'text' => esc_html__( 'Upgrade To Pro Theme','woocommerce-multisite' ),
			'url'  => 'https://www.prodesigns.com/wordpress-themes/downloads/ecommerce-gem-plus',
			'button' => 'primary',
			),
		),

	// Tabs.
	'tabs' => array(
		'getting_started'     => esc_html__( 'Getting Started', 'woocommerce-multisite' ),
		'recommended_actions' => esc_html__( 'Recommended Actions', 'woocommerce-multisite' ),
		'useful_plugins'      => esc_html__( 'Useful Plugins', 'woocommerce-multisite' ),
		'demo_content'        => esc_html__( 'Demo Content', 'woocommerce-multisite' ),
		'support'             => esc_html__( 'Support', 'woocommerce-multisite' ),
		'free_pro'            => esc_html__( 'FREE VS. PRO', 'woocommerce-multisite' ),
	),

	// Getting started.
	'getting_started' => array(
		array(
			'title'               => esc_html__( 'Theme Documentation', 'woocommerce-multisite' ),
			'text'                => esc_html__( 'Find step by step instructions with video documentation to setup theme easily.', 'woocommerce-multisite' ),
			'button_label'        => esc_html__( 'View documentation', 'woocommerce-multisite' ),
			'button_link'         => 'https://www.prodesigns.com/wordpress-themes/documentation/ecommerce-gem/',
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => true,
		),
		array(
			'title'               => esc_html__( 'Recommended Actions', 'woocommerce-multisite' ),
			'text'                => esc_html__( 'We recommend few steps to take so that you can get complete site like shown in demo.', 'woocommerce-multisite' ),
			'button_label'        => esc_html__( 'Check recommended actions', 'woocommerce-multisite' ),
			'button_link'         => esc_url( admin_url( 'themes.php?page=ecommerce-gem-about&tab=recommended_actions' ) ),
			'is_button'           => false,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),
		array(
			'title'               => esc_html__( 'Customize Everything', 'woocommerce-multisite' ),
			'text'                => esc_html__( 'Start customizing every aspect of the website with customizer.', 'woocommerce-multisite' ),
			'button_label'        => esc_html__( 'Go to Customizer', 'woocommerce-multisite' ),
			'button_link'         => esc_url( wp_customize_url() ),
			'is_button'           => true,
			'recommended_actions' => false,
			'is_new_tab'          => false,
		),

		array(
			'title'        			=> esc_html__( 'Youtube Video Tutorials', 'woocommerce-multisite' ),
			'text'         			=> esc_html__( 'Please check our youtube channel for video instructions of Woocommerce Multisite setup and customization.', 'woocommerce-multisite' ),
			'button_label' 			=> esc_html__( 'Video Tutorials', 'woocommerce-multisite' ),
			'button_link'  			=> 'https://www.youtube.com/watch?v=YUBUosw64AA&list=PL-Ic437QwxQ8cW5jX4XC0or7vYzUhZX7s',
			'is_button'    			=> false,
			'recommended_actions' 	=> false,
			'is_new_tab'   			=> true,
		),

		array(
			'title'        			=> esc_html__( 'Pro Version', 'woocommerce-multisite' ),
			'text'         			=> esc_html__( 'Upgrade to pro version for additional features and options.', 'woocommerce-multisite' ),
			'button_label' 			=> esc_html__( 'View Pro Version', 'woocommerce-multisite' ),
			'button_link'  			=> 'https://www.prodesigns.com/wordpress-themes/downloads/ecommerce-gem-plus/',
			'is_button'    			=> true,
			'recommended_actions' 	=> false,
			'is_new_tab'   			=> true,
		),

		'first' => array(
			'title'        			=> esc_html__( 'Contact Support', 'woocommerce-multisite' ),
			'text'         			=> esc_html__( 'If you have any problem, feel free to create ticket on our dedicated Support forum.', 'woocommerce-multisite' ),
			'button_label' 			=> esc_html__( 'Contact Support', 'woocommerce-multisite' ),
			'button_link'  			=> esc_url( 'https://www.prodesigns.com/wordpress-themes/support/item/ecommerce-gem/' ),
			'is_button'    			=> false,
			'recommended_actions' 	=> false,
			'is_new_tab'   			=> true,
		),
	),

	// Recommended actions.
	'recommended_actions' => array(
		'content' => array(
			'woocommerce' => array(
				'title'       => esc_html__( 'WooCommerce', 'woocommerce-multisite' ),
				'description' => esc_html__( 'Please install WooCommerce plugin.', 'woocommerce-multisite' ),
				'check'       => class_exists( 'WooCommerce' ),
				'plugin_slug' => 'woocommerce',
				'id'          => 'woocommerce',
			),
			'woocommerce-pages' => array(
				'title'       => esc_html__( 'WooCommerce Pages', 'woocommerce-multisite' ),
				'description' => sprintf( esc_html__( 'Please make sure all WooCommerce pages are set properly. %1$s', 'woocommerce-multisite' ), '<a href="https://docs.woocommerce.com/document/woocommerce-pages/" target="_blank">' . esc_html__( 'Reference', 'woocommerce-multisite' ) . '</a>' ),
				'check'       => ecommerce_gem_woocommerce_pages_status(),
				'id'          => 'woocommerce-pages',
				'help'        => ecommerce_gem_woocommerce_pages_status_message(),
			),
			'front-page' => array(
				'title'       => esc_html__( 'Setting Static Front Page','woocommerce-multisite' ),
				'description' => esc_html__( 'Create a new page to display on front page ( Ex: Home ) and assign "Home" template. Select A static page then Front page and Posts page to display front page specific sections. Note: Static page will be set automatically when you import demo content.', 'woocommerce-multisite' ),
				'id'          => 'front-page',
				'check'       => ( 'page' === get_option( 'show_on_front' ) ) ? true : false,
				'help'        => '<a href="' . esc_url( wp_customize_url() ) . '?autofocus[section]=static_front_page" class="button button-secondary">' . esc_html__( 'Static Front Page', 'woocommerce-multisite' ) . '</a>',
			),

			'one-click-demo-import' => array(
				'title'       => esc_html__( 'One Click Demo Import', 'woocommerce-multisite' ),
				'description' => esc_html__( 'Please install the One Click Demo Import plugin to import the demo content. After activation go to Appearance >> Import Demo Data and import it.', 'woocommerce-multisite' ),
				'check'       => class_exists( 'OCDI_Plugin' ),
				'plugin_slug' => 'one-click-demo-import',
				'id'          => 'one-click-demo-import',
			),
		),
	),

	// Useful plugins.
	'useful_plugins' => array(
		'description'        => esc_html__( 'This theme supports some helpful WordPress plugins to enhance your website.', 'woocommerce-multisite' ),
		'plugins_list_title' => esc_html__( 'Useful Plugins List:', 'woocommerce-multisite' ),
	),

	// Demo content.
	'demo_content' => array(
		'description' => sprintf( esc_html__( 'Install %1$s plugin to import demo content. Demo data are bundled within the theme, Please make sure plugin is installed and activated. After plugin activation, go to Import Demo Data menu under Appearance and import it.', 'woocommerce-multisite' ), '<a href="https://wordpress.org/plugins/one-click-demo-import/" target="_blank">' . esc_html__( 'One Click Demo Import', 'woocommerce-multisite' ) . '</a>' ),
		),

	// Support.
	'support_content' => array(
		'first' => array(
			'title'        => esc_html__( 'Contact Support', 'woocommerce-multisite' ),
			'icon'         => 'dashicons dashicons-sos',
			'text'         => esc_html__( 'If you have any problem, feel free to create ticket on our dedicated Support forum.', 'woocommerce-multisite' ),
			'button_label' => esc_html__( 'Contact Support', 'woocommerce-multisite' ),
			'button_link'  => esc_url( 'https://www.prodesigns.com/wordpress-themes/support/item/ecommerce-gem/' ),
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'second' => array(
			'title'        => esc_html__( 'Theme Documentation', 'woocommerce-multisite' ),
			'icon'         => 'dashicons dashicons-book-alt',
			'text'         => esc_html__( 'Kindly check our theme documentation for detailed information and video instructions.', 'woocommerce-multisite' ),
			'button_label' => esc_html__( 'View Documentation', 'woocommerce-multisite' ),
			'button_link'  => 'https://www.prodesigns.com/wordpress-themes/documentation/ecommerce-gem/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'third' => array(
			'title'        => esc_html__( 'Pro Version', 'woocommerce-multisite' ),
			'icon'         => 'dashicons dashicons-products',
			'icon'         => 'dashicons dashicons-star-filled',
			'text'         => esc_html__( 'Upgrade to pro version for additional features and options.', 'woocommerce-multisite' ),
			'button_label' => esc_html__( 'View Pro Version', 'woocommerce-multisite' ),
			'button_link'  => 'https://www.prodesigns.com/wordpress-themes/downloads/ecommerce-gem-plus/',
			'is_button'    => true,
			'is_new_tab'   => true,
		),
		'fourth' => array(
			'title'        => esc_html__( 'Youtube Video Tutorials', 'woocommerce-multisite' ),
			'icon'         => 'dashicons dashicons-video-alt3',
			'text'         => esc_html__( 'Please check our youtube channel for video instructions of Woocommerce Multisite setup and customization.', 'woocommerce-multisite' ),
			'button_label' => esc_html__( 'Video Tutorials', 'woocommerce-multisite' ),
			'button_link'  => 'https://www.youtube.com/watch?v=YUBUosw64AA&list=PL-Ic437QwxQ8cW5jX4XC0or7vYzUhZX7s',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'fifth' => array(
			'title'        => esc_html__( 'Customization Request', 'woocommerce-multisite' ),
			'icon'         => 'dashicons dashicons-admin-tools',
			'text'         => esc_html__( 'We have dedicated team members for theme customization. Feel free to contact us any time if you need any customization service.', 'woocommerce-multisite' ),
			'button_label' => esc_html__( 'Customization Request', 'woocommerce-multisite' ),
			'button_link'  => 'https://www.prodesigns.com/contact-us/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
		'sixth' => array(
			'title'        => esc_html__( 'Child Theme', 'woocommerce-multisite' ),
			'icon'         => 'dashicons dashicons-admin-customizer',
			'text'         => esc_html__( 'If you want to customize theme file, you should use child theme rather than modifying theme file itself.', 'woocommerce-multisite' ),
			'button_label' => esc_html__( 'About child theme', 'woocommerce-multisite' ),
			'button_link'  => 'https://developer.wordpress.org/themes/advanced-topics/child-themes/',
			'is_button'    => false,
			'is_new_tab'   => true,
		),
	),

    // Free vs pro array.
    'free_pro' => array(

	    array(
		    'title'     => esc_html__( 'WooCommerce Ready', 'woocommerce-multisite' ),
		    'desc'      => esc_html__( 'Theme supports/works with WooCommerce plugin', 'woocommerce-multisite' ),
		    'free'      => esc_html__('yes','woocommerce-multisite'),
		    'pro'       => esc_html__('yes','woocommerce-multisite'),
	    ),

	    array(
		    'title'     => esc_html__( 'Slider Support', 'woocommerce-multisite' ),
		    'desc'      => esc_html__( 'Supports Slider Revolution, Layer Slider, Hero Slider, etc.', 'woocommerce-multisite' ),
		    'free'      => esc_html__('no','woocommerce-multisite'),
		    'pro'       => esc_html__('yes','woocommerce-multisite'),
	    ),
	    array(
		    'title'     => esc_html__( 'Google Fonts', 'woocommerce-multisite' ),
		    'desc' 		=> esc_html__( 'Google fonts options for changing the overall site fonts', 'woocommerce-multisite' ),
		    'free'  	=> 'no',
		    'pro'   	=> esc_html__('100+','woocommerce-multisite'),
	    ),
	    array(
		    'title'     => esc_html__( 'Primary Color Option', 'woocommerce-multisite' ),
		    'desc'      => esc_html__( 'Option to change primary color of the site', 'woocommerce-multisite' ),
		    'free'      => esc_html__('yes','woocommerce-multisite'),
		    'pro'       => esc_html__('yes','woocommerce-multisite'),
	    ),
        array(
    	    'title'     => esc_html__( 'Advance Color Options', 'woocommerce-multisite' ),
    	    'desc'      => esc_html__( 'Options to change color of individual sections like top header, site title, menu, footer, etc of the site', 'woocommerce-multisite' ),
    	    'free'      => esc_html__('no','woocommerce-multisite'),
    	    'pro'       => esc_html__('yes','woocommerce-multisite'),
        ),
        array(
    	    'title'     => esc_html__( 'Latest Product Carousel', 'woocommerce-multisite' ),
    	    'desc'      => esc_html__( 'Widget to display latest products in carousel mode', 'woocommerce-multisite' ),
    	    'free'      => esc_html__('yes','woocommerce-multisite'),
    	    'pro'       => esc_html__('yes','woocommerce-multisite'),
        ),

        array(
    	    'title'     => esc_html__( 'Featured Product Carousel', 'woocommerce-multisite' ),
    	    'desc'      => esc_html__( 'Widget to display featured products in carousel mode', 'woocommerce-multisite' ),
    	    'free'      => esc_html__('yes','woocommerce-multisite'),
    	    'pro'       => esc_html__('yes','woocommerce-multisite'),
        ),
        array(
    	    'title'     => esc_html__( 'Hide Footer Credit', 'woocommerce-multisite' ),
    	    'desc'      => esc_html__( 'Option to enable/disable Powerby(Designer) credit in footer', 'woocommerce-multisite' ),
    	    'free'      => esc_html__('no','woocommerce-multisite'),
    	    'pro'       => esc_html__('yes','woocommerce-multisite'),
        ),
        array(
    	    'title'     => esc_html__( 'Override Footer Credit', 'woocommerce-multisite' ),
    	    'desc'      => esc_html__( 'Option to Override existing Powerby credit of footer', 'woocommerce-multisite' ),
    	    'free'      => esc_html__('no','woocommerce-multisite'),
    	    'pro'       => esc_html__('yes','woocommerce-multisite'),
        ),
	    array(
		    'title'     => esc_html__( 'SEO', 'woocommerce-multisite' ),
		    'desc' 		=> esc_html__( 'Developed with high skilled SEO tools.', 'woocommerce-multisite' ),
		    'free'  	=> 'yes',
		    'pro'   	=> 'yes',
	    ),
	    array(
		    'title'     => esc_html__( 'Support Forum', 'woocommerce-multisite' ),
		    'desc'      => esc_html__( 'Highly experienced and dedicated support team for your help plus online chat.', 'woocommerce-multisite' ),
		    'free'      => esc_html__('yes', 'woocommerce-multisite'),
		    'pro'       => esc_html__('High Priority', 'woocommerce-multisite'),
	    )

    ),

);
eCommerce_Gem_About::init( apply_filters( 'ecommerce_gem_about_filter', $config ) );
