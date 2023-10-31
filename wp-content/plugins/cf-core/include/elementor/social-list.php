<?php

namespace CFCore;

use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
     exit;
}

require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/contact-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/section-title-trait.php';

class Social_List extends Widget_Base
{
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use Contact_Trait;
     use Section_Title_Trait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Social List';
          $this->widget_name = 'social_list';
          $this->widget_icon = 'eicon-social-icons';
     }

     protected function register_controls()
     {

          $this->socilaProfileController();
     }
     protected function render()
     {
          $this->socialProfileRender();
     }
}

$widgets_manager->register(new Social_List());
