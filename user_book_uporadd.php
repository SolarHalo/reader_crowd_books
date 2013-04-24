<?php
 /*
 Template Name: user_book_addorup
 */
wp_enqueue_script("jquery");

get_header(); 
global $wpdb;
 
$pageSql = <<<SQL
select post.guid uid , me.meta_value meValue from wp_postmeta me ,wp_posts post 
where me.meta_key ='_wp_page_template' 
and me.meta_value in ('user_books_show.php','book-operation.php','chapter_addorup.php') 
and me.post_id =  post.id
SQL;
 $pages = $wpdb->get_results($pageSql);
 $viewPageUrl = "";
 $operPageUrl = "";
 $chapterPageUrl = "";
 foreach ($pages as $page) {
 	if("user_books_show.php"==$page->meValue){
 		$viewPageUrl=$page->uid;
 	}else if("chapter_addorup.php" == $page->meValue){
 		$chapterPageUrl= $page->uid;
 	}else{
 		$operPageUrl=$page->uid;
 	}
 }
 $books = false;
 if(isset($_GET['termid'])){
 $termid = $_GET['termid'];
 
 
 $sql = <<<SQL
		select 	te.`name` bookname ,te.`slug` slug,tx.description bookdes ,org.icon bookico ,tx.parent parent ,tx.term_taxonomy_id shipid , te.term_id termid,
		org.words  words, org.progress  progress from wp_terms te 
		JOIN 			wp_term_taxonomy tx 	on te.term_id = tx.term_id and tx.taxonomy = 'series' 
		LEFT JOIN wp_orgseriesicons org on org.term_id = te.term_id   where org.user_id='$current_user->ID' and te.term_id='$termid'
SQL;
      
	  
     $books = $wpdb->get_row($sql);
 }
 ?>
 <script type="text/javascript">
<!--
jQuery(document).ready(function($) { 
	$("#bookname").click(function(){
		var tex = $("#bookname").val();
		if(tex=='Write Your Book Title here'){
			$("#bookname").val("");
		}
   });
	$("#bookDes").click(function(){
		var tex = $("#bookDes").val();
		if(tex=='Write your book summary here'){
			$("#bookDes").val("");
		}
   });

	 
 }); 
//-->
</script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.form.js" ></script>
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bookoper.js" ></script>
 <div class="startbut">
        <a href="javascript:window.location.reload()">Start a New Book</a>
     </div>
    <div id="conter"class="bookcontent fl"> 
    	
    	<div class="usertitle"><input id="bookname"  name="bookname" type="text"  class="h-inpt" value="<?php if ($books) echo $books->bookname; else echo "Write Your Book Title here";?>"/></div> 
        <div class="mark fl">
        	<a href="<?php echo get_site_url(); ?>/?series=<?php echo $books->slug ?>" class="viewbook">View Book</a>
        </div> 
        <div class="bookcontentbox">
          <div id="imgform"> 
        	<a href=""><img id="bookcoverimg" src="<?php if($books) echo get_site_url()."/".$books->bookico; else echo get_template_directory_uri()."/images/bookcover.gif";?>" class="fl" width="181"  height="270"/></a>        	
	           <form id="fileform" enctype='multipart/form-data'>	<input id='bookcover' type='file' name='bookcover' size='20' />
	           	<input type='button' value='upload' onclick="userbookOpr.bookPhoto('<?php echo $operPageUrl;?>')"/>
	           </form>
          </div>
           <input type="hidden" id="userid" value="<?php echo $current_user->ID;?>" />
           <input type="hidden" id="term_id" value="<?php echo $termid ?>" />
           	<textarea id='bookDes' name="bookDes" class="bor-top booktextbox2"><?php if ($books) echo $books->bookdes; else echo "Write your book summary here";?></textarea>
            <ul>
            	<li><strong>Category:</strong>
                	<div class="bookmenubut">
                    	
                    	<select id="category"  name="category" >
                        <?php 

                        $sql= <<<SQL
						select ste.term_id id,ste.`name` catname 
						from wp_terms ste
						join wp_term_taxonomy  stx 		on stx.term_id = ste.term_id 
						join wp_term_taxonomy  tx 		on tx.term_id = stx.parent 
						join wp_terms te 							on te.term_id = tx.term_id and te.`name` = 'Genres'
SQL;
                        $categorys = $wpdb->get_results($sql);
                        foreach ($categorys as $category) {
                        	$categoryName = $category->catname;
                        	$categoryId = $category->id;
                        ?>
                        	<option value="<?php echo $categoryId;?>" <?php if($books) { if($books->parent == $categoryId) echo "selected"; }?>><?php echo $categoryName;?></option> 
                        <?php
						}?>
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
                         </select>
                    </div>
                </li>
                <li><strong>Words:</strong><?php if($books) echo countTheWordsByTermId($termid); else echo "0";?></li>
                <li><strong>Progress:</strong>
                <select id="progress"  name="progress" >
                	<option value="0" <?php if($books) { if(intval($books->progress) == 0) echo "selected"; }?>>In-Progress</option>
                	<option value="1" <?php if($books) { if(intval($books->progress) == 1) echo "selected"; }?>>Finished</option>
                </select>
                	<!--  
                	<div class="bookmenubut">
                    	<span>In-Progress</span>
                        <ul class="bookmenu">
                            <li><a href="#">In-Progress</a></li>
                            <li><a href="#">Finished</a></li> 
                        </ul>
                    </div>
                    -->
                </li>
                <li><strong>Tags:</strong>
                	<span style="display:table; margin-top:10px;"></span>
                </li>
            </ul>
        </div>
         <div class="startbut bor-top">
            <a href="javascript:userbookOpr.bookAdd('<?php echo $operPageUrl;?>');">Update Book lnfo.</a>
         </div> 
        <div class="total">
        	<a id='chapteradd' href="javascript:userbookOpr.bookChapter('<?php echo $chapterPageUrl;?>');"><font>Add a New Chapter</font> </a>
        </div>
        
    </div>
<?php get_footer(); ?>