<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('BranchesClass')) {
 	  $bs = new BranchesClass();

 	  if (method_exists($bs, 'deleteBranchesById')) {

 	  	 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['branches_id']) && $_POST['branches_data'] == 99) {

 	  	 	$branches_id = $_POST['branches_id'];
 	  	    $msg = $bs->deleteBranchesById($branches_id);
 	  	 }
 	  	 
 	  }
 }
