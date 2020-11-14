<?php
  if (realpath("../../classes/Mainclass.php")) {
  	include "../../classes/Mainclass.php";
  	 Session::checkSession();

	 if (class_exists('NewsEventsClass')) {
	 	  $neObj = new NewsEventsClass();

	 	  if (method_exists($neObj, 'newsEventsDelid')) {

	 	  	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['news_events_del_data']) && $_POST['news_events_del_data'] == 99) {
	 	  		$news_events_delid = $_POST['news_events_delid'];
	 	  	    $neObj->newsEventsDelid($news_events_delid);
	 	  	 }
	 	  	 
	 	  }
	 }
 }
