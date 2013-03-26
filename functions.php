<?php

// Enable Featured Images for posts
add_theme_support('post-thumbnails', array('post'));

// Enable Menu
function register_my_menus() {
	register_nav_menus(
		array( 'header-menu' => __( 'Header Menu' ) )
	);
}
add_action( 'init', 'register_my_menus' );

// Enable Widget -- Sidebar
if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'before_title' => '<h2>',
		'after_title' => '</h2>',
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
));

if ( ! function_exists( 'content_nav' ) ) :
/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since Twenty Twelve 1.0
 */
function content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text">Post navigation</h3>
			<div class="nav-previous alignleft"><?php next_posts_link( '<span class="meta-nav">&larr;</span> Older posts' ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( 'Newer posts <span class="meta-nav">&rarr;</span>' ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
	<?php endif;
}

//function count_words($str) was added by ian to count words' numbers in a post   
function count_words($str){
	$words = 0;
	$str = eregi_replace(" +", " ", $str);
	$array = explode(" ", $str);
	for($i=0;$i < count($array);$i++)
	{
		if (eregi("[0-9A-Za-zÀ-ÖØ-öø-ÿ]", $array[$i]))
		$words++;
	}
	echo $words;
}

//function get_post_clicked_nums was added by ian
function get_post_clicked_nums($pid){
	$pid = "'".$pid."'";
	global $wpdb;
	$sql = "select m.meta_value from wp_postmeta m where m.post_id = $pid and m.meta_key = 'custom_total_hits'";
	$viewNums = $wpdb->get_var($sql);
	echo $viewNums;
}

//function get_post_rating was add by ian
function get_post_rating ($pid){
	$pid = "'".$pid."'";
	global $wpdb;
	$selectSql = "select sum(rating_rating)/count(rating_rating) aa from wp_ratings where rating_postid=$pid";
	 
	$rating = $wpdb->get_var($selectSql);
	$output = "";
	$parentUrl = get_template_directory_uri();
	for ($i = 0; $i < $rating; $i++) {
		$output.=<<<html
<img src='$parentUrl/images/rating_on.gif' />
html;
	}
	for ($i = 0; $i < 5-$rating; $i++) {
		$output.=<<<html
<img src='$parentUrl/images/rating_off.gif' />
html;
	}
	echo $output;
}


// add by yuyue 2013-3-25======================
/**
 get user login name by user id
 */
function get_user_loginname($userid=''){
	 $user="'".$userid."'";
	 global $wpdb;
	 $user_names = $wpdb->get_col("SELECT user_login FROM $wpdb->users WHERE id = $user ORDER BY ID");
	 foreach($user_names as $user_name){
	 return $user_name;
	 }
}
/*
 * get the top views posts
 */

function getTopReviewd ($showNum){
	global $wpdb;
	$selectSql = "select t.post_title,t.post_author,m.meta_value,t.ID from wp_posts t,wp_postmeta m where t.ID = m.post_id and m.meta_key = 'custom_total_hits' order by m.meta_value desc limit $showNum";
	 
	$top_posts = $wpdb->get_results($selectSql);
	$output = "";
	$i = 1;
	foreach ($top_posts as $top_post) { 
	     $hit = (int)$top_post->meta_value;
	      $author = get_user_loginname($top_post->post_author);
	      $image = get_the_post_thumbnail($top_post->ID,array(45,70));
	       $permalink = get_permalink( $top_post->ID );
		 $output.="<li><a href='$permalink' title='$top_post->post_title'> $image $i.$top_post->post_title </a> <span >$author</span><span >($hit) </span></li>"; 
			 $i++;	
	}
	echo $output;
}
function getHighestRation ($showNum){
	global $wpdb;
	$selectSql = "select rating_id,rating_postid,rating_posttitle,sum(rating_rating)/count(rating_rating) aa from wp_ratings  group by rating_postid order by aa desc limit $showNum";
	 
	$top_posts = $wpdb->get_results($selectSql);
	$output = "";
	$i = 1;
	foreach ($top_posts as $top_post) {  
	     $hit = (int)$top_post->meta_value;
	      $author = get_user_loginname($top_post->post_author);
	      $image = get_the_post_thumbnail($top_post->ID,array(45,70));
	       $permalink = get_permalink( $top_post->rating_postid );
	        $uri = get_template_directory_uri();
		 $output.=<<<html
		          <li>
					<a href='$permalink' title='' ">$top_post->rating_posttitle</a>
                    <div class='ratingsbox'>
                        <img src='$uri/images/rating_on.gif' />
                        <img src='$uri/images/rating_on.gif' />
                        <img src='$uri/images/rating_on.gif' />
                        <img src='$uri/images/rating_off.gif' />
                        <img src='$uri/images/rating_off.gif' /> 
                     </div> 
				</li>
html;
		 $i++; 
				
	}
	echo $output;
}
endif;
?>