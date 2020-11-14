<?php
  if (realpath("../../classes/Mainclass.php")) {
  	include "../../classes/Mainclass.php";
  	 Session::checkSession();

	 if (class_exists('NewsEventsClass')) {
	 	  $neObj = new NewsEventsClass();

	 	  if (method_exists($neObj, 'addNewsEvents')) {

	 	  	if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['news_events_add_data']) && $_POST['news_events_add_data'] == 99) {	 	  		

	 	  	    if (empty($_POST['news_events_title']) || empty($_FILES['news_events_img'])) {
		 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';

		 	  	  } else{

					$news_events_title = $_POST['news_events_title'];
					$news_events_date  = $_POST['news_events_date'];
					$news_events_des   = $_POST['news_events_des'];
					$news_events_img   = $_FILES['news_events_img'];

		            $neObj->addNewsEvents($news_events_title,$news_events_date,$news_events_img,$news_events_des);
		 	  	 }
	 	  	 }
	 	  	 
	 	  }
	 }
 }
