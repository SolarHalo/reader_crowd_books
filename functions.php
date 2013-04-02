<?php
/* Set max number of excerpt string lengty for output used in catergory-blog.php (http://codex.wordpress.org/Function_Reference/get_the_excerpt)*/

function the_excerpt_max_charlength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo "read";
	} else {
		echo $excerpt;
	}
}
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
		if (eregi("[0-9A-Za-z脌-脰脴-枚酶-每]", $array[$i]))
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
	$selectSql = "select (sum(rating_rating)/count(rating_rating) )aa from wp_ratings where rating_postid=$pid";
	 
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
//	$selectSql = "select t.post_title,t.post_author,m.meta_value,t.ID from wp_posts t,wp_postmeta m where t.ID = m.post_id and m.meta_key = 'custom_total_hits' order by m.meta_value desc limit $showNum";
	$selectSql = "select  m.term_id,m.name,sum(CONVERT(pm.meta_value,UNSIGNED))sumhit,m.slug,u.user_login from wp_terms m,wp_term_taxonomy t,wp_term_relationships r,wp_posts p,wp_postmeta pm ,wp_users u where m.term_id = t.term_id and t.taxonomy='series' and r.term_taxonomy_id=t.term_taxonomy_id and r.object_id=p.id and p.id=pm.post_id and pm.meta_key='custom_total_hits' and p.post_author=u.id group by  m.term_id, m.name,m.slug,u.user_login order by sumhit desc limit $showNum";
	$top_posts = $wpdb->get_results($selectSql);
	$output = "";
//	$i = 1;
//	foreach ($top_posts as $top_post) { 
//	     $hit = (int)$top_post->meta_value;
//	      $author = get_user_loginname($top_post->post_author);
//	      $image = get_the_post_thumbnail($top_post->ID,array(45,70));
//	       $permalink = get_permalink( $top_post->ID );
//		 $output.="<li><a href='$permalink' title='$top_post->post_title'> $image $i.$top_post->post_title </a> <span >$author</span><span >($hit) </span></li>"; 
//			 $i++;	
//	}
	$i = 1;
	$books = array();
	foreach($top_posts as $top_post){
		$name = $top_post->name;
		$sumhit = $top_post->sumhit;
		$author = $top_post->user_login;
		$uri = get_site_url();
		$uri .= "/?series=$top_post->slug";
		$term_id = $top_post->term_id;
		if(!array_key_exists($name, $books)){
			$book = array();
			$books[$name] = array($name,$sumhit,$author,$uri,$term_id);
		}else{
			$book = $books[$name];
			$book[1] = $book[1]+$sumhit;
			$books[$name] = $book;
		}
	}
	foreach($books as $key=>$book){
		$b=$books[$key];
		$name = $b[0];
		$sumhit = $b[1];
		$author = $b[2];
		$url = $b[3];
		$term_id = $b[4];
		$uri = get_site_url();
		$bookImg = getBookImg($term_id);
		$image = $uri.'/'.$bookImg;
		$output.="<li><a href='$uri' title='$name'><img src='$image' /> $i.$name </a> <span >$author</span><span >($sumhit) </span></li>"; 
		$i++;
	}
	echo $output;
}

function getBookImg($term_id,$user_id=null){
	$sql = "select * from wp_orgseriesicons where term_id=".$term_id;
	if($user_id!=null){
		$sql.=" and user_id=".$term_id;
	}	
	global $wpdb;
	$bookImgs = $wpdb->get_results($sql);
	foreach($bookImgs as $bookImg){
		return $bookImg->icon;
	}
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

/**
 * 
 * count the content words
 */
function wcount(){
    ob_start();
    the_content();
    $content = ob_get_clean();
    return sizeof(explode(" ", $content));
}

/**
 * get all books
 */
function allBooks(){
	$selSQL = "";
	
	
}
/**
 * count the words of posts
 *  .
 * @param str $content post content
 */
function wcountbycontent($content){
	 return sizeof(explode(" ", $content));
}
/**
 * 
 * count the word
 * @param unknown_type $term_id
 */
function countTheWordsByTermId($term_id){
	$sql = "select p.post_content from wp_posts p,wp_terms t,wp_term_taxonomy m where t.term_id = m.term_id and t.term_id = '$term_id'";
	global $wpdb;
	$lastUpdatePosts = $wpdb->get_results($sql);
	$countwords = 0;
    foreach ($lastUpdatePosts as $lastUpdatePost) {   
	   $countwords += wcountbycontent($lastUpdatePost->post_content );
	}
	return $countwords;
}
/**
 *get lastUpdate posts
 */
function getLastUpate($postnum){
	$sql = "select id,post_title,post_content from wp_posts p,wp_term_relationships s,wp_term_taxonomy x where p.ID = s.object_id and s.term_taxonomy_id = x.term_taxonomy_id and x.taxonomy = 'series' and p.post_status ='publish' order by post_modified desc  limit ".$postnum;
	global $wpdb;
	$lastUpdatePosts = $wpdb->get_results($sql);
	$output = "";
	foreach ($lastUpdatePosts as $lastUpdatePost) { 
		$posturl = get_permalink($lastUpdatePost->id);
		$content = mb_substr($lastUpdatePost->post_content,0,60,'UTF-8');
	    $output.="<li><h4>".$lastUpdatePost->post_title."</h4><p>$content ...</p><a href='$posturl'>read more</a></li>";
	}
	echo $output;
}
 
/**
 * get Author name by term_id
 */
function getAuthorByTermID($term_id){
	$sql = "select p.post_author from wp_posts p,wp_terms t,wp_term_taxonomy m where t.term_id = m.term_id and t.term_id = '$term_id' limit 1";
	global $wpdb;
	$user_authors = $wpdb->get_results($sql);
	foreach ($user_authors as $user_author) {
	  return   get_user_loginname($user_author->post_author);
	}
}
/**
 * get series id by series name
 */
function getSeriesIDByName($serName){
	$sql = "select term_id from wp_terms where name = '$serName'";
	global $wpdb;
	$term_ids = $wpdb->get_results($sql);
    foreach ($term_ids as $term_id) {
	  return   $term_id->term_id;
	} 
}
/**
 * get book info
 */
function getBookInfo(){
	$sql = "select t.term_id,t.name,t.slug from wp_terms t,wp_term_taxonomy m where t.term_id = m.term_id and taxonomy = 'series'";
	global $wpdb;
	$bookBasicInfos = $wpdb->get_results($sql);
	$output = "";
	foreach($bookBasicInfos as $bookBasicInfo){ 
		$term_id = $bookBasicInfo->term_id;
		$book_name = $bookBasicInfo->name;
		$slug = $bookBasicInfo->slug;
		$uri = get_site_url();
		$uri .= "/?series=$slug";
		 $template_uri = get_template_directory_uri();
		//鏍规嵁term_id鑾峰彇涔︽湰鍏朵粬淇℃伅...
		
		//鑾峰彇涔︽湰浣滆�
		//$authSql = "select u.user_login from wp_term_taxonomy t,wp_term_relationships r,wp_posts p,wp_users u where t.term_id=".$term_id." and t.term_taxonomy_id=r.term_taxonomy_id and r.object_id=p.id and p.post_author=u.id";
	
                  	$output.="<tr><td width='245'><a href='$uri'><b>$book_name</b></a></td>
                    <td width='145'>".getAuthorByTermID($term_id)."</td>
                    <td width='65'>Health</td>
                    <td width='65'>".countTheWordsByTermId($term_id)."</td>
                   	<td width='65'>Finished</td>
                    <td width='95'>
                       <div class='ratingsbox'>
                          <img src='$template_uri/images/rating_on.gif' />
                          <img src='$template_uri/images/rating_on.gif' />
                          <img src='$template_uri/images/rating_on.gif' />
                          <img src='$template_uri/images/rating_off.gif' />
                          <img src='$template_uri/images/rating_off.gif' />
                       </div>
                  </td>
                  <td width='50'>13/03</td></tr>";
	} 
	echo $output; 
}
 
endif;
?>