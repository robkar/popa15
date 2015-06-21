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
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<div class="entry-content row">
		<?php
		// get ID of artist page
		$progpage = get_page_by_path('program/artister');
		$artists = get_pages(array(
			'sort_column' => 'menu_order,post_title',
			'child_of' => $progpage->ID
		));
		foreach ($artists as $artist) {
			?>
			<div class="artist col-xs-6 col-md-4">
				<?php echo $artist->post_title; ?>
				<?php echo get_the_post_thumbnail($artist->ID); ?>
			</div><?php
		}

		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
