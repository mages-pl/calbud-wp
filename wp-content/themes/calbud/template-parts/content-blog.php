<?php
/**
 * Template part for displaying posts - blog
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

?>

<div class="single-blog">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>


	<div class="row">
		<div class="col-md-6">
			<h1><?php the_title(); ?></h1>
			<p class="date"><?php echo get_the_date(); ?></p>
		</div>
		<div class="col-md-6">
		
		<?php if (has_post_thumbnail()){ ?>
		
			<?php the_post_thumbnail(); ?> 
		
		<?php } else {?>
		
			<img src="<?php echo get_template_directory_uri(); ?>/img/calbud-gradient.jpg" alt="CalBud">

		<?php } ?>
		
			
		</div>
	</div>
	<div class="entry-content">
		<?php
        if ( is_single() ) :
			the_content();
        else :
            the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wp-bootstrap-starter' ) );
        endif;

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'wp-bootstrap-starter' ),
				'after'  => '</div>',
			) );
		?>
		
		<a href="/aktualnosci/" class="check-left">Powrót</a>
		
	</div>
	
	
		<div class="current-invest-gallery row-full">
			<div class="container-fluid">
			<?php 
			$images = get_field('galeria_aktualnosci');
			if( $images ): ?>
				<div class="row gallery no-gutters">
					<?php foreach( $images as $image ): ?>
						<div class="col-md-6">
							<a href="<?php echo esc_url($image['url']); ?>" class="foobox" rel="gallery">
								 <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="size-full"/>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			</div>
		</div>
	
	
	<div class="posts-add row-full">
	<div class="container">
		<div class="row">
		
		<div class="col-xl-4">
			<h3>Zobacz inne aktualności</h3>
		</div>
		<div class="col-xl-8">
		
			<div class="row">
			
				<?php echo do_shortcode("[ic_add_posts category='aktualnosci' showposts='2' template='template-blog.php']"); ?>
			
			</div>
			
		</div>
		
		</div>
	</div>
	</div>

</article>
</div>