<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('ServicesClass')) {
 	  $psObj = new ServicesClass();

 	  if (method_exists($psObj, 'servicesStatusChangeById')) {

 	  	 if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['services_status']) && $_POST['services_status'] == 99) {

 	  	 	$servicesid = $_POST['servicesid'];
 	  	 	$status     = $_POST['status'];
 	  	    $psObj->servicesStatusChangeById($servicesid,$status);
 	  	 }
 	  	 
 	  }
 }
