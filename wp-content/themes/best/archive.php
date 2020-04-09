<?php
get_header();
page_banner([
  'title' => get_the_archive_title(),
  'subtitle' => get_the_archive_description()
]);
 
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