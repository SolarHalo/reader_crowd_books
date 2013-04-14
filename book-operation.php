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
	$userid = $_GET['user_id'];
	$term_id = "";
	$slug = str_replace(" ","-",$bookname);
	$data_array = array("name"=>$bookname,'slug'=>$slug,'term_group'=>0);
	
	
	if(isset($_GET['termid'])){
		$term_id = $_GET['termid'];
		$wpdb->update("wp_terms",$data_array, array('term_id'=> $term_id));
		
		$data_array = array("term_id"=>$term_id,'taxonomy'=>'series','description'=>$bookDes,'parent'=>$category);
		$wpdb->update("wp_term_taxonomy",$data_array, array("term_id" =>$term_id ));
		$len = strlen($bookDes);
		$data_array = array("term_id"=>$term_id,'words'=>$len,"progress"=>$progress);
		$wpdb->update("wp_orgseriesicons",$data_array, array("term_id"=>$term_id));
	}else{
		$wpdb->insert("wp_terms",$data_array);
		$books = $wpdb->get_results("select term_id from wp_terms where name = '".$bookname."'");
		foreach ($books as $book){
			$term_id = $book->term_id;
			break;
		}
		$data_array = array("term_id"=>$term_id,'taxonomy'=>'series','description'=>$bookDes,'parent'=>$category);
		$wpdb->insert("wp_term_taxonomy",$data_array);
		
		$len = strlen($bookDes);
		$data_array = array("user_id"=>$userid, "term_id"=>$term_id,'words'=>$len,"progress"=>$progress);
		$wpdb->insert("wp_orgseriesicons",$data_array);
	}
	//wp_orgseriesicons
	
	
	echo $term_id;
}else if("bookPhoto"== $method){ 
	$term_id = $_GET['termid'];
	$userid  = $_GET['userid'];
	$filename = microtime()*1000000;
  if ((($_FILES["bookcover"]["type"] == "image/gif")|| ($_FILES["bookcover"]["type"] == "image/jpeg")|| ($_FILES["bookcover"]["type"] == "image/png")))
  {
  	
  	$filebak = explode("." , $_FILES["bookcover"]["name"]);
  	$filename = $filename.$filebak[count($filebak) -1].$_FILES["bookcover"]["name"];
  	
	  if ($_FILES["file"]["error"] > 0)
	    {
	    echo "Return Code: " . $_FILES["bookcover"]["error"] . "<br />";
	    }
	  else
	    {
	    $file_path =  get_theme_root()."/reader_crowd_books/upload/";   
	      
	    
		      move_uploaded_file($_FILES["bookcover"]["tmp_name"],
		      $file_path .$filename);
		      
		      $data_array = array("term_id"=>$term_id,'user_id'=>$userid,"icon"=>$filename);
		      $wpdb->upadte("wp_orgseriesicons", $data_array, array("term_id"=>$term_id));
		      
		      echo "success:::". get_template_directory_uri()."/upload/".$filename;
	      
	    }
  }
else
  {
   echo "Invalid file";
  };
	
}

?>