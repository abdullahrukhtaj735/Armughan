<?php

namespace CFCore;

use Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use Elementor\Core\Schemes\Color;


trait Common_Controller_Trait
{
     public function start_section($id = 'title_content', $name = 'Section Content')
     {
          $this->start_controls_section(
               $id,
               [
                    'label' => __($name, 'cfcore'),
               ]
          );
     }
     public function start_section_tab($id = 'title_content', $name = 'Section Content')
     {
          $this->start_controls_section(
               $id,
               [
                    'label' => __($name, 'cfcore'),
                    'tab' => Controls_Manager::TAB_STYLE,
               ]
          );
     }


     public function end_section()
     {
          $this->end_controls_section();
     }

     public function alignController($align = 'center')
     {
          $this->add_responsive_control(
               'align',
               [
                    'label' => esc_html__('Alignment', 'cfcore'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                         'left' => [
                              'title' => esc_html__('Left', 'cfcore'),
                              'icon' => 'eicon-text-align-left',
                         ],
                         'center' => [
                              'title' => esc_html__('Center', 'cfcore'),
                              'icon' => 'eicon-text-align-center',
                         ],
                         'right' => [
                              'title' => esc_html__('Right', 'cfcore'),
                              'icon' => 'eicon-text-align-right',
                         ],
                    ],
                    'default' => $align,
                    'toggle' => false,
                    'selectors' => [
                         '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                    ],
               ]
          );
     }

     public function tag($defultTag = 'h2', $label = 'Title HTML Tag', $tagID = 'tag')
     {
          $this->add_control(
               $tagID,
               [
                    'label' => esc_html__($label, 'cfcore'),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                         'h1' => [
                              'title' => esc_html__('H1', 'cfcore'),
                              'icon' => 'eicon-editor-h1',
                         ],
                         'h2' => [
                              'title' => esc_html__('H2', 'cfcore'),
                              'icon' => 'eicon-editor-h2',
                         ],
                         'h3' => [
                              'title' => esc_html__('H3', 'cfcore'),
                              'icon' => 'eicon-editor-h3',
                         ],
                         'h4' => [
                              'title' => esc_html__('H4', 'cfcore'),
                              'icon' => 'eicon-editor-h4',
                         ],
                         'h5' => [
                              'title' => esc_html__('H5', 'cfcore'),
                              'icon' => 'eicon-editor-h5',
                         ],
                         'h6' => [
                              'title' => esc_html__('H6', 'cfcore'),
                              'icon' => 'eicon-editor-h6',
                         ],
                    ],
                    'default' => $defultTag,
                    'toggle' => false,
               ]
          );
     }

     public function tagSelect($defultTag = 'p', $label = 'Title HTML Tag', $tagID = 'tag')
     {
          $this->add_control(
               $tagID,
               [
                    'label' => __($label, 'cfcore'),
                    'type' => \Elementor\Controls_Manager::SELECT,
                    'options' => [
                         'span' => __('Span', 'cfcore'),
                         'p' => __('P', 'cfcore'),
                         'h1' => __('H1', 'cfcore'),
                         'h2' => __('H2', 'cfcore'),
                         'h3' => __('H3', 'cfcore'),
                         'h4' => __('H4', 'cfcore'),
                         'h5' => __('H5', 'cfcore'),
                         'h6' => __('H6', 'cfcore'),
                    ],
                    'default' => $defultTag,
               ]
          );
     }

     public function textController($controllerID = 'controller', $controllerLabel = 'Label', $defultText = 'center', $labelBlock = true)
     {
          $this->add_control(
               $controllerID,
               [
                    'label' => __($controllerLabel, 'cfcore'),
                    'type' => Controls_Manager::TEXT,
                    'description' => $labelBlock ?  cf_get_allowed_html_desc('basic') : '',
                    'default' => esc_html__($defultText, 'cfcore'),
                    'label_block' => $labelBlock,
               ]
          );
     }
     public function textAreaController($controllerID = 'controller', $controllerLabel = 'Label', $defultText = 'center')
     {
          $this->add_control(
               $controllerID,
               [
                    'label' => esc_html__($controllerLabel, 'cfcore'),
                    'description' => cf_get_allowed_html_desc('intermediate'),
                    'type' => Controls_Manager::TEXTAREA,
                    'default' => esc_html__($defultText, 'cfcore'),
               ]
          );
     }
     public function imageController($imageID = 'image', $imageSizeID = 'image_size')
     {
          $this->add_control(
               $imageID,
               [
                    'label' => esc_html__('Choose Image', 'cfcore'),
                    'type' => \Elementor\Controls_Manager::MEDIA,
                    'default' => [
                         'url' => \Elementor\Utils::get_placeholder_image_src(),
                    ],
               ]
          );
          $this->add_group_control(
               Group_Control_Image_Size::get_type(),
               [
                    'name' => $imageSizeID,
                    'default' => 'full',
                    'exclude' => [
                         'custom',
                    ],
               ]
          );
     }

     public function colorController($colorID = 'color', $defultColor = '#15295f', $controllerLabel = 'Color', $selectors = '')
     {
          $this->add_control(
               $colorID,
               [
                    'label' => __($controllerLabel, 'cfcore'),
                    'type' => Controls_Manager::COLOR,
                    'scheme' => [
                         'type' => Color::get_type(),
                         'value' => Color::COLOR_1,
                    ],
                    'selectors' => [
                         '{{WRAPPER}}' . $selectors ?  $selectors : '' => 'color: {{VALUE}};',
                    ],
                    'default' => $defultColor,
               ]
          );
     }

     public function iconController($label = 'Arrow Left', $iconID = 'icon', $iconIDSelect = 'selected_icon', $defultIcon = 'fa-solid fa-arrow-left', $skin = 'inline')
     {
          if (cf_is_elementor_version('<', '2.6.0')) {
               $this->add_control(
                    $iconID,
                    [
                         'label' => __($label, 'cfcore'),
                         'type' => Controls_Manager::ICONS,
                         'fa4compatibility' => 'icon',
                         'label_block' => false,
                         'skin' => $skin,
                         'default' => $defultIcon,
                    ]
               );
          } else {
               $this->add_control(
                    $iconIDSelect,
                    [
                         'label' => __($label, 'cfcore'),
                         'type' => Controls_Manager::ICONS,
                         'fa4compatibility' => 'icon',
                         'label_block' => false,
                         'skin' => $skin,
                         'default' => [
                              'value' => $defultIcon,
                              'library' => 'solid',
                         ],
                    ]
               );
          }
     }

     public function imageRander($imageId = 'image', $imageSize = 'image_size')
     {
          if (empty($instance)) {
               $instance = $this;
          }
          $settings = $instance->get_settings();
          if (!empty($settings[$imageId]['url'])) {
               $image = !empty($settings[$imageId]['id']) ? wp_get_attachment_image_url($settings[$imageId]['id'], $settings[$imageSize . '_size']) : $settings[$imageId]['url'];
               $image_alt = get_post_meta($settings[$imageId]["id"], "_wp_attachment_image_alt", true);
          }
?>
          <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($image_alt); ?>">
<?php
     }

     public function textRanderWithTag($textID = 'title', $tagID = 'tag', $className = '')
     {
          if (empty($instance)) {
               $instance = $this;
          }
          $settings = $instance->get_settings();

          $this->remove_render_attribute('title_args', 'class');
          $this->add_render_attribute('title_args', 'class', $className);

          // Rander
          if (!empty($settings[$textID])) :
               printf(
                    '<%1$s %2$s>%3$s</%1$s>',
                    tag_escape($settings[$tagID]),
                    $this->get_render_attribute_string('title_args'),
                    cf_kses($settings[$textID])
               );
          endif;
     }

     public function iconRender($iconID = 'icon', $iconIDSelect = 'selected_icon')
     {
          if (empty($instance)) {
               $instance = $this;
          }
          $settings = $instance->get_settings();
          cf_render_icon($settings, $iconID, $iconIDSelect);
     }
}
