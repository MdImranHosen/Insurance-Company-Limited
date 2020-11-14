<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('OnlineClaim')) {
 	  $ocObj = new OnlineClaim(); 	  

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['oc_data']) && $_POST['oc_data'] == 99) {

 	  	 if (empty($_POST['ocid'])) {
 	  	 	echo '<div class="alert alert-danger"> Id is Required!</div>';
 	  	 } else{

 	  	 if (method_exists($ocObj, 'deleteOnlineClaimById')) {
 	  	 
 	  	 $ocid = $_POST['ocid'];

 	  	 $ocObj->deleteOnlineClaimById($ocid);
 	  	 }
 	  	}
 	  }
 	  

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['viewoc_data']) && $_POST['viewoc_data'] == 99) {

 	  	if (empty($_POST['vocid'])) {
 	  	 	echo '<div class="alert alert-danger"> * Id Must not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($ocObj, 'viewOnlineClaimById')) {
 	  	 
 	  	  $vocid = $_POST['vocid'];

 	  	  $ocObj->viewOnlineClaimById($vocid);

 	  	 }
 	  	}
 	  }

 	 


 }
