<?php

namespace CFCore;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use Elementor\Core\Schemes\Color;



trait RepeaterControllerTrait
{
     public function repeaterTextController($repeater, $ID = 'name', $label = 'label', $defaultValue = 'value')
     {
          $repeater->add_control(
               $ID,
               [
                    'label' => __($label, 'cfcore'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __($defaultValue, 'cfcore'),
                    'description' => cf_get_allowed_html_desc('basic'),
                    'label_block' => true,
               ]
          );
     }
     public function repeaterTextAreaController($repeater, $ID = 'name', $label = 'label', $defaultValue = 'value')
     {
          $repeater->add_control(
               $ID,
               [
                    'label' => __($label, 'cfcore'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __($defaultValue, 'cfcore'),
                    'description' => cf_get_allowed_html_desc('basic'),
                    'label_block' => true,
               ]
          );
     }

     public function repeaterSelectController($repeater, $ID = 'select', $label = 'label', $defaultValue = '1', $options = [])
     {
          $repeater->add_control(
               $ID,
               [
                    'label' => __($label, 'cfcore'),
                    'type' => Controls_Manager::SELECT,
                    'default' => $defaultValue,
                    'options' => $options,
                    'label_block' => true,
               ]
          );
     }

     public function repeaterImageController($repeater, $ID = 'image', $label = 'Choose Image')
     {
          $repeater->add_control(
               $ID,
               [
                    'label' => esc_html__($label, 'cfcore'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                         'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
               ]
          );
     }

     public function repeaterPercentageController($repeater, $ID = 'name', $label = 'label', $defaultValue = 100)
     {
          $repeater->add_control(
               $ID,
               [
                    'label' => __($label, 'cfcore'),
                    'type' => Controls_Manager::SLIDER,
                    'size_units'      => ['%'],
                    'default' => [
                         'unit' => '%',
                         'size' => $defaultValue,
                    ],
                    'range' => [
                         '%' => [
                              'min' => 1,
                              'max' => 100,
                              'step' => 1,
                         ],
                    ],
               ]
          );
     }

     public function repeaterDefultController($repeater, $ID = 'name', $valueID = 'id', $defaultValue = [], $showLabel = false, $label = '')
     {
          $this->add_control(
               $ID,
               [
                    'show_label' => $showLabel,
                    'label' => __($label, 'cfcore'),
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'default' => $defaultValue,
                    'title_field' => '{{{' . $valueID . '}}}',
               ]
          );
     }
     // Condition
     public function textRepeaterControllerWithCondition($repeater, $condition, $ID = 'name', $label = 'label', $defaultValue = 'value')
     {
          $repeater->add_control(
               $ID,
               [
                    'label' => __($label, 'cfcore'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __($defaultValue, 'cfcore'),
                    'description' => cf_get_allowed_html_desc('basic'),
                    'label_block' => true,
                    'condition' => $condition
               ]
          );
     }
     public function textAreaRepeaterControllerWithCondition($repeater, $condition, $ID = 'name', $label = 'label', $defaultValue = 'value')
     {
          $repeater->add_control(
               $ID,
               [
                    'label' => __($label, 'cfcore'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => __($defaultValue, 'cfcore'),
                    'description' => cf_get_allowed_html_desc('basic'),
                    'label_block' => true,
                    'condition' => $condition
               ]
          );
     }

     public function iconRepeaterController($repeater, $iconID = 'icon', $iconIDSelect = 'selected_icon', $defultIcon = 'fa-solid fa-arrow-left', $skin = 'inline', $label = 'Arrow Left')
     {
          if (cf_is_elementor_version('<', '2.6.0')) {
               $repeater->add_control(
                    $iconID,
                    [
                         'label' => __($label, 'cfcore'),
                         'type' => Controls_Manager::ICONS,
                         'fa4compatibility' => 'icon',
                         'label_block' => true,
                         'default' => $defultIcon,
                    ]
               );
          } else {
               $repeater->add_control(
                    $iconIDSelect,
                    [
                         'label' => __($label, 'cfcore'),
                         'type' => Controls_Manager::ICONS,
                         'fa4compatibility' => 'icon',
                         'label_block' => true,
                         'default' => [
                              'value' => $defultIcon,
                              'library' => 'solid',
                         ],
                    ]
               );
          }
     }
     public function repeaterColorControll($repeater, $ID = 'color', $label = 'Color', $default = '#9C19C9')
     {
          $repeater->add_control(
               $ID,
               [
                    'label' => __($label, 'cfcore'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                         'type' => Color::get_type(),
                         'value' => Color::COLOR_1,
                    ],
                    'default' => $default,
               ]
          );
     }

     public function imageRanderForRepeater($imageId = 'image',)
     {
          if (!empty($imageId['url'])) {
               $image = !empty($imageId['id']) ? wp_get_attachment_image_url($imageId['id']) : $imageId['url'];
               $image_alt = get_post_meta($imageId["id"], "_wp_attachment_image_alt", true);
          }
?>
          <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>">
<?php
     }
}
