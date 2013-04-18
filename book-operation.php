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
    $wpdb->show_errors(); 
    
	if($_GET['termid'] != null && $_GET['termid'] != "" ){
		
		$term_id = $_GET['termid'];
		 
		$wpdb->update("wp_terms",$data_array, array('term_id'=> $term_id));
		
		$data_array = array("term_id"=>$term_id,'taxonomy'=>'series','description'=>$bookDes,'parent'=>$category);
		$wpdb->update("wp_term_taxonomy",$data_array, array("term_id" =>$term_id ));
		
		$len = str_word_count($bookDes);
		//$data_array = array("term_id"=>$term_id,'words'=>$len,"progress"=>$progress,"modifytime"=>new DateTime());
		//$wpdb->update("wp_orgseriesicons",$data_array, array("term_id"=>$term_id));
		$wpdb->query(
			"UPDATE wp_orgseriesicons  
			SET words = ".$len." , progress =".$progress.",modifytime=SYSDATE() 
			WHERE term_id = '".$term_id."'"
		);
	 
		
	}else{
		$wpdb->insert("wp_terms",$data_array);
		$books = $wpdb->get_results("select term_id from wp_terms where name = '".$bookname."'");
		
		foreach ($books as $book){
			$term_id = $book->term_id;
			break;
		}
		
		$data_array = array("term_id"=>$term_id,'taxonomy'=>'series','description'=>$bookDes,'parent'=>$category);
		$wpdb->insert("wp_term_taxonomy",$data_array);
		
		$len = str_word_count($bookDes);
		//$data_array = array("user_id"=>$userid, "term_id"=>$term_id,'words'=>$len,"progress"=>$progress,"modifytime"=>new DateTime());
		//$wpdb->insert("wp_orgseriesicons",$data_array);
		$wpdb->query(
				"insert into wp_orgseriesicons(term_id,user_id,progress,words,modifytime) 
				values('".$term_id."','".$userid."','".$progress."',".$len.", SYSDATE())"
		);
	}
	//wp_orgseriesicons
	
	echo $term_id;
} else if("delchapter" == $method){
	global $wpdb;
	$chapterid = $_GET['chapterid'];
	
	wp_delete_post( $chapterid, true );
	
	$wpdb->query(" DELETE from wp_postmeta where post_id ='".$chapterid."'");
	echo "successful";
} else if ("delbook" == $method){
	global $wpdb;
	$term_id = $_GET['term_id'];
	//删除 post
	$wpdb->query(" DELETE from wp_posts where id in (
		select object_id from wp_term_relationships where term_taxonomy_id in (
		select term_taxonomy_id from wp_term_taxonomy where term_id = '".$term_id."' ) )");
	
	$wpdb->query(" DELETE from wp_term_relationships where term_taxonomy_id in (
		select term_taxonomy_id from wp_term_taxonomy where term_id ='".$term_id."') ");
	
	$wpdb->query(" DELETE from wp_term_taxonomy where term_id ='".$term_id."'");
	
	$wpdb->query(" DELETE from wp_orgseriesicons where term_id ='".$term_id."'");
	
	$wpdb->query(" DELETE from wp_terms where term_id ='".$term_id."'");
	echo "successful";
	
} else if("bookPhoto"== $method){ 
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
		     // $upload_dir = wp_upload_dir();
		     $bashUrl = wp_upload_dir();
		     $file_path =  $bashUrl['basedir']."/".$bashUrl['subdir']."/";   
		     $file_save_path = $file_path .$filename;
		 
		      move_uploaded_file($_FILES["bookcover"]["tmp_name"],$file_save_path);
		      //  content/uploads/2013/02/add221a1fe148d0ef6532a770ecd8e5f56104cc1.gif 
		      $file_content = "wp-content/uploads".$bashUrl['subdir']."/".$filename;
		      $data_array = array("term_id"=>$term_id,'user_id'=>$userid,"icon"=>$file_content);
		      $wpdb->update("wp_orgseriesicons", $data_array, array("term_id"=>$term_id));
		      
		      echo "success:::".  get_site_url()."/".$file_content;
	      
	    }
  }
else
  {
   echo "Invalid file";
  };
	
}

?>