<?php

/** 
 * dora_scripts description
 * @return [type] [description]
 */

/**
 * Enqueue scripts and styles.
 */
function dora_scripts()
{
     wp_enqueue_style('dora_fonts', dora_fonts_url(), array(), time());
     /** CSS */
     wp_enqueue_style('swiper-slider', DORA_THEME_CSS_DIR . 'swiper-bundle.min.css', [], _S_VERSION);
     wp_enqueue_style('animate', DORA_THEME_CSS_DIR . 'animate.css', [], _S_VERSION);
     wp_enqueue_style('magnific-popup', DORA_THEME_CSS_DIR . 'magnific-popup.min.css', [], _S_VERSION);
     wp_enqueue_style('flaticon', DORA_THEME_CSS_DIR . 'flaticon.css', [], _S_VERSION);
     wp_enqueue_style('font-awesome-pro', DORA_THEME_CSS_DIR . 'font-awesome-pro.css', [], _S_VERSION);
     wp_enqueue_style('nice-select', DORA_THEME_CSS_DIR . 'nice-select.css', [], _S_VERSION);
     wp_enqueue_style('meanmenu', DORA_THEME_CSS_DIR . 'meanmenu.css', [], _S_VERSION);
     wp_enqueue_style('dora-core', DORA_THEME_CSS_DIR . 'dora-core.css', [], _S_VERSION);
     wp_enqueue_style('dora-unit', DORA_THEME_CSS_DIR . 'dora-unit.css', [], _S_VERSION);
     wp_enqueue_style('dora-style', get_stylesheet_uri(), [], _S_VERSION);
     /** JS */
     wp_enqueue_script('magnific', DORA_THEME_JS_DIR . 'swiper-bundle.min.js', ['jquery'], _S_VERSION, true);
     wp_enqueue_script('swiper-bundle', DORA_THEME_JS_DIR . 'jquery.magnific-popup.min.js', ['jquery'], _S_VERSION, true);
     wp_enqueue_script('meanmenu', DORA_THEME_JS_DIR . 'meanmenu.js', ['jquery'], false, true);
     wp_enqueue_script('wow', DORA_THEME_JS_DIR . 'wow.min.js', ['jquery'], _S_VERSION, true);
     wp_enqueue_script('isotope-pkgd', DORA_THEME_JS_DIR . 'isotope.js', ['imagesloaded'], false, true);
     wp_enqueue_script('nav', DORA_THEME_JS_DIR . 'jquery.nav.min.js', ['jquery'], false, true);
     wp_enqueue_script('gsap', DORA_THEME_JS_DIR . 'gsap.min.js', ['jquery'], false, true);
     wp_enqueue_script('jquery-nice-select', DORA_THEME_JS_DIR . 'jquery.nice-select.min.js', ['jquery'], false, true);
     wp_enqueue_script('dora-main', DORA_THEME_JS_DIR . 'main.js', ['jquery'], time(), true);

     if (is_singular() && comments_open() && get_option('thread_comments')) {
          wp_enqueue_script('comment-reply');
     }
}
add_action('wp_enqueue_scripts', 'dora_scripts');


/*
Register Fonts
 */
function dora_fonts_url()
{
     $font_url = '';

     /*
    Translators: If there are characters in your language that are not supported
    by chosen font(s), translate this to 'off'. Do not translate into your own language.
     */
     if ('off' !== _x('on', 'Google font: on or off', 'dora')) {
          $font_url = 'https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap';
     }
     return $font_url;
}
