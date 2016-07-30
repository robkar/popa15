<?php
/**
 * The template for displaying the front page.

 *
 * @package Popaganda 2015
 */

get_header(); ?>
	<div class="container">
		<div class="jumbotron"><?php if (get_theme_mod('show_buytix')) { ?>
			<a href="https://secure.tickster.com/Intro.aspx?ERC=F1JTUGWJZ4RNXCJ" id="biljettbubbla" target="_blank">
				<img src="<?= get_template_directory_uri() ?>/img/popa15_biljettbubbla_svart.png" alt="K&ouml;p biljett nu!"/>
			</a><?php } # end show_buytix ?>
			<a href="https://www.facebook.com/popagandasthlm/events/" target="_blank"><img src="<?= get_template_directory_uri() ?>/img/anka16.min.png" class="main-logo img-responsive" /></a>
		</div>
		<div class="row">
			<a href="https://www.facebook.com/popagandasthlm/events/" target="_blank"><?php
			// fetch lineup (or other) image from featured image of latest published
			// post in category "framsida"
			$query_mainimg = new WP_Query('category_name=framsida&posts_per_page=1');
			$query_mainimg->the_post();
			echo get_the_post_thumbnail( $post->ID, 'full' , array(
				'class' => 'img-responsive lineup'
			));
			wp_reset_postdata();
			?></a>
		</div>
		<footer class="footer">

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

				if ( $item->type != "custom" ) {
					// Setup page
					$pageid = $item->object_id;
					global $post;
					$post = get_post($pageid, OBJECT);
					setup_postdata($post);
					// Get page template
					//$template_file = get_page_template_slug($pageid);
					//$template_slug = pathinfo($template_file, PATHINFO_FILENAME);
					//$template      = str_replace('page-', '', $template_slug);
					// DEBUG
					//echo get_the_title($post->ID)  . '<br>';
					//echo $template_slug . '<br>'. $template . '<br>';

					// Get template parts
					//if ($template) {
						get_template_part('template-parts/content-page', $post->post_name);
					//} else {
					//	echo "hej";
					//	get_template_part( 'template-parts/content', 'page' );
					//}

					wp_reset_postdata();
				}
			endforeach;

			?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
