<?php
  if (realpath("../../classes/Mainclass.php")) {
  	include "../../classes/Mainclass.php";
  	 Session::checkSession();

	 if (class_exists('EmployerClass')) {
	 	  $em = new EmployerClass();

	 	  if (method_exists($em, 'boardOfDirectorsDetailsid')) {

	 	  	 $bodvid = $_POST['bodvid'];
	 	  	 $em_type  = $_POST['em_type'];
	 	  	 $em->boardOfDirectorsDetailsid($em_type,$bodvid);
	 	  }
	 }
 }
