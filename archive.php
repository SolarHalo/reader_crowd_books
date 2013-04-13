<?php get_header(); ?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<script type="text/javascript">
function AddFavorite(){
	   
	   var sURL = document.URL;
	   var sTitle = location.href;

	   try
	    {
	        window.external.addFavorite(sURL, sTitle);
	    }
	    catch (e)
	    {
	        try
	        {
	            window.sidebar.addPanel(sTitle, sURL, "");
	        }
	        catch (e)
	        {
	            alert("add to favorite failed,please press 'CTRL+D'");
	        }
	    }

	}
</script>
<div id="conter" class="bookcontent mt30 fl">
	<h1>
	<?php single_cat_title();?>
		<strong> <?php
		$current_category = single_cat_title("", false);
		$currnt_term_id = getSeriesIDByName($current_category);
		echo getAuthorByTermID(getSeriesIDByName($current_category));
		?> </strong>
	</h1>
	<div class="ratings fl">
		 <?php echo getRationgBySeriesId($currnt_term_id);
		  // echo $current_category;
		 ?>
	</div>
	<div class="mark fl">
		<a href="javascript:AddFavorite();"><img
			src="<?php echo get_template_directory_uri();?>/images/bookmark-ioc.gif"
			onclick="AddFavorite();" /> Book mark</a>
	</div>
	
	<div class="share">
	<div class="fb-like" data-href="http://elitechronicles.tk/?series=coyote" data-send="true" data-width="450" data-show-faces="true"></div>
	<a href="https://twitter.com/share" class="twitter-share-button" data-url="http://elitechronicles.tk/?series=coyote">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
		<span><a href="#"><img
				src="<?php echo get_template_directory_uri(); ?>/images/like-ioc.gif" />
		</a> <font>2.2K</font> </span> <span><a href="#"><img
				src="<?php echo get_template_directory_uri(); ?>/images/tweter-ioc.gif" />
		</a><font>2.5K</font> </span> <span><a href="#"><img
				src="<?php echo get_template_directory_uri(); ?>/images/+2-ioc.gif" />
		</a><font>2</font> </span>

	</div>
	<div class="bookcontentbox">
		<img
			src="<?php echo getBookImg(getSeriesIDByName($current_category)); ?>"
			class="fl" width="181" height="270" />
		<p> <?php echo getBoookDescription(getSeriesIDByName($current_category))?></p>
		<ul>
			<li><strong>Category:</strong>
			<?php //$category = get_the_category(); 
				$category = getBookGenres(getSeriesIDByName($current_category));
			?>
			 <a href="<?php echo get_category_link($category[0]->term_id )?>">
			 <?php   
				   echo $category[0]->cat_name
			  ?></a>
			</li>
			<li><strong>Words:</strong> <?php echo countTheWordsByTermId(getSeriesIDByName($current_category));?>
			</li>
			<li><strong>Progress:</strong>Finished</li>
			<li><strong>Tags:</strong><?php echo getBoookTag(getSeriesIDByName($current_category))?></li>
		</ul>



	</div>
	<div class="bookboxlist">
		<ul class="list-title">
			<li class="titleChapter">Chapter</li>
			<li class="titleContent">Content</li>
			<li class="titleWords">Words</li>
			<li class="titleViews">Views</li>
			<li class="titleRating">Rating</li>
			<li class="titleLast">Last Upadte</li>
		</ul>

		<?php while ( have_posts() ) : the_post(); ?>

		<ul>
			<li class="titleChapter"><?php the_ID()?></li>
			<li class="titleContent"><a href="?p=<?php the_ID()?>"><?php the_title()?>
			</a></li>
			<li class="titleWords"><?php  echo wcount();?></li>
			<li class="titleViews"><?php get_post_clicked_nums(the_ID())?></li>
			<li class="titleRating">
				<div class="ratingsbox">
				<?php 
				   $postid = get_the_ID(); 
				  get_post_rating($postid);
				?>
				</div>
			</li>
			<li class="titleLast"><?php the_modified_date()?></li>
		</ul>


		<?php endwhile; ?>
	</div>
	<div class="total">
		<font>Total Views:<?php echo getBookTotalView(getSeriesIDByName($current_category))?></font> <font>Total Bookmarks:100</font> <font>Total
			Comments:<?php echo getBookTotalComments(getSeriesIDByName($current_category))?></font>
	</div>
</div>
<?php get_footer(); ?>

