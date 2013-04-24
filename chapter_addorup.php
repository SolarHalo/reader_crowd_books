<?php
 /*
 Template Name: chapter_addorup
 */
 get_header(); ?>
 <?php 
  $series_id = $_GET['series_id']; 
  //$series_id= "14";
 ?>
 <script type="text/javascript">
<!--
function viewChapter(siteUrl){
	jQuery(document).ready(function($) {
		var postid = $("#post_id").val();
		if(postid == null || "" == postid){
			alert("Please publish chapter info first, then view chapter");
			return ;
		}
		var url = siteUrl+"/?p="+postid;
		window.location.href=url;
	});
	
}
jQuery(document).ready(function($) { 
	$("#chtitle").click(function(){
		var tex = $("#chtitle").val();
		if(tex=='Write Your Chapter Name here'){
			$("#chtitle").val("");
		}
   });
	$("#chcotent").click(function(){
		var tex = $("#chcotent").val();
		if(tex=='Write your story here'){
			$("#chcotent").val("");
		}
   });

	$('#btn_ajax').click(function () {
		var chapterName = $("#chtitle").val();
		if(chapterName == null || chapterName.replace(/[ ]/g,"")=="" || 'Write Your Chapter Name here'==chapterName){
			alert("Please fill the Chapter name/summary");
			return ;
		}
	     $.post('<?php echo admin_url( 'admin-ajax.php' );?>', {
	       action: 'my_ajax_action', 
	       post_content: $('#chcotent').val(),  
	       post_title:$("#chtitle").val(),
	       post_id:$("#post_id").val(),
	       series_id:<?php echo $series_id ;?>
	     }, function(data) {
	    	 $("#post_id").val(data)
	       alert("successful");  
	     });
	   });
 }); 
//-->
</script>
<?php 
 $post_id = $_GET['post_id'];
 if(isset($post_id)){
 	 $post_7 = get_post($post_id); 
     $title = $post_7->post_title;
     $content = $post_7->post_content; 
 }
 $term = get_term_by('id', $series_id, 'series');
 
?>
 <div class="chapter">
        chapter
     </div>
    <div id="conter"class="bookcontent fl">
    	<form action=""> 
    	<div class="usertitle">
    	<input type="text" id="chtitle" name="chtitle" class="h-inpt" 
    	<?php  if(isset($post_id)){?>
    	value="<?php echo $title?>"/>
    	<?php }else{?>
    	value="Write Your Chapter Name here"/>
    	<?php }?>
    	<input type="hidden" id="post_id" value="<?php echo $post_id?>"/>
    	</div> 
        <div class="mark fl">
        	<a href="javascript:viewChapter('<?php echo get_site_url(); ?>')" class="viewbook">View Chapter</a> 
        </div> 
        <div class="bookcontentbox">
        	
        	<?php  if(isset($post_id)){?>
    	 <textarea class="bor-top booktextbox" id="chcotent" name="chcotent" ><?php echo $content?></textarea>
    	<?php }else{?>
<textarea class="bor-top booktextbox" id="chcotent" name="chcotent" >Write your story here</textarea>
    	<?php }?>
        
        </div>
         <div class="startbut bor-top">
            <a href="javascript:void(0);" id="btn_ajax">Publish</a>
         </div> 
        <div class="total">
        	<a href="javascript:window.location.reload()"><font>Add a New Chapter</font> </a>
        </div>
        </form>
    </div>  
<?php get_footer(); ?>