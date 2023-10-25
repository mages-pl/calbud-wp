<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

get_header(); ?>

	<section id="primary" class="content-area col-sm-12 col-lg-12">
		<div id="main" class="site-main" role="main">
		
		
		<?php if (is_category('aktualnosci')){ ?>
		
		
			<div class="blog-list-top row-full">
			<div class="container">
			<div class="row">
			<div class="col">
				<h1>Aktualności</h1>
			</div>
			</div>
			</div>
			</div>
		
			<div class="row">
			<?php if ( have_posts() ) : ?>

				<?php

				while ( have_posts() ) : the_post();

					get_template_part( 'template-parts/content-blog-list', get_post_format() );

				endwhile;

				the_posts_navigation();

				endif; ?>
			
			</div>
	
		
		<?php } else { ?>

		
			<?php
			if ( have_posts() ) : ?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
						the_archive_description( '<div class="archive-description">', '</div>' );
					?>
				</header><!-- .page-header -->

				
					<?php
					/* Start the Loop */
					while ( have_posts() ) : the_post();

						get_template_part( 'template-parts/content', get_post_format() );

					endwhile;

					the_posts_navigation();

					else :

						get_template_part( 'template-parts/content', 'none' );

					endif; ?>

		<?php } ?>	

		</div><!-- #main -->
	</section><!-- #primary -->

<?php
//get_sidebar();
get_footer();
