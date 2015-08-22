<?php
/**
 * Template part for displaying posts.
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
		<div class="clearfix"></div>
		<div class="panel-group" id="newslist">
		<?php /* get news posts */
			$firstpost_class = " in"; // make first post expanded by default
			$news_query = new WP_Query();
			global $paged; // ugly hack to get next posts links working
			$paged = ( get_query_var('page')  ? get_query_var('page') : 1 );
			$news_query->query(array(
				'category_name' => 'nyheter',
				'posts_per_page' => '3',
				'paged' => $paged
			));
			if ($news_query->have_posts()) : while ($news_query->have_posts()) : $news_query->the_post();
		?>
			<div class="panel">
				<div class="panel-heading">
					<?php the_title( sprintf( '<h2 class="panel-title"><a href="#%s" data-toggle="collapse" data-parent="#newslist">', basename( get_permalink() ) ), '</a></h1>' ); ?>

					<?php if ( 'post' == get_post_type() ) : ?>
					<div class="entry-meta">
						<?php popa15_posted_on(); ?>
					</div><!-- .entry-meta -->
					<?php endif; ?>
				</div><!-- .panel-heading -->

				<div class="panel-collapse collapse<?php echo $firstpost_class; ?>" id="<?php echo basename( get_permalink() ); ?>">
					<div class="panel-body">
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
					</div><!-- .panel-body -->
				</div>
			</div>
	<?php
		$firstpost_class = "";
		endwhile;
		?>
			<div id="more_posts"><span class="prev"><?php
		echo get_previous_posts_link( '<span class="glyphicon glyphicon-triangle-left"></span> Nyare nyheter' );
		?></span><span class="next"><?php
		echo get_next_posts_link ( '&Auml;ldre nyheter <span class="glyphicon glyphicon-triangle-right"></span>', $news_query->max_num_pages );
		?></span></div>
		<div class="clearfix"></div>
		<?php

	endif;

		wp_reset_postdata();
	?>
		</div> <!-- #newslist -->
	</div>
	<div class="clearfix"></div>
</article><!-- #post-## -->
