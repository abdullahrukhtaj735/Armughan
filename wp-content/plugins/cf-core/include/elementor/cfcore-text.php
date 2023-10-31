<?php

namespace CFCore;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Repeater;
use Elementor\Core\Schemes\Color;

if (!defined('ABSPATH')) {
     exit;
}

require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/repeater-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/button-trait.php';

class Text_ extends Widget_Base
{

     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use ButtonTrait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'CF Core Text';
          $this->widget_name = 'cf_text';
          $this->widget_icon = 'fa-thin fa-text';
     }

     protected function register_controls()
     {
          $this->start_section('CF Core Text', 'text');
          $this->textAreaController('text_content', 'Text', 'Hello World!');
          $this->tagSelect();
          $this->alignController('left');
          $this->add_group_control(
               \Elementor\Group_Control_Typography::get_type(),
               [
                    'name' => 'typography_',
                    'label' => __('Typography', 'cfcore'),
                    'selector' => '{{WRAPPER}} h1,{{WRAPPER}} h2,{{WRAPPER}} h3,{{WRAPPER}} h4,{{WRAPPER}} h5,{{WRAPPER}} h6,{{WRAPPER}} p,{{WRAPPER}} span',
                    // You were missing a comma after the selector
               ]
          );
          $this->textController('text_class', 'Class', '', false);
          $this->colorController('color', '#15295f', 'Color', 'h1,{{WRAPPER}} h2,{{WRAPPER}} h3,{{WRAPPER}} h4,{{WRAPPER}} h5,{{WRAPPER}} h6,{{WRAPPER}} p,{{WRAPPER}} span');
          $this->end_section();
     }


     protected function render()
     {
          $settings = $this->get_settings_for_display();

          $text_tag = $settings['tag'];
          $text_content = $settings['text_content'];
          $typography = $settings['typography_'] ?? null;
          $text_class = $settings['text_class'];
          echo '<' . $text_tag . ' class="' . $text_class . '"' . $typography . '>' . $text_content . '</' . $text_tag . '>';
     }
}

$widgets_manager->register(new Text_());
