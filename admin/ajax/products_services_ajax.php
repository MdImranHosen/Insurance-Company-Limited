<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('ServicesClass')) {
 	  $ps = new ServicesClass();

 	  if (method_exists($ps, 'productsServicesAdd')) {

 	  	 if (empty($_POST['ps_icon']) || empty($_FILES['ps_img']) || empty($_POST['ps_title'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
 	  	 } else{

			$ps_icon    = $_POST['ps_icon'];
			$ps_title   = $_POST['ps_title'];
			$ps_details = $_POST['ps_details'];
			$ps_img     = $_FILES['ps_img'];

            $ps->productsServicesAdd($ps_icon,$ps_title,$ps_img,$ps_details);
 	  	 }
        	  	 
 	  }
  }
 }
