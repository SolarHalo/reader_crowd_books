<?php
 /*
 Template Name: user_book_show
 */
wp_enqueue_script("jquery");

 get_header(); 
 global $wpdb;
 
$pageSql = <<<SQL
select post.guid uid , me.meta_value meValue from wp_postmeta me ,wp_posts post 
where me.meta_key ='_wp_page_template' 
and me.meta_value in ('user_books_show.php','book-operation.php','user_book_uporadd.php', 'chapter_addorup.php') 
and me.post_id =  post.id
SQL;
$pages = $wpdb->get_results($pageSql);
$viewPageUrl = "";
$operPageUrl = "";
$operationUrl = "";
$chapterPageUrl ="";
foreach ($pages as $page) {
	if("user_books_show.php"==$page->meValue){
		$viewPageUrl=$page->uid;
	}else if("user_book_uporadd.php"==$page->meValue){
		$operPageUrl=$page->uid;
	}else if("book-operation.php"==$page->meValue){
		$operationUrl=$page->uid;
	}else if("chapter_addorup.php" == $page->meValue){
		$chapterPageUrl=$page->uid;
	}
}
?>
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bookoper.js" ></script>
  <div class="startbut" >
        <a href="<?php echo $operPageUrl;?>">Start a New Book</a>
     </div>
     
     <?php 
     
     $sql = <<<SQL
		select 	te.`name` bookname ,te.`slug` slug,tx.description bookdes ,org.icon bookico ,tx.parent parent ,tx.term_taxonomy_id shipid , te.term_id as termid
		, org.words  words, org.progress  progress ,DATE_FORMAT(org.modifytime,'%d/%m/%Y') modify from wp_terms te 
		JOIN 			wp_term_taxonomy tx 	on te.term_id = tx.term_id and tx.taxonomy = 'series' 
		LEFT JOIN wp_orgseriesicons org on org.term_id = te.term_id   where org.user_id='$current_user->ID' 
		order by org.modifytime desc 
SQL;
      
      $books = $wpdb->get_results($sql);
     foreach ($books as $book) {
     	$catname = "";
     	$catSql = "select te.`name` catname from wp_terms te ,wp_term_taxonomy tx where tx.term_id = te.term_id and tx.term_id = '".$book->parent."'";
     	$cats = $wpdb->get_results($catSql);
     	foreach ($cats as $cat) {
     		$catname = $cat->catname;
     	}
     	
     ?>
     
    <div id="conter"class="bookcontent fl"> 
    	<div class="usertitle"><?php echo $book->bookname ;?><span>Last Update:<font><?php echo $book->modify ;?></font></span></div> 
        <div class="mark fl">
        	<a href="<?php echo get_site_url()."/?series=$book->slug" ?>" class="viewbook">View Book</a>
        </div> 
        <div class="bookcontentbox">
        	<a href="#"><img src="<?php echo get_site_url()."/".$book->bookico ;?>" class="fl" width="181"  height="270"/></a>
            <p>
            	<?php echo $book->bookdes ;?>
            </p>
            <ul>
            	<li><strong>Category:</strong>
                	<div class="bookmenubut">
                    	<span><?php echo $catname;?></span>
                    	<!-- 
                        <ul class="bookmenu">
                            <li><a href="#">Apocalypic and Post-apocalyptic</a></li>
                            <li><a href="#">Biopunk</a></li>
                            <li><a href="#">military science fiction </a></li>
                            <li><a href="#">time travel</a></li>
                            <li><a href="#">space opera</a></li>
                            <li><a href="#">superheroes</a></li>
                        </ul>
                         -->
                    </div>
                </li>
                <li><strong>Words:</strong><?php echo countTheWordsByTermId($book->termid);?></li>
                <li><strong>Progress:</strong>
                	<div >
                    	<span><?php if($book->progress == 0) echo "In-Progress"; else echo "Finished"; ?></span>
                        <!-- 
                        <ul class="bookmenu">
                            <li><a href="#">In-Progress</a></li>
                            <li><a href="#">Finished</a></li> 
                        </ul>
                        -->
                    </div>
                </li>
                <li><strong>Tags:</strong>
                	<span style="display:table; margin-top:10px;"></span>
                </li>
            </ul>
        </div>
         <div class="startbut bor-top">
            <a href="<?php echo $operPageUrl;?>&termid=<?php echo $book->termid;?>">Update Book lnfo.</a>
             <a href="javascript:userbookOpr.bookDel('<?php echo $operationUrl;?>','<?php echo $book->termid;?>');">Delete Book lnfo.</a>
            
         </div>
        <div class="bookboxlist">
        	<ul class="list-title">
            	<li class="titleChapter">Chapter</li>
                <li class="titleContent2" style="text-align:center;">Content</li>
                <li class="titleWords">Words</li> 
                <li class="titleLast">Last Upadte</li> 
            </ul>
            <?php 
            $chapterSql = <<<SQL
		     	select post.ID id,post.post_content pcontent, post.post_title postname,DATE_FORMAT(post.post_modified,'%d/%m/%Y') postdate 
		     	from wp_term_relationships ship
		     	JOIN wp_posts post
		     	on post.ID = ship.object_id and
		     	post.post_type = 'post' and
		     	post.post_status  = 'publish'
SQL;
            $chapterSql = $chapterSql." and ship.term_taxonomy_id = '".$book->shipid."'";
            $chapters = $wpdb->get_results($chapterSql);
            $chapterIndex = 0;
            foreach ($chapters as $chapter) {
            	$chaptername = $chapter->postname ;
            	$chapterdate = $chapter->postdate ;
            	$post_id = $chapter->id ;
            	$pcontent = $chapter->pcontent;
            ?>
            <ul>
            	<li class="titleChapter"><?php echo ++$chapterIndex;?></li>
                <li class="titleContent2">
                 <a id="chapter_title" href="<?php echo $chapterPageUrl; ?>&series_id=<?php echo $book->termid;?>&post_id=<?php echo $post_id?>"> <?php echo $chaptername;?></a>
                 <a href="<?php echo $chapterPageUrl; ?>&series_id=<?php echo $book->termid;?>&post_id=<?php echo $post_id?>">edit</a>
                 <a href="javascript:userbookOpr.chapterDel('<?php echo $operationUrl;?>','<?php echo $post_id;?>');">delete</a>
                </li>
                <li class="titleWords"><?php echo wcountbycontent($pcontent);?></li> 
                <li class="titleLast"><?php echo $chapterdate;?></li> 
            </ul>
           <?php }?>
        </div>
        <div class="total">
        	<a href="<?php echo $chapterPageUrl; ?>&series_id=<?php echo $book->termid;?>"><font>Add a New Chapter</font> </a>
        </div>
    </div> 
<div style="margin:3px 0; width:100%;height:5px;background-color:#999;overflow:hidden;">&nbsp;&nbsp;</div>   
 <?php 
     }
     ?>

<?php get_footer(); ?>