<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SlideContentClass')) {
 	  $gallary = new SlideContentClass();

 	  if (method_exists($gallary, 'mediaGalleryImageDelete')) {

 	  	 if (empty($_POST['mgallery_id'])) {
 	  	 	echo '<div class="alert alert-danger"> Gallery Id Must not be Empty!</div>';
 	  	 } else{
 	  	 	
 	  	 $mgallery_id = $_POST['mgallery_id'];	 

         $msg = $gallary->mediaGalleryImageDelete($mgallery_id);
 	  	 }
        	  	 
 	  }
  }
 }
