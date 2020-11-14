<?php
if (realpath("../../classes/Mainclass.php")) {
 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SlideContentClass')) {
 	  $scc = new SlideContentClass();

 	  if (method_exists($scc, 'setImageVideoWelcome')) {

 	  	 if (empty($_POST['youtube_video_url'])) {
 	  	 	echo '<div class="alert alert-danger"> YouTube url Field is Required!</div>';
 	  	 } else{
 	  	 	
 	  	 $youtube_video_url = $_POST['youtube_video_url'];
 	  	 $welcome_msg       = $_POST['welcome_msg']; 
         $ivw_id            = $_POST['ivw_id'];
         if (isset($_FILES['banner_image'])) {
         	$banner_image   = $_FILES['banner_image']; 
         }else{
         	$banner_image = '';
         }        

         $scc->setImageVideoWelcome($youtube_video_url,$banner_image,$welcome_msg,$ivw_id);
 	  	 }
        	  	 
 	  }
  }
 }
