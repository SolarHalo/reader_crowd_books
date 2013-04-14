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
and me.meta_value in ('user_books_show.php','book-operation.php') 
and me.post_id =  post.id
SQL;
 $pages = $wpdb->get_results($pageSql);
 $viewPageUrl = "";
 $operPageUrl = "";
 foreach ($pages as $page) {
 	if("user_books_show.php"==$page->meValue){
 		$viewPageUrl=$page->uid;
 	}else{
 		$operPageUrl=$page->uid;
 	}
 }
 ?>
 <script type="text/javascript">
<!--
jQuery(document).ready(function($) { 
	$("#bookname").click(function(){
		var tex = $("#bookname").val();
		if(tex=='Write Your Chapter Name here'){
			$("#bookname").val("");
		}
   });
	$("#bookDes").click(function(){
		var tex = $("#bookDes").val();
		if(tex=='Write your story here'){
			$("#bookDes").val("");
		}
   });

	 
 }); 
//-->
</script>
  <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/jquery.form.js" ></script>
 <script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/bookoper.js" ></script>
 <div class="startbut">
        <a href="#">Start a New Book</a>
     </div>
    <div id="conter"class="bookcontent fl"> 
    	
    	<div class="usertitle"><input id="bookname"  name="bookname" type="text"  class="h-inpt" value="Write Your Chapter Name here"/></div> 
        <div class="mark fl">
        	<a href="<?php echo get_site_url(); ?>/?series=the-virtuous-misfortune" class="viewbook">View Book</a>
        </div> 
        <div class="bookcontentbox">
        	<a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/bookcover.gif" class="fl" width="181"  height="270"/></a>
           <form id="fileform" enctype='multipart/form-data'>	<input id='bookcover' type='file' name='bookcover' size='20' />
           	<input type='button' value='upload' onclick="userbookOpr.bookPhoto('<?php echo $operPageUrl;?>')"/>
           </form>
           <input type="hidden" id="userid" value="<?php echo $current_user->ID;?>" />
           <input type="hidden" id="term_id" value="<?php echo $_GET['term_id'] ?>" />
           	<textarea id='bookDes' name="bookDes" class="bor-top booktextbox2">Write your story here</textarea>
            <ul>
            	<li><strong>Category:</strong>
                	<div class="bookmenubut">
                    	
                    	<select id="category"  name="category" >
                        <?php 

                        $sql= <<<SQL
						select ste.term_id id,ste.`name` catname 
						from wp_terms ste
						join wp_term_taxonomy  stx 		on stx.term_id = ste.term_id 
						join wp_term_taxonomy  tx 		on tx.term_taxonomy_id = stx.parent 
						join wp_terms te 							on te.term_id = tx.term_id and te.`name` = 'Genres'
SQL;
                        $categorys = $wpdb->get_results($sql);
                        foreach ($categorys as $category) {
                        	$categoryName = $category->catname;
                        	$categoryId = $category->id;
                        ?>
                        	<option value="<?php echo $categoryId;?>"><?php echo $categoryName;?></option> 
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
                <li><strong>Words:</strong>0</li>
                <li><strong>Progress:</strong>
                <select id="progress"  name="progress" >
                	<option value="0">In-Progress</option>
                	<option value="1">Finished</option>
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
                	<span style="display:table; margin-top:10px;">Add some keword here</span>
                </li>
            </ul>
        </div>
         <div class="startbut bor-top">
            <a href="javascript:userbookOpr.bookAdd('<?php echo $operPageUrl;?>');">Update Book lnfo.</a>
         </div> 
        <div class="total">
        	<a href="javascript:"><font>Add a New CHapter</font> </a>
        </div>
        
    </div>
<?php get_footer(); ?>