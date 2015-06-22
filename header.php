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

<body <?php body_class(); ?><?php if (is_front_page()) {echo 'data-spy="scroll" data-target="#site-navigation"';} ?>>
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-5032980-3', {'allowAnchor': true});
ga('send', 'pageview');

</script>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'popa15' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		<nav id="site-navigation" class="main-navigation navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container-fluid">
				<div class="navbar-header">
		      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-navigation-menu">
		        <span class="sr-only">Toggle navigation</span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		        <span class="icon-bar"></span>
		      </button>
		      <a class="navbar-brand" href="<?php echo home_url( '/', $scheme = 'relative' ); ?>">
		        <?php bloginfo('name'); ?>
		      </a>
		    </div>
				<div id="site-navigation-menu" class="collapse navbar-collapse">
					<ul class="social navbar-right">
						<li><a class="facebook" href="http://www.facebook.com/popagandasthlm" title="Popaganda på Facebook" alt="Popaganda på Facebook"></a></li>
						<li><a class="twitter" href="http://www.twitter.com/popagandasthlm" title="Popaganda på Twitter" alt="Popaganda på Twitter"></a></li>
						<li><a class="instagram" href="http://instagram.com/popagandasthlm" title="Popaganda på Instagram" alt="Popaganda på Instagram"></a></li>
						<li><a class="spotify" href="https://open.spotify.com/user/popagandastockholm" title="Popaganda på Spotify" alt="Popaganda på Spotify"></a></li>
					</ul>
					<div class="container">
						<?php wp_nav_menu( array(
							'theme_location' => 'primary',
							'menu_id' => 'primary-menu',
							'depth' => 2,
							'container' => false,
							'menu_class' => 'nav navbar-nav text-uppercase',
							'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
							'items_wrap' => '<ul id="%1$s" class="%2$s">%3$s</ul>',
			        'walker' => new wp_bootstrap_navwalker()) ); ?>
						</div>
				</div>
			</div>
		</nav><!-- #site-navigation -->
	</header><!-- #masthead -->

	<div id="content" class="site-content">
