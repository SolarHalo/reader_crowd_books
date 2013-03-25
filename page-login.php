<?php get_header(); ?>
<!--  contaienr  -->
<div id="container">
<div id="content">

<?php while ( have_posts() ) : the_post(); ?>
<article id="post" class="login_page">
	<div id="ribbon">
		<a title="Go to homepage" href="<?php echo get_settings('home'); ?>/">Home</a> > <?php the_title(); ?>
	</div>

	<h1><?php the_title(); ?></h1>

	<?php the_content(); ?>
</article>

<?php endwhile; ?>

</div><!-- /content -->

<?php get_sidebar(); ?>

</div><!--  /container  -->
<?php get_footer(); ?>