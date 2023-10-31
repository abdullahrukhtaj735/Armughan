<?php

/**
 * 
 * Demo Imports
 */

function tp_ocdi_import_files()
{

     return array(
          array(
               'import_file_name'           => 'Home Main',
               'local_import_file'             => trailingslashit(get_template_directory()) . 'sample-data/contents-demo.xml',
               'local_import_widget_file' => trailingslashit(get_template_directory()) . 'sample-data/widget-settings.json',
               'local_import_customizer_file' => trailingslashit(get_template_directory()) . 'sample-data/customizer-data.dat',
               'import_preview_image_url' => plugins_url('assets/img/main-demo.png', dirname(__FILE__)),
               'preview_url'                => 'https://wp.shsarker.xyz/dora',
          ),
     );
}
add_filter('ocdi/import_files', 'tp_ocdi_import_files');



function tp_ocdi_plugin_page_setup($default_settings)
{
     $default_settings['parent_slug'] = 'themes.php';
     $default_settings['page_title']  = esc_html__('One Click Demo Import', 'one-click-demo-import');
     $default_settings['menu_title']  = esc_html__('Import Theme Demos', 'one-click-demo-import');
     $default_settings['capability']  = 'import';
     $default_settings['menu_slug']   = 'one-click-demo-import';

     return $default_settings;
}
add_filter('ocdi/plugin_page_setup', 'tp_ocdi_plugin_page_setup');
