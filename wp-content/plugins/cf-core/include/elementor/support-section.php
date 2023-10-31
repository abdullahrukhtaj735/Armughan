<?php

namespace CFCore;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
     exit;
}

require_once CFCORE_ELEMENTS_PATH . '/traits/section-title-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/repeater-controller-trait.php';

class Support_Section extends Widget_Base
{

     use Section_Title_Trait;
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use RepeaterControllerTrait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Fun Section';
          $this->widget_name = 'un-section';
          $this->widget_icon = 'eicon-accordion';
          $this->widget_keywords = ['fun', 'support', 'icon with text'];
     }

     protected function register_controls()
     {
          $this->start_section('fun_content', 'Content');

          $repeater = new \Elementor\Repeater();
          $this->iconRepeaterController($repeater, 'content_icon', 'content_selected_icon', 'fa-light fa-award');
          $this->repeaterTextController($repeater, 'fun_title', 'Title', '8 years job');
          $this->repeaterTextController($repeater, 'fun_tag', 'Tag / Category', 'Experience');
          $this->repeaterDefultController($repeater, 'fun_section', 'fun_title', [
               [
                    'fun_title' => __('8 years job', 'cfcore'),
                    'fun_tag' => __('Experience', 'cfcore'),
               ],
               [
                    'fun_title' => __('500+ Projects', 'cfcore'),
                    'fun_tag' => __('Completed', 'cfcore'),
               ],
               [
                    'fun_title' => __('Online 24/7', 'cfcore'),
                    'fun_tag' => __('Support', 'cfcore'),
               ],
          ]);

          $this->end_section();
     }
     protected function render()
     {
          $settings = $this->get_settings_for_display();
?>
          <section class="support-section wow fadeInUp">
               <div class="container">
                    <div class="support-items">
                         <div class="row">
                              <!-- 01 support item start -->
                              <?php foreach ($settings['fun_section'] as $item) : ?>
                                   <div class="support-item">
                                        <div class="support-icon">
                                             <?php cf_render_icon($item, 'content_icon', 'content_selected_icon') ?>
                                        </div>
                                        <div class="support-text">
                                             <?php if (!empty($item['fun_title'])) : ?>
                                                  <h3><?php echo $item['fun_title'] ?></h3>
                                             <?php endif ?>
                                             <?php if (!empty($item['fun_tag'])) : ?>
                                                  <p><?php echo $item['fun_tag'] ?></p>
                                             <?php endif ?>
                                        </div>
                                   </div>
                              <?php endforeach ?>
                         </div>
                    </div>
               </div>
          </section>
<?php
     }
}

$widgets_manager->register(new Support_Section());
