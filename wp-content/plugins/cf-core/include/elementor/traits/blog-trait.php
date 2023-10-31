<?php

namespace CFCore;

use Elementor\Controls_Manager;


trait Blog_Trait
{
     public function blogTraitController()
     {
          // Blog Query
          $this->start_controls_section(
               'cf_post_query',
               [
                    'label' => esc_html__('Blog Query', 'cfcore'),
               ]
          );

          $this->add_control(
               'posts_per_page',
               [
                    'label' => esc_html__('Posts Per Page', 'cfcore'),
                    'description' => esc_html__('Leave blank or enter -1 for all.', 'cfcore'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '3',
               ]
          );

          $this->add_control(
               'orderby',
               [
                    'label' => esc_html__('Order By', 'cfcore'),
                    'type' => Controls_Manager::SELECT,
                    'options' => array(
                         'ID' => 'Post ID',
                         'author' => 'Post Author',
                         'title' => 'Title',
                         'date' => 'Date',
                         'modified' => 'Last Modified Date',
                         'parent' => 'Parent Id',
                         'rand' => 'Random',
                         'comment_count' => 'Comment Count',
                         'menu_order' => 'Menu Order',
                    ),
                    'default' => 'date',
               ]
          );

          $this->add_control(
               'order',
               [
                    'label' => esc_html__('Order', 'cfcore'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                         'asc' => esc_html__('Ascending', 'cfcore'),
                         'desc' => esc_html__('Descending', 'cfcore'),
                    ],
                    'default' => 'desc',

               ]
          );

          $this->add_control(
               'cf_blog_title_word',
               [
                    'label' => esc_html__('Title Word Count', 'cfcore'),
                    'description' => esc_html__('Set how many word you want to displa!', 'cfcore'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => '6',
               ]
          );

          $this->add_control(
               'cf_post_content',
               [
                    'label' => __('Content', 'cfcore'),
                    'type' => Controls_Manager::SWITCHER,
                    'label_on' => __('Show', 'cfcore'),
                    'label_off' => __('Hide', 'cfcore'),
                    'return_value' => 'yes',
                    'default' => '',
               ]
          );

          $this->add_control(
               'cf_post_content_limit',
               [
                    'label' => __('Content Limit', 'cfcore'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => '14',
                    'condition' => [
                         'cf_post_content' => 'yes',
                    ],
               ]
          );

          $this->end_controls_section();
     }

     public function blogRender($extraTitleClass = '', $extraSubTitle = '')
     {
          $settings = $this->get_settings_for_display();

          if (get_query_var('paged')) {
               $paged = get_query_var('paged');
          } else if (get_query_var('page')) {
               $paged = get_query_var('page');
          } else {
               $paged = 1;
          }

          $posts_per_page = (!empty($settings['posts_per_page'])) ? $settings['posts_per_page'] : '-1';
          $orderby = (!empty($settings['orderby'])) ? $settings['orderby'] : 'post_date';
          $order = (!empty($settings['order'])) ? $settings['order'] : 'desc';

          $args = array(
               'post_type' => 'post',
               'post_status' => 'publish',
               'ignore_sticky_posts' => true,
               'posts_per_page' => $posts_per_page,
               'orderby' => $orderby,
               'order' => $order,
               'paged' => $paged,
               'meta_query' => array(
                    array(
                         'key' => '_thumbnail_id'
                    )
               )
          );

          // The Query
          $query = new \WP_Query($args);


          if ($query->have_posts()) : ?>
               <div class="blog-items">
                    <?php while ($query->have_posts()) :
                         $query->the_post();
                         global $post;
                         $categories = get_the_category($post->ID);
                    ?>
                         <!-- 01 blog item start -->
                         <div class="blog-item">
                              <div class="wow fadeInUp">
                                   <?php if (has_post_thumbnail()) : ?>
                                        <div class="blog-date-cont">
                                             <p><?php echo get_the_date(); ?></p>
                                        </div>
                                        <a href="<?php the_permalink(); ?>" class="blog-item-img">
                                             <?php the_post_thumbnail('category-thumb'); ?>
                                        </a>
                                   <?php endif ?>
                                   <div class="blog-info">
                                        <?php if (!empty($categories[0]->name)) : ?>
                                             <a href="<?php echo esc_url(get_category_link($categories[0]->term_id)) ?>" class="category  <?php echo $extraSubTitle ?>"><?php echo esc_html($categories[0]->name); ?></a>
                                        <?php endif ?>
                                        <h4 class="blog-title <?php echo $extraTitleClass ?>">
                                             <a href="<?php the_permalink(); ?>">
                                                  <?php echo wp_trim_words(get_the_title(), $settings['cf_blog_title_word'], ''); ?> </a>
                                        </h4>
                                        <?php if (!empty($settings['cf_post_content'])) :
                                             $cf_post_content_limit = (!empty($settings['cf_post_content_limit'])) ? $settings['cf_post_content_limit'] : '';
                                        ?>
                                             <p><?php print wp_trim_words(get_the_excerpt(get_the_ID()), $cf_post_content_limit, ''); ?></p>
                                        <?php endif; ?>
                                   </div>
                              </div>
                         </div>
                         <!-- 01 blog item end -->
                    <?php endwhile;
                    wp_reset_query(); ?>
               </div>
<?php endif;
     }
}
