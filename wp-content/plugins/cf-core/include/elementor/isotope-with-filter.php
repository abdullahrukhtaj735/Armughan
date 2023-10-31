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

class Isotope_With_Filter extends Widget_Base
{
     use Section_Title_Trait;
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use RepeaterControllerTrait;
     use IsotopeTrait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Portfolio with category filter';
          $this->widget_name = 'isotope_filter';
          $this->widget_icon = 'eicon-post';
     }

     protected function register_controls()
     {
          $this->isotopeController();
     }
     protected function render()
     {
          $this->isotopeFilterRender();
     }
}

$widgets_manager->register(new Isotope_With_Filter());
