<?php

add_action('rest_api_init', 'add_fields');

function add_fields() {
  register_rest_field('post', 'authorName', array(
    'get_callback' => function() { return get_author_name(); }
  ));
}

function add_route() {
  register_rest_route('university/v1/', 'search', array( //university/v1/search?keyword=something
    'methods' => WP_REST_SERVER::READABLE,
    'callback' => 'universitySearchResults'
  ));
}

function universitySearchResults($data) {
  $mainQuery = new WP_Query(array(
    'post_type' => array('post', 'page', 'professor', 'event'),
    's' => sanitize_text_field( $data['keyword'] )
  ));

  $result = array(
    'general' => array(),
    'professors' => array(),
    'events'
  );

  while($mainQuery->havePost()) {
    $mainQuery->the_post();

    if( get_post_type() == 'post' || get_post_type() =='page' ) {
      array_push($result['general'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }

    if( get_post_type() == 'professor') {
      array_push($result['professors'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }

    if( get_post_type() == 'event') {
      array_push($result['events'], array(
        'title' => get_the_title(),
        'permalink' => get_the_permalink()
      ));
    }

  }

  return $professorsResult;
}


function page_banner($args = NULL) {
  if(!$args['title']) {
    $args['title'] = get_the_title();
  } 

  if(!$args['subtitle']) {
    $args['subtitle'] = get_field('page_banner_text');
  } 

  if(!$args['photo']) {
    if(get_field('page_banner_image')) {
      $args['photo'] = get_field('page_banner_image')['sizes']['pageBanner']; 
    }else {
      $args['photo'] = get_theme_file_uri('/images/ocean.jpg');
    }
  };

  ?>
    <div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo'] ?>)"></div>
        <div class="page-banner__content container container--narrow">
          <h1 class="page-banner__title"><?php echo $args['title'] ?></h1>
          <div class="page-banner__intro">
            <p><?php echo $args['subtitle']?></p>
          </div>
        </div>  
      </div>
 <?php 
}

function university_files() {
  wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
  wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'university_files');

function university_features() {
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');
  add_image_size('professorLandscape', 400, 260, true); // Plugin Manual image crop
  add_image_size('professorPortrait', 480, 650, true); // Plugin regenerator thumbnails
  add_image_size('pageBanner', 1500, 350, true); 
}

add_action('after_setup_theme', 'university_features');
