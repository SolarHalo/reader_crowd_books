<?php get_header(); ?>
<!--  contaienr  -->
<div id="container">
<div id="content">
<?php
	if(get_query_var('author_name')) :
		$curauth = get_userdatabylogin(get_query_var('author_name'));
	else :
		$curauth = get_userdata(get_query_var('author'));
	endif;
?>

<div id="author_details">
	<?php echo get_avatar( $curauth->ID , 80 ); ?>
	<h4><?php echo $curauth->first_name; ?> <?php echo $curauth->last_name; ?></h4>
	<p><?php echo $curauth->description; ?></p>
</div>

<div id="post_list">
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

</div>

</div><!-- /content -->

<?php get_sidebar(); ?>

</div><!--  /container  -->
<?php get_footer(); ?>