<?php get_header(); ?>
<!--
	====DO NOT NEED THE SIDE NAV FOR READING PAGE====
<div id="conter" class="fl">
	<div class="book-left">
		<div class="clmu fl bgcolor1" id="bookconter-ls_elite">
			<h5 class="title">Elite Chronilces</h5>
			<ul class="index-list">
				<li><a href="#">What is this?</a></li>
				<li><a href="#">Current Event</a></li>
				<li><a href="#">Playbook</a></li>
				<li><a href="#">Elite Universe</a></li>
			</ul>
			<h5 class="title mt20">Genres</h5>
			<ul class="index-list">
				<li><a href="#">What is this?</a></li>
				<li><a href="#">Current Event</a></li>
				<li><a href="#">Playbook</a></li>
				<li><a href="#">Elite Universe</a></li>
				<li><a href="#">Elite Universe</a></li>
			</ul>
		</div>
		<div class="clmu fl tag">
			<h5 class="title">Tags</h5>
			<ul class="index-list">
				<li><a href="#">What is this?</a></li>
				<li><a href="#">Current Event</a></li>
				<li><a href="#">Playbook</a></li>
				<li><a href="#">Elite Universe</a></li>
				<li><a href="#">Playbook</a></li>
				<li><a href="#">Elite Universe</a></li>
			</ul>
		</div>
	</div>
-->
	<div class="clmu fl" id="book_mc_featured">
	<?php while (have_posts()):the_post();?>
		<h6 class="subnav">
       
			<a title="Go to homepage" href="<?php echo get_settings('home'); ?>/">Home</a>
			>
			<?php the_title(); ?>
		</h6>
		
        <div class ="readingText">
		<?php the_content()?>
		<div>
        
		<div id="commentform" class="mt20">
<!--			<div class="clmu Author">
				<h5 class="title">Author's Note</h5>

			</div>
-->
			<div id="postauthor">
				<img src="images/photo04.jpg" /> <span>About</span> <span>Mail&nbsp;&nbsp;|&nbsp;&nbsp;<a
					href="#">More Posts(8)</a> </span>
			</div>
      <!--  
			the commont source
	 -->
	 <?php comments_template( '', true ); ?>
	 
	<?php endwhile; ?>
</div>
	<?php get_footer(); ?>
</div>
</body>
</html>
