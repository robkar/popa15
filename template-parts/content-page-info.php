<?php
/**
 * The template used for displaying faq entries
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

	<div class="entry-content row">
		<?php
		// get ID of info page
		$infopage = get_page_by_path('info');
		$faqs = get_pages(array(
			'sort_column' => 'menu_order,post_title',
			'child_of' => $infopage->ID
		));
		foreach ($faqs as $faq) {
			setup_postdata($faq);
			?>
			<div class="col-xs-12 col-md-6">
				<div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title"><a class="faq-title" href="#faq-<?php echo $faq->post_name;?>" data-toggle="collapse"><?php echo $faq->post_title; ?></a></h3>
					</div>
					<div id="faq-<?php echo $faq->post_name; ?>" class="collapse panel-body">
						<?php echo get_the_content()?>
					</div>
				</div>
			</div>

			<?php
			wp_reset_postdata();
		}

		?>
	</div><!-- .entry-content -->
</article><!-- #post-## -->
