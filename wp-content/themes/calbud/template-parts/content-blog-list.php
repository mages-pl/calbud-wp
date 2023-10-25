
<div class="blog-list col-lg-6 col-xl-4">




	<div class="inner">
	
	<div class="hover-link" style="background-image:url(<?php echo get_template_directory_uri(); ?>/img/blog-list-gradient.png), url(<?php echo the_post_thumbnail_url(); ?>)">"
	</div>
	
		<p class="date"><?php echo get_the_date(); ?></p>

		<a href="<?php the_permalink(); ?>" class="link xs-up-hidden"><?php the_title(); ?></a>
		<a href="<?php the_permalink(); ?>" class="link xs-hidden"><?php echo mb_strimwidth(get_the_title(), 0, 42, '...'); ?></a>
		
		<div class="entry-summary">
			<?php echo wp_trim_words(get_the_content(), 30, '...'); ?>
		</div>
		
		<a href="<?php the_permalink(); ?>" class="check">Czytaj więcej</a>

	</div>
	

	
	
</div>
