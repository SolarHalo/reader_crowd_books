<?php
 /*
 Template Name: top_view_rating
 */
 get_header(); ?>
 <?php 
  $series_id = $_GET['series_id']; 
  //$series_id= "14";
 ?>
 <script type="text/javascript">

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
	       action: 'my_ajax_action', 
	       post_content: $('#chcotent').val(),  
	       post_title:$("#chtitle").val(),
	       post_id:$("#post_id").val(),
	       series_id:<?php echo $series_id ;?>
	     }, function(data) {
	       alert(data);  
	     });
	   });
 }); 
 
</script>
<?php 
 $show_id = $_GET['show_id'];
 //show id is 1,that't top viewd
 if($show_id ==  1){
 	
 }else{
 	
 }
 
 
?>
   <div id="conter" class="fl">
    	<div class="Ratedbooklist">
        	<h4>TOP Viewed</h4>
        	 <ul class="mlrp_ul bor-r">
            	<li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />1.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
               <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />2.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />3.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />4.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />5.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />6.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
               <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />7.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />8.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />9.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />10.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
            </ul>
             <ul class="mlrp_ul">
            	<li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />11.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
               <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />12.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />3.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />4.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />5.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />1.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
               <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />2.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />3.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />4.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
                <li>
					<a href="#" title=""><img width="45" height="70"  class="attachment-thumbnail"  src="images/photo2.jpg" />5.Bear story</a>
                    <span >David Bear</span>
					<span > (185)</span>
				</li>
            </ul>
        </div>
    </div> 
<?php get_footer(); ?>