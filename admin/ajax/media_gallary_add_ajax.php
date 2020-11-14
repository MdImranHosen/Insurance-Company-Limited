<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SlideContentClass')) {
 	  $mgallary = new SlideContentClass();

 	  if (method_exists($mgallary, 'mediaGallaryYouTubeUrlAdd')) {

 	  	 if (empty($_POST['youtube_video_url']) || empty($_POST['content_title'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
 	  	 } else{
 	  	 $content_title     = $_POST['content_title'];
         $youtube_video_url = $_POST['youtube_video_url'];  	 

         $msg = $mgallary->mediaGallaryYouTubeUrlAdd($content_title,$youtube_video_url);
 	  	 }
        	  	 
 	  }
  }
 }
