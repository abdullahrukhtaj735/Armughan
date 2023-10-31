<?php

namespace CFCore;

use Elementor\Controls_Manager;


trait Contact_Trait
{
     protected static function get_profile_names()
     {
          return [
               'apple' => esc_html__('Apple', 'cfcore'),
               'behance' => esc_html__('Behance', 'cfcore'),
               'bitbucket' => esc_html__('BitBucket', 'cfcore'),
               'codepen' => esc_html__('CodePen', 'cfcore'),
               'delicious' => esc_html__('Delicious', 'cfcore'),
               'deviantart' => esc_html__('DeviantArt', 'cfcore'),
               'digg' => esc_html__('Digg', 'cfcore'),
               'dribbble' => esc_html__('Dribbble', 'cfcore'),
               'email' => esc_html__('Email', 'cfcore'),
               'facebook' => esc_html__('Facebook', 'cfcore'),
               'flickr' => esc_html__('Flicker', 'cfcore'),
               'foursquare' => esc_html__('FourSquare', 'cfcore'),
               'github' => esc_html__('Github', 'cfcore'),
               'houzz' => esc_html__('Houzz', 'cfcore'),
               'instagram' => esc_html__('Instagram', 'cfcore'),
               'jsfiddle' => esc_html__('JS Fiddle', 'cfcore'),
               'linkedin' => esc_html__('LinkedIn', 'cfcore'),
               'medium' => esc_html__('Medium', 'cfcore'),
               'pinterest' => esc_html__('Pinterest', 'cfcore'),
               'product-hunt' => esc_html__('Product Hunt', 'cfcore'),
               'reddit' => esc_html__('Reddit', 'cfcore'),
               'slideshare' => esc_html__('Slide Share', 'cfcore'),
               'snapchat' => esc_html__('Snapchat', 'cfcore'),
               'soundcloud' => esc_html__('SoundCloud', 'cfcore'),
               'spotify' => esc_html__('Spotify', 'cfcore'),
               'stack-overflow' => esc_html__('StackOverflow', 'cfcore'),
               'tripadvisor' => esc_html__('TripAdvisor', 'cfcore'),
               'tumblr' => esc_html__('Tumblr', 'cfcore'),
               'twitch' => esc_html__('Twitch', 'cfcore'),
               'twitter' => esc_html__('Twitter', 'cfcore'),
               'vimeo' => esc_html__('Vimeo', 'cfcore'),
               'vk' => esc_html__('VK', 'cfcore'),
               'website' => esc_html__('Website', 'cfcore'),
               'whatsapp' => esc_html__('WhatsApp', 'cfcore'),
               'wordpress' => esc_html__('WordPress', 'cfcore'),
               'xing' => esc_html__('Xing', 'cfcore'),
               'yelp' => esc_html__('Yelp', 'cfcore'),
               'youtube' => esc_html__('YouTube', 'cfcore'),
          ];
     }

     public function get_cf_contact_form()
     {
          if (!class_exists('WPCF7')) {
               return;
          }
          $cf_cfa         = array();
          $cf_cf_args     = array('posts_per_page' => -1, 'post_type' => 'wpcf7_contact_form');
          $cf_forms       = get_posts($cf_cf_args);
          $cf_cfa         = ['0' => esc_html__('Select Form', 'cfcore')];
          if ($cf_forms) {
               foreach ($cf_forms as $cf_form) {
                    $cf_cfa[$cf_form->ID] = $cf_form->post_title;
               }
          } else {
               $cf_cfa[esc_html__('No contact form found', 'cfcore')] = 0;
          }
          return $cf_cfa;
     }

     public function contactFromController()
     {
          $this->start_controls_section(
               'cfcore_contact_label',
               [
                    'label' => esc_html__('Contact Form', 'cfcore'),
               ]
          );

          $this->add_control(
               'cfcore_select_contact_form',
               [
                    'label'   => esc_html__('Select Form', 'cfcore'),
                    'type'    => Controls_Manager::SELECT,
                    'default' => '0',
                    'options' => $this->get_cf_contact_form(),
               ]
          );

          $this->end_controls_section();
     }

     public function contactFromRender()
     {
          $settings = $this->get_settings_for_display();
?>
          <?php if (!empty($settings['cfcore_select_contact_form'])) : ?>
               <div class="contact-form">
                    <?php echo do_shortcode('[contact-form-7  id="' . $settings['cfcore_select_contact_form'] . '"]'); ?>
               </div>
          <?php else : ?>
               <?php echo '<div class="alert alert-info"><p class="m-0">' . __('Please Select contact form.', 'cfcore') . '</p></div>'; ?>
          <?php endif; ?>
          <?php
     }

     public function socilaProfileController()
     {

          $this->start_controls_section(
               '_section_social',
               [
                    'label' => esc_html__('Social Profiles', 'cfcore'),
                    'tab' => Controls_Manager::TAB_CONTENT,
               ]
          );

          $repeater = new \Elementor\Repeater();

          $repeater->add_control(
               'name',
               [
                    'label' => esc_html__('Profile Name', 'cfcore'),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'select2options' => [
                         'allowClear' => false,
                    ],
                    'options' => self::get_profile_names()
               ]

          );

          $repeater->add_control(
               'link',
               [
                    'label' => esc_html__('Profile Link', 'cfcore'),
                    'placeholder' => esc_html__('Add your profile link', 'cfcore'),
                    'type' => Controls_Manager::URL,
                    'label_block' => true,
                    'autocomplete' => false,
                    'show_external' => false,
                    'condition' => [
                         'name!' => 'email'
                    ],
                    'dynamic' => [
                         'active' => true,
                    ]
               ]
          );
          $this->add_control(
               'profiles',
               [
                    'show_label' => false,
                    'type' => Controls_Manager::REPEATER,
                    'fields' => $repeater->get_controls(),
                    'title_field' => '<# print(name.slice(0,1).toUpperCase() + name.slice(1)) #>',
                    'default' => [
                         [
                              'link' => ['url' => 'https://facebook.com/'],
                              'name' => 'facebook'
                         ],
                         [
                              'link' => ['url' => 'https://linkedin.com/'],
                              'name' => 'linkedin'
                         ],
                         [
                              'link' => ['url' => 'https://twitter.com/'],
                              'name' => 'twitter'
                         ]
                    ],
               ]
          );

          $this->end_controls_section();
     }
     public function socialProfileRender()
     {
          $settings = $this->get_settings_for_display();
          if (is_array($settings['profiles'])) : ?>
               <ul class="contact-social wow fadeInUp">
                    <?php
                    foreach ($settings['profiles'] as $profile) :
                         $icon = $profile['name'];
                         $url = esc_url($profile['link']['url']);

                         printf(
                              '<li><a target="_blank" rel="noopener"  href="%s" class="elementor-repeater-item-%s"><i class="fab fa-%s" aria-hidden="true"></i></a></li>',
                              $url,
                              esc_attr($profile['_id']),
                              esc_attr($icon)
                         );
                    endforeach; ?>

               </ul>
<?php endif;
     }
}
