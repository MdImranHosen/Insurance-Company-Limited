<?php
if (realpath("../../classes/Mainclass.php")) {

 include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SettingsClass')) {
 	  $settings = new SettingsClass();

 	  if (method_exists($settings, 'companyProfileUpdate')) {

 	  	 if (empty($_POST['company_profile'])) {
 	  	 	echo '<div class="alert alert-danger"> Field Must not be Empty!</div>';
 	  	 } else{

 	  	 $company_profile = $_POST['company_profile'];
         $cp_id = $_POST['cp_id'];

        $msg = $settings->companyProfileUpdate($company_profile,$cp_id);
 	    }
        	  	 
 	 }
  }
 }
