<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SettingsClass')) {
 	  $settings = new SettingsClass();

 	  if (method_exists($settings, 'careerPageUpdateData')) {

 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['career_datac']) && $_POST['career_datac'] == 99) {

 	  	 if (empty($_POST['career'])) {
 	  	 	echo '<div class="alert alert-danger"> Field Must not be Empty!</div>';
 	  	 } else{

 	  	 $career   = $_POST['career'];
         $careerid = $_POST['careerid'];

         $settings->careerPageUpdateData($career,$careerid);
 	    }
 	   }
        	  	 
 	 }
  }
 }
