<?php
/**
 * The template used for displaying a compact schedule
 *
 * @package Popaganda 2015
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<meta property="og:url" content="http://m.popaganda.se" />
<meta property="og:title" content="<?php is_front_page() ? bloginfo('name') : wp_title('|', true, 'right'); ?>" />
<meta property="og:description" content="Robyn &amp; La Bagatelle Magique, Bob Hund, Seinabo Sey, James Blake [UK], Jungle [UK], Angel Haze [US], Lorentz, Shout Out Louds, Mø [DK], Laakso, Amason, Elliphant, Tove Styrke, Mapei, Sabina Ddumba, Beatrice Eli, Urban Cone, Joel Alme och Maja Francis spelar på Popaganda 2015. #popa15" />
<meta property="og:image" content="<?= get_template_directory_uri() ?>/img/anka15.fb.png" />

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> id="mobilschema" onload="var today=document.getElementById('schedule-<?php echo strftime("%F"); ?>'); ( today ? today : document.getElementById('schedule')).scrollIntoView()">
<script>
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

ga('create', 'UA-5032980-3', {'allowAnchor': true});
ga('send', 'pageview');

</script>
<div id="page" class="hfeed site">
	<div id="content" class="site-content container">
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div>
		<header class="entry-header">
			<a href="http://www.popaganda.se" target="_blank"><img src="<?= get_template_directory_uri() ?>/img/anka15.min.png" class="main-logo img-responsive" /></a>
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

				// nice colours
				$paint = array("#f25f91", "#6eb3e4", "#e8ef6b", "#f58f52", "#bbced8",
					"#d363b7", "#c5e352", "#74cfc8", "#87c7e2", "#e890cc", "#5bbceb", "#f69c57", "#ebf185");
				$npaints = count($paint);

				echo '<div id="schedule" class="schedule"><div class="">';

				$lastdate = "";
				$lastendtime = 0;
				$first = true;
				$i = 0;
				foreach($schedule as $slot) {
					if ($slot['date'] != $lastdate) {
						if (!$first) echo '</div>';
						echo '<div class="col-xs-12 col-sm-' . $cols . '" id="schedule-' . strftime("%F", strtotime($slot['datetime'])) . '"><h3>' . $slot['date'] . '</h3>';
					}
					$first = false;
					$scale = 1;
					$height = round($scale * (max(30, $slot['length'] - 5)));
					$top = $slot['date'] != $lastdate ? (round((($slot['utime'] - $mintime + ($slot['utime'] > $mintime ? 15*60 : 0))/60) * $scale)) : round($scale * (5 + ($slot['utime'] - $lastendtime)/60));
					$ofs = ' margin-top: ' . $top . 'px;';
					echo '<div class="schedule-slot", style="height: ' . $height .
					'px; line-height: ' . $height .'px; background-color: ' . $paint[$i % $npaints] . ';' . $ofs .'"><span class="schedule-time">' . $slot['time'] .
					'</span> <span class="schedule-artist">' . $slot['artist'] . '</span></div>';
					$lastdate = $slot['date'];
					$lastendtime = $slot['utime'] + ($slot['length'])* 60;
					$i++;
				}
				echo "</div></div></div>";
			}

			?>
		</div><!-- .entry-content -->
	</div>
</article><!-- #post-## -->
</div><!-- #content -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
