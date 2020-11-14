<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SlideContentClass')) {
 	  $slidecont = new SlideContentClass();

 	  if (method_exists($slidecont, 'slideContentAdd')) {

 	  	 if (empty($_FILES['slide_bg_img']) || empty($_POST['slide_title'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
 	  	 } else{
         $slide_title  = $_POST['slide_title'];
 	  	 $slide_bg_img = $_FILES['slide_bg_img'];

        $msg = $slidecont->slideContentAdd($slide_title,$slide_bg_img);
 	  	}
        	  	 
 	  }
  }
 }
