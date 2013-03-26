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
		<p>Captain Hesperus, a grey furry feline from Orrira, wiped goat soup
			from his eyes and sighed. A torsion wave, burped out from the badly
			maintained engines of the Dubious Profit, had slid through the ship's
			mess just as he and his crew were sitting down to dine. Local s
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
			<li class="titleWords"><?php $str=the_content();count_words($str)?></li>
			<li class="titleViews"><?php get_post_clicked_nums(the_ID())?></li>
			<li class="titleRating">
				<div class="ratingsbox">
				<?php get_post_rating(the_ID())?>
				</div>
			</li>
			<li class="titleLast"><?php the_modified_date()?></li>
		</ul>

		
		<?php endwhile; ?>
	</div>
</div>
		<?php get_footer(); ?>
</div>
</body>
</html>
