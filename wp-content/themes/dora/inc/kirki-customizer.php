<?php

/**
 * dora customizer
 * @package dora
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
     exit;
}


/**
 * Added Panels & Sections
 **/

function dora_kirki_customizer_panels_sections($wp_customize)
{
     //Add panel
     $wp_customize->add_panel('dora_customizer', [
          'priority' => 10,
          'title'    => esc_html__('Dora Customizer', 'dora'),
     ]);
     /**
      * Side Info Setting
      */
     $wp_customize->add_section('side_setting', [
          'title'       => esc_html__('Side Info', 'dora'),
          'description' => '',
          'priority'    => 10,
          'capability'  => 'edit_theme_options',
          'panel'       => 'dora_customizer',
     ]);

     /**
      * Header Settings
      */
     $wp_customize->add_section('header_setting', [
          'title'       => esc_html__('Header Setting', 'dora'),
          'description' => '',
          'priority'    => 11,
          'capability'  => 'edit_theme_options',
          'panel'       => 'dora_customizer',
     ]);

     /**
      * Footer Settings
      */
     $wp_customize->add_section('footer_setting', [
          'title'       => esc_html__('Footer Setting', 'dora'),
          'description' => '',
          'priority'    => 16,
          'capability'  => 'edit_theme_options',
          'panel'       => 'dora_customizer',
     ]);

     /**
      * Breadcrumb Setting
      */
     $wp_customize->add_section('breadcrumb_setting', [
          'title'       => esc_html__('Breadcrumb Setting', 'dora'),
          'description' => '',
          'priority'    => 12,
          'capability'  => 'edit_theme_options',
          'panel'       => 'dora_customizer',
     ]);

     /**
      * Color Setting
      */
     $wp_customize->add_section('color_setting', [
          'title'       => esc_html__('Color Setting', 'dora'),
          'description' => '',
          'priority'    => 13,
          'capability'  => 'edit_theme_options',
          'panel'       => 'dora_customizer',
     ]);

     /**
      * Typography Setting
      */
     $wp_customize->add_section('typo_setting', [
          'title'       => esc_html__('Typography Setting', 'dora'),
          'description' => '',
          'priority'    => 14,
          'capability'  => 'edit_theme_options',
          'panel'       => 'dora_customizer',
     ]);
}
add_action('customize_register', 'dora_kirki_customizer_panels_sections');

/** Side Settings */
function _side_info($fields)
{
     $fields[] = [
          'type'     => 'image',
          'settings' => 'dora_logo',
          'label'       => esc_html__('Logo', 'dora'),
          'description' => esc_html__('Upload Your Logo.', 'dora'),
          'section'  => 'side_setting',
          'default'     => get_template_directory_uri() . '/assets/images/logo.png',
          'priority' => 10,
     ];

     $fields[] = [
          'type'     => 'switch',
          'settings' => 'dora_preloader',
          'label'       => esc_html__('Preloader Swicher', 'dora'),
          'section'  => 'side_setting',
          'default'     => false,
          'priority' => 10,
          'choices'  => [
               'on'  => esc_html__('Enable', 'dora'),
               'off' => esc_html__('Disable', 'dora'),
          ],
     ];

     $fields[] = [
          'type'     => 'switch',
          'settings' => 'dora_megic_cursor',
          'label'       => esc_html__('Megic Cursor', 'dora'),
          'section'  => 'side_setting',
          'default'     => false,
          'priority' => 10,
          'choices'  => [
               'on'  => esc_html__('Enable', 'dora'),
               'off' => esc_html__('Disable', 'dora'),
          ],
     ];

     return $fields;
}
add_filter('kirki/fields', '_side_info');

/** Header Settings */
function _header_setting($fields)
{
     $fields[] = [
          'type'     => 'switch',
          'settings' => 'dora_btn_switch',
          'label'    => esc_html__('Header Button Swicher', 'dora'),
          'section'  => 'header_setting',
          'default'  => '0',
          'priority' => 10,
          'choices'  => [
               'on'  => esc_html__('Enable', 'dora'),
               'off' => esc_html__('Disable', 'dora'),
          ],
     ];

     $fields[] = [
          'type'     => 'text',
          'settings' => 'dora_btn_text',
          'label'    => esc_html__('Header Button Text', 'dora'),
          'section'  => 'header_setting',
          'default'  => 'Button Text',
          'priority' => 10,
          'active_callback' => [
               [
                    'setting'  => 'dora_btn_switch',
                    'operator' => '==',
                    'value'    => true,
               ]
          ],
     ];

     $fields[] = [
          'type'     => 'select',
          'settings' => 'dora_btn_page_link_type',
          'label'    => esc_html__('Header Button Link Type', 'dora'),
          'section'  => 'header_setting',
          'default'  => 'url',
          'priority' => 10,
          'choices'     => [
               'url' => esc_html__('Url', 'dora'),
               'page_link' => esc_html__('Page Link', 'dora'),
          ],
          'active_callback' => [
               [
                    'setting'  => 'dora_btn_switch',
                    'operator' => '==',
                    'value'    => true,
               ]
          ],
     ];

     $fields[] = [
          'type'     => 'link',
          'settings' => 'dora_btn_link_url',
          'label'    => esc_html__('Header Button URL Type', 'dora'),
          'section'  => 'header_setting',
          'default'  => esc_html__('#', 'dora'),
          'priority' => 10,
          'active_callback' => [
               [
                    'setting'  => 'dora_btn_switch',
                    'operator' => '==',
                    'value'    => true,
               ],
               [
                    'setting'  => 'dora_btn_page_link_type',
                    'operator' => '==',
                    'value'    => 'url',
               ],
          ],
     ];

     $fields[] = [
          'type'     => 'dropdown-pages',
          'settings' => 'dora_btn_page_link',
          'label'    => esc_html__('Header Page Link', 'dora'),
          'section'  => 'header_setting',
          'default'  => 42,
          'priority' => 10,
          'active_callback' => [
               [
                    'setting'  => 'dora_btn_switch',
                    'operator' => '==',
                    'value'    => true,
               ],
               [
                    'setting'  => 'dora_btn_page_link_type',
                    'operator' => '==',
                    'value'    => 'page_link',
               ],
          ],
     ];

     return $fields;
}
add_filter('kirki/fields', '_header_setting');

/* footer setting */
function _footer_setting($fields)
{
     $fields[] = [
          'type'     => 'switch',
          'settings' => 'dora_footer_switch',
          'label'    => esc_html__('Footer Swicher', 'dora'),
          'section'  => 'footer_setting',
          'default'  => '0',
          'priority' => 10,
          'choices'  => [
               'on'  => esc_html__('Enable', 'dora'),
               'off' => esc_html__('Disable', 'dora'),
          ],
     ];

     $fields[] = [
          'type'     => 'color',
          'settings' => 'dora_footer_bg_color',
          'label'    => esc_html__('Footer BG Color', 'dora'),
          'description' => esc_html__('This is a Footer bg color control.', 'dora'),
          'section'  => 'footer_setting',
          'default'  => '#FDF8F7',
          'priority' => 10,
          'active_callback' => [
               [
                    'setting'  => 'dora_footer_switch',
                    'operator' => '==',
                    'value'    => true,
               ]
          ],
          'output'        => array(
               array(
                    'element'  => '.copyright',
                    'property' => 'background-color',
               ),
          ),
     ];

     $fields[] = [
          'type'     => 'textarea',
          'settings' => 'dora_footer_text',
          'label'    => esc_html__('Copy Right', 'dora'),
          'section'  => 'footer_setting',
          'default'  => '<p>Developed with love by <a href="https://dora.net/" class="customize-unpreviewable">Codeefly</a> © 2023</p>',
          'priority' => 10,
          'active_callback' => [
               [
                    'setting'  => 'dora_footer_switch',
                    'operator' => '==',
                    'value'    => true,
               ]
          ],
     ];

     return $fields;
}
add_filter('kirki/fields', '_footer_setting');


/** Breadcrumb Settings */
function _breadcrumb_setting($fields)
{
     $fields[] = [
          'type'     => 'select',
          'settings' => 'breadcrumb_background_select',
          'label'    => esc_html__('Select Breadcrumb Background', 'dora'),
          'section'  => 'breadcrumb_setting',
          'default'  => 'color',
          'priority' => 10,
          'choices'     => [
               'color' => esc_html__('Background Color', 'dora'),
               'image' => esc_html__('Background Image', 'dora'),
          ],
     ];
     $fields[] = [
          'type'     => 'image',
          'settings' => 'breadcrumb_background_image',
          'label'    => esc_html__('Breadcrumb Background Image', 'dora'),
          'section'  => 'breadcrumb_setting',
          'priority' => 10,
          'active_callback' => [
               [
                    'setting'  => 'breadcrumb_background_select',
                    'operator' => '==',
                    'value'    => 'image',
               ],
          ],
     ];
     $fields[] = [
          'type'     => 'color',
          'settings' => 'breadcrumb_background_color',
          'label'    => esc_html__('Breadcrumb Background color', 'dora'),
          'description' => esc_html__('Breadcrumb color control with alpha channel.', 'dora'),
          'section'  => 'breadcrumb_setting',
          'default'     => '#FDF8F7',
          'priority' => 10,
          'active_callback' => [
               [
                    'setting'  => 'breadcrumb_background_select',
                    'operator' => '==',
                    'value'    => 'color',
               ],
          ],
     ];

     return $fields;
}
add_filter('kirki/fields', '_breadcrumb_setting');


/** Color Settings */
function _color_setting($fields)
{
     $fields[] =  [
          'type'        => 'color',
          'settings'    => 'primary_color',
          'label'       => __('Primary Color', 'dora'),
          'description' => esc_html__('This is a Theme Primary color control.', 'dora'),
          'section'     => 'color_setting',
          'default'     => '#fd6e0a',
          'priority'    => 10,
          'output'        => array(
               array(
                    'element'  => ':root',
                    'property' => '--cf-primary-color',
               ),
          ),
     ];

     $fields[] =  [
          'type'        => 'color',
          'settings'    => 'dark_color',
          'label'       => __('Dark Color', 'dora'),
          'description' => esc_html__('This is a Theme Dark color control.', 'dora'),
          'section'     => 'color_setting',
          'default'     => '#15295f',
          'priority'    => 10,
          'output'        => array(
               array(
                    'element'  => ':root',
                    'property' => '--cf-dark',
               ),
          ),
     ];

     $fields[] =  [
          'type'        => 'color',
          'settings'    => 'text_body_color',
          'label'       => __('Text Body Color', 'dora'),
          'description' => esc_html__('This is a Theme Text color control.', 'dora'),
          'section'     => 'color_setting',
          'default'     => '#6f6b80',
          'priority'    => 10,
          'output'        => array(
               array(
                    'element'  => ':root',
                    'property' => '--cf-text-gray',
               ),
          ),
     ];

     $fields[] =  [
          'type'        => 'color',
          'settings'    => 'border_color',
          'label'       => __('Border Color', 'dora'),
          'description' => esc_html__('This is a Theme Border color control.', 'dora'),
          'section'     => 'color_setting',
          'default'     => '#f2f2f2',
          'priority'    => 10,
          'output'        => array(
               array(
                    'element'  => ':root',
                    'property' => '--cf-border-color',
               ),
          ),
     ];

     return $fields;
}
add_filter('kirki/fields', '_color_setting');


/** Typo settings */
function _typo_setting($fields)
{
     $fields[] = [
          'type'        => 'typography',
          'settings'    => 'typography_setting',
          'label'       => esc_html__('Body Font Control', 'dora'),
          'section'     => 'typo_setting',
          'priority'    => 9,
          'transport'   => 'auto',
          'default'     => [
               'font-family'     => '',
               'variant'         => '',
               'font-style'      => '',
               'font-size'       => '',
               'line-height'     => '',
               'letter-spacing'  => '',
               'text-transform'  => '',
               'text-decoration' => '',
          ],
          'output'      => [
               [
                    'element' => ['body'],
               ],
          ],
     ];

     $fields[] = [
          'type'        => 'typography',
          'settings'    => 'typography_setting_h1',
          'label'       => esc_html__('H1 Font Control', 'dora'),
          'section'     => 'typo_setting',
          'priority'    => 20,
          'transport'   => 'auto',
          'default'     => [
               'font-family'     => '',
               'variant'         => '',
               'font-style'      => '',
               'font-size'       => '',
               'line-height'     => '',
               'letter-spacing'  => '',
               'text-transform'  => '',
               'text-decoration' => '',
          ],
          'output'      => [
               [
                    'element' => ['h1', '.breadcrumb h1', '.hero-section .hero-text h1'],
               ],
          ],
     ];

     $fields[] = [
          'type'        => 'typography',
          'settings'    => 'typography_setting_h2',
          'label'       => esc_html__('H2 Font Control', 'dora'),
          'section'     => 'typo_setting',
          'priority'    => 20,
          'transport'   => 'auto',
          'default'     => [
               'font-family'     => '',
               'variant'         => '',
               'font-style'      => '',
               'font-size'       => '',
               'line-height'     => '',
               'letter-spacing'  => '',
               'text-transform'  => '',
               'text-decoration' => '',
          ],
          'output'      => [
               [
                    'element' => ['h2', '.breadcrumb h2', '.section-title'],
               ],
          ],
     ];

     $fields[] = [
          'type'        => 'typography',
          'settings'    => 'typography_setting_h3',
          'label'       => esc_html__('H3 Font Control', 'dora'),
          'section'     => 'typo_setting',
          'priority'    => 20,
          'transport'   => 'auto',
          'default'     => [
               'font-family'     => '',
               'variant'         => '',
               'font-style'      => '',
               'font-size'       => '',
               'line-height'     => '',
               'letter-spacing'  => '',
               'text-transform'  => '',
               'text-decoration' => '',
          ],
          'output'      => [
               [
                    'element' => ['h3', '.hero-section .hero-text h3', '.support-section .support-items .support-item .support-text h3', '.feedback-section .feedback-item .feedback-title-cont h3', '.contact-section .contact-form h3', '.blog-area .blog h3'],
               ],
          ],
     ];

     $fields[] = [
          'type'        => 'typography',
          'settings'    => 'typography_setting_h4',
          'label'       => esc_html__('H4 Font Control', 'dora'),
          'section'     => 'typo_setting',
          'priority'    => 20,
          'transport'   => 'auto',
          'default'     => [
               'font-family'     => '',
               'variant'         => '',
               'font-style'      => '',
               'font-size'       => '',
               'line-height'     => '',
               'letter-spacing'  => '',
               'text-transform'  => '',
               'text-decoration' => '',
          ],
          'output'      => [
               [
                    'element' => ['h4', '.dora-popup .mfp-content .content .des h4', '.blog-area .blog-sidebar .blog-sidebar-widget h4', '.feedback-section .feedback-item .feedback-info-cont .feedback-person-info h4', '.blog-section .blog-items .blog-item .blog-info h4',],
               ],
          ],
     ];

     $fields[] = [
          'type'        => 'typography',
          'settings'    => 'typography_setting_h5',
          'label'       => esc_html__('H5 Font Control', 'dora'),
          'section'     => 'typo_setting',
          'priority'    => 20,
          'transport'   => 'auto',
          'default'     => [
               'font-family'     => '',
               'variant'         => '',
               'font-style'      => '',
               'font-size'       => '',
               'line-height'     => '',
               'letter-spacing'  => '',
               'text-transform'  => '',
               'text-decoration' => '',
          ],
          'output'      => [
               [
                    'element' => ['h5'],
               ],
          ],
     ];

     $fields[] = [
          'type'        => 'typography',
          'settings'    => 'typography_setting_h6',
          'label'       => esc_html__('H6 Font Control', 'dora'),
          'section'     => 'typo_setting',
          'priority'    => 20,
          'transport'   => 'auto',
          'default'     => [
               'font-family'     => '',
               'variant'         => '',
               'font-style'      => '',
               'font-size'       => '',
               'line-height'     => '',
               'letter-spacing'  => '',
               'text-transform'  => '',
               'text-decoration' => '',
          ],
          'output'      => [
               [
                    'element' => ['h6', '.blog-area .blog-sidebar .blog-sidebar-widget .recent-posts .recent-post-single h6'],
               ],
          ],
     ];

     return $fields;
}
add_filter('kirki/fields', '_typo_setting');



/**
 * This is a short hand function for getting setting value from customizer
 *
 * @param string $name
 *
 * @return bool|string
 **/

function DORA_THEME_option($name)
{
     $value = '';
     if (class_exists('dora')) {
          $value = Kirki::get_option(dora_get_theme(), $name);
     }
     return apply_filters('DORA_THEME_option', $value, $name);
}

/**
 * Get config ID
 * @return string
 **/

function dora_get_theme()
{
     return 'dora';
}
