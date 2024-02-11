<?php
/**
 * Template for displaying a post in the [ic_add_posts] shortcode.
 *
 * @package   Posts_in_Page
 * @author    Eric Amundson <eric@ivycat.com>
 * @copyright Copyright (c) 2019, IvyCat, Inc.
 * @link      https://ivycat.com
 * @since     1.0.0
 * @license   GPL-2.0-or-later
 */

?>



<div class="post hentry ivycat-post col-md-6">

	<div class="inner">
	
		<p class="date"><?php echo get_the_date(); ?></p>

		<a href="<?php the_permalink(); ?>" class="link"><?php the_title(); ?></a>
		
		<div class="entry-summary">
			<?php //the_excerpt(); ?>
			<p>
				<?php echo wp_trim_words(get_the_content(), 30, '...'); ?>
			</p>
		</div>
		
		<a href="<?php the_permalink(); ?>" class="check">Czytaj więcej</a>

	</div>
	
</div>

