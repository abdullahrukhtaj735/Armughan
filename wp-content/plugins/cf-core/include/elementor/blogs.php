<?php

namespace CFCore;

use Elementor\Widget_Base;

require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/blog-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';

if (!defined('ABSPATH')) {
     exit;
}

class Blogs extends Widget_Base
{
     use Widget_Details_Trait;
     use Blog_Trait;
     use Common_Controller_Trait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Blog';
          $this->widget_name = 'blogs';
          $this->widget_icon = 'eicon-posts-grid';
     }

     protected function register_controls()
     {
          $this->blogTraitController();

          $this->start_section('color_control', 'Colors');
          $this->colorController('title_color', '#15295f', 'Title Color', '.blog-item .blog-info .blog-title.single-blog-title');
          $this->colorController('subtitle_color', '#fd6e0a', 'Sub Title Color', '.blog-item .blog-info a.category.single-category-title');
          $this->end_section();
     }

     protected function render()
     {
          $this->blogRender("single-blog-title", "single-category-title");
     }
}

$widgets_manager->register(new Blogs());
