<time class="updated" datetime="<?php echo get_the_time('c'); ?>"><?php echo get_the_date(); ?></time>
<p class="byline author vcard"><?php _e('By', 'sage'); ?> <a href="<?php echo get_author_posts_url(get_the_author_meta('ID')); ?>" rel="author" class="fn"><?php echo get_the_author(); ?></a>
    <?php if(!is_single()) : ?>
        <br />
        <small class="archive-category-tag">
            <?php _e("Categories: ", "kysbag"); the_category(', '); ?>
            <span class="white-space"></span>
            <?php the_tags(); ?>
        </small>
    <?php endif; ?>
</p>
