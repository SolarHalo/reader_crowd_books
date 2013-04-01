<?php get_header(); ?>
<div id="conter" class="bookcontent mt30 fl">
	<h1>
		Life Plan <strong>Michael Hyatt</strong>
	</h1>
	<div class="ratings fl">
		<div class="ratingsbox">
			<img src="images/rating_on.gif" /> <img src="images/rating_on.gif" />
			<img src="images/rating_on.gif" /> <img src="images/rating_off.gif" />
			<img src="images/rating_off.gif" /> (20)
		</div>
	</div>
	<div class="mark fl">
		<a href="#"><img src="images/bookmark-ioc.gif" /> Book mark</a>
	</div>
	<div class="share">
		<a href="#"><img src="images/like-ioc.gif" /> </a> <a href="#"><img
			src="images/tweter-ioc.gif" /> </a>
	</div>
	<div class="bookcontentbox">
		<img src="images/photo01.jpg" class="fl" width="181" height="270" />
		<p> down to dine. Local s
			pacetime in the cramped little room had briefly bulged and twisted,
			gravity pulling six ways at once. A nauseous sensation at the best of
			times, and possibly at its most inconvenient when one was seated in
			front of a large bowl of hot and oily soup...</p>
		<ul>
			<li><strong>Category:</strong>Space Opera</li>
			<li><strong>Words:</strong>17766</li>
			<li><strong>Progress:</strong>Finished</li>
			<li><strong>Tags:</strong>Captain hesperus,Feline, Qudira</li>
		</ul>



	</div>
	<div class="bookboxlist">
		<ul class="list-title">
			<li class="titleChapter">Chapter</li>
			<li class="titleContent">Content</li>
			<li class="titleWords">Words</li>
			<li class="titleViews">Views</li>
			<li class="titleRating">Rating</li>
			<li class="titleLast">Last Upadte</li>
		</ul>

		<?php while ( have_posts() ) : the_post(); ?>

		<ul>
			<li class="titleChapter"><?php the_ID()?></li>
			<li class="titleContent"><?php the_title()?></li>
			<li class="titleWords"><?php count_words(the_content());?></li>
			<li class="titleViews"><?php get_post_clicked_nums(the_ID())?></li>
			<li class="titleRating">
				<div class="ratingsbox">
				<?php get_post_rating(the_ID())?>
				</div>
			</li>
			<li class="titleLast"><?php the_modified_date()?></li>
		</ul>

		<hr>
		<div class="post_item">
			<h2>
				<a href="<?php echo get_permalink(); ?>"><?php the_title(); ?> </a>
			</h2>

			<p class="post_details">
				<span class="date"><?php the_time('j F, Y'); ?> </span> / <span
					class="author">Published by <?php the_author_posts_link(); ?> </span>
				/ <span class="comments"><?php comments_popup_link('No comment yet', '1 Comment', '% Comments'); ?>
				</span>
			</p>

			<?php the_excerpt(); ?>

			<a class="read_more" href="<?php echo get_permalink(); ?>">Read
				more...</a>
		</div>
		<?php endwhile; ?>
	</div>
</div>
		<?php get_footer(); ?>
</div>
</body>
</html>
