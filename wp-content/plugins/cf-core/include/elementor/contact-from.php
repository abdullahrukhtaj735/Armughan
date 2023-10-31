<?php

namespace CFCore;

use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
     exit;
}

require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/contact-trait.php';

class Contact_form extends Widget_Base
{
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use Contact_Trait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Contact From';
          $this->widget_name = 'contact_from';
          $this->widget_icon = 'fa-thin fa-message';
     }

     protected function register_controls()
     {
          $this->contactFromController();
     }
     protected function render()
     {
          $this->contactFromRender();
     }
}

$widgets_manager->register(new Contact_form());
