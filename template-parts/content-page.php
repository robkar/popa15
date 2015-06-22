<?php
/**
 * The template used for displaying page content in page.php
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

		<div class="entry-content col-xs-12">
			<?php the_content(); ?>
			<?php
				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'popa15' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->
		<div  class="clearfix"></div>
	</div>
	<?php edit_post_link( esc_html__( 'Edit', 'popa15' ), '<footer class="entry-footer"><span class="edit-link">', '</span></footer>' ); ?>
</article><!-- #post-## -->
