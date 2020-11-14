<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('DownloadClass')) {
 	  $dwCat = new DownloadClass(); 	  

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_data']) && $_POST['cat_data'] == 99) {

 	  	 if (empty($_POST['category_title'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($dwCat, 'addDownloadCategory')) {
 	  	 
 	  	 $category_title = $_POST['category_title'];

 	  	 $dwCat->addDownloadCategory($category_title);
 	  	 }
 	  	}
 	  }


 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_del_data']) && $_POST['cat_del_data'] == 99) {

 	  	 if (empty($_POST['cat_id'])) {
 	  	 	echo '<div class="alert alert-danger"> Id is Required!</div>';
 	  	 } else{

 	  	 if (method_exists($dwCat, 'deleteDownloadCategoryByCatId')) {
 	  	 
 	  	 $cat_id = $_POST['cat_id'];

 	  	 $dwCat->deleteDownloadCategoryByCatId($cat_id);
 	  	 }
 	  	}
 	  }

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cat_status_data']) && $_POST['cat_status_data'] == 99) {

 	  	if (empty($_POST['cat_status_id'])) {
 	  	 	echo '<div class="alert alert-danger"> * Id Must not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($dwCat, 'downloadCategoryStatusChangeById')) {
 	  	 
 	  	 $cat_status_id = $_POST['cat_status_id'];
 	  	 $cat_status    = $_POST['cat_status'];

 	  	 $dwCat->downloadCategoryStatusChangeById($cat_status,$cat_status_id);
 	  	 }
 	  	}
 	  }


 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dwf_check_data']) && $_POST['dwf_check_data'] == 99) {

 	  	if (method_exists($dwCat, 'addDownloadFromData')) {

 	  	if (empty($_FILES['dwf_file']) || empty($_POST['dwf_title']) || empty($_POST['dwf_cat_title'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
 	  	 } else{
 	  	 	
 	  	    $dwf_title = $_POST['dwf_title'];
 	  	    $dwf_date  = $_POST['dwf_date'];
 	  	    $dwf_cat_title = $_POST['dwf_cat_title'];
            $dwf_file = $_FILES['dwf_file'];	 
          
          $dwCat->addDownloadFromData($dwf_title,$dwf_date,$dwf_cat_title,$dwf_file);
 	  	 } 	  	
 	    }
 	  }

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dwf_del_data']) && $_POST['dwf_del_data'] == 99) {

 	  	 if (empty($_POST['dwf_id'])) {
 	  	 	echo '<div class="alert alert-danger"> Id is Required!</div>';
 	  	 } else{

 	  	 if (method_exists($dwCat, 'deleteDownloadFromByCatId')) {
 	  	 
 	  	 $dwf_id = $_POST['dwf_id'];

 	  	 $dwCat->deleteDownloadFromByCatId($dwf_id);
 	  	 }
 	  	}
 	  }

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['dwf_status_check']) && $_POST['dwf_status_check'] == 99) {

 	  	if (empty($_POST['dwf_status_id'])) {
 	  	 	echo '<div class="alert alert-danger"> * Id Must not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($dwCat, 'downloadStatusChangeById')) {
 	  	 
 	  	 $dwf_status_id = $_POST['dwf_status_id'];
 	  	 $dwf_status    = $_POST['dwf_status'];

 	  	 $dwCat->downloadStatusChangeById($dwf_status,$dwf_status_id);
 	  	 }
 	  	}
 	  }

 	 


 }
