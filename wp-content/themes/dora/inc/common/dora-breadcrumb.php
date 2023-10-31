<?php

/**
 * Breadcrumbs for dora theme.
 *
 * @package     dora
 * @author      Codeefly
 * @copyright   Copyright (c) 2022, Codeefly
 * @link        https://codeefly.net
 * @since       dora 1.0.0
 */

function dora_breadcrumb_func()
{
     global $post;
     $breadcrumb_class = '';
     $breadcrumb_show = 1;

     if (is_front_page() && is_home()) {
          $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'dora'));
          $breadcrumb_class = 'home_front_page';
     } elseif (is_front_page()) {
          $title = get_theme_mod('breadcrumb_blog_title', __('Blog', 'dora'));
          $breadcrumb_show = 0;
     } elseif (is_home()) {
          if (get_option('page_for_posts')) {
               $title = get_the_title(get_option('page_for_posts'));
          }
     } elseif (is_single() && 'post' == get_post_type()) {
          $title = get_the_title();
     } elseif (is_single() && 'product' == get_post_type()) {
          $title = get_theme_mod('breadcrumb_product_details', __('Shop', 'dora'));
     } elseif (is_single() && 'courses' == get_post_type()) {
          $title = esc_html__('Course Details', 'dora');
     } elseif ('courses' == get_post_type()) {
          $title = esc_html__('Courses', 'dora');
     } elseif (is_search()) {
          $title = esc_html__('Search Results for : ', 'dora') . get_search_query();
     } elseif (is_404()) {
          $title = esc_html__('Page not Found', 'dora');
     } elseif (function_exists('is_woocommerce') && is_woocommerce()) {
          $title = get_theme_mod('breadcrumb_shop', __('Shop', 'dora'));
     } elseif (is_archive()) {
          $title = get_the_archive_title();
     } else {
          $title = get_the_title();
     }

     $_id = get_the_ID();

     if (is_single() && 'product' == get_post_type()) {
          $_id = $post->ID;
     } elseif (function_exists("is_shop") and is_shop()) {
          $_id = wc_get_page_id('shop');
     } elseif (is_home() && get_option('page_for_posts')) {
          $_id = get_option('page_for_posts');
     }

     $is_breadcrumb = function_exists('get_field') ? get_field('is_it_invisible_breadcrumb', $_id) : '';
     if (!empty($_GET['s'])) {
          $is_breadcrumb = null;
     }

     if (empty($is_breadcrumb) && $breadcrumb_show == 1) {

          // get_theme_mod
          // $breadcrumb_switch = get_theme_mod('breadcrumb_switch', true);
          $breadcrumb_background_color = get_theme_mod('breadcrumb_background_color',  __('#FDF8F7', 'dora'));
          $breadcrumb_background_image = get_theme_mod('breadcrumb_background_image', 'dora');

          $breadcrumb_switch = get_post_meta(get_the_ID(), 'CFCore_breadcrumb_checkbox', true) == 'on';
?>



          <?php if (!$breadcrumb_switch) : ?>
               <section class="breadcrumb" data-bg-color="<?php print esc_attr($breadcrumb_background_color); ?>" style="background: ;">
                    <div class="container">
                         <?php if (!empty($title)) : ?>
                              <div class="banner-inner">
                                   <h1><?php echo dora_kses($title) ?></h1>
                              </div>
                         <?php endif ?>
                    </div>
               </section>
<?php endif;
     }
}

add_action('dora_before_main_content', 'dora_breadcrumb_func');
