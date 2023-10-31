<?php

namespace CFCore;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined("ABSPATH")) {
     exit();
}

require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/repeater-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/button-trait.php';

class Buton extends Widget_Base
{
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use ButtonTrait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Button';
          $this->widget_name = 'cf_button';
          $this->widget_icon = 'eicon-button';
     }

     protected function register_controls()
     {
          $this->start_section('btn', 'Button');
          $this->buttonController($this);
          $this->end_section();

          $this->start_section_tab('button_style', 'Button');
          $this->add_control(
               'btn_padding',
               [
                    'label' => esc_html__('Padding', 'elementor'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                         '{{WRAPPER}} .btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
               ]
          );

          $this->add_control(
               'btn_border_r',
               [
                    'label' => esc_html__('Border Radius', 'elementor'),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => ['px', 'em', '%'],
                    'selectors' => [
                         '{{WRAPPER}} .btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' => 'before',
               ]
          );

          $this->alignController('left');
          $this->end_section();
     }

     protected function render()
     {
          $this->buttonRender();
     }
}

$widgets_manager->register(new Buton());
