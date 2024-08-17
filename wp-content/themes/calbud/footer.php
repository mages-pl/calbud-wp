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
	
	<?/*
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2376.991001152164!2d14.567407177076598!3d53.43286916824568!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47aa090b4c6ee395%3A0x46b629f5a9faa47d!2sCalbud%20Sp.%20z%20o.o.!5e0!3m2!1spl!2spl!4v1694619646669!5m2!1spl!2spl" width="100%" height="730" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
	*/?>
	
		<iframe src="https://snazzymaps.com/embed/540680" width="100%" height="730px" style="border:none!important;border:0!important;"></iframe>
	

	
	<?php } ?>
	
	
	<?php if (is_page('inwestycje-przemyslowe')){ ?>
		<div class="row">
			<?php echo do_shortcode("[ic_add_posts category='inwestycje-przemyslowe' template='template-invest.php' paginate='yes' showposts='44']"); ?>
		</div>
	<?php } ?>
	
	<?php if (is_page('inwestycje-komercyjne')){ ?>
		<div class="row">
			<?php echo do_shortcode("[ic_add_posts category='inwestycje-komercyjne' template='template-invest.php' paginate='yes' showposts='44']"); ?>
		</div>
	<?php } ?>
	
	<?php if (is_page('inwestycje-mieszkaniowe')){ ?>
		<div class="row">
			<?php echo do_shortcode("[ic_add_posts category='inwestycje-mieszkaniowe' template='template-invest.php' paginate='yes' showposts='44']"); ?>
		</div>
	<?php } ?>
	
	<?php if (is_page('inwestycje-uzytecznosci-publicznej')){ ?>
		<div class="row">
			<?php echo do_shortcode("[ic_add_posts category='inwestycje-uzytecznosci-publicznej' template='template-invest.php' paginate='yes' showposts='44']"); ?>
		</div>
	<?php } ?>
	
	<?php if (is_page('realizacje')){ ?>
		<div class="row">
			<?php echo do_shortcode("[ic_add_posts category='realizacje-deweloper' template='template-invest.php' paginate='yes' showposts='44']"); ?>
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
						<a href="https://www.instagram.com/calbud_pl/" title="CalBud Instagram" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/img/insta.webp" alt="CalBud Instagram">
						</a>
						<a href="https://pl.linkedin.com/company/calbudcompl" title="CalBud LinkedIn" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/img/linkedin.webp" alt="CalBud LinkedIn">
						</a>
						<a href="https://www.youtube.com/@calbud-szczecin" title="CalBud YouTube" target="_blank">
							<img src="<?php echo get_template_directory_uri(); ?>/img/yt.png" alt="CalBud Youtube">
						</a>
					</div>

				</div>
				<div class="col-sm-6 col-lg-3">
				
					<h6>Kontakt</h6>
					
					<p>
					P.B. CALBUD Sp. z o.o.<br />
					ul. Kapitańska 2<br />
					71-602 Szczecin<br />
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
	 jQuery(function($) {
$('#submit').on('click', function() {
    if ($('#container').css('opacity') == 0) {
        $('#container').css('opacity', 1);
    }
    else {
        $('#container').css('opacity', 0);
    }
});
	 });

</script>

<?php wp_footer(); ?>
<script src="<?php echo get_template_directory_uri(); ?>/js/waypoints.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>

<script>
			if(!$) var $ = jQuery;
			jQuery(document).ready(function($) {
				$('.counter').counterUp({
					delay: 10,
					time: 1000
				});
			});
</script>

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

<script type="text/javascript">
	window.onload = function() { 
		if((document.querySelectorAll(".half.first").length > 0) && (document.querySelectorAll(".half.second").length > 0)) {
		document.querySelector(".half.first").addEventListener('mouseover', function() {
			document.querySelector(".half.second .inner").style.opacity = '0';
		});
		document.querySelector(".half.first").addEventListener('mouseout', function() {
			document.querySelector(".half.second .inner").style.opacity = '1';
		});

		document.querySelector(".half.second").addEventListener('mouseover', function() {
			document.querySelector(".half.first .inner").style.opacity = '0';
		});

		document.querySelector(".half.second").addEventListener('mouseout', function() {
			document.querySelector(".half.first .inner").style.opacity = '1';
		});
	}
	}
	 
</script>

	
<script type="text/javascript">
	$(window).scroll(function() {

	if($(".table-responsive").length > 0) {
	var windowHeight = $(window).innerHeight()/2;
    var top_of_element = $(".table-responsive").offset().top + windowHeight;
    var bottom_of_element = $(".table-responsive").offset().top + $(".table-responsive").outerHeight();
    var bottom_of_screen = $(window).scrollTop() + $(window).innerHeight();
    var top_of_screen = $(window).scrollTop();

    if ((bottom_of_screen > top_of_element) && (top_of_screen < bottom_of_element)){
        // element widoczny, pokaz strzalki na mobile
		$(".table-responsive").addClass('mobile-arrows');
    } else {
        // element niewidoczny, ukrj strzalki na mobile
		$(".table-responsive").removeClass('mobile-arrows');
    }
}
});

</script>
<script type="text/javascript" >



// Get the div element with the ID "monkey".
 const monkey = document.getElementById('monkey');


 if (typeof(monkey) != 'undefined' && monkey != null) {
  checkVisibility = () => {

 // Check if the div element is scrolled into view.
 if (monkey.getBoundingClientRect().top < window.innerHeight/2 ) {


	$(".meter > span").each(function () {
	  $(this)
		.data("origWidth", $(this).width())
		.width(0)
		.animate(
		  {
			width: $(this).data("origWidth")
		  },
		  1200
		);
	});
   
   
   //If you want this to happen only once then you can add line 20, if not don't remove the eventlistiner as I did in line 20(I mean delete line 20)
   window.removeEventListener('scroll', checkVisibility )
   
 }
} 


// Set a listener for the "scroll" event below the function.
window.addEventListener('scroll', checkVisibility );
}
	</script>
	
	
	
	
<script>
var x, i, j, l, ll, selElmnt, a, b, c;
/*look for any elements with the class "custom-select":*/
x = document.getElementsByClassName("custom-select-opt");
l = x.length;
for (i = 0; i < l; i++) {
  selElmnt = x[i].getElementsByTagName("select")[0];
  ll = selElmnt.length;
  /*for each element, create a new DIV that will act as the selected item:*/
  a = document.createElement("DIV");
  a.setAttribute("class", "select-selected");
  a.innerHTML = selElmnt.options[selElmnt.selectedIndex].innerHTML;
  x[i].appendChild(a);
  /*for each element, create a new DIV that will contain the option list:*/
  b = document.createElement("DIV");
  b.setAttribute("class", "select-items select-hide");
  for (j = 1; j < ll; j++) {
    /*for each option in the original select element,
    create a new DIV that will act as an option item:*/
    c = document.createElement("DIV");
    c.innerHTML = selElmnt.options[j].innerHTML;
    c.addEventListener("click", function(e) {
        /*when an item is clicked, update the original select box,
        and the selected item:*/
        var y, i, k, s, h, sl, yl;
        s = this.parentNode.parentNode.getElementsByTagName("select")[0];
        sl = s.length;
        h = this.parentNode.previousSibling;
        for (i = 0; i < sl; i++) {
          if (s.options[i].innerHTML == this.innerHTML) {
            s.selectedIndex = i;
            h.innerHTML = this.innerHTML;
            y = this.parentNode.getElementsByClassName("same-as-selected");
            yl = y.length;
            for (k = 0; k < yl; k++) {
              y[k].removeAttribute("class");
            }
            this.setAttribute("class", "same-as-selected");
            break;
          }
        }
        h.click();
    });
    b.appendChild(c);
  }
  x[i].appendChild(b);
  a.addEventListener("click", function(e) {
      /*when the select box is clicked, close any other select boxes,
      and open/close the current select box:*/
      e.stopPropagation();
      closeAllSelect(this);
      this.nextSibling.classList.toggle("select-hide");
      this.classList.toggle("select-arrow-active");
    });
}
function closeAllSelect(elmnt) {
  /*a function that will close all select boxes in the document,
  except the current select box:*/
  var x, y, i, xl, yl, arrNo = [];
  x = document.getElementsByClassName("select-items");
  y = document.getElementsByClassName("select-selected");
  xl = x.length;
  yl = y.length;
  for (i = 0; i < yl; i++) {
    if (elmnt == y[i]) {
      arrNo.push(i)
    } else {
      y[i].classList.remove("select-arrow-active");
    }
  }
  for (i = 0; i < xl; i++) {
    if (arrNo.indexOf(i)) {
      x[i].classList.add("select-hide");
    }
  }
}
/*if the user clicks anywhere outside the select box,
then close all select boxes:*/
document.addEventListener("click", closeAllSelect);
</script>	
	


</body>
</html>