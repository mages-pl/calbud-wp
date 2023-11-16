<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WP_Bootstrap_Starter
 */

?>
<?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
			</div><!-- .row -->
		</div><!-- .container -->
	</div><!-- #content -->
    <?php get_template_part( 'footer-widget' ); ?>
	
	<?php if (is_page('kontakt') || is_page('kontakt-deweloper') || is_page('kontakt-generalny-wykonawca')){ ?>
	
	
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2376.991001152164!2d14.567407177076598!3d53.43286916824568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47aa090b4c6ee395%3A0x46b629f5a9faa47d!2sCalbud%20Sp.%20z%20o.o.!5e0!3m2!1spl!2spl!4v1694619646669!5m2!1spl!2spl" width="100%" height="730" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	
		<iframe src="https://snazzymaps.com/embed/540680" width="100%" height="730px" style="border:none;"></iframe>

	<?php } ?>
	
	
	<?php if (is_page('inwestycje-przemyslowe')){ ?>
		<div class="row">
			<?php echo do_shortcode("[ic_add_posts category='inwestycje-przemyslowe' template='template-invest.php' paginate='yes' showposts='22']"); ?>
		</div>
	<?php } ?>
	
	<?php if (is_page('inwestycje-komercyjne')){ ?>
		<div class="row">
			<?php echo do_shortcode("[ic_add_posts category='inwestycje-komercyjne' template='template-invest.php' paginate='yes' showposts='22']"); ?>
		</div>
	<?php } ?>
	
	<?php if (is_page('inwestycje-mieszkaniowe')){ ?>
		<div class="row">
			<?php echo do_shortcode("[ic_add_posts category='inwestycje-mieszkaniowe' template='template-invest.php' paginate='yes' showposts='22']"); ?>
		</div>
	<?php } ?>
	
	<?php if (is_page('inwestycje-uzytecznosci-publicznej')){ ?>
		<div class="row">
			<?php echo do_shortcode("[ic_add_posts category='inwestycje-uzytecznosci-publicznej' template='template-invest.php' paginate='yes' showposts='22']"); ?>
		</div>
	<?php } ?>
	
	<?php if (is_page('realizacje')){ ?>
		<div class="row">
			<?php echo do_shortcode("[ic_add_posts category='realizacje-deweloper' template='template-invest.php' paginate='yes' showposts='22']"); ?>
		</div>
	<?php } ?>
	
	
	<footer id="colophon" class="site-footer <?php echo wp_bootstrap_starter_bg_class(); ?>" role="contentinfo">
		<div class="container">

			<div class="row">

				<div class="col-sm-6 col-lg-3">
				
					<?php if (is_front_page()){ ?>
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="CalBud">
					<?php } else { ?>	
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="CalBud">
						</a>
					<?php } ?>
					
					<div class="fb">
						<a href="https://www.facebook.com/CALBUD/" title="CalBud Facebook" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/img/fb.svg" alt="CalBud Facebook">
						</a>
					</div>
				
				</div>
				<div class="col-sm-6 col-lg-3">
				
					<h6>Kontakt</h6>
					
					<p>
					P.B. CALBUD Sp. z o.o.<br />
					ul. Kapitańska 2, 71-602 Szczecin<br />
					tel: <a href="tel:+48914806101">91 48 06 101</a><br />
					fax: 91 44 80 523<br />
					e-mail: <a href="mailto:firma@calbud.com.pl">firma@calbud.com.pl</a>
					</p>
				
				</div>
				<div class="col-sm-6 col-lg-3 links">
				
					<h6>CALBUD</h6>
					
						<a href="/o-firmie/">Nasza historia</a>
						<a href="/zarzad/">Zarząd</a>
						<a href="/nagrody/">Nagrody</a>
						<a href="/referencje/">Referencje</a>
						<a href="/wspierane-inicjatywy/">Wspierane inicjatywy</a>
						<a href="/rodo/">RODO</a>
				
				</div>
				<div class="col-sm-6 col-lg-3 links">
				
					<h6>Oferta</h6>

						<a href="/sand-dunes/">Sand Dunes</a>
						<a href="/deweloper/">Deweloper</a>
						<a href="/generalny-wykonawca/">Generalny Wykonawca</a>
						<a href="/kariera/">Kariera w Calbud</a>
				
				</div>

			</div>
			
		</div>
	</footer><!-- #colophon -->
<?php endif; ?>
</div><!-- #page -->


<script>
$('#submit').on('click', function() {
    if ($('#container').css('opacity') == 0) {
        $('#container').css('opacity', 1);
    }
    else {
        $('#container').css('opacity', 0);
    }
});

</script>

<?php wp_footer(); ?>


	<?php if (is_page('deweloper')){ ?>

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

	<?php } ?>

 
	<link href="https://code.jquery.com/ui/1.10.4/themes/ui-lightness/jquery-ui.css" rel="stylesheet"> 
	
      <script src="https://code.jquery.com/jquery-1.10.2.js"></script>  
	 
      <script src="https://code.jquery.com/ui/1.10.4/jquery-ui.js"></script> 
   
	<script>  
         $(function() {  
            $( "#slide" ).slider({  
orientation: "horizontal",                 
range:true,  
               min: 0,  
               max: $("#powierzchnia_content").attr('data-max'),  
               values: [ 0, parseFloat($("#powierzchnia_content").attr('data-max')) ],  
               slide: function( event, ui ) {
				$( "input[name=metraz]" ).val( ui.values[ 0 ] );  
				$( "input[name=metraz_do]" ).val(   ui.values[ 1 ] ); 
				ajaxImagemapperSearch(''); 

				$( "#powierzchnia_content" ).val( "" + ui.values[ 0 ] +  
    	 " - " + ui.values[ 1 ] +"m2" ); 
               }  
           });  
        $( "#powierzchnia_content" ).val( "" + $( "#slide" ).slider( "values", 0 ) +  
    	 " - " + $( "#slide" ).slider( "values", 1 ) +"m2");  
         });  
      </script> 
	
	

</body>
</html>