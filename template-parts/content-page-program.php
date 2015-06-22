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
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title text-uppercase">', '</h1>' ); ?>
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
				<h3><?php echo $artist->post_title; ?></h3>
				<?php echo get_the_post_thumbnail($artist->ID, "post-thumbnail", array(
					'data-parent' => '#artist-grid',
					'data-toggle' => 'collapse',
					'data-target' => '#artist-' . $artist->post_name
				)); ?>
				<div id="artist-<?php echo $artist->post_name; ?>" class="col-xs-12 collapse">
					<?php echo get_the_content()?>
				</div>
			</div><?php
			wp_reset_postdata();
		}

		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
