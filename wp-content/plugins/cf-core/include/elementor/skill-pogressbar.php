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

class Skill_Pogressbar extends Widget_Base
{
     use Section_Title_Trait;
     use Widget_Details_Trait;
     use Common_Controller_Trait;
     use RepeaterControllerTrait;

     public function __construct($data = [], $args = null)
     {
          parent::__construct($data, $args);

          $this->widget_title = 'Skills Progress Bar';
          $this->widget_name = 'skills-pogressbar';
          $this->widget_icon = 'eicon-skill-bar';
     }

     protected function register_controls()
     {
          $this->start_section('skills', 'Skills');

          $repeater = new \Elementor\Repeater();
          $this->repeaterTextController($repeater, 'skill_name', 'Name');
          $this->repeaterPercentageController($repeater, 'skill_percentage', 'Percentage');
          $this->repeaterDefultController($repeater, 'skill_items', 'skill_name', [
               [
                    'skill_name' => __('Facebook Marketing', 'cfcore'),
                    'skill_percentage'     => ['size' => 95, 'unit' => '%']
               ],
               [
                    'skill_name' => __('Affiliate Marketing', 'cfcore'),
                    'skill_percentage'     => ['size' => 80, 'unit' => '%']
               ],
               [
                    'skill_name' => __('Search Engine Optimization', 'cfcore'),
                    'skill_percentage'     => ['size' => 90, 'unit' => '%']
               ],
               [
                    'skill_name' => __('Graphic Design', 'cfcore'),
                    'skill_percentage'     => ['size' => 85, 'unit' => '%']
               ],
               [
                    'skill_name' => __('Content Writing', 'cfcore'),
                    'skill_percentage'     => ['size' => 95, 'unit' => '%']
               ],
               [
                    'skill_name' => __('Web Ui Design', 'cfcore'),
                    'skill_percentage'     => ['size' => 49, 'unit' => '%']
               ],
               [
                    'skill_name' => __('Youtube Marketing', 'cfcore'),
                    'skill_percentage'     => ['size' => 72, 'unit' => '%']
               ],
               [
                    'skill_name' => __('Web Design', 'cfcore'),
                    'skill_percentage'     => ['size' => 70, 'unit' => '%']
               ],
          ]);
          $this->end_section();
     }
     protected function render()
     {
          $settings = $this->get_settings_for_display();
?>
          <div class="experience-items wow fadeInUp">
               <!-- 01 experience item start -->
               <?php foreach ($settings['skill_items'] as $item) : ?>
                    <div class="experience-item">
                         <div class="experience-info">
                              <p><?php echo $item['skill_name'] ?></p>
                              <p><?php echo $item['skill_percentage']['size'] ?>%</p>
                         </div>
                         <div class="progress-line" data-percent="<?php echo $item['skill_percentage']['size'] ?>%">
                              <span></span>
                         </div>
                    </div>
               <?php endforeach ?>
               <!-- 01 experience item end -->
          </div>
<?php
     }
}

$widgets_manager->register(new Skill_Pogressbar());
