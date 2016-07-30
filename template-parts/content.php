<?php
/**
 * Template part for displaying posts.
 *
 * @package Popaganda 2015
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div>
		<div class="panel">
			<div class="panel-header">
				<header class="entry-header">
					<?php the_title( sprintf( '<h1 class="entry-title col-xs-12"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h1>' ); ?>

				</header><!-- .entry-header -->
			</div> <!-- .panel-header -->
			<div class="panel-body">
			<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<?php popa15_posted_on(); ?>
			</div><!-- .entry-meta -->
			<?php endif; ?>
				<div class="entry-content col-xs-12">
		<?php
			/* translators: %s: Name of current post */
			the_content( sprintf(
				wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'popa15' ), array( 'span' => array( 'class' => array() ) ) ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			) );
		?>

		<?php
			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'popa15' ),
				'after'  => '</div>',
			) );
		?>
				</div><!-- .entry-content -->
			</div><!-- .panel-body -->

	<footer class="entry-footer">
		<?php popa15_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</div><!-- .panel -->
</div>
</article><!-- #post-## -->
