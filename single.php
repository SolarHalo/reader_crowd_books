<?php get_header(); ?>
<script type="text/javascript">
<!--
var ratingsL10n={"plugin_url":"<?php echo get_site_url(); ?>\/wp-content\/plugins\/wp-postratings","ajax_url":"<?php echo get_site_url(); ?>\/wp-admin\/admin-ajax.php","text_wait":"Please rate only 1 post at a time.","image":"stars_crystal","image_ext":"gif","max":"5","show_loading":"0","show_fading":"0","custom":"0"};var ratings_mouseover_image=new Image();ratings_mouseover_image.src=ratingsL10n.plugin_url+"/images/"+ratingsL10n.image+"/rating_over."+ratingsL10n.image_ext;;

//-->
</script>
<script type='text/javascript' src='<?php echo get_site_url(); ?>/wp-content/plugins/wp-postratings/postratings-js.js'></script>

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
			<?php 
			 $booksql = "select ter.* from wp_term_relationships ship 
				join wp_term_taxonomy tax 
				on tax.term_taxonomy_id = ship.term_taxonomy_id and ship.object_id = '".get_the_ID()."' 
				join wp_terms ter 
				on ter.term_id = tax.term_id and tax.taxonomy = 'series' ";
			 global $wpdb;
			 $bookName = "";
			 $bookSlug = "";
			 $books = $wpdb->get_results($booksql);
			 foreach ($books as $book){
			 	$bookName = $book->name;
			 	$bookSlug = $book->slug;
			 	break;
			 }
			?>
			<a title="<?php echo $bookName;?>" href="<?php echo get_site_url(); ?>/?series=<?php echo $bookSlug;?>"><?php echo $bookName;?></a>
			>
			<?php the_title(); ?>
		 <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
			
		</h6>
		
        <div class ="readingText">
		<?php the_content()?>
		<div>
        
		<div id="commentform" class="mt20">
<!--			<div class="clmu Author">
				<h5 class="title">Author's Note</h5>

			</div>
--> 
 <?php 
        	    $userpoto = getUserPotoPath( get_the_author_meta( 'ID' ));
        	 ?>
            	
			<div id="postauthor">
				  <img src="<?php echo $userpoto;?>"  width="43" height="43"/>   <span>About:<?php the_author_posts_link();?></span>  <a
					href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ) );?>">More Posts</a> </span>
			</div>
      <!--  
			the commont source
	 -->
	 <?php comments_template( '', true ); ?>
	 
	<?php endwhile; ?>
</div>
	<?php get_footer(); ?>
