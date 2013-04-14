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
  if ((($_FILES["bookcover"]["type"] == "image/gif")|| ($_FILES["bookcover"]["type"] == "image/jpeg")|| ($_FILES["bookcover"]["type"] == "image/png")))
  {
	  if ($_FILES["file"]["error"] > 0)
	    {
	    echo "Return Code: " . $_FILES["bookcover"]["error"] . "<br />";
	    }
	  else
	    {
	    echo "Upload: " . $_FILES["bookcover"]["name"] . "<br />";
	    echo "Type: " . $_FILES["bookcover"]["type"] . "<br />";
	    echo "Size: " . ($_FILES["bookcover"]["size"] / 1024) . " Kb<br />";
	    echo "Temp file: " . $_FILES["bookcover"]["tmp_name"] . "<br />";
	     $file_path =  get_theme_root()."/reader_crowd_books/upload/";   
	      
	    if (file_exists($file_path . $_FILES["bookcover"]["name"]))
	      {
	      	 $userid = $_GET['userid'];
	         echo $userid.$_FILES["bookcover"]["name"] . " already exists. ";
	      }
	    else
	      {
		      move_uploaded_file($_FILES["bookcover"]["tmp_name"],
		      $file_path . $_FILES["bookcover"]["name"]);
		      $userid = $_GET['userid'];
		      
		      
		      echo $userid."the file upload success!";
	      }
	    }
  }
else
  {
   echo "Invalid file";
  };
	
}

?>