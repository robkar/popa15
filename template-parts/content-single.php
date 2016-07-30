<?php
/**
 * Template part for displaying single posts.
 *
 * @package Popaganda 2015
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div>
	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title col-xs-12">', '</h1>' ); ?>

		<div class="entry-meta">
			<?php popa15_posted_on(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content col-xs-12">
		<?php the_content(); ?>
		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'popa15' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php popa15_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</div>
</article><!-- #post-## -->
