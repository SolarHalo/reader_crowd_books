<?php
add_action( 'wp_ajax_my_ajax_action', 'ajax_action_stuff' ); //  
add_action( 'wp_ajax_nopriv_my_ajax_action', 'ajax_action_stuff' ); //  
function ajax_action_stuff() {
 $series_id = $_POST['series_id'];  
 $post_content=$_POST['post_content'];
 $post_title= $_POST['post_title'];
  
 // Create post object
$my_post = array(
  'post_title'    => $post_title,
  'post_content'  => $post_content,
  'post_status'   => 'publish',
  'post_author'   => 1  
);

// Insert the post into the database
$post_id = wp_insert_post( $my_post); 
    $data_array = array("object_id"=>$post_id,'term_taxonomy_id'=>$series_id,'term_order'=>0);
    global $wpdb;
	$wpdb->insert("wp_term_relationships",$data_array);
 

 echo $post_id; //  
 die(); // 一定要加這行，才會完整的處理ajax請求
}