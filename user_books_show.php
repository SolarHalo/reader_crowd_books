<?php
 /*
 Template Name: user_book_show
 */
 get_header(); ?>
  <div class="startbut">
        <a href="<?php get_site_url(); ?>/?page_id=225">Start a New Book</a>
     </div>
     
     <?php 
     global $wpdb;
     
     $sql = <<<SQL
		select 	te.`name` bookname ,tx.description bookdes ,org.icon bookico ,tx.parent parent ,tx.term_taxonomy_id shipid 
		from wp_terms te 
		JOIN 			wp_term_taxonomy tx 	on te.term_id = tx.term_id and tx.taxonomy = 'series' 
		LEFT JOIN wp_orgseriesicons org on org.term_id = te.term_id
SQL;
     $books = $wpdb->get_results($sql);
     foreach ($books as $book) {
     	$catname = "";
     	$catSql = "select te.`name`  catname from wp_terms te ,wp_term_taxonomy tx where tx.term_id = te.term_id and tx.term_taxonomy_id = '".$book->parent."'";
     	$cats = $wpdb->get_results($catSql);
     	foreach ($cats as $cat) {
     		$catname = $cat->catname;
     	}
     	//
     	
     ?>
     
    <div id="conter"class="bookcontent fl"> 
    	<div class="usertitle"><?php echo $book->bookname ;?><span>Last Update:<font>13/03/2013</font></span></div> 
        <div class="mark fl">
        	<a href="#" class="viewbook">View Book</a>
        </div> 
        <div class="bookcontentbox">
        	<a href="#"><img src="<?php echo $book->bookico ;?>" class="fl" width="181"  height="270"/></a>
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
                <li><strong>Words:</strong>17766</li>
                <li><strong>Progress:</strong>
                	<div class="bookmenubut">
                    	<span>Finished</span>
                        <ul class="bookmenu">
                            <li><a href="#">In-Progress</a></li>
                            <li><a href="#">Finished</a></li> 
                        </ul>
                    </div>
                </li>
                <li><strong>Tags:</strong>
                	<span style="display:table; margin-top:10px;">Captain hesperus,Feline, Qudira</span>
                </li>
            </ul>
        </div>
         <div class="startbut bor-top">
            <a href="#">Update Book lnfo.</a>
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
		     	select post.ID id, post.post_name postname,DATE_FORMAT(post.post_modified,'%d/%m/%Y') postdate 
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
            ?>
            <ul>
            	<li class="titleChapter"><?php echo ++$chapterIndex;?></li>
                <li class="titleContent2"><?php echo $chaptername;?><a href="#">edit</a></li>
                <li class="titleWords">1221</li> 
                <li class="titleLast"><?php echo $chapterdate;?></li> 
            </ul>
           <?php }?>
        </div>
        <div class="total">
        	<a href="#"><font>Add a New CHapter</font> </a>
        </div>
    </div> 
    <?php 
     }
     ?>

<?php get_footer(); ?>