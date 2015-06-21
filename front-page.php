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
		<footer class="footer">
			<div class="container">
				<a href="http://www.visitstockholm.com"><img src="<?= get_template_directory_uri() ?>/img/spons-sthlm-2015.png" alt="Stockholm - the Capital of Scandinavia" /></a>
				<a href="http://www.norrlandsguld.se"><img src="<?= get_template_directory_uri() ?>/img/spons-ng-2015.png" alt="Norrlands Guld alkoholfri" /></a>
			</div>
		</footer>
	</div>
	<div id="primary" class="content-area container">
		<main id="main" class="site-main" role="main">

			<?php //while ( have_posts() ) : the_post(); ?>

				<?php //get_template_part( 'template-parts/content', 'page' ); ?>

			<?php //endwhile; // End of the loop. ?>

			<?php
			// "one-page" section - all items on main menu get included
			$menu_name  = 'primary';
			$locations  = get_nav_menu_locations();
			$menu       = wp_get_nav_menu_object( $locations[$menu_name] );
			$menuitems = wp_get_nav_menu_items( $menu->term_id );
			// Loop through menu items to get page ID's
			foreach ($menuitems as $item):
				// DEBUG
				//echo '<pre>';
				//var_dump($item);
				//var_dump(get_post_meta($item->ID));
				//echo '</pre>';
				//echo '<br>';

				// Setup page
				$pageid = $item->object_id;
				global $post;
				$post = get_post($pageid, OBJECT);
				setup_postdata($post);
				// Get page template
				$template_file = get_page_template_slug($pageid);
				$template_slug = pathinfo($template_file, PATHINFO_FILENAME);
				$template      = str_replace('page-', '', $template_slug);
				// DEBUG
				//echo get_the_title($post->ID)  . '<br>';
				//echo $template_slug . '<br>'. $template . '<br>';

				// Get template parts
				if ($template) {
					get_template_part('template-parts/content-page', $template);
				} else {
					get_template_part( 'template-parts/content', 'page' );
				}

				wp_reset_postdata();
			endforeach;

			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
