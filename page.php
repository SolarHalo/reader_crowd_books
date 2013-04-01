<?php get_header(); ?>
<!--  contaienr  -->
<div id="container">
<div id="content">

<?php while ( have_posts() ) : the_post(); ?>
<article id="post">
<!-- ===NO NEED TO A NORMAL PAGE===
    <div id="ribbon">
		<a title="Go to homepage" href="<?php echo get_settings('home'); ?>/">Home</a> > <?php the_title(); ?>
	</div>
-->
    

	<h1><?php the_title(); ?></h1>
	<hr>

	<!-- <p id="adjust_font">
		<a id="increase-font" href="#">[ A+ ]</a>
		<a id="decrease-font" href="#">[ A- ]</a>
	</p> -->
	<div class="pageParagrouph">
	<?php the_content(); ?>
    </div>
</article>

<?php endwhile; ?>

</div><!-- /content -->

</div><!--  /container  -->
<?php get_footer(); ?>