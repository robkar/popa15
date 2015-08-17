<?php
/**
 * The template used for displaying booked artists
 *
 * @package Popaganda 2015
 */

?>
<?php if (is_front_page()) { ?>
<article id="<?php echo $post->post_name; ?>" <?php post_class(); ?>>
<?php } else { ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<?php } ?>
	<div>
		<header class="entry-header">
			<?php the_title( '<h1 class="entry-title text-uppercase col-xs-12">', '</h1>' ); ?>
		</header><!-- .entry-header -->

		<div id="artist-grid" class="entry-content row panel-group">
			<?php
			// get ID of artist page
			$progpage = get_page_by_path('program/artister');
			$artists = get_pages(array(
				'sort_column' => 'menu_order,post_title',
				'child_of' => $progpage->ID
			));
			foreach ($artists as $artist) {
				setup_postdata($artist);
				?>
				<div class="artist col-xs-6 col-md-4 panel">
					<?php
						$playtime = get_post_meta($artist->ID, "time", true);
						if ($playtime && get_theme_mod('show_day')) {
							setlocale(LC_ALL, 'sv_SE.UTF8');
							$utime = strtotime($playtime);
							$dayclass = sanitize_title(strftime("%A", $utime));
							$day = strftime("%A", $utime);
							echo '<div class="day day-' . $dayclass .
								' img-circle"><span class="abbr">' .
								$day[0] .
								'</span> <span class="full">' .
								$day .
								'</span></div>';
						}
					?>
					<div class="panel-heading">
						<h3 class="panel-title text-uppercase"><?php echo $artist->post_title; ?></h3>
					</div>
					<?php
					$fullimg = wp_get_attachment_image_src( get_post_thumbnail_id( $artist->ID ), 'full' );
					echo get_the_post_thumbnail($artist->ID, "post-thumbnail", array(
						'data-parent' => '#artist-grid',
						'data-toggle' => 'collapse',
						'data-target' => '#artist-' . $artist->post_name,
						'data-fullimage' => $fullimg[0]
					)); ?>
					<div id="artist-<?php echo $artist->post_name; ?>" class="col-xs-12 collapse">
						<?php echo apply_filters('the_content',get_the_content()); ?>
						<?php echo get_meta($artist->ID); ?>
					</div>
				</div><?php
				wp_reset_postdata();
			}

			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
