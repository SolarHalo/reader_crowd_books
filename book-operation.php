<?php
/*
 Template Name: user_book_operation
*/

$method = $_GET['method'];
if($method == "addbook"){
	$bookDes = $_GET['bookDes'];
	$progress = $_GET['progress'];
	$category = $_GET['category'];
	$bookname = $_GET['bookname'];
	$slug = str_replace(" ","-",$bookname);
	
	//wp_terms
	$data_array = array("name"=>$bookname,'slug'=>$slug,'term_group'=>0);
	$wpdb->insert("wp_terms",$data_array);
	$books = $wpdb->get_results("select term_id from wp_terms where name = '".$bookname."'");
	$term_id="";
	foreach ($books as $book){
		$term_id = $book->term_id;
		break;
	}
	
	//wp_term_taxonomy
	$data_array = array("term_id"=>$term_id,'taxonomy'=>'series','description'=>$bookDes,'parent'=>$category);
	$wpdb->insert("wp_term_taxonomy",$data_array);
	
	//wp_orgseriesicons
	$len = strlen($bookDes);
	$data_array = array("term_id"=>$term_id,'words'=>$len,"progress"=>$progress);
	$wpdb->insert("wp_orgseriesicons",$data_array);
	echo "success";
}else if("bookPhoto"== $method){
	
}

?>