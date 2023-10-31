<?php

namespace CFCore;

use Elementor\Controls_Manager;


trait Widget_Details_Trait
{
     protected $widget_name = 'my-elementor-widget___';
     protected $widget_title = 'My Elementor Widget';
     protected $widget_icon = 'fa fa-code';
     protected $widget_categories = ['cf-core'];
     protected $widget_keywords = [
          'codeefly',
          'dora',
          'cfcore',
          'cf core'
     ];
     protected $extra_widget_keywords = [];

     public function get_name()
     {
          return $this->widget_name;
     }

     public function get_title()
     {
          return __($this->widget_title, 'cfcore');
     }

     public function get_icon()
     {
          return $this->widget_icon . ' codeeflyicon-elementor';
     }

     public function get_categories()
     {
          return $this->widget_categories;
     }

     public function get_keywords()
     {
          return array_merge($this->widget_keywords, $this->extra_widget_keywords);
     }
}
