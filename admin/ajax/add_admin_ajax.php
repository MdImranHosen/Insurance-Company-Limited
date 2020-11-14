<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('Adminclass')) {
 	  $admin = new Adminclass();

 	if (method_exists($admin, 'addAdminData')) {
 	  	 
 	  	 $name     = $_POST['admin_name'];
         $email    = $_POST['admin_email'];
         $type     = $_POST['typeone'];
         $password = $_POST['admin_password'];

	     if (empty($name) || empty($email) || empty($password) || empty($type)) {
	       echo '<div class="alert alert-danger"> Field Must not be Empty!</div>';
	     } else{
	      $msg = $admin->addAdminData($name,$email,$password,$type);
        }
 	  }

 }
