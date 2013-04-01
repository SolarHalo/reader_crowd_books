<?php get_header(); ?>
<!--  contaienr  -->
<div id="container">
<div id="content">

<h1>Blog</h1>
<?php while ( have_posts() ) : the_post(); ?>
<hr>
<div class="post_item">
	<h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>

	<p class="post_details">
		<span class="date"><?php the_time('j F, Y'); ?></span></p>
<!--	====NO NEED====
<span class="author">Published by <?php the_author_posts_link(); ?></span> / 
-->
	<P class="blogExcerpt">
	<?php
    the_excerpt_max_charlength(500);

?>
<a class="read_more" href="<?php echo get_permalink(); ?>">Read more</a></P>
    
	<P> <span class="comments"><?php comments_popup_link('No comment yet', '1 Comment', '% Comments'); ?></span> </P>
</div>
<?php endwhile; ?>

<?php content_nav( 'nav-below' ); ?>

</div><!-- /content -->

</div><!--  /container  -->
<?php get_footer(); ?>