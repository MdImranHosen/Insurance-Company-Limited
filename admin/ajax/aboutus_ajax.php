<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SettingsClass')) {
 	  $settings = new SettingsClass();

 	  if (method_exists($settings, 'aboutUsAddData')) {

 	  	 if (empty($_POST['about_us'])) {
 	  	 	echo '<div class="alert alert-danger"> About Us Must not be Empty!</div>';
 	  	 } else{

 	  	 $about_us    = $_POST['about_us'];
         $about_us_id = $_POST['about_us_id'];

        $msg = $settings->aboutUsAddData($about_us,$about_us_id);
 	    }
        	  	 
 	 }
  }
 }
