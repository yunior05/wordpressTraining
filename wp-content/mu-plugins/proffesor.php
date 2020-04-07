<?php

function add_professor_post_type() {
  $args = array(
    'public' => true,
    'supports' => array('title','editor','thumbnail'),
    'labels'  => array(
      'name' => 'Professor',
      // 'add_new' => 'Add new event',
      'add_new_item' => 'Add new professor'),
    'menu_icon' => 'dashicons-welcome-learn-more'
  );
  register_post_type('professor', $args);
}
add_action('init', 'add_professor_post_type');