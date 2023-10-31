<?php

namespace CFCore;

use Elementor\Controls_Manager;


trait Section_Title_Trait
{

     public function title_controls($align = 'center', $defaultText = 'Section Title', $label = 'Section Title')
     {
          $this->add_control(
               'title',
               [
                    'label' => __($label, 'cfcore'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__($defaultText, 'cfcore'),
                    'description' => cf_get_allowed_html_desc('basic'),
               ]
          );

          $this->add_control(
               'title_tag',
               [
                    'label' => esc_html__('Title HTML Tag', 'cfcore'),
                    'type' => Controls_Manager::CHOOSE,
                    'label_block' => true,
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
                    'default' => 'h2',
                    'toggle' => false,
               ]
          );

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
                         '{{WRAPPER}} .section-wrapper' => 'text-align: {{VALUE}};',
                    ],
               ]
          );
     }

     public function sub_title_controls($defaultText = 'Section Sub Title', $label = 'Section Sub Title')
     {
          $this->add_control(
               'sub_title',
               [
                    'label' => __($label, 'cfcore'),
                    'type' => Controls_Manager::TEXT,
                    'label_block' => true,
                    'default' => esc_html__($defaultText, 'cfcore'),
                    'description' => cf_get_allowed_html_desc('basic'),
               ]
          );
     }

     public function description_controls($defaultText = '')
     {
          $this->add_control(
               'description',
               [
                    'label' => __('Description', 'cfcore'),
                    'type' => Controls_Manager::TEXTAREA,
                    'label_block' => true,
                    'default' => $defaultText,
                    'description' => cf_get_allowed_html_desc('basic'),
               ]
          );
     }



     public function get_title_rander_value($extraClass = '', $extraSubTitle = '')
     {
          if (empty($instance)) {
               $instance = $this;
          }

          $settings = $instance->get_settings();
          $this->add_render_attribute('title_args', 'class', 'section-title' . ' ' . $extraClass);
?>
          <div class="section-wrapper title wow fadeInUp">
               <?php if (!empty($settings['sub_title'])) : ?>
                    <p class="sub-title <?php echo $extraSubTitle ?>"><?php echo $settings['sub_title'] ?></p>
               <?php endif; ?>
               <?php
               if (!empty($settings['title'])) :
                    printf(
                         '<%1$s %2$s>%3$s</%1$s>',
                         tag_escape($settings['title_tag']),
                         $this->get_render_attribute_string('title_args'),
                         cf_kses($settings['title'])
                    );
               endif;
               ?>
               <?php if (!empty($settings['description'])) : ?>
                    <P><?php echo $settings['description'] ?></P>
               <?php endif ?>
          </div>
<?php
     }
}
