<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package Popaganda 2015
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'popa15' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-navigation">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="<?php echo home_url(); ?>">
		        <?php bloginfo('name'); ?>
		      </a>
		    </div>

				<?php wp_nav_menu( array(
					'theme_location' => 'primary',
					'menu_id' => 'primary-menu',
					'depth' => 2,
					'container' => 'div',
					'container_class' => 'collapse navbar-collapse',
					'menu_class' => 'nav navbar-nav',
					'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
	        'walker' => new wp_bootstrap_navwalker()) ); ?>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
