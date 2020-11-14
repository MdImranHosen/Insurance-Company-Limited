<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('ServicesClass')) {
 	  $psPObj = new ServicesClass(); 	  

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['policy_data']) && $_POST['policy_data'] == 99) {

 	  	 if (empty($_POST['policy_name']) || empty($_FILES['policy_img'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($psPObj, 'addpsPolicyData')) {
 	  	 
 	  	 $services_url = $_POST['services_url'];
 	  	 $policy_name  = $_POST['policy_name'];
 	  	 $policy_des   = $_POST['policy_des'];
 	  	 $highlights   = $_POST['highlights'];
 	  	 $covered      = $_POST['covered'];
 	  	 $exclusions   = $_POST['exclusions'];
 	  	 $policy_img   = $_FILES['policy_img'];

 	  	 $psPObj->addpsPolicyData($services_url,$policy_name,$policy_img,$policy_des,$highlights,$covered,$exclusions);
 	  	 }
 	  	}
 	  }


 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['policy_data_view']) && $_POST['policy_data_view'] == 99) {

 	  	 if (empty($_POST['policy_id']) || empty($_POST['services_url'])) {
 	  	 	echo '<div class="alert alert-danger"> * Id Must not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($psPObj, 'viewpsPolicyDataByPId')) {
 	  	 
 	  	 $services_url = $_POST['services_url'];
 	  	 $policy_id    = $_POST['policy_id'];

 	  	 $psPObj->viewpsPolicyDataByPId($services_url,$policy_id);
 	  	 }
 	  	}
 	  }

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['policy_data_status']) && $_POST['policy_data_status'] == 99) {

 	  	if (empty($_POST['policy_id'])) {
 	  	 	echo '<div class="alert alert-danger"> * Id Must not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($psPObj, 'policyStatusChangeByPId')) {
 	  	 
 	  	 $policy_status = $_POST['policy_status'];
 	  	 $policy_id     = $_POST['policy_id'];

 	  	 $psPObj->policyStatusChangeByPId($policy_status,$policy_id);
 	  	 }
 	  	}
 	  }

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['policy_data_del']) && $_POST['policy_data_del'] == 99) {

 	  	if (empty($_POST['policy_id'])) {
 	  	 	echo '<div class="alert alert-danger"> * Id Must not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($psPObj, 'psPolicyDeleteByPId')) {
 	  	 
 	  	 $services_url = $_POST['services_url'];
 	  	 $policy_id    = $_POST['policy_id'];

 	  	 $psPObj->psPolicyDeleteByPId($services_url,$policy_id);
 	  	 }
 	  	}
 	  }


 }
