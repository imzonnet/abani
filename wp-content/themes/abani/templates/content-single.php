<?php while ( have_posts() ) : the_post(); ?>

	<article <?php post_class("single-post-detail"); ?>>
		<header>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php get_template_part( 'templates/entry-meta' ); ?>
		</header>
		<?php the_post_thumbnail(); ?>
		<div class="entry-content">
			<?php 
			if(is_singular('attachment')){
				if ( wp_attachment_is_image( $post->id ) ) {
					$att_image = wp_get_attachment_image_src( $post->id, "full");
					?>
					<p class="attachment">
						<a href="<?php echo esc_url(wp_get_attachment_url($post->id)); ?>" title="<?php the_title(); ?>" rel="attachment">
							<img src="<?php echo esc_attr($att_image[0]);?>" width="<?php echo esc_attr($att_image[1]);?>" height="<?php echo esc_attr($att_image[2]);?>"  class="attachment-medium" alt="<?php the_title(); ?>" />
						</a>
                    </p>
					<?php
				}
			}else{
				the_content(); 
			}
			?>
		</div>
		<div class="entry-tags"><?php the_tags(); ?></div>
		<footer>
			<?php wp_link_pages( array(
				'before' => '<nav class="page-nav"><p>' . __( 'Pages:', 'sage' ),
				'after'  => '</p></nav>'
			) ); ?>
		</footer>
		<?php posts_nav_link(); ?>
		<?php comments_template( '/templates/comments.php' ); ?>
	</article>
<?php endwhile; ?>
