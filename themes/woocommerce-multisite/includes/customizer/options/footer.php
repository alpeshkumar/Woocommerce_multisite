<?php
/**
 * Footer Options.
 *
 * @package multisite_Ab
 */

// Footer Section.
$wp_customize->add_section( 'section_footer',
	array(
		'title'      => esc_html__( 'Footer Options', 'woocommerce-multisite' ),
		'priority'   => 100,
		'panel'      => 'theme_option_panel',
	)
);

// Setting copyright_text.
$wp_customize->add_setting( 'theme_options[copyright_text]',
	array(
		'default'           => $default['copyright_text'],
		//'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[copyright_text]',
	array(
		'label'    => esc_html__( 'Copyright Text', 'woocommerce-multisite' ),
		'section'  => 'section_footer',
		'type'     => 'text',
		'priority' => 100,
	)
);
$wp_customize->add_setting( 'theme_options[powered_by_text]',
	array(
		'default'           => $default['powered_by_text'],
		//'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'theme_options[powered_by_text]',
	array(
		'label'    => esc_html__( 'Powered by Text', 'woocommerce-multisite' ),
		'section'  => 'section_footer',
		'type'     => 'text',
		'priority' => 100,
	)
);