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

			// get artists for lineup grid and schedule
			$artists = get_pages(array(
				'sort_column' => 'menu_order,post_title',
				'child_of' => $progpage->ID
			));

			// get ID of afterparty page
			$clubpage = get_page_by_path('program/efterfester');

			// get afterparties for lineup grid and schedule
			$clubs = get_pages(array(
				'sort_column' => 'menu_order,post_title',
				'child_of' => $clubpage->ID
			));

			// schedule code starts here
			if (get_theme_mod('show_schedule')) {
				// generate schedule array (of arrays, with entries artist, datetime, date, time, stage, length (in minutes))
				$schedule = array();
				setlocale(LC_ALL, 'sv_SE.UTF8');
				foreach($artists as $artist) {
					$playtimes = get_post_meta($artist->ID, "time", false);
					foreach($playtimes as $time) {
						array_push($schedule, array(
							'artist' => $artist->post_title,
							'datetime' => $time,
							'date' => strftime("%A", strtotime($time)) . date(" j/n", strtotime($time)),
							'time' => substr($time, 11),
							'stage' => get_post_meta($artist->ID, "stage", true),
							'length' => get_post_meta($artist->ID, "length", true),
							'utime' => strtotime($time) - strtotime(substr($time, 0, 10))
						));
					}
				}

				function bydatetime($a, $b) {
					return strcmp($a['datetime'], $b['datetime']);
				}
				function bytime($a, $b) {
					return strcmp($a['time'], $b['time']);
				}

				// prepare array of all dates with events
				$alldates = array();
				$alltimes = array();
				$mintime = INF;

				// count days with events, and find the earliest starting time
				usort($schedule, "bydatetime");
				$lastdate = "";
				foreach($schedule as $slot) {
					$mintime = min($mintime, $slot['utime']);
					if ($slot['date'] != $lastdate) {
						array_push($alldates, $slot['date']);
					}
					$lastdate = $slot['date'];
				}

				// output the ultimate schedule
				$cols = floor(12/count($alldates));

				// nice colours (TODO)
				$paint = array("#f25f91", "#6eb3e4", "#e8ef6b");

				echo '<div id="schedule" class="schedule"><div class="row">';

				$lastdate = "";
				$first = true;
				foreach($schedule as $slot) {
					if ($slot['date'] != $lastdate) {
						if (!$first) echo '</div>';
						echo '<div class="col-xs-12 col-md-' . $cols . '"><h3>' . $slot['date'] . '</h3>';
					}
					$first = false;
					$height = round((max(30, $slot['length']))) - 5;
					$ofs = $slot['date'] != $lastdate ? (' margin-top: ' . round(($slot['utime'] - $mintime)/40). 'px;') : '';
					echo '<div class="schedule-slot", style="height: ' . $height .
					'px; line-height: ' . $height .'px;' . $ofs .'"><span class="schedule-time">' . $slot['time'] .
					'</span> <span class="schedule-artist">' . $slot['artist'] . '</span></div>';
					$lastdate = $slot['date'];
				}
				echo "</div></div></div>";
			}

			// output artist grid
			$n_artists = count($artists);
			$n_clubs = count($clubs);
			$i = 0;
			foreach (array_merge($artists, $clubs) as $artist) {
				$i++;
				setup_postdata($artist);
				?>
				<div id="<?php echo $artist->post_name; ?>" class="artist col-xs-6 col-md-4 panel">
					<?php
						$stage = get_post_meta($artist->ID, "stage", true); // show stage if available
						if ($stage) {
							echo '<div class="stage day-inner">' . $stage . '</div>';
						}
						if (get_theme_mod('show_day')) {
							?><div class="day"><?php
							$playtimes = get_post_meta($artist->ID, "time", false);
							foreach ($playtimes as $playtime) {
								if ($playtime) {
									setlocale(LC_ALL, 'sv_SE.UTF8');
									$utime = strtotime($playtime);
									$dayclass = sanitize_title(strftime("%A", $utime));
									$day = strftime("%A", $utime);
									$time = strftime("%H:%M", $utime);
									echo '<div class="day-inner day-' . $dayclass .
										' img-circle"><span class="abbr">' .
										$day[0] .
										'</span> <span class="full">' .
										$day .
										(get_theme_mod('show_schedule')? ' ' . $time : '') . // add playtime if schedule is published
										'</span></div>';
								}
							}
							?></div><?php
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
				if ($n_clubs > 0 && $i == $n_artists) {
					echo '<div id="klubbprogram" class="col-xs-12"><div id="klubb-inner" class="col-xs-12"><h2>KLUBBPROGRAM (separat inträde)</h2></div></div>';
				}
			}

			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
