<?php

namespace CFCore;

use Elementor\Widget_Base;

require_once CFCORE_ELEMENTS_PATH . '/traits/section-title-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/repeater-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/button-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/blog-trait.php';

if (!defined('ABSPATH')) {
     exit;
}

class Blog_Section extends Widget_Base
{
     use Section_Title_Trait;
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use Blog_Trait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Blog Section';
          $this->widget_name = 'blog-section';
          $this->widget_icon = 'eicon-accordion';
     }


     protected function register_controls()
     {
          $this->start_section();
          $this->title_controls('center', 'Our Recent Updates, Blog, Tips, Tricks & More');
          $this->sub_title_controls('From My Blog');
          $this->end_section();

          $this->blogTraitController();
     }


     protected function render()
     {

?>
          <section class="blog-section fill-section" id="blog">
               <div class="container">
                    <?php $this->get_title_rander_value() ?>
                    <?php $this->blogRender() ?>
               </div>
          </section>
<?php
     }
}

$widgets_manager->register(new Blog_Section());
