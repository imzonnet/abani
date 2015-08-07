<article <?php post_class(); ?>>
  <?php if(has_post_thumbnail()) : ?>
    <div class="thumbnail">
      <?php the_post_thumbnail(); ?>
    </div>
  <?php endif; ?>
  <header>
    <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
    <?php get_template_part('templates/entry-meta'); ?>
  </header>
  <div class="entry-summary">
    <?php the_excerpt(); ?>
  </div>
  <div class="more-link">
    <a href="<?php the_permalink(); ?>"><?php _e("Read more", "kysbag"); ?></a>
  </div>
</article>
