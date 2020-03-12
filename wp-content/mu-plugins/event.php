<?php

function add_post_types() {
  $args = array(
    'rewrite' =>  array('slug' => 'events'),
    'has_archive' => true,
    'public' => true,
    'labels'  => array(
      'name' => 'Event',
      // 'add_new' => 'Add new event',
      'add_new_item' => 'Add new event'),
    'menu_icon' => 'dashicons-calendar'
  );
  register_post_type('event', $args);
}
add_action('init', 'add_post_types');