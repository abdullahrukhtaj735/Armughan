<?php

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function my_theme_register_sidebar()
{
     $args = array(
          'name'          => __('Blog Sidebar', 'dora'),
          'id'            => 'custom-blog-widget',
          'description'   => __('Your Blog Widget.', 'dora'),
          'before_widget' => '<div class="widget-container">',
          'after_widget'  => '</div>',
          'before_title'  => '<h4 class="widget-header">',
          'after_title'   => '</h4>',
     );
     register_sidebar($args);
}
add_action('widgets_init', 'my_theme_register_sidebar');
