<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SettingsClass')) {
 	  $settings = new SettingsClass();

 	  if (method_exists($settings, 'ourMissionVissionUpData')) {

 	  	 if (empty($_POST['our_vision_mission'])) {
 	  	 	echo '<div class="alert alert-danger"> Field Must not be Empty!</div>';
 	  	 } else{

 	  	 $our_vision_mission = $_POST['our_vision_mission'];
         $vm_id = $_POST['vm_id'];

        $msg = $settings->ourMissionVissionUpData($our_vision_mission,$vm_id);
 	    }
        	  	 
 	 }
  }
 }
