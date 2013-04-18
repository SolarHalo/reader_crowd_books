<?php
include 'ajax_functions.php';
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
		$root_uri = get_site_url();
		$bookImg = getBookImg($term_id);
		$image = $root_uri.'/'.$bookImg;
		$output.="<li><a href='$url' title='$name'><img src='$image' alt='$i.$name'/> $i.$name </a> <span >$author</span><span >($sumhit) </span></li>"; 
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
function getBookGenres($term_id){
//	$sql ="
//		select te.name from wp_terms te,wp_term_taxonomy tt,wp_term_relationships rr,( 
//		select r.* from wp_term_relationships r, wp_term_taxonomy t where t.term_id=".$term_id." and t.term_taxonomy_id=r.term_taxonomy_id limit 1) ss 
//		where tt.term_taxonomy_id=rr.term_taxonomy_id and rr.object_id=ss.object_id and tt.taxonomy='category' and tt.term_id=te.term_id";
	$sql = <<<SQL
	select t.name from wp_terms t,wp_term_taxonomy p,
	wp_term_taxonomy c where c.term_id='$term_id' and c.parent=p.term_taxonomy_id and p.term_id=t.term_id
SQL;
	global $wpdb;
	$genres = $wpdb->get_results($sql);
	foreach($genres as $genre){
		return $genre->name;
	}
}

function getBookLastUpdate($term_id){
	$sql = "select p.post_modified from wp_posts p,
			(select r.* from wp_term_relationships r, wp_term_taxonomy t where t.term_id=".$term_id." and t.term_taxonomy_id=r.term_taxonomy_id) ss 
			where p.ID=ss.object_id order by post_modified desc limit 1";
	global $wpdb;
	$lastupdates = $wpdb->get_results($sql);
	foreach($lastupdates as $lastupdate){
		return $lastupdate->post_modified;
	}
}

function getBookTotalView($term_id){
	$sql = "select sum(p.meta_value) as viewNums from wp_postmeta p,
			(select r.* from wp_term_relationships r, wp_term_taxonomy t where t.term_id=".$term_id." and t.term_taxonomy_id=r.term_taxonomy_id) ss 
			where p.post_id=ss.object_id and p.meta_key='custom_total_hits'";
	global $wpdb;
	$totals = $wpdb->get_results($sql);
	foreach($totals as $total){
		return $total->viewNums;
	}
}

function getBoookDescription($term_id){
	$sql = "select description from wp_term_taxonomy where term_id=".$term_id." and taxonomy='series'";
	global $wpdb;
	$dess = $wpdb->get_results($sql);
	foreach($dess as $des){
		return $des->description;
	}
}

function getBoookTag($term_id){
	$sql ="
		select te.slug,te.term_id from wp_terms te,wp_term_taxonomy tt,wp_term_relationships rr,( 
		select r.* from wp_term_relationships r, wp_term_taxonomy t where t.term_id=".$term_id." and t.term_taxonomy_id=r.term_taxonomy_id) ss 
		where tt.term_taxonomy_id=rr.term_taxonomy_id and rr.object_id=ss.object_id and tt.taxonomy='post_tag' and tt.term_id=te.term_id";
	global $wpdb;
	$tags = $wpdb->get_results($sql);
	$ret="";
	foreach($tags as $tag){
		$e = "<a href=\"?s=$tag->slug\">$tag->slug</a>";
		$ret =$ret.$e.",";
	}
	$ret[strlen($ret)-1] = '';
	return $ret;
}

function getTotalBookMark(){
	
}

function getBookTotalComments($term_id){
	$sql = "select sum(p.comment_count) as commentNums from wp_posts p,
			(select r.* from wp_term_relationships r, wp_term_taxonomy t where t.term_id=".$term_id." and t.term_taxonomy_id=r.term_taxonomy_id) ss 
			where p.ID=ss.object_id";
	global $wpdb;
	$totals = $wpdb->get_results($sql);
	foreach($totals as $total){
		return $total->commentNums;
	}
}
function getHighestRation ($showNum){
	global $wpdb; 
	$sql = "select m.name,round(avg(rating_rating),0)avgrate,m.slug,m.term_id,u.user_login from wp_terms m,wp_term_taxonomy t,wp_term_relationships r ,wp_ratings a,wp_posts p,wp_users u where m.term_id=t.term_id and t.taxonomy='series' and t.term_taxonomy_id=r.term_taxonomy_id and r.object_id=p.id and p.id=rating_postid and p.post_author=u.id group by m.name,m.slug,m.term_id,u.user_login order by avgrate desc limit ".$showNum;
	$bookrates = $wpdb->get_results($sql);
	$i = 1;
	$output = "";
	$books = array();
	$dir_uri = get_template_directory_uri();
	$site_uri = get_site_url();
	//为了防止同一本数的不同章节有不同的作者，做如下处理
	foreach($bookrates as $bookrate){
		$name = $bookrate->name;
		$avgrate = 0;
		if($bookrate->avgrate!=null&&$bookrate->avgrate!=''){
			
			$avgrate = intval($bookrate->avgrate);
		}
		
		$term_id = $bookrate->term_id;
		if(!array_key_exists($name, $books)){
			$books[$name] = array($name,array($avgrate),$bookrate->user_login,$bookrate->slug,$term_id);
		}else{
			$book = $books[$name];
			array_push($book[1], $avgrate);
			$books[$name] = $book;
		}
	}
	foreach($books as $key=>$book){
		$bookname = $books[$key][0];
		$bookurl = $site_uri.'/?series='.$books[$key][3];
		$term_id = $books[$key][4];
		$bookImg = getBookImg($term_id);
		$author = $books[$key][2];
		$avgrateArr = $books[$key][1];
		$ratesum = 0;
		$avgrate = 0;
		if($avgrateArr!=null&&count($avgrateArr)>0){
			foreach ($avgrateArr as $r){
				$ratesum = $ratesum+$r;
			}
			$avgrate = $ratesum/count($avgrateArr);
		}
		$image;
		if($bookImg){
			$image = $site_uri.'/'.$bookImg;
		}
		$rateImage = getRatingImage($avgrate, $dir_uri);
		$output.="<li><a href='$bookurl' title='$bookname'><img src='$image' alt='$i.$bookname'/> $i.$bookname </a> <span >$author</span>
		<span >
			$rateImage
		</span></li>"; 
		$i++;
	}
	echo $output;
}

function getRatingImage($rate,$dir_uri){
 
	$output = "<div class='ratingsbox'>"; 
//	$avgrate = 0;
//	if(gettype($rate)!='integer'){
//		$avgrate = intval($rate);
//	}
	$avgrate = 0;
	if($rate!=null&&$rate!=''){
		$avgrate = intval($rate);
		
	}
 
//	$avgrate = intval($rate);
 
 
	if($avgrate>0){
		for($i=0;$i<$avgrate;$i++){
			$output.="<img src='$dir_uri/images/rating_on.gif' />";
		}
	}
	$rateOff = 5-$avgrate;
	if($rateOff>0){
	   for($i=0;$i<$rateOff;$i++){
			$output.="<img src='$dir_uri/images/rating_off.gif' />";
		}
	 
	}
	
	$output.="</div>";
	return $output;
}
/**
 * 
 * Enter get featured books
 */
function getFeatured(){
	$sql = <<<SQL
select m.term_id,m.name,m.slug,u.user_login,t.description from wp_terms m,wp_term_taxonomy t,
wp_term_relationships r,wp_posts p,wp_postmeta pm ,wp_users u where m.term_id = t.term_id and 
t.taxonomy='series' and r.term_taxonomy_id=t.term_taxonomy_id and r.object_id=p.id and p.id=pm.post_id 
and pm.meta_key='featured'  and pm.meta_value='1' and p.post_author=u.id  group by  m.term_id, m.name,
m.slug,u.user_login ORDER BY m.term_id desc limit 3
SQL;
	global $wpdb; 
	$bookrates = $wpdb->get_results($sql);
	$site_uri = get_site_url();
	$output = "";
	foreach($bookrates as $book){
		 
		$bookurl = $site_uri.'/?series='.$book->slug;
		$img = getBookImg($book->term_id);
		$bookrating = getRationgBySeriesId($book->term_id);
		$bookRateCount = getCountBySeriesId($book->term_id);
		$desc = mb_substr($book->description,0,40,'UTF-8');
		$output .= <<<HTML
<div class="featured_item">
				<div class="fi_left"><img src="$img" alt=""></div>
				<div class="fi_right">
					<h3><a href="$bookurl">$book->name</a><span>$book->user_login</span></h3>
					 $bookrating ($bookRateCount)
					<div class="excerpt">
						<p>$desc ...
						<a href="$bookurl">Read more</a>
            </p>
					</div>
				</div> 
</div>
HTML;
		
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
//	$sql = "select p.post_content from wp_posts p,wp_terms t,wp_term_taxonomy m where t.term_id = m.term_id and t.term_id = '$term_id'";
	$sql = <<<SQL
	select p.post_content from wp_term_taxonomy m,wp_term_relationships r,
	wp_posts p where m.term_id='$term_id' and m.term_taxonomy_id = r.term_taxonomy_id and r.object_id=p.id
SQL;
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
		$rating = getRationgBySeriesId($bookBasicInfo->term_id);
		$uri .= "/?series=$slug";
		 $template_uri = get_template_directory_uri(); 
                  	$output.="<tr><td width='245'><a href='$uri'><b>$book_name</b></a></td>
                    <td width='145'>".getAuthorByTermID($term_id)."</td>
                    <td width='65'>".getBookGenres($term_id)."</td>
                    <td width='65'>".countTheWordsByTermId($term_id)."</td>
                   	<td width='65'>Finished</td>
                    <td width='95'> $rating
                  </td>
                  <td width='50'>".mysql2date(get_option('date_format'), getBookLastUpdate($term_id),false)."</td></tr>";
	} 
	echo $output; 
}

/**
 * 
 * 
 * @param unknown_type $flag
 */
function getProgress($flag){
		if ($flag == 0){
			return "In-Progress";
		}else return "Finished";
}
/**
 * get all book info
 */
function getAllBookInfo(){
	$sql = "select ic.*,wp_terms.name,wp_terms.slug from (select term_id,user_id,progress,modifytime from wp_orgseriesicons) as ic left join wp_terms on ic.term_id =wp_terms.term_id order by ic.modifytime desc;";
	global $wpdb;
	$bookBasicInfos = $wpdb->get_results($sql);
	$output = "";
	foreach($bookBasicInfos as $bookBasicInfo){ 
		$progress = $bookBasicInfo->progress;
		$updatetime = $bookBasicInfo->modifytime;
		$term_id = $bookBasicInfo->term_id;
		$book_name = $bookBasicInfo->name;
		$slug = $bookBasicInfo->slug;
		$uri = get_site_url();
		$rating = getRationgBySeriesId($bookBasicInfo->term_id);
		$uri .= "/?series=$slug";
		 $template_uri = get_template_directory_uri(); 
                  	$output.="<tr><td width='245'><a href='$uri'><b>$book_name</b></a></td>
                    <td width='145'>".getAuthorByTermID($term_id)."</td>
                    <td width='65'>".getBookGenres($term_id)."</td>
                    <td width='65'>".countTheWordsByTermId($term_id)."</td>
                   	<td width='65'>".getProgress($progress)."</td>
                    <td width='95'> $rating
                  </td>
                  <td width='50'>".mysql2date(get_option('date_format'), $updatetime,false)."</td></tr>";
	} 
	echo $output; 
}

/**
 * 
 * Enter judge whether the book with term_id in  category with cateId
 * @param unknown_type $cateId
 * @param unknown_type $term_id
 */
function ifinThisCate($cateId,$term_id){
	$sql = <<<SQL
	select t.term_id from wp_terms t,wp_term_taxonomy p,
	wp_term_taxonomy c where c.term_id='$term_id' and c.parent=p.term_taxonomy_id and p.term_id=t.term_id
SQL;
	global $wpdb;
	$genres = $wpdb->get_results($sql);
	foreach($genres as $genre){
		return $genre->term_id==$cateId;
	}
}

function getBookIdFromCateId($cateId){
	$sql = <<<SQL
	select t.term_id from wp_terms t,wp_term_taxonomy c where c.parent='$cateId';
SQL;
	global $wpdb;
	$books = $wpdb->get_results($sql);
	$bookIds = array();
	foreach($books as $book){
		if(empty($book->item_id)||$book->item_id==""){
			continue;
		}
		array_push(intval($book->item_id));
	}
	return implode(",",$bookIds);
	
}

/**
 * get cate book info
 */
function getCateBookInfo($cateId){
	$bookIdsFromCate = getBookIdFromCateId($cateId);
	echo $bookIdsFromCate;
	if(empty($bookIdsFromCate)||$bookIdsFromCate==""){
		return getAllBookInfo();
	}
	$sql = "select ic.*,wp_terms.name,wp_terms.slug from (select term_id,user_id,progress,modifytime from wp_orgseriesicons) as ic left join wp_terms on ic.term_id =wp_terms.term_id where wp_terms.term_id in (".$bookIdsFromCate.") order by ic.modifytime desc;";
	global $wpdb;
	$bookBasicInfos = $wpdb->get_results($sql);
	$output = "";
	foreach($bookBasicInfos as $bookBasicInfo){ 
		$progress = $bookBasicInfo->progress;
		$updatetime = $bookBasicInfo->modifytime;
		$term_id = $bookBasicInfo->term_id;
		$book_name = $bookBasicInfo->name;
		$slug = $bookBasicInfo->slug;
//		$inThisCate = ifinThisCate($cateId, $term_id);
//		if(!$inThisCate){
//			continue;
//		}
		$uri = get_site_url();
		$rating = getRationgBySeriesId($bookBasicInfo->term_id);
		$uri .= "/?series=$slug";
		 $template_uri = get_template_directory_uri(); 
                  	$output.="<tr><td width='245'><a href='$uri'><b>$book_name</b></a></td>
                    <td width='145'>".getAuthorByTermID($term_id)."</td>
                    <td width='65'>".getBookGenres($term_id)."</td>
                    <td width='65'>".countTheWordsByTermId($term_id)."</td>
                   	<td width='65'>".getProgress($progress)."</td>
                    <td width='95'> $rating
                  </td>
                  <td width='50'>".mysql2date(get_option('date_format'), $updatetime,false)."</td></tr>";
	} 
	echo $output; 
}
/**
 * add by yuyue
 * get the gener for index show gener don't show blog
 */
function getGener(){
//	$seleSql = <<<SQL
//select t.term_id,t.name,t.slug,x.term_taxonomy_id from wp_terms t left join wp_term_taxonomy x on (t.term_id = x.term_id ) 
//where t.name != 'Blog' and x.taxonomy='category'
//order by  t.term_id limit 5
//SQL;

	$seleSql = <<<SQL
select tc.term_id,tc.name,tc.slug,c.term_taxonomy_id from wp_terms tc,wp_term_taxonomy c
		 where c.parent in(select g.term_id from wp_terms t,wp_term_taxonomy g 
		 where t.name='Genres' and t.term_id=g.term_id) and tc.term_id=c.term_id order by tc.term_id limit 6
SQL;
	global $wpdb;
	$output = "";
	$geners = $wpdb->get_results($seleSql);
	foreach($geners as $gener){ 	
//		$output .= "<li><a href='".get_category_link( $gener->term_id )."'>$gener->name</a></li>";
		$output .= "<li><a href='http://localhost/?page_id=161&cateid=$gener->term_id'>$gener->name</a></li>";
	}
	echo $output;
}
/**
 *
 * get Rating by book id
 * @param str $SeriesId book id
 */
function getCountBySeriesId($SeriesId){
	$sql = <<<SQL
		select count( a.rating_id) total
		from 
			wp_terms m,
			wp_term_taxonomy t, 
			wp_term_relationships r ,
			wp_ratings a,
			wp_posts p 
		where
			m.term_id=t.term_id 
		and t.taxonomy='series' and t.term_taxonomy_id=r.term_taxonomy_id and r.object_id=p.id 
		and p.id=rating_postid and m.term_id = '$SeriesId'
SQL;
	global $wpdb;
	$ratingims = 0;
	$ratings = $wpdb->get_results($sql);
	foreach ($ratings as $rating) {
		return $rating->total;
	}
	return $ratingims;

}

/**
 * 
 * get Rating by book id
 * @param str $SeriesId book id
 */
function getRationgBySeriesId($SeriesId){
	 $sql = <<<SQL
	 select round(avg(rating_rating),0)avgrate
from wp_terms m,wp_term_taxonomy t, 
wp_term_relationships r ,wp_ratings a,wp_posts p where m.term_id=t.term_id 
and t.taxonomy='series' and t.term_taxonomy_id=r.term_taxonomy_id and r.object_id=p.id 
and p.id=rating_postid and m.term_id = '$SeriesId' group by
m.term_id
SQL;
	global $wpdb;
	$ratings = $wpdb->get_results($sql);
 
	$output = " <div class='ratingsbox'>";
	$ratingims = ""; 
	$ratingims = getRatingImage(0,get_template_directory_uri());
	foreach ($ratings as $rating) {
		$ratingims  = getRatingImage($rating->avgrate,get_template_directory_uri());
 
	} 
	return $ratingims;
  
} 
function vf_widget_activities2($args) {
		//extract($args);

		// Each widget can store its own options. We keep strings here.
		$options = get_option(VF_OPTIONS_NAME);
		$title = vf_get_value('widget-discussions-title', $options, '');
		$categoryid = (int)vf_get_value('widget-discussions-categoryid', $options, '');
		$count = (int)vf_get_value('widget-discussions-count', $options, '');
		$count = 5;
			
		$url = vf_get_value('url', $options, '');
		$link_url = vf_get_link_url($options);
		$resturl = array($url, '?p=discussions.json');
		if ($categoryid > 0)
			$resturl = array($url, '?p=categories/'.$categoryid.'.json');
			
//		$DataName = $categoryid > 0 ? 'DiscussionData' : 'Discussions';
		
		// Retrieve the latest discussions from the Vanilla API
		$resturl = vf_combine_paths($resturl, '/');
		$data = json_decode(vf_rest($resturl));
		if (!is_object($data))
			return;
      
      if (isset($data->Discussions))
         $Discussions = $data->Discussions;
      elseif (isset($data->DiscussionData))
         $Discussions = $data->DiscussionData;
      else
         $Discussions = array();
      
      if (empty($Discussions))
         return;

		// These lines generate our output. Widgets can be very complex
		// but as you can see here, they can also be very, very simple.
		 
		echo '<ul>';
		$i = 0;
		foreach ($Discussions as $Discussion) {
//         var_dump($Discussion);
			$i++;
			if ($i > $count)
				break;
			$desc = $Discussion->Name;
			$desc = str_replace("Reader Crowd  » ","",$desc);
			$desc = mb_substr($desc,0,36,'UTF-8');
			
			//echo '<li><a href="'.vf_combine_paths(array($link_url, '?page_id=437&discussion/'.$Discussion->DiscussionID.'/'.vf_format_url($Discussion->Name)), '/').'">'.$desc.'</a></li>';
			echo '<li><a href="'.vf_combine_paths(array(get_site_url(), '/?page_id=437#/discussion/'.$Discussion->DiscussionID.'/'.vf_format_url($Discussion->Name)), '/').'">'.$desc.'</a></li>';
			
		}
		echo '</ul>';
	}
endif;
?>