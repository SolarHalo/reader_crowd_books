<?php
 /*
 Template Name: top_view_rating
 */
 get_header(); ?>

<?php 
 $show_id = $_GET['show_id'];
 $title = "";
 $datas_one = "";
 $datas_two = "";
 //show id is 1,that't top viewd
 if($show_id ==  1){
 	$title = "TOP Viewed";
 	$datas_one = getTopReviewdShow(1);
 	$datas_two = getTopReviewdShow(2);
 }else{
 	$title = "Top Rated";
 	$datas_one = getTopRationgShow(1);
 	$datas_two = getTopRationgShow(2);
 } 
?>
   <div id="conter" class="fl">
    	<div class="Ratedbooklist">
        	<h4><?php echo $title;?></h4> 
        	 <ul class="mlrp_ul bor-r"> 
              <?php echo $datas_one;?>
            </ul>
             <ul class="mlrp_ul">
               <?php echo $datas_two;?>
            </ul>
        </div>
    </div> 
<?php get_footer(); ?>