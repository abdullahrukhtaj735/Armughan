<?php

namespace CFCore;

use Elementor\Controls_Manager;
use Elementor\Widget_Base;

if (!defined('ABSPATH')) {
     exit;
}

require_once CFCORE_ELEMENTS_PATH . '/traits/widget-details-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/common-controller-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/contact-trait.php';
require_once CFCORE_ELEMENTS_PATH . '/traits/section-title-trait.php';

class Contact_Section extends Widget_Base
{
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use Contact_Trait;
     use Section_Title_Trait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Contact Section';
          $this->widget_name = 'contact_section';
          $this->widget_icon = 'eicon-accordion';
     }

     protected function register_controls()
     {

          $this->start_section();
          $this->title_controls('left', "Let's Connect");
          $this->description_controls('Please fill out the form on this section to contact with me. Or call between 9:00 a.m. and 8:00 p.m. ET, Monday through Friday');
          $this->end_section();

          $this->socilaProfileController();

          $this->contactFromController();
     }
     protected function render()
     {


?>
          <section class="contact-section" id="contact">
               <div class="container">
                    <div class="contact-info-cont">
                         <!-- Contact left -->
                         <div class="contact-info">
                              <?php $this->get_title_rander_value() ?>
                              <?php $this->socialProfileRender() ?>
                         </div>
                         <!-- Contact right -->
                         <?php $this->contactFromRender() ?>
                    </div>
               </div>
          </section>
<?php
     }
}

$widgets_manager->register(new Contact_Section());
