<?php
 /*
 Template Name: chapter_addorup
 */
 get_header(); ?>
 <?php 
  $series_id = $_GET['series_id']; 
  $series_id= "14";
 ?>
 <script type="text/javascript">
<!--
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
	     $.post('<?php echo admin_url( 'admin-ajax.php' );?>', {
	       action: 'my_ajax_action', // 自取一個action的名稱
	       post_content: $('#chcotent').val(), // 附上的參數
	       post_title:$("#chtitle").val(),
	       series_id:<?php echo $series_id ;?>
	     }, function(data) {
	       alert(data); // 當AJAX處理完畢，就把回傳的資料alert出來
	     });
	   });
 }); 
//-->
</script>
 <div class="chapter">
        chapter
     </div>
    <div id="conter"class="bookcontent fl">
    	<form action=""> 
    	<div class="usertitle"><input type="text" id="chtitle" name="chtitle" class="h-inpt" value="Write Your Chapter Name here"/></div> 
        <div class="mark fl">
        	<a href="#" class="viewbook">View Book</a>
        </div> 
        <div class="bookcontentbox">
        	<textarea class="bor-top booktextbox" id="chcotent" name="chcotent" >Write your story here</textarea>
        </div>
         <div class="startbut bor-top">
            <a href="#" id="btn_ajax">Publish</a>
         </div> 
        <div class="total">
        	<a href="#"><font>Add a New CHapter</font> </a>
        </div>
        </form>
    </div>  
<?php get_footer(); ?>