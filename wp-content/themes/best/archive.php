<?php
get_header();
?>
<div class="page-banner">
<div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('/images/ocean.jpg') ?>);"></div>
<div class="page-banner__content container container--narrow">
  <h1 class="page-banner__title"><?php the_archive_title() ?></h1>
  <div class="page-banner__intro">
    <p><?php the_archive_description() ?></p>
  </div>
</div>  
</div>
<?php 
while(have_posts()) {
  the_post(); ?>
  
  <div class="container container--narrow page-section">
    <h1 class="headline headline--medium headline--post-title" ><?php the_title(); ?></h1>
    <span class="metabox">Post by <?php the_author_link(); ?> on <?php the_date('n/d/Y') ?> in <?php  the_category(', ') ?></span>

    <div class="generic-content">
      <?php the_excerpt(); ?>
      <p><a class="btn btn--blue" href="<?php the_permalink() ?>">Continue reading &raquo;</a></p>
    </div>
   
</div>
<?php
}

get_footer();
?>