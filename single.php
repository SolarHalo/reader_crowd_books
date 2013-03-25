<?php get_header(); ?>
<!--  contaienr  -->
<div id="container">
<div id="content">

<?php while ( have_posts() ) : the_post(); ?>
<article id="post">
	<div id="ribbon">
		<a title="Go to homepage" href="<?php echo get_settings('home'); ?>/">Home</a>
		> <?php the_category(', '); ?>
		> <?php the_title(); ?>
	</div>

	<h1><?php the_title(); ?></h1>

	<!-- <p id="adjust_font">
		<a id="increase-font" href="#">[ A+ ]</a>
		<a id="decrease-font" href="#">[ A- ]</a>
	</p> -->

	<div class="post_details">
		<span class="date"><?php the_time('j F, Y'); ?></span> /
		<span class="author">Published by <?php the_author_posts_link(); ?></span> /
		<span class="comments"><?php comments_popup_link('No comments yet', '1 Comment', '% Comments'); ?></span> /
		<span class="edit_this"><?php edit_post_link('Edit'); ?></span>
	</div>

	<div class="ratings_wrap">
		<?php if(function_exists('the_ratings')) { the_ratings(); } ?>
	</div>

	<?php if ( has_post_thumbnail()) : ?>
	<a class="thumbnail" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_post_thumbnail(); ?></a>
	<?php endif; ?>

	<?php the_content(); ?>
</article>

<div id="postauthor">
	<?php echo get_avatar( get_the_author_id() , 80 ); ?>

	<h4>Author: <?php the_author_firstname(); ?> <?php the_author_lastname(); ?></h4>

	<p><?php the_author_description(); ?></p>

	<a href="<?php bloginfo('url'); ?>/?author=<?php the_author_ID(); ?>">
		<?php the_author_firstname(); ?> <?php the_author_lastname(); ?> has wrote <?php the_author_posts(); ?> articles for us.
	</a>
</div>

<?php comments_template( '', true ); ?>

<?php endwhile; ?>

</div><!-- /content -->

<?php get_sidebar(); ?>

</div><!--  /container  -->
<?php get_footer(); ?>