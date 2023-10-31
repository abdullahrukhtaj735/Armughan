<?php

// Add meta box
function CFCore_meta_box()
{
     add_meta_box(
          'CFCore_meta_box', // Unique ID
          'Checkbox Meta Box', // Box title
          'CFCore_meta_box_callback', // Content callback
          'page' // Post type
     );
}
add_action('add_meta_boxes', 'CFCore_meta_box');


// Callback function to display meta box contents
function CFCore_meta_box_callback($post)
{
     // Add a nonce field for security
     wp_nonce_field('CFCore_meta_box', 'CFCore_meta_box_nonce');

     // Retrieve current value of the meta box
     $cb_value = get_post_meta($post->ID, 'CFCore_breadcrumb_checkbox', true);

     // Display the meta box fields
     echo '<label for="CFCore_meta_box">';
     echo '</label> ';
     echo '<input type="checkbox" id="CFCore_meta_box" name="CFCore_meta_box" ' . checked($cb_value, 'on', false) . ' /> ';
     echo 'Is it invisible breadcrumb?';
}


// Save the meta box value
function save_CFCore_meta_box($post_id)
{
     // Check if nonce is set
     if (!isset($_POST['CFCore_meta_box_nonce'])) {
          return;
     }

     // Verify nonce
     if (!wp_verify_nonce($_POST['CFCore_meta_box_nonce'], 'CFCore_meta_box')) {
          return;
     }

     // Check if user has permission to save data
     if (!current_user_can('edit_post', $post_id)) {
          return;
     }

     // Save the meta box value
     $cb_value = isset($_POST['CFCore_meta_box']) ? 'on' : 'off';
     update_post_meta($post_id, 'CFCore_breadcrumb_checkbox', $cb_value);
}
add_action('save_post', 'save_CFCore_meta_box');
