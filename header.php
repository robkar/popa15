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
<meta property="og:url" content="<?php the_permalink();?>" />
<meta property="og:title" content="<?php is_front_page() ? bloginfo('name') : wp_title('|', true, 'right'); ?>" />
<?php if (is_front_page()) { ?><meta property="og:description" content="#popa16" />
<?php } ?>
<meta property="og:image" content="<?= get_template_directory_uri() ?>/img/anka16.fb.png" />

<!-- Facebook Pixel Code -->
<script>
!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
document,'script','https://connect.facebook.net/en_US/fbevents.js');

fbq('init', '1320960847932998');
fbq('track', "PageView");</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1320960847932998&ev=PageView&noscript=1"
/></noscript>
<!-- End Facebook Pixel Code -->

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
