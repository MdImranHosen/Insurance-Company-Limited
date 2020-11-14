<?php
  if (realpath("../../classes/Mainclass.php")) {
  	include "../../classes/Mainclass.php";
  	 Session::checkSession();

	 if (class_exists('NewsEventsClass')) {
	 	  $neObj = new NewsEventsClass();

	 	  if (method_exists($neObj, 'newsEventsDetailsid')) {

	 	  	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['newsevents_data']) && $_POST['newsevents_data'] == 99) {
	 	  		$newseventsid = $_POST['newseventsid'];
	 	  	    $neObj->newsEventsDetailsid($newseventsid);
	 	  	 }
	 	  	 
	 	  }
	 }
 }
