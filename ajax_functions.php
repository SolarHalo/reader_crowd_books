<?php
add_action( 'wp_ajax_my_ajax_action', 'ajax_action_stuff' ); //  
add_action( 'wp_ajax_nopriv_my_ajax_action', 'ajax_action_stuff' ); //  
function ajax_action_stuff() {
 $series_id = $_POST['series_id'];  
 $post_content=$_POST['post_content'];
 $post_title= $_POST['post_title']; 
 $post_id = $_POST['post_id'];
 $tip = "successful";
 if(strlen($post_id)==0){
	 // Create post object

	global $wpdb;
	$sql = "select term_taxonomy_id from wp_term_taxonomy where term_id ='$series_id'";
	$term_taxonomy_id = '';
	$term_taxonomy_ids = $wpdb->get_results($sql);
	 foreach ($term_taxonomy_ids as $term_taxonomy_id){
		 $term_taxonomy_id = $term_taxonomy_id->term_taxonomy_id;
		 break;
	 }
	// Insert the post into the database
	global $post_id;
	
	$authorSql = "select user_id from wp_orgseriesicons where term_id='$series_id'";
	
	$authors = $wpdb->get_results($authorSql);
	$authorId = "";
	foreach($authors as $author){
		$authorId = $author->user_id ;
		break;
	}
	
	$my_post = array(
			'post_title'    => stripslashes($post_title),
			'post_content'  => stripslashes($post_content),
			'post_status'   => 'publish',
			'post_author'   => $authorId
	);
	
	   $post_id = wp_insert_post( $my_post); 
	    $data_array = array("object_id"=>$post_id,'term_taxonomy_id'=>$term_taxonomy_id,'term_order'=>0);
	    
		$wpdb->insert("wp_term_relationships",$data_array);
		
		$wpdb->query(
			"UPDATE wp_orgseriesicons  
			SET modifytime=SYSDATE()  
			WHERE term_id = '".$series_id."'"
		); 
 }else{ 
//	$my_post = array(
//		  'ID'    => $post_id,
//		  'post_content'  => $post_content,
//		  'post_title' => $post_title
//		);
//     // Update the post into the database
//     $post_id = wp_update_post($my_post,null);
//bad!!!
 global $wpdb;
 	$wpdb->update( 
	'wp_posts', 
	array( 
		'post_content' => stripslashes("$post_content"),	// string
		'post_title' => stripslashes("$post_title") 
	), 
	array( 'ID' => $post_id ) 
	 
     ); 
 }	 
	$wpdb->query(
			"UPDATE wp_orgseriesicons  
			SET modifytime=SYSDATE() 
			WHERE term_id = '".$series_id."'"
		);
 echo $post_id; //  
 die(); // 
}