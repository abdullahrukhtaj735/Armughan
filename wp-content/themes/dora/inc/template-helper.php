<?php

/**
 * [dora_header_menu description]
 * @return [type] [description]
 */

function dora_header_menu()
{
     wp_nav_menu([
          'theme_location' => 'menu-1',
          'menu_class' => '',
          'container' => '',
          'fallback_cb' => 'dora_Navwalker_Class::fallback',
          'walker' => new dora_Navwalker_Class(),
     ]);
}

/* WP kses allowed tags */
function dora_kses($raw)
{
     $allowed_tags = array(
          'a' => array(
               'class' => array(),
               'href' => array(),
               'rel' => array(),
               'title' => array(),
               'target' => array(),
          ),
          'abbr' => array(
               'title' => array(),
          ),
          'b' => array(),
          'blockquote' => array(
               'cite' => array(),
          ),
          'cite' => array(
               'title' => array(),
          ),
          'code' => array(),
          'del' => array(
               'datetime' => array(),
               'title' => array(),
          ),
          'dd' => array(),
          'div' => array(
               'class' => array(),
               'title' => array(),
               'style' => array(),
          ),
          'dl' => array(),
          'dt' => array(),
          'em' => array(),
          'h1' => array(),
          'h2' => array(),
          'h3' => array(),
          'h4' => array(),
          'h5' => array(),
          'h6' => array(),
          'i' => array(
               'class' => array(),
          ),
          'img' => array(
               'alt' => array(),
               'class' => array(),
               'height' => array(),
               'src' => array(),
               'width' => array(),
          ),
          'li' => array(
               'class' => array(),
          ),
          'ol' => array(
               'class' => array(),
          ),
          'p' => array(
               'class' => array(),
          ),
          'q' => array(
               'cite' => array(),
               'title' => array(),
          ),
          'span' => array(
               'class' => array(),
               'title' => array(),
               'style' => array(),
          ),
          'iframe' => array(
               'width' => array(),
               'height' => array(),
               'scrolling' => array(),
               'frameborder' => array(),
               'allow' => array(),
               'src' => array(),
          ),
          'strike' => array(),
          'br' => array(),
          'strong' => array(),
          'data-wow-duration' => array(),
          'data-wow-delay' => array(),
          'data-wallpaper-options' => array(),
          'data-stellar-background-ratio' => array(),
          'ul' => array(
               'class' => array(),
          ),
          'svg' => array(
               'class' => true,
               'aria-hidden' => true,
               'aria-labelledby' => true,
               'role' => true,
               'xmlns' => true,
               'width' => true,
               'height' => true,
               'viewbox' => true, // <= Must be lower case!
          ),
          'g' => array('fill' => true),
          'title' => array('title' => true),
          'path' => array('d' => true, 'fill' => true),
     );

     if (function_exists('wp_kses')) { // WP is here
          $allowed = wp_kses($raw, $allowed_tags);
     } else {
          $allowed = $raw;
     }

     return $allowed;
}

/** Doar pagination */
if (!function_exists('dora_pagination')) {

     function _dora_pagi_callback($pagination)
     {
          return $pagination;
     }

     //page navegation
     function dora_pagination($prev, $next, $pages, $args)
     {
          global $wp_query, $wp_rewrite;
          $menu = '';
          $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

          if ($pages == '') {
               global $wp_query;
               $pages = $wp_query->max_num_pages;

               if (!$pages) {
                    $pages = 1;
               }
          }

          $pagination = [
               'base' => add_query_arg('paged', '%#%'),
               'format' => '',
               'total' => $pages,
               'current' => $current,
               'prev_text' => $prev,
               'next_text' => $next,
               'type' => 'array',
          ];

          //rewrite permalinks
          if ($wp_rewrite->using_permalinks()) {
               $pagination['base'] = user_trailingslashit(trailingslashit(remove_query_arg('s', get_pagenum_link(1))) . 'page/%#%/', 'paged');
          }

          if (!empty($wp_query->query_vars['s'])) {
               $pagination['add_args'] = ['s' => get_query_var('s')];
          }

          $pagi = '';
          if (paginate_links($pagination) != '') {
               $paginations = paginate_links($pagination);
               $pagi .= '<ul>';
               foreach ($paginations as $key => $pg) {
                    $pagi .= '<li>' . $pg . '</li>';
               }
               $pagi .= '</ul>';
          }

          print _dora_pagi_callback($pagi);
     }
}

/** get tags */
function dora_get_tag()
{
     $html = '';
     if (has_tag()) {
          $html .= '<div class="blog-tags"><span>' . esc_html__('Post Tags : ', 'dora') . '</span>';
          $html .= get_the_tag_list('', ' ', '');
          $html .= '</div>';
     }
     return $html;
}
