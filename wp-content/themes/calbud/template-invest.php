




<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>

	<?php if( get_field('dodatkowy_obrazek_wyrozniajacy') ): ?>

		<a href="<?php the_permalink(); ?>" class="invest-hentry col-lg-6" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/gradient-black.png') ,url(<?php the_field('dodatkowy_obrazek_wyrozniajacy'); ?>);">
	
	<?php else: ?>

		<a href="<?php the_permalink(); ?>" class="invest-hentry col-lg-6" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/gradient-black.png') ,url('<?php echo $backgroundImg[0]; ?>');">

	<?php endif; ?>

<div class="" >

	<div class="row">
	
		<div class="col-xl-8">
			<h6><?php the_title(); ?></h6>
			<p><?php the_field('adres'); ?></p>
		</div>
		
		<div class="col-xl-4 second">

			<span class="check">Sprawdź</span>
		</div>
		
	</div>	
	
</div>
</a>