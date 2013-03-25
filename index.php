<?php get_header(); ?>
<!--  contaienr  -->
<div id="container" class="index">
	<div id="left_sidebar">
		<div id="ls_elite">
			<h2>Elite Chronilces</h2>
			<ul>
				<li><a href="<?php echo get_page_link(150); ?>">What is this?</a></li>
				<li><a href="<?php echo get_page_link(152); ?>">Top 10</a></li>
				<li><a href="<?php echo get_page_link(153); ?>">Selected Stories</a></li>
				<li><a href="<?php echo get_page_link(154); ?>">Playbook</a></li>
				<li><a href="<?php echo get_page_link(155); ?>">Elite Universe</a></li>
			</ul>
		</div>
		<div id="ls_genres">
			<h2>Genres</h2>
			<ul>
				<li><a href="<?php echo get_page_link(181); ?>">Fantasy</a></li>
				<li><a href="<?php echo get_page_link(184); ?>">Science Fiction</a></li>
			</ul>
		</div>
		<div id="ls_tags">
			<h2>Tags</h2>
			<?php the_tags('', ' '); ?>
		</div>
	</div><!-- /left_sidebar -->

	<div id="main_content">
		<div id="mc_featured">
			<h2>Featured</h2>
			<div class="featured_item">
				<div class="fi_left"><img src="http://elitechronicles.tk/wp-content/uploads/2013/02/The-Virtuous-Misfortune_DS2-66x100.png" alt=""></div>
				<div class="fi_right">
					<h3>Life Plan<span>Michael Hyatt</span></h3>
					<div class="rated">
						<p>&#9733;&#9733;&#9733;&#9733;&#9734;</p>
					</div>
					<div class="excerpt">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget lorem odio, id elementum massa. Cras arcu lacus, interdum et laoreet vitae, aliquet in odio. Etiam nec venenatis justo.</p>
					</div>
				</div>
			</div>
			<div class="featured_item">
				<div class="fi_left"><img src="http://elitechronicles.tk/wp-content/uploads/2013/02/The-Virtuous-Misfortune_DS2-66x100.png" alt=""></div>
				<div class="fi_right">
					<h3>Life Plan<span>Michael Hyatt</span></h3>
					<div class="rated">
						<p>&#9733;&#9733;&#9733;&#9733;&#9734;</p>
					</div>
					<div class="excerpt">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget lorem odio, id elementum massa. Cras arcu lacus, interdum et laoreet vitae, aliquet in odio. Etiam nec venenatis justo.</p>
					</div>
				</div>
			</div>
			<div class="featured_item">
				<div class="fi_left"><img src="http://elitechronicles.tk/wp-content/uploads/2013/02/The-Virtuous-Misfortune_DS2-66x100.png" alt=""></div>
				<div class="fi_right">
					<h3>Life Plan<span>Michael Hyatt</span></h3>
					<div class="rated">
						<p>&#9733;&#9733;&#9733;&#9733;&#9734;</p>
					</div>
					<div class="excerpt">
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec eget lorem odio, id elementum massa. Cras arcu lacus, interdum et laoreet vitae, aliquet in odio. Etiam nec venenatis justo.</p>
					</div>
				</div>
			</div>
		</div>

		<!-- top_viewed -->
		<?php the_widget(
			'MostReadPostsWidget',
			array(
				'title' => 'Top Viewed',
				'posts_number' => 5,
				'words_excluded' => '[Reader Crowd]',
				'show_hits' => true,
				'show_thumbs' => true,
			),
			array(
				'before_title' => '<h2>',
				'after_title' => '</h2>',
				'before_widget' => '<div id="mc_top_viewed">',
				'after_widget' => '</div>'
			));
		?>

		<div id="mc_latest_updated">
			<h2>Latest Update</h2>
			<?php echo TCHPCSCarousel(); ?>
		</div>
	</div><!-- /main_content -->

	<!-- right sidebar -->
	<div id="right_side">

		<!-- top_rated -->
		<?php the_widget(
			'WP_Widget_PostRatings',
			array(
				'title' => 'Top Rated',
				'type' => 'highest_rated',
				'mode' => 'post',
				'limit' => 5,
			),
			array(
				'before_title' => '<h2>',
				'after_title' => '</h2>',
				'before_widget' => '<div id="rs_top_rated">',
				'after_widget' => '</div>'
			));
		?>

		<?php the_widget(
			'phpbb_topics_portal',
			array(
				'title' => '',
				'phpbb_config_location' => "{$_SERVER['DOCUMENT_ROOT']}" . '/forum/config.php',
				'phpbb_url_location' => '',
				'exclude_forums' => '17/31/37',
				'return_list_length' => '15',
				'topic_text_length' => '30',
				'date_format' => 'j M',
			),
			array(
				'before_widget' => '<div id="rs_forum"><h2>Forum</h2><ul>',
				'after_widget' => '</ul></div>'
			));
		?>
	</div><!-- /right_sidebar -->

	<div id="bottom_content">
		<div id="left_top">
			<?php
				$post_id = 121;
				$queried_post = get_post($post_id);
				$post_link = get_permalink($post_id);
			?>
			<h2><?php echo $queried_post->post_title; ?></h2>
			<p><?php echo $queried_post->post_excerpt; ?>.. <a href="<?php echo get_permalink(); ?>">Read more</a></p>
		</div>

		<div id="right_top">
			<?php
				$post_id = 123;
				$queried_post = get_post($post_id);
				$post_link = get_permalink($post_id);
			?>
			<h2><?php echo $queried_post->post_title; ?></h2>
			<p><?php echo $queried_post->post_excerpt; ?>.. <a href="<?php echo get_permalink(); ?>">Read more</a></p>
		</div>
	</div><!-- /bottom_content -->
</div><!--  /container  -->
<?php get_footer(); ?>