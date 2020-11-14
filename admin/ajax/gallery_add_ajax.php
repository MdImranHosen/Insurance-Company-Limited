<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SlideContentClass')) {
 	  $gallary = new SlideContentClass();

 	  if (method_exists($gallary, 'galleryImageAdd')) {

 	  	 if (empty($_FILES['gallery_image']) || empty($_POST['content_title'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
 	  	 } else{
 	  	 	
 	  	 $content_title = $_POST['content_title'];
         $gallery_image = $_FILES['gallery_image'];  	 

         $msg = $gallary->galleryImageAdd($content_title,$gallery_image);
 	  	 }
        	  	 
 	  }
  }
 }
