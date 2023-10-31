<?php

/**
 * Template part for displaying header
 * 
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package dora
 */

$dora_defult_logo = get_template_directory_uri() . '/assets/images/logo.png';
$logo = get_theme_mod('dora_logo', $dora_defult_logo);
/** Header option */
$dora_btn_switch = get_theme_mod('dora_btn_switch', false);
$dora_btn_text = get_theme_mod('dora_btn_text', __('Button Text', 'dora'));
$dora_btn_page_link_type = get_theme_mod('dora_btn_page_link_type', __('url', 'dora'));
$dora_btn_link_url = get_theme_mod('dora_btn_link_url', __('#', 'dora'));
$dora_btn_page_link = get_permalink(get_theme_mod('dora_btn_page_link', __('#', 'dora')));

$btn_url = $dora_btn_page_link_type == 'url' ? $dora_btn_link_url : $dora_btn_page_link;

?>

<header class="header">
     <div class="container">
          <div class="row justify-content-between align-items-center">
               <div class="brand-name-toggle">
                    <!-- Logo -->
                    <div class="brand-name">
                         <a href="<?php print esc_url(home_url('/')); ?>">
                              <img src="<?php echo esc_url($logo)  ?>" alt="<?php echo esc_attr__('logo', 'dora') ?>">
                         </a>
                    </div>
                    <!-- Toggle -->
                    <div class="toggle">
                         <i class="fal fa-bars"></i>
                    </div>
               </div>
               <!-- Nav -->
               <nav class="nav" id="nav">
                    <?php dora_header_menu() ?>
                    <?php if ($dora_btn_switch) : ?>
                         <div class="nav-btn">
                              <a href="<?php echo esc_url($btn_url) ?>" class="btn primary-btn"><?php echo esc_html($dora_btn_text) ?></a>
                         </div>
                    <?php endif ?>
               </nav>
          </div>
          <div class="mobile-menu"></div>
     </div>
</header>