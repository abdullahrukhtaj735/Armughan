<?php

namespace CFCore;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use \Elementor\Repeater;


require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/repeater-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/button-trait.php';

if (!defined('ABSPATH')) {
     exit;
}

class Banner extends Widget_Base
{
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use RepeaterControllerTrait;
     use ButtonTrait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Banner';
          $this->widget_name = 'banner';
          $this->widget_icon = 'fa-light fa-pipe-section';
     }


     protected function register_controls()
     {

          $this->start_section('section_content', 'Content/Title');
          $this->textController('banner_title', 'Banner Title / Name', 'Mary Hardy');
          $this->textController('banner_subtitle', 'Banner Sub Title', 'Digital Marketing Expert');
          $this->textAreaController('banner_des', 'Description', 'Shot what able cold new the see hold. Friendly as an betrayed formerly he. Morning because as to society behaved moments');
          $this->tag('h1');
          $this->alignController('left');
          $this->end_section();


          // Button
          $this->start_section('btn_group', 'Button');
          $repeater = new \Elementor\Repeater();
          $this->buttonController($repeater, true);
          $this->end_section();

          $this->start_section('banner_img', 'Image');
          $this->imageController();
          $this->end_section();
     }


     protected function render()
     {
          $settings = $this->get_settings_for_display();
          $buttons = $settings['buttons'];
          $imageUrl = $settings['image']['url'];
          $banner_des = $settings['banner_des'];
          $banner_subtitle = $settings['banner_subtitle'];
          $banner_title = $settings['banner_title'];

?>
          <section class="hero-section" id="home">
               <div class="container">
                    <div class="<?php echo $imageUrl ? 'row' : '' ?>">

                         <?php if ($banner_subtitle || $banner_des || $buttons) : ?>
                              <div class="<?php echo $imageUrl ? 'header-left' : '' ?> hero-text wow fadeInUp">

                                   <?php if (!empty($banner_title)) : ?>
                                        <span>Hi, I'm</span>
                                        <?php $this->textRanderWithTag('banner_title', 'tag', 'h1'); ?>
                                   <?php endif ?>

                                   <?php if (!empty($banner_subtitle)) : ?><h3><?php echo $banner_subtitle ?></h3><?php endif ?>

                                   <?php if (!empty($banner_des)) : ?><p><?php echo cf_kses($banner_des) ?></p><?php endif ?>

                                   <?php if (!empty($buttons)) : ?>
                                        <div class="hero-btn-container">
                                             <?php $this->buttonRepeaterRender() ?>
                                        </div>
                                   <?php endif ?>
                              </div>
                         <?php endif; ?>

                         <?php if ($imageUrl || $settings['image']['id']) : ?>
                              <div class="hero-img">
                                   <?php $this->imageRander() ?>
                              </div>
                         <?php endif; ?>
                    </div>
               </div>
          </section>
<?php
     }
}

$widgets_manager->register(new Banner());
