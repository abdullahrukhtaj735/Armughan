<?php

namespace CFCore;

use Elementor\Controls_Manager;



trait ButtonTrait
{
     public function buttonController($contanainer, $isItRepeater = false)
     {
          $contanainer->add_control(
               'btn_text',
               [
                    'label' => __('Button Text', 'cfcore'),
                    'type' => Controls_Manager::TEXT,
                    'default' => __('Button Text', 'cfcore'),
                    'label_block' => true,
               ]
          );
          $contanainer->add_control(
               'btn_link_type',
               [
                    'label' => esc_html__('Button Link Type', 'cfcore'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                         '1' => 'Custom Link',
                         '2' => 'Internal Page',
                    ],
                    'default' => '1',
                    'label_block' => true,
               ]
          );
          $contanainer->add_control(
               'btn_link',
               [
                    'label' => esc_html__('Button link', 'cfcore'),
                    'type' => Controls_Manager::URL,
                    'placeholder' => esc_html__('htcfs://your-link.com', 'cfcore'),
                    'show_external' => false,
                    'default' => [
                         'url' => '#',
                         'is_external' => true,
                         'nofollow' => true,
                         'custom_attributes' => '',
                    ],
                    'condition' => [
                         'btn_link_type' => '1',
                    ],
                    'label_block' => true,
               ]
          );
          $contanainer->add_control(
               'btn_page_link',
               [
                    'label' => esc_html__('Select Button Page', 'cfcore'),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'options' => cf_get_all_pages(),
                    'condition' => [
                         'btn_link_type' => '2',
                    ],
               ]
          );
          $contanainer->add_control(
               'btn_class',
               [
                    "label" => __("Type", "cfcore"),
                    "type" => Controls_Manager::SELECT,
                    "default" => __("primary-btn", "cfcore"),
                    "label_block" => true,
                    "options" => [
                         "primary-btn" => "Primary",
                         "secondary-btn" => "Secondary",
                    ],
               ]
          );
          if ($isItRepeater) {
               $this->add_control(
                    'buttons',
                    [
                         'show_label' => false,
                         'label' => __('Buttons', 'cfcore'),
                         'type' => Controls_Manager::REPEATER,
                         'fields' => $contanainer->get_controls(),
                         'default' => [
                              [
                                   'btn_text' => __('Download CV', 'cfcore'),
                                   'btn_class' => 'primary-btn'
                              ],
                              [
                                   'btn_text' => __('Contact', 'cfcore'),
                                   'btn_class' => 'secondary-btn'
                              ],
                         ],
                         'title_field' => '{{{ btn_text }}}',
                    ]
               );
          }
     }
     public function buttonRender()
     {
          if (empty($instance)) {
               $instance = $this;
          }
          $settings = $instance->get_settings();
?>
          <a href="<?php echo $settings["btn_link_type"] == "2"
                         ? get_permalink($settings["btn_page_link"])
                         : $settings["btn_link"]["url"]; ?>" class="btn <?php echo esc_html($settings["btn_class"]); ?>"><?php echo $settings["btn_text"]; ?></a>
          <?php
     }
     public function buttonRepeaterRender()
     {
          if (empty($instance)) {
               $instance = $this;
          }
          $settings = $instance->get_settings();

          foreach ($settings['buttons'] as $item) : ?>
               <a href="<?php echo $item['btn_link_type'] == '2' ?  get_permalink($item['btn_page_link']) : $item['btn_link']['url'] ?>" class="btn <?php echo esc_html($item['btn_class']) ?>"><?php echo $item["btn_text"] ?></a>
<?php endforeach;
     }
}
