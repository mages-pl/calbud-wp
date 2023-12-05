<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WP_Bootstrap_Starter
 */

?>

	<?php if (in_category('inwestycje')){ ?>
	
		<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
		<div class="current-invest-single row-full" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/apla40.png') ,url('<?php echo $backgroundImg[0]; ?>');">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
				
					<?php if( get_field('logo') ): ?>
						<img src="<?php the_field('logo'); ?>" class="logo" />
					<?php endif; ?>
				
					<?php if( get_field('haslo_reklamowe') ) { ?>
						<h1><?php the_field('haslo_reklamowe'); ?></h1>
					<?php } ?>
					
					<a href="#" class="orange" data-toggle="modal" data-target="#exampleModalOffer">Zapytaj o ofertę</a>
					
					<a href="#pills-tabContent" class="white">Wyszukaj apartament</a>
				
				</div>	
			</div>	
		</div>	
		</div>
		
		<?php /* pierwsza sekcja */ ?>
		
		<div class="current-invest-first row-full" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/apla60.png'),url('<?php the_field('obrazek_tla_pierwsza'); ?>');">
		
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
						<h2><?php the_field('nazwa_inwestycji'); ?></h2>
						
						<div class="row">
						
						<?php if( get_field('pierwsza_ikonka_pierwszej') ) {?>
							<div class="col-md-6">
								<div class="inner" style="background-image:url('<?php the_field('pierwsza_ikonka_pierwszej'); ?>');">
								<p><?php the_field('pierwszy_tekst_pierwszej_sekcji'); ?></p>
								</div>
							</div>
						<?php } ?>
								
						<?php if( get_field('druga_ikonka_pierwszej') ) {?>
							<div class="col-md-6">
								<div class="inner" style="background-image:url('<?php the_field('druga_ikonka_pierwszej'); ?>');">
								<p><?php the_field('drugi_tekst_pierwszej_sekcji'); ?></p>
								</div>
							</div>
						<?php } ?>
								
						<?php if( get_field('trzecia_ikonka_pierwszej') ) {?>
							<div class="col-md-6">
								<div class="inner" style="background-image:url('<?php the_field('trzecia_ikonka_pierwszej'); ?>');">
								<p><?php the_field('trzeci_tekst_pierwszej_sekcji'); ?></p>
								</div>
							</div>
						<?php } ?>
						
						<?php if( get_field('czwarta_ikonka_pierwszej') ) {?>
							<div class="col-md-6">
								<div class="inner" style="background-image:url('<?php the_field('czwarta_ikonka_pierwszej'); ?>');">
								<p><?php the_field('czwarty_tekst_pierwszej_sekcji'); ?></p>
								</div>
							</div>
						<?php } ?>
						
						<div class="col-md-12">

							<p class="main-first"><?php the_field('tekst_glowny_pierwszej_sekcji'); ?></p>
						
							<div class="additional">
							
								<a class="more-open more-invest" role="button" href="#collapse02" data-toggle="collapse" aria-expanded="false" aria-controls="collapse02">czytaj więcej</a>
								
								<div id="collapse02" class="collapse">
								
									<p><?php the_field('tekst_dodatkowy_pierwszej_sekcji'); ?></p>
								
									<a class="more-close" role="button" href="#collapse02" data-toggle="collapse" aria-expanded="false" aria-controls="collapse02">mniej</a>
								
								</div>
							
							</div>
						
						</div>
						
						</div>
			
					</div>
				</div>
			</div>

		</div>		
		
		<?php /* sekcja Wyszukiwarka-Mapa*/ ?>
		
		<div class="current-invest-search container">
			<div class="row">
			
				<div class="col-md-12 text-center">
					<h3><?php the_field('tytul_sekcji_wyszukiwarka_mapa'); ?></h3>
				</div>
				
				<?php /*
				<div class="col-md-12 text-center">
					<ul class="nav nav-pills" id="pills-tab" role="tablist">
					  <li class="nav-item">
						<a class="nav-link active" id="pills-01-tab" data-toggle="pill" href="#pills-01" role="tab" aria-controls="pills-01" aria-selected="true">Wybór interaktywny</a>
					  </li>
					  <li class="nav-item">
						<a class="nav-link" id="pills-02-tab" data-toggle="pill" href="#pills-02" role="tab" aria-controls="pills-02" aria-selected="false">Lista mieszkań</a>
					  </li>
					</ul>
				</div>
				*/?>
				
				<div class="col-md-12 text-center">
					<div class="tab-content" id="pills-tabContent">
						<div class="tab-pane fade show active" id="pills-01" role="tabpanel" aria-labelledby="pills-01-tab">
							<p class="info-text"><?php the_field('tekst_info_mapa'); ?></p>



							<?php 
							// Widok pojedynczej inwestycji
							$inwestycja = trim($post->post_title); 
							
							?>
							

							
							<?php 
							
							echo do_shortcode("[allimagemap name='".$inwestycja."' view='single']"); 
							
							?>
							
						</div>
						<div class="tab-pane fade" id="pills-02" role="tabpanel" aria-labelledby="pills-02-tab">

							<p class="info-text02"><?php the_field('tekst_info_wyszukiwarka'); ?></p>
							
						</div>
					</div>
				</div>

			</div>
		</div>
		
		
		<?php /* sekcja Kontakt */ ?>
		
		<div class="current-invest-contact row-full" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/apla60.png'),url('<?php the_field('obrazek_tla_kontakt'); ?>');">
		
			<p><?php the_field('tekst_sekcji_kontakt'); ?></p>
			
			<a href="/kontakt-deweloper/" class="orange">Skontaktuj się z nami</a>
		
		</div>
		
		<?php /* sekcja Lokalizacja */ ?>
		
		<div class="current-invest-localisation row-full">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 text-center">
						<h3><?php the_field('tytul_sekcji_lokalizacja'); ?></h3>
						<h6><?php the_field('haslo_sekcji_lokalizacja'); ?></h6>
					</div>
					
					<?php if( get_field('pierwsza_ikonka_lokalizacja') ) {?>
						<div class="col-md-6 col-lg-3">
							<div class="inner" style="background-image:url('<?php the_field('pierwsza_ikonka_lokalizacja'); ?>');">
							<p><?php the_field('pierwszy_tekst_lokalizacja'); ?></p>
							</div>
						</div>
					<?php } ?>
							
					<?php if( get_field('druga_ikonka_lokalizacja') ) {?>
						<div class="col-md-6 col-lg-3">
							<div class="inner" style="background-image:url('<?php the_field('druga_ikonka_lokalizacja'); ?>');">
							<p><?php the_field('drugi_tekst_lokalizacja'); ?></p>
							</div>
						</div>
					<?php } ?>
							
					<?php if( get_field('trzecia_ikonka_lokalizacja') ) {?>
						<div class="col-md-6 col-lg-3">
							<div class="inner" style="background-image:url('<?php the_field('trzecia_ikonka_lokalizacja'); ?>');">
							<p><?php the_field('trzeci_tekst_lokalizacja'); ?></p>
							</div>
						</div>
					<?php } ?>
					
					<?php if( get_field('czwarta_ikonka_lokalizacja') ) {?>
						<div class="col-md-6 col-lg-3">
							<div class="inner" style="background-image:url('<?php the_field('czwarta_ikonka_lokalizacja'); ?>');">
							<p><?php the_field('czwarty_tekst_lokalizacja'); ?></p>
							</div>
						</div>
					<?php } ?>
					
				</div>
			</div>
		</div>
		
		
		<?php the_field('mapa'); ?>
		<?php the_field('mapa_test'); ?>
		
		
		<?php /* sekcja Standard */ ?>
		
		<div class="current-invest-standard row-full" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/apla60.png'),url('<?php the_field('obrazek_tla'); ?>');">
		
			<div class="container">
				<div class="row">
					<div class="col-lg-6">
					</div>
					<div class="col-lg-6">
						
						<h3><?php the_field('tytul_sekcji_standard'); ?></h3>
						<h6><?php the_field('haslo_sekcji_standard'); ?></h6>
						
						<div class="row">
						
							<?php if( get_field('pierwsza_ikonka_standard') ) {?>
							<div class="col-md-6 col-lg-12 col-xl-6">
								<div class="inner" style="background-image:url('<?php the_field('pierwsza_ikonka_standard'); ?>');">
								<p><?php the_field('pierwszy_tekst_standard'); ?></p>
								</div>
							</div>
							<?php } ?>
							
							<?php if( get_field('druga_ikonka_standard') ) {?>
							<div class="col-md-6 col-lg-12 col-xl-6">
								<div class="inner" style="background-image:url('<?php the_field('druga_ikonka_standard'); ?>');">
								<p><?php the_field('drugi_tekst_standard'); ?></p>
								</div>
							</div>
							<?php } ?>
							
							<?php if( get_field('trzecia_ikonka_standard') ) {?>
							<div class="col-md-6 col-lg-12 col-xl-6">
								<div class="inner" style="background-image:url('<?php the_field('trzecia_ikonka_standard'); ?>');">
								<p><?php the_field('trzeci_tekst_standard'); ?></p>
								</div>
							</div>
							<?php } ?>
							
							<?php if( get_field('czwarta_ikonka_standard') ) {?>
							<div class="col-md-6 col-lg-12 col-xl-6">
								<div class="inner" style="background-image:url('<?php the_field('czwarta_ikonka_standard'); ?>');">
								<p><?php the_field('czwarty_tekst_standard'); ?></p>
								</div>
							</div>
							<?php } ?>
							
							<?php if( get_field('piata_ikonka_standard') ) {?>
							<div class="col-md-6 col-lg-12 col-xl-6">
								<div class="inner" style="background-image:url('<?php the_field('piata_ikonka_standard'); ?>');">
								<p><?php the_field('piaty_tekst_standard'); ?></p>
								</div>
							</div>
							<?php } ?>
							
							<?php if( get_field('szosta_ikonka_standard') ) {?>
							<div class="col-md-6 col-lg-12 col-xl-6">
								<div class="inner" style="background-image:url('<?php the_field('szosta_ikonka_standard'); ?>');">
								<p><?php the_field('szosty_tekst_standard'); ?></p>
								</div>
							</div>
							<?php } ?>
							
						</div>
						
						<div class="col-md-12">
						
							<div class="additional">
							
								<a class="more-open more-additional" role="button" href="#collapse01" data-toggle="collapse" aria-expanded="false" aria-controls="collapse01">dowiedz się więcej</a>
								
								<div id="collapse01" class="collapse">
								
									<p><?php the_field('dodatkowa_tresc_standard'); ?></p>
								
									<a class="more-close" role="button" href="#collapse01" data-toggle="collapse" aria-expanded="false" aria-controls="collapse01">mniej</a>
								
								</div>
							
							</div>
						
						</div>
						
	
					</div>
				</div>
			</div>	
		
		</div>
		

		<?php /* sekcja opcjonalna */ ?>

		<?php if( get_field('sekcja_opcjonalna_wybor') ) { ?>

		<div class="current-invest-interior row-full">
		<div class="container">
			<div class="row">
			<div class="col-md-12">
				<h3><?php the_field('tytul_sekcji_opcjonalnej'); ?></h3>
				<p class="big"><?php the_field('podtytul_sekcji_opcjonalnej'); ?></p>
			</div>
			
			<div class="col-md-12">
			
			  <ul class="nav nav-tabs">
				<li class="active"><a data-toggle="tab" href="#tab01"><?php the_field('nazwa_pierwszego_stylu'); ?></a></li>
				<li><a data-toggle="tab" href="#tab02"><?php the_field('nazwa_drugiego_stylu'); ?></a></li>
			  </ul>

			  <div class="tab-content">
			  
				<div id="tab01" class="tab-pane fade in active show">
					<h6><?php the_field('nazwa_pierwszego_stylu'); ?></h6>
					<p class="slogan"><?php the_field('slogan_pierwszego_stylu'); ?></p>
					<p class="desc"><?php the_field('opis_pierwszego_stylu'); ?></p>
					
					<?php 
					$images = get_field('galeria_pierwszego_stylu');
					if( $images ): ?>
						<div class="row gallery">
						
							<?php foreach( $images as $image ): ?>
								<div class="col-md-4">

									<a href="<?php echo esc_url($image['url']); ?>" class="foobox" rel="first-gallery">
										<img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php //echo esc_attr($image['alt']); ?>" />
									</a>

								</div>
							<?php endforeach; ?>
							
						</div>
					<?php endif; ?>
					
				</div>
				<div id="tab02" class="tab-pane fade">
					<h6><?php the_field('nazwa_drugiego_stylu'); ?></h6>
					<p class="slogan"><?php the_field('slogan_drugiego_stylu'); ?></p>
					<p class="desc"><?php the_field('opis_drugiego_stylu'); ?></p>
					
					<?php 
					$images = get_field('galeria_drugiego_stylu');
					if( $images ): ?>
						<div class="row gallery">
						
							<?php foreach( $images as $image ): ?>
								<div class="col-md-4">

									<a href="<?php echo esc_url($image['url']); ?>" class="foobox" rel="second-gallery">
										<img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php //echo esc_attr($image['alt']); ?>" />
									</a>

								</div>
							<?php endforeach; ?>
							
						</div>
					<?php endif; ?>
					
				</div>
			   
			  </div>
		  
			</div>

			
			</div>
		</div>
		</div>
		
		<?php } ?>
		
		
		<div class="current-invest-gallery row-full">
			<div class="container-fluid">
			
			<h3>Galeria</h3>
			
			<?php 
			$images = get_field('galeria');
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
		

		
		

	<?php } else if (in_category('realizacje-deweloper') || in_category('inwestycje-komercyjne') || in_category('inwestycje-mieszkaniowe') || in_category('inwestycje-przemyslowe') || in_category('inwestycje-uzytecznosci-publicznej')){ ?>
	
	
		<?php $backgroundImg = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'full' );?>
		<div class="invest-single row-full" style="background-image:url('<?php echo get_template_directory_uri(); ?>/img/apla-big.png') ,url('<?php echo $backgroundImg[0]; ?>');">
		<div class="container">
			<div class="row">
				<div class="col-lg-6">
					<h1><?php the_title(); ?></h1><?php the_field('miejsce_pracy'); ?>
					
					<div class="row">
					
						
						<?php if( get_field('adres') ) { ?>
						
							<div class="col-md-6 box first">
								<h6>Adres:</h6>
								<p><?php the_field('adres'); ?></p>
							</div>
							
						<?php } ?>
						
						<?php if( get_field('termin_realizacji') ) { ?>
						
							<div class="col-md-6 box second">
								<h6>Termin realizacji:</h6>
								<p><?php the_field('termin_realizacji'); ?></p>
							</div>
							
						<?php } ?>
						
						<?php if( get_field('inwestor') ) { ?>
						
							<div class="col-md-6 box third">
								<h6>Inwestor:</h6>
								<p><?php the_field('inwestor'); ?></p>
							</div>
							
						<?php } ?>
						
						<?php if( get_field('projektant') ) { ?>
						
							<div class="col-md-6 box fourth">
								<h6>Projektant:</h6>
								<p><?php the_field('projektant'); ?></p>
							</div>
							
						<?php } ?>
						
						<?php if( get_field('liczba_lokali') ) { ?>
						
							<div class="col-md-6 box fifth">
								<h6>Liczba lokali:</h6>
								<p><?php the_field('liczba_lokali'); ?></p>
							</div>
							
						<?php } ?>
						
						<?php if( get_field('zakres_robot') ) { ?>
						
							<div class="col-md-6 box sixth">
								<h6>Zakres robót</h6>
								<p><?php the_field('zakres_robot'); ?></p>
							</div>
							
						<?php } ?>
						
					</div>
					<div class="invest-single-content">
						<?php echo the_content(); ?>
					</div>
				</div>	
			</div>	
		</div>	
		</div>
		
		<div class="invest-gallery row-full">
			<?php //the_field('galeria_zdjec'); ?>
			
			<?php 
			$images = get_field('galeria_zdjec');
			if( $images ): ?>
				<div class="row gallery no-gutters">
					<?php foreach( $images as $image ): ?>
						<div class="col-md-4">
							<a href="<?php echo esc_url($image['url']); ?>" class="foobox" rel="gallery">
								 <img src="<?php echo esc_url($image['sizes']['large']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" class="size-full"/>
							</a>
						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>
			
		</div>	
	
	<?php } else { ?>

		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div class="post-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<header class="entry-header">
				<?php
				if ( is_single() ) :
					the_title( '<h1 class="entry-title">', '</h1>' );
				else :
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
				endif;

				if ( 'post' === get_post_type() ) : ?>
				<div class="entry-meta">
					<?php wp_bootstrap_starter_posted_on(); ?>
				</div><!-- .entry-meta -->
				<?php
				endif; ?>
			</header><!-- .entry-header -->
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
			</div><!-- .entry-content -->

			<footer class="entry-footer">
				<?php wp_bootstrap_starter_entry_footer(); ?>
			</footer><!-- .entry-footer -->
		</article><!-- #post-## -->

	<?php } ?>
	
	
	
	
	
	
	
	


<!-- Modal -->
<div class="modal fade modal-black" id="exampleModalOffer" tabindex="-1" role="dialog" aria-labelledby="exampleModalOfferTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
   
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
	  

		
		
		<?php echo do_shortcode('[contact-form-7 id="be959c5" title="Formularz Zapytaj o Ofertę"]'); ?>

      </div>

    </div>
  </div>
</div>

	
	
	
	
	
