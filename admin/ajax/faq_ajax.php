<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('FaqClass')) {
 	  $obj = new FaqClass(); 	  

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['faq_ad_data']) && $_POST['faq_ad_data'] == 99) {

 	  	if (empty($_POST['faq_ask']) || empty($_POST['faq_solution']) || empty($_POST['faq_ps_id'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($obj, 'addFaq')) {
 	  	 
 	  	 $faq_ask = $_POST['faq_ask'];
 	  	 $faq_solution = $_POST['faq_solution'];
 	  	 $faq_ps_id = $_POST['faq_ps_id'];

 	  	 $obj->addFaq($faq_ask,$faq_solution,$faq_ps_id);
 	  	 }
 	  	}
 	  }


 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['faq_del_data']) && $_POST['faq_del_data'] == 99) {

 	  	 if (empty($_POST['faq_id'])) {
 	  	 	echo '<div class="alert alert-danger"> Id is Required!</div>';
 	  	 } else{

 	  	 if (method_exists($obj, 'deleteFaqByfId')) {
 	  	 
 	  	 $faq_id = $_POST['faq_id'];

 	  	 $obj->deleteFaqByfId($faq_id);
 	  	 }
 	  	}
 	  }

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['faq_status_data']) && $_POST['faq_status_data'] == 99) {

 	  	if (empty($_POST['faq_status_id'])) {
 	  	 	echo '<div class="alert alert-danger"> * Id Must not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($obj, 'faqStatusChangeById')) {
 	  	 
 	  	 $faq_status_id = $_POST['faq_status_id'];
 	  	 $faq_status    = $_POST['faq_status'];

 	  	 $obj->faqStatusChangeById($faq_status,$faq_status_id);
 	  	 }
 	  	}
 	  }

 }
