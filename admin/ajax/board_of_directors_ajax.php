<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('EmployerClass')) {
 	  $em = new EmployerClass();

 	  if (method_exists($em, 'addBoardOfDirector')) {

 	  	 if (empty($_POST['bod_name']) || empty($_FILES['bod_img']) || empty($_POST['bod_designation'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
 	  	 } else{
 	  	 	
			$bod_name = $_POST['bod_name'];
			$bod_deg  = $_POST['bod_designation'];
			$bod_img  = $_FILES['bod_img'];
			$bod_des  = $_POST['bod_description'];
			$bod_fb   = $_POST['bod_fb'];
			$bod_tw   = $_POST['bod_tw'];
			$bod_pt   = $_POST['bod_pt'];
			$bod_lk   = $_POST['bod_lk'];
			$em_type  = $_POST['em_type'];

            $em->addBoardOfDirector($bod_name,$bod_deg,$bod_img,$bod_des,$bod_fb,$bod_tw,$bod_pt,$bod_lk,$em_type);
 	  	 }
        	  	 
 	  }
  }
 }
