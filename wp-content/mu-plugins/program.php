<?php

function add_program_post_type() {
  $args = array(
    'rewrite' =>  array('slug' => 'programs'),
    'has_archive' => true,
    'public' => true,
    'labels'  => array(
      'name' => 'Program',
      // 'add_new' => 'Add new event',
      'add_new_item' => 'Add new program'),
    'menu_icon' => 'dashicons-format-aside'
  );
  register_post_type('program', $args);
}
add_action('init', 'add_program_post_type');