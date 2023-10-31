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


class Feedback_Section extends Widget_Base
{
     use Section_Title_Trait;
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use RepeaterControllerTrait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Feedback Section';
          $this->widget_name = 'feedback-section';
          $this->widget_icon = 'eicon-accordion';
          $this->widget_keywords = ['testimonial', 'slider', 'feedback'];
     }

     protected function register_controls()
     {

          $this->start_section('section_content', 'Content');
          $this->title_controls('left', 'Clients Are Satisfied For Our Work, View Feedback');
          $this->end_section();

          $this->start_section('testimonial_slider', 'Testimonials Slider');
          $this->iconController('Arrows Left', 'arrow_left_icon', 'arrow_left_selected_icon', 'fa-solid fa-arrow-left');
          $this->iconController('Arrows right', 'arrow_right_icon', 'arrow_right_selected_icon', 'fa-solid fa-arrow-right');
          $repeater = new \Elementor\Repeater();
          $this->repeaterTextAreaController($repeater, 'testimonial_text', '', 'Loved the template design, documentation, customizability and the customer support from Marketify team! I am a noob in programming with very little knowledge about coding.');
          $this->repeaterTextController($repeater, 'testimonial_title', 'Title', 'Awesome Service!');
          $this->repeaterTextController($repeater, 'testimonial_name', 'Name', 'Beseie Cooper');
          $this->repeaterTextController($repeater, 'testimonial_occopation', 'Occopation', 'Web Designer');
          $this->repeaterImageController($repeater, 'testimonial_image');
          $this->repeaterDefultController($repeater, 'testimonials', 'testimonial_name', [
               [
                    'testimonial_name' => __('Beseie Cooper', 'cfcore'),
               ],
               [
                    'testimonial_name' => __('Beseie Cooper', 'cfcore'),
               ],
          ], true, 'Testimonial');
          $this->end_section();
     }
     protected function render()
     {
          $settings = $this->get_settings_for_display();
          $this->add_render_attribute('title_args', 'class', 'section-title');
?>
          <section class="feedback-section">
               <div class="container">
                    <div class="feedback-section-title-cont">
                         <!-- Feedback Title -->
                         <?php $this->get_title_rander_value() ?>
                         <!-- Slider arrow -->
                         <div class="feedback-btn-cont wow fadeInUp">
                              <?php if (!empty($settings['arrow_left_selected_icon']['value'])) : ?>
                                   <a href="#" class="slider-arrow feedback-left">
                                        <?php cf_render_icon($settings, 'arrow_left_icon', 'arrow_left_selected_icon') ?>
                                   </a>
                              <?php endif ?>
                              <?php if (!empty($settings['arrow_right_selected_icon']['value'])) : ?>
                                   <a href="#" class="slider-arrow active feedback-right">
                                        <?php cf_render_icon($settings, 'arrow_right_icon', 'arrow_right_selected_icon') ?>
                                   </a>
                              <?php endif ?>
                         </div>
                    </div>

                    <div class="swiper feedback-items-cont">
                         <div class="swiper-wrapper feedback-items wow fadeInUp">
                              <?php foreach ($settings['testimonials'] as $testimonial) : ?>
                                   <!-- 01 feedback item start -->
                                   <div class="swiper-slide feedback-item">
                                        <?php if ($testimonial['testimonial_image']['url'] || $testimonial['testimonial_image']['id']) : ?>
                                             <div class="feedback-active-img">
                                                  <?php $this->imageRanderForRepeater($testimonial['testimonial_image']) ?>
                                             </div>
                                        <?php endif; ?>

                                        <div class="feedback-info-cont">
                                             <div class="feedback-title-cont">
                                                  <?php if (!empty($testimonial['testimonial_title'])) : ?>
                                                       <h3> <?php echo $testimonial['testimonial_title'] ?></h3>
                                                  <?php endif ?>
                                                  <div class="feedback-title-element">
                                                       <img src="<?php echo get_template_directory_uri() ?>/assets/images/bg_elements/feedback-element.svg" alt="dora_img">
                                                  </div>
                                             </div>
                                             <?php if (!empty($testimonial['testimonial_text'])) : ?>
                                                  <p class="feedback-txt">
                                                       <?php echo $testimonial['testimonial_text'] ?>
                                                  </p>
                                             <?php endif ?>
                                             <div class="feedback-person-info">

                                                  <?php if ($testimonial['testimonial_image']['url'] || $testimonial['testimonial_image']['id']) : ?>
                                                       <div class="feedback-person-img">
                                                            <?php $this->imageRanderForRepeater($testimonial['testimonial_image']) ?> </div>
                                                  <?php endif; ?>

                                                  <div class="feedback-person-name">
                                                       <?php if (!empty($testimonial['testimonial_name'])) : ?>
                                                            <h4><?php echo $testimonial['testimonial_name'] ?></h4>
                                                       <?php endif ?>
                                                       <?php if (!empty($testimonial['testimonial_occopation'])) : ?>
                                                            <p><?php echo $testimonial['testimonial_occopation'] ?></p>
                                                       <?php endif ?>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                                   <!-- 01 feedback item end -->
                              <?php endforeach ?>
                         </div>
                    </div>
               </div>
          </section>
<?php
     }
}

$widgets_manager->register(new Feedback_Section());
