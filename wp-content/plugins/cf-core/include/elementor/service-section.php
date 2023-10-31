<?php

namespace CFCore;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use Elementor\Core\Schemes\Color;

require_once CFCORE_ELEMENTS_PATH . '/traits/section-title-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/repeater-controller-trait.php';

if (!defined('ABSPATH')) {
     exit;
}


class Service_Section extends Widget_Base
{
     use Section_Title_Trait;
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use RepeaterControllerTrait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Services Section';
          $this->widget_name = 'service-section';
          $this->widget_icon = 'eicon-accordion';
     }

     protected function register_controls()
     {
          $this->start_section();
          $this->title_controls('left', 'I Provide Wide Range Of Digital Services');
          $this->sub_title_controls('Services');
          $this->end_section();


          $this->start_section('service_slider', 'Services Slider');

          $this->iconController('Arrow Left', 'left_icon', 'selected_left_icon', 'fa-solid fa-arrow-left');
          $this->iconController('Arrow Right', 'right_icon', 'selected_right_icon', 'fa-solid fa-arrow-right');

          $repeater = new \Elementor\Repeater();
          $this->iconRepeaterController($repeater, 'service_icon', 'service_selected_icon', 'fa-light fa-award', 'Icon');
          $this->repeaterColorControll($repeater, 'icon_bg', 'Icon Background Color', '#9C19C9');
          $this->repeaterColorControll($repeater, 'icon_color', 'Icon Color', '#fff');
          $this->repeaterTextController($repeater, 'service_name', 'Service Name', 'UI/UX Design');
          $this->repeaterTextAreaController($repeater, 'service_des', 'Description', 'Rror te inal desiga othe fal dveoprer age your adcased men Mageeef speists');
          $this->repeaterDefultController($repeater, 'services', 'service_name', [
               [
                    'service_name' => __('UI/UX Design', 'cfcore'),
               ],
               [
                    'service_name' => __('Web Design', 'cfcore'),
               ],
          ], true, 'Services');

          $this->end_section();
     }
     protected function render()
     {
          $settings = $this->get_settings_for_display();
          $selected_left_icon = $settings['selected_left_icon'];
          $selected_right_icon = $settings['selected_right_icon'];
?>
          <section class="service-section" id="services">
               <div class="container">
                    <div class="row align-items-center">
                         <div class="service-title-container">
                              <!-- Service Title -->
                              <?php $this->get_title_rander_value(); ?>
                              <!-- Arrow icon -->
                              <?php if (!empty($settings['services'])) : ?>
                                   <div class="service-btn-container wow fadeInUp">
                                        <?php if (!empty($selected_left_icon['value'])) : ?>
                                             <a href="#" class="slider-arrow service-swiper-button-left">
                                                  <?php cf_render_icon($settings, 'left_icon', 'selected_left_icon') ?>
                                             </a>
                                        <?php endif ?>
                                        <?php if (!empty($selected_right_icon['value'])) : ?>
                                             <a href="#" class="slider-arrow active service-swiper-button-right">
                                                  <?php cf_render_icon($settings, 'right_icon', 'selected_right_icon') ?>
                                             </a>
                                        <?php endif ?>
                                   </div>
                              <?php endif ?>
                         </div>
                         <?php if (!empty($settings['services'])) : ?>
                              <div class="swiper services-cont wow fadeInUp">
                                   <div class="swiper-wrapper service-items">
                                        <?php foreach ($settings['services'] as $service) : ?>
                                             <div class="swiper-slide">
                                                  <div class="service-item">
                                                       <?php if (!empty($service['service_selected_icon'])) : ?>
                                                            <span class="service-item-logo" style="background:<?php echo $service['icon_bg'] ?> ; color: <?php echo $service['icon_color'] ?>;"><?php cf_render_icon($service, 'service_icon', 'service_selected_icon') ?></span>
                                                       <?php endif ?>
                                                       <?php if (!empty($service['service_name'])) : ?>
                                                            <h3><?php echo cf_kses($service['service_name']) ?></h3>
                                                       <?php endif ?>
                                                       <?php if (!empty($service['service_des'])) : ?>
                                                            <p>
                                                                 <?php echo cf_kses($service['service_des']) ?>
                                                            </p>
                                                       <?php endif ?>
                                                  </div>
                                             </div>
                                        <?php endforeach ?>
                                   </div>
                              </div>
                         <?php endif ?>
                    </div>
               </div>
          </section>
<?php
     }
}

$widgets_manager->register(new Service_Section());
