<?php get_header(); ?>
<!--  contaienr  -->
<div id="container">
<div id="content">
<?php if ( have_posts() ) : ?>
	<h1><?php printf('Search Results for: %s', '<span>'.get_search_query().'</span>' ); ?></h1>

	<?php while ( have_posts() ) : the_post(); ?>
	<hr>
	<div class="post_item">
		<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>

		<p class="post_details">
			<span class="date"><?php the_time('j F, Y'); ?></span> /
			<span class="author">Published by <?php the_author_posts_link(); ?></span>
		</p>

		<?php the_excerpt(); ?>

		<a class="read_more" href="<?php echo get_permalink(); ?>">Read more...</a>
	</div>
	<?php endwhile; ?>
<?php else : ?>
	<h1><?php printf('Nothing found about: %s', '<span>'.get_search_query().'</span>' ); ?></h1>
	<hr>
	<p>Sorry, but nothing matched your search criteria. Please try again with some different keywords.</p>

	<form id="" method="get" action="<?php echo home_url(); ?>" >
		<input type="text" id="" name="s" value="" placeholder="Search...">
		<input type="submit" value="Search">
	</form>
<?php endif; ?>
</div>
</div><!-- /content -->

<?php get_sidebar(); ?>

</div><!--  /container  -->
<?php get_footer(); ?>