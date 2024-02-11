<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="profile" href="http://gmpg.org/xfn/11">
	
	<meta name="theme-color" content="#EC6500" />
	
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon">
	
	<?php if (is_front_page()){ ?>
	
	<?php } ?>
	
	<?php if (is_category('aktualnosci') || in_category('aktualnosci')){ ?>
		<style>
			#main-nav-third{display:none!important;}
		</style>
	<?php } ?>

	<?php if (is_category('inwestycje') || is_category('realizacje-deweloper') || in_category('inwestycje') || in_category('realizacje-deweloper')){ ?>
		<style>
			.hidden-services{display:none;}
		</style>
	<?php } ?>

	<?php if (is_category('inwestycje-komercyjne') || in_category('inwestycje-komercyjne') || is_category('inwestycje-mieszkaniowe') || in_category('inwestycje-mieszkaniowe')
		 || is_category('inwestycje-przemyslowe') || in_category('inwestycje-przemyslowe') || is_category('inwestycje-uzytecznosci-publicznej') || in_category('inwestycje-uzytecznosci-publicznej')
	){ ?>
		<style>
			.hidden-realizations{display:none;}
		</style>
	<?php } ?>	
	
	<?php if (is_page('deweloper')){ ?>
		<style>
			.developer-search{padding-bottom:0!important;}
			.only-dev{background:#090909;}
			.current-invest-search{margin-top:0!important;}
			.checkbox-container{border:2px solid #707070!important;}
			.checkbox-container::before{border-bottom:2px solid #707070!important;}
			.image_search_form .row.panel{background-color:#090909!important;padding:0!important;margin-bottom:80px;}
			.image_search_form select,.checkbox-container{background:transparent!important;color:#fff!important;}
			.no-input{background:transparent!important;color:#fff!important;}
			#powierzchnia_content{background:#090909!important;color:#fff!important;}
			.ui-slider-range.ui-corner-all.ui-widget-header{background:#707070!important;}
			.ui-state-default, .ui-widget-content .ui-state-default, .ui-widget-header .ui-state-default{border:0!important;}
			
			.only-dev-real{padding-top:118px;padding-bottom:50px;background:#fff;margin-bottom:110px;}
		</style>
	<?php } ?>
	
	
<?php wp_head(); ?>


	<?php if (is_page('test')){ ?>
	
		<style>



	
		</style>
		
	<?php } ?>



</head>

<body <?php body_class(); ?>>

<?php 

    // WordPress 5.2 wp_body_open implementation
    if ( function_exists( 'wp_body_open' ) ) {
        wp_body_open();
    } else {
        do_action( 'wp_body_open' );
    }

?>

<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wp-bootstrap-starter' ); ?></a>
    <?php if(!is_page_template( 'blank-page.php' ) && !is_page_template( 'blank-page-with-container.php' )): ?>
	<header id="masthead" class="site-header navbar-static-top <?php echo wp_bootstrap_starter_bg_class(); ?>" role="banner">
        <div class="container">
            <nav class="navbar navbar-expand-xl p-0">
                <div class="navbar-brand">
				
					<?php if (is_front_page()){ ?>
						<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="CalBud">
	
					<?php } else { ?>	
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
							<img src="<?php echo get_template_directory_uri(); ?>/img/logo.svg" alt="CalBud">
						</a>
						
						<?php if (is_page('kontakt-deweloper') || is_page('deweloper') || is_page('realizacje') || in_category('realizacje-deweloper') || in_category('inwestycje')){ ?>
							<h6>Deweloper</h6>
						<?php } ?>
						
						<?php if (is_page('kontakt-generalny-wykonawca') || is_page('zakres-uslug') || is_page('generalny-wykonawca')
							|| in_category('inwestycje-komercyjne') || in_category('inwestycje-mieszkaniowe') || in_category('inwestycje-przemyslowe') || in_category('inwestycje-uzytecznosci-publicznej')
							|| is_page('inwestycje-komercyjne') || is_page('inwestycje-mieszkaniowe') || is_page('inwestycje-przemyslowe') || is_page('inwestycje-uzytecznosci-publicznej')
						){ ?>
							<h6>Wykonawca</h6>
						<?php } ?>
						
					<?php } ?>

                </div>

<!-- 		 
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-nav" aria-controls="" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button> -->
				 
                
				
                <?php /*
                wp_nav_menu(array(
                'theme_location'    => 'primary',
                'container'       => 'div',
                'container_id'    => 'main-nav',
                'container_class' => 'collapse navbar-collapse justify-content-end',
                'menu_id'         => false,
                'menu_class'      => 'navbar-nav',
                'depth'           => 3,
                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                'walker'          => new wp_bootstrap_navwalker()
                ));
                */
                ?>
				
				
                <?php
                wp_nav_menu(array(
                'theme_location'    => 'secondary',
                'container'       => 'div',
                'container_id'    => 'main-nav-second',
                'container_class' => 'collapse navbar-collapse justify-content-end',
                'menu_id'         => false,
                'menu_class'      => 'navbar-nav',
                'depth'           => 3,
                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                'walker'          => new wp_bootstrap_navwalker()
                ));
                ?>
				
                <?php
                wp_nav_menu(array(
                'theme_location'    => 'tertiary',
                'container'       => 'div',
                'container_id'    => 'main-nav-third',
                'container_class' => 'collapse navbar-collapse justify-content-end',
                'menu_id'         => false,
                'menu_class'      => 'navbar-nav',
                'depth'           => 3,
                'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
                'walker'          => new wp_bootstrap_navwalker()
                ));
                ?>
	

            </nav>
        </div>
	</header><!-- #masthead -->
	
	
	
	
	<?php if (is_page('test')){ ?>
	
	
	
	
	

<section id="two-sides">

<div class="first">
<div class="wrapper">
<a href="http://calbud.virtual-people.com.pl/deweloper/">
<img src="" width="1920" height="968" data-src="<?php echo get_template_directory_uri(); ?>/img/hp-top-deweloper.jpg" />
</a>
<div class="description">
<div class="inner">
<h6>Deweloper</h6>
<p>Vivamus sed posuere dolor, id porta</p>
<a class="check" href="http://calbud.virtual-people.com.pl/deweloper/">Sprawdź</a>
</div>
</div>
</div>

<div class="arrows">
<span class="arrow-left"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-left.png" alt="CalBud"></span>
<span class="arrow-right"><img src="<?php echo get_template_directory_uri(); ?>/img/arrow-right.png" alt="CalBud"></span>
</div>

</div>

<div class="second">
<a href="http://calbud.virtual-people.com.pl/generalny-wykonawca/">
<img src="" width="1920" height="968" data-src="<?php echo get_template_directory_uri(); ?>/img/hp-top-gw.jpg" />
</a>
<div class="description">
<div class="inner">
<h6>Generalny
wykonawca</h6>
<p>Vivamus sed posuere dolor, id porta</p>
<a class="check" href="http://calbud.virtual-people.com.pl/generalny-wykonawca/">Sprawdź</a>
</div>
</div>
</div>

<div class="hover">
<div class="cleft" onclick="location.href='http://calbud.virtual-people.com.pl/deweloper/'">
</div>
<div class="cright" onclick="location.href='http://calbud.virtual-people.com.pl/generalny-wykonawca/'">
</div>
</div>


</section>






<script type="litespeed/javascript">
jQuery(document).ready(function($){$('#two-sides .cleft').on('mouseenter',function(){$('#two-sides .first').addClass('active').removeClass('noactive')});$('#two-sides .cright').on('mouseenter',function(){$('#two-sides .first').addClass('noactive').removeClass('active')});$('#two-sides').on('mouseleave',function(){$('#two-sides .first').removeClass('active').removeClass('noactive')})})
</script> 

<script>const litespeed_ui_events=["mouseover","click","keydown","wheel","touchmove","touchstart"];var urlCreator=window.URL||window.webkitURL;function litespeed_load_delayed_js_force(){console.log("[LiteSpeed] Start Load JS Delayed"),litespeed_ui_events.forEach(e=>{window.removeEventListener(e,litespeed_load_delayed_js_force,{passive:!0})}),document.querySelectorAll("iframe[data-litespeed-src]").forEach(e=>{e.setAttribute("src",e.getAttribute("data-litespeed-src"))}),"loading"==document.readyState?window.addEventListener("DOMContentLoaded",litespeed_load_delayed_js):litespeed_load_delayed_js()}litespeed_ui_events.forEach(e=>{window.addEventListener(e,litespeed_load_delayed_js_force,{passive:!0})});async function litespeed_load_delayed_js(){let t=[];for(var d in document.querySelectorAll('script[type="litespeed/javascript"]').forEach(e=>{t.push(e)}),t)await new Promise(e=>litespeed_load_one(t[d],e));document.dispatchEvent(new Event("DOMContentLiteSpeedLoaded")),window.dispatchEvent(new Event("DOMContentLiteSpeedLoaded"))}function litespeed_load_one(t,e){console.log("[LiteSpeed] Load ",t);var d=document.createElement("script");d.addEventListener("load",e),d.addEventListener("error",e),t.getAttributeNames().forEach(e=>{"type"!=e&&d.setAttribute("data-src"==e?"src":e,t.getAttribute(e))});let a=!(d.type="text/javascript");!d.src&&t.textContent&&(d.src=litespeed_inline2src(t.textContent),a=!0),t.after(d),t.remove(),a&&e()}function litespeed_inline2src(t){try{var d=urlCreator.createObjectURL(new Blob([t.replace(/^(?:<!--)?(.*?)(?:-->)?$/gm,"$1")],{type:"text/javascript"}))}catch(e){d="data:text/javascript;base64,"+btoa(t.replace(/^(?:<!--)?(.*?)(?:-->)?$/gm,"$1"))}return d}</script>

	
	
	
	
	<?php } ?>
	
	
	
	
	
	
	<div id="content" class="site-content">
		<div class="container<?php if (in_category('Inwestycje')){ ?>-fluid container-inwestycje<?php } ?>">
			<div class="row">
                <?php endif; ?>