<?php
  if (realpath("../../classes/Mainclass.php")) {
  	include "../../classes/Mainclass.php";
  	 Session::checkSession();

	 if (class_exists('ServicesClass')) {
	 	  $ps = new ServicesClass();

	 	  if (method_exists($ps, 'productsServicesDelid')) {

	 	  	 $servicesid = $_POST['servicesid'];

	 	  	 $ps->productsServicesDelid($servicesid);
	 	  }
	 }
 }
