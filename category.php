<?php get_header(); ?>
<!--  contaienr  -->
<div id="container">
<div id="content">

<h1>Categories for <?php single_cat_title(); ?></h1>
<?php while ( have_posts() ) : the_post(); ?>
<hr>
<div class="post_item">
	<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>

	<p class="post_details">
		<span class="date"><?php the_time('j F, Y'); ?></span> /
		<span class="author">Published by <?php the_author_posts_link(); ?></span> /
		<span class="comments"><?php comments_popup_link('No comment yet', '1 Comment', '% Comments'); ?></span>
	</p>

	<?php the_excerpt(); ?>

	<a class="read_more" href="<?php echo get_permalink(); ?>">Read more...</a>
</div>
<?php endwhile; ?>

<?php content_nav( 'nav-below' ); ?>

</div><!-- /content -->

<?php get_sidebar(); ?>

</div><!--  /container  -->
<?php get_footer(); ?>