<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SlideContentClass')) {
 	  $gallary = new SlideContentClass();

 	  if (method_exists($gallary, 'galleryImageDelete')) {

 	  	 if (empty($_POST['gallery_id'])) {
 	  	 	echo '<div class="alert alert-danger"> Gallery Id Must not be Empty!</div>';
 	  	 } else{
 	  	 	
 	  	 $gallery_id = $_POST['gallery_id'];	 

         $msg = $gallary->galleryImageDelete($gallery_id);
 	  	 }
        	  	 
 	  }
  }
 }
