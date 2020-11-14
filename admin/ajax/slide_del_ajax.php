<?php
  if (realpath("../../classes/Mainclass.php")) {
  	include "../../classes/Mainclass.php";
  	 Session::checkSession();

	 if (class_exists('SlideContentClass')) {
	 	  $slidecont = new SlideContentClass();

	 	  if (method_exists($slidecont, 'slideContentDelete')) {

	 	  	 $slidedelid = $_POST['slidedelid'];

	 	  	 $msg = $slidecont->slideContentDelete($slidedelid);
	 	  }
	 }
 }
