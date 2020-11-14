<?php
  if (realpath("../../classes/Mainclass.php")) {
  	include "../../classes/Mainclass.php";
  	 Session::checkSession();

	 if (class_exists('EmployerClass')) {
	 	  $em = new EmployerClass();

	 	  if (method_exists($em, 'boardOfDirectorsDelid')) {

	 	  	 $bod_id = $_POST['bod_id'];
	 	  	 $em_type= $_POST['em_type'];

	 	  	 $em->boardOfDirectorsDelid($em_type,$bod_id);
	 	  }
	 }
 }
