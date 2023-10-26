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
	
	
	
	
<?php wp_head(); ?>





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
	
	
	<div id="content" class="site-content">
		<div class="container">
			<div class="row">
                <?php endif; ?>