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
require_once CFCORE_ELEMENTS_PATH . '/traits/isotope-trait.php';


class Portfolio_Section extends Widget_Base
{
     use Section_Title_Trait;
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use RepeaterControllerTrait;
     use IsotopeTrait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Portfolio Section';
          $this->widget_name = 'portfolio_section';
          $this->widget_icon = 'eicon-accordion';
          $this->widget_keywords = ['isotope', 'works'];
     }

     protected function register_controls()
     {
          $this->start_section();
          $this->title_controls('center', 'My Amazing Works');
          $this->sub_title_controls('Portfolio');
          $this->end_section();

          $this->isotopeController();
     }
     protected function render()
     {
?>
          <section class="works-section" id="works">
               <div class="container">
                    <?php $this->get_title_rander_value() ?>
                    <!-- Work Isotope -->
                    <?php $this->isotopeFilterRender() ?>
               </div>
          </section>
<?php
     }
}

$widgets_manager->register(new Portfolio_Section());
