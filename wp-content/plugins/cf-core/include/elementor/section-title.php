<?php

namespace CFCore;

use Elementor\Widget_Base;

require_once CFCORE_ELEMENTS_PATH . '/traits/section-title-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';

if (!defined('ABSPATH')) {
     exit;
}

class Section_Title extends Widget_Base
{
     use Section_Title_Trait;
     use Widget_Details_Trait;
     use Common_Controller_Trait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Section Title';
          $this->widget_name = 'section-title';
          $this->widget_icon = 'eicon-site-title';
     }

     protected function register_controls()
     {
          $this->start_section('content', 'Content');
          $this->title_controls();
          $this->sub_title_controls();
          $this->description_controls();
          $this->end_section();

          $this->start_section('colors', 'Colors');
          $this->colorController('title_color', '#15295f', 'Title Color', '.section-title.single-title');
          $this->colorController('subtitle_color', '#fd6e0a', 'Sub Title Color', '.sub-title.single-sub-title');
          $this->end_section();
     }

     protected function render()
     {
          $this->get_title_rander_value("single-title", "single-sub-title");
     }
}

$widgets_manager->register(new Section_Title());
