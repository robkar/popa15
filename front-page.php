<?php
/**
 * The template for displaying the front page.

 *
 * @package Popaganda 2015
 */

get_header(); ?>
	<div class="container">
	<div class="jumbotron">
		<a href="https://www.facebook.com/events/433784926799972/" target="_blank"><img src="<?= get_template_directory_uri() ?>/img/anka15.min.png" class="main-logo img-responsive" /></a>
		<a href="https://secure.tickster.com/Intro.aspx?ERC=XWJEVF5MPP5C0T8&t=RR507B1K" role="button" class="btn btn-lg btn-primary" onclick="var w=820, h=600, l = (screen.width - w) / 2, t = (screen.height - h) / 2; window.open(this.href, '', 'width='+w+', height='+h+', left='+l+', top='+t+',scrollbars=yes'); return false">Köp Early Bird-biljett här!</a>
	</div>
	<div class="row">
		<a href="https://www.facebook.com/events/433784926799972/" target="_blank">
			<img class="img-responsive lineup" src="<?= get_template_directory_uri() ?>/img/lineup.png" alt="James Blake [UK], Seinabo Sey, Mø [DK], Lorentz, Amason, Elliphant och Joel Alme spelar på Popaganda 2015. Fler artister tillkommer. #popa15"/>
		</a>
	</div>
	<div class="row social">
			<ul>
				<li><a class="facebook" href="http://www.facebook.com/popagandasthlm" title="Popaganda på Facebook" alt="Popaganda på Facebook"></a></li>
				<li><a class="twitter" href="http://www.twitter.com/popagandasthlm" title="Popaganda på Twitter" alt="Popaganda på Twitter"></a></li>
				<li><a class="instagram" href="http://instagram.com/popagandasthlm" title="Popaganda på Instagram" alt="Popaganda på Instagram"></a></li>
				<li><a class="spotify" href="https://open.spotify.com/user/popagandastockholm" title="Popaganda på Spotify" alt="Popaganda på Spotify"></a></li>
			</ul>
	</div>
	<footer class="footer">
		<div class="container">
			<a href="http://www.visitstockholm.com"><img src="<?= get_template_directory_uri() ?>/img/spons-sthlm-2015.png" alt="Stockholm - the Capital of Scandinavia" /></a>
			<a href="http://www.norrlandsguld.se"><img src="<?= get_template_directory_uri() ?>/img/spons-ng-2015.png" alt="Norrlands Guld alkoholfri" /></a>
		</div>
	</footer>
	</div>
	<div id="primary" class="content-area container">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'template-parts/content', 'page' ); ?>

			<?php endwhile; // End of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
