<?php

namespace CFCore;

trait IsotopeTrait
{

     public function isotopeController()
     {
          $this->start_section('gallery_content', 'Gallery Isotope');
          $repeater = new \Elementor\Repeater();
          $this->repeaterTextController($repeater, 'isotope_title', 'Title', 'Youtube');
          $this->repeaterImageController($repeater, 'thumbnail_image');
          $this->repeaterSelectController($repeater, 'isotop_type', 'Work Type', '1', [
               '1' => 'Embed Url',
               '2' => 'Image',
               '3' => 'Details',
          ]);
          $repeater->add_control(
               'embed_url',
               [
                    'label' => esc_html__('Embed Url', 'cfcore'),
                    'type' => \Elementor\Controls_Manager::TEXT,
                    'input_type' => 'embed_url',
                    'default' => 'https://www.youtube.com/watch?v=B-ytMSuwbf8',
                    'condition' => [
                         'isotop_type' => '1',
                    ],
               ]
          );
          $this->textRepeaterControllerWithCondition($repeater, [
               'isotop_type' => '3',
          ], 'details_title', 'Title', 'Mobile Application');
          $this->textRepeaterControllerWithCondition($repeater, [
               'isotop_type' => '3',
          ], 'category', 'Category', 'Details');
          $this->textAreaRepeaterControllerWithCondition($repeater, [
               'isotop_type' => '3',
          ], 'desc', 'Details', 'We live in a world where we need to move quickly and iterate on our ideas as flexibly as possible. Building mockups strikes the ideal balance between true-life representation of the end product and ease of modification.');
          $this->repeaterDefultController($repeater, 'isotope_gallary', 'isotope_title', [
               [
                    'isotope_title' => __('Youtube', 'cfcore'),
               ],
               [
                    'isotope_title' => __('Vimeo', 'cfcore'),
               ],
          ]);
          $this->end_section();
     }
     public function isotopeFilterRender()
     {
          $settings = $this->get_settings_for_display();
          $isotope_gallary = $settings['isotope_gallary'];
          $category = unique_multidim_array($isotope_gallary, 'isotope_title');
?>
          <div class="work-isotope-filter">
               <!-- work isotope menu -->
               <ul class="works-list-ul wow fadeInUp">
                    <li class="active" data-filter="*">All</li>
                    <?php foreach ($category as $isotope) : ?>
                         <li data-filter=".<?php echo esc_html(str_replace(' ', '-', strtolower($isotope['isotope_title']))) ?>">
                              <?php echo ucfirst($isotope['isotope_title']) ?></li>
                    <?php endforeach; ?>
               </ul>
               <!-- work isotope items -->
               <div class="works-row wow fadeInUp">
                    <!-- Youtube -->
                    <?php foreach ($isotope_gallary as $isotope) : ?>
                         <?php
                         $url = '';
                         if ($isotope["isotop_type"] == 2) {
                              $url = $isotope['thumbnail_image']['url'];
                         } elseif ($isotope["isotop_type"] == 1) {
                              $url = ($isotope['embed_url']);
                         } else {
                              $url = '#' . strtolower(str_replace(' ', '-', $isotope['details_title']));
                         ?>

                              <div id="<?php echo esc_attr(strtolower(str_replace(' ', '-', $isotope['details_title']))) ?>" class="mfp-fade mfp-hide">
                                   <div class="content">
                                        <?php if (!empty($isotope['thumbnail_image'])) : ?>
                                             <div class="img">
                                                  <img src="<?php echo esc_url($isotope['thumbnail_image']['url']) ?>" alt="isotope-image">
                                             </div>
                                        <?php endif ?>
                                        <div class="des">
                                             <span><?php echo $isotope['category'] ?></span>
                                             <h4><?php echo $isotope['details_title'] ?></h4>
                                             <p><?php echo cf_kses($isotope['desc']) ?></p>
                                        </div>
                                   </div>
                              </div>

                         <?php
                         }

                         ?>
                         <div class="works-col <?php $isotope['isotop_type'] == 3 ? 'details' : '' ?> <?php echo esc_html(str_replace(' ', '-', strtolower($isotope['isotope_title']))) ?>">
                              <?php if (!empty($isotope['thumbnail_image'])) : ?>
                                   <a href="<?php echo esc_attr($url) ?>">
                                        <img src="<?php echo esc_url($isotope['thumbnail_image']['url']) ?>" alt="isotope-image">
                                   </a>
                              <?php endif ?>
                         </div>
                    <?php endforeach; ?>
                    <!--  -->
               </div>
          </div>
<?php
     }
}
