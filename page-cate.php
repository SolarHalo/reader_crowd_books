<?php
 /*
 Template Name: Category
 */
 get_header(); ?>
<!--  contaienr  -->
<div id="container">
<div id="books_wrap">
	<h1><?php the_title(); ?></h1>
	<hr>
	<?php while ( have_posts() ) : the_post(); ?>
	<?php the_content(); ?>
	<?php endwhile; ?>
</div><!-- /page_cate -->

</div><!--  /container  -->
<?php get_footer(); ?>