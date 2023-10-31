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


class Service_Slider extends Widget_Base
{
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use RepeaterControllerTrait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Services Slider';
          $this->widget_name = 'service-slider';
          $this->widget_icon = 'eicon-slider-push';
     }



     protected function register_controls()
     {
          $this->start_section('service_slider', 'Services Slider');

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
          ],);

          $this->end_section();
     }
     protected function render()
     {
          $settings = $this->get_settings_for_display();
?>
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
<?php
     }
}

$widgets_manager->register(new Service_Slider());
