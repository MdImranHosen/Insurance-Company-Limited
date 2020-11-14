<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('BranchesClass')) {
 	  $bs = new BranchesClass();

 	  if (method_exists($bs, 'addBranchesData')) {
 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['branches_data']) && $_POST['branches_data'] == 99) {
 	  	 
 	  	 $branches_name    = $_POST['branches_name'];
 	  	 $branches_address = $_POST['branches_address'];
 	  	 $branches_phone   = $_POST['branches_phone'];
 	  	 $branches_email   = $_POST['branches_email'];
 	  	 $division         = $_POST['division'];

 	  	 $msg = $bs->addBranchesData($branches_name,$branches_address,$branches_phone,$branches_email,$division);
 	  	}
 	  }
 }
