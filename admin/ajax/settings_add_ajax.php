<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SettingsClass')) {
 	  $settings = new SettingsClass();

 	  if (method_exists($settings, 'updateSettingsData')) {
 	  	 
    	 $site_title    = $_POST['site_title'];
    	 $meta_keyword  = $_POST['site_meta_keyword'];
    	 $meta_desc_on  = $_POST['site_meta_description'];
    	 $s_copy_right  = $_POST['site_copy_right'];
         $site_url      = $_POST['site_url'];
    	 $site_dev      = $_POST['site_dev'];
         $dev_site_url  = $_POST['develop_site_url'];
         $opening_time  = $_POST['opening_time'];
         $site_phone    = $_POST['site_phone'];
         $site_email    = $_POST['site_email'];
         $site_address  = $_POST['site_address'];
         $site_facebook = $_POST['site_facebook'];
         $site_twitter  = $_POST['site_twitter'];
         $site_linkedin = $_POST['site_linkedin'];
         $site_instagram= $_POST['site_instagram'];
         $site_youtube  = $_POST['site_youtube'];
         $site_footer_about = $_POST['site_footer_about'];


 	  	 if (empty($_FILES['site_icon'])) {
 	  	 	$site_icon = '';
 	  	 } else{
 	  	 	$site_icon = $_FILES['site_icon'];
 	  	 }

 	  	 if (empty($_FILES['site_logo'])) {
 	  	 	$site_logo = '';
 	  	 } else{
 	  	 	$site_logo = $_FILES['site_logo'];
 	  	 }

       $msg = $settings->updateSettingsData($site_title,$site_icon,$site_logo,$meta_keyword,$meta_desc_on,$s_copy_right,$site_url,$site_dev,$dev_site_url,$opening_time,$site_phone,$site_email,$site_address,$site_facebook,$site_twitter,$site_linkedin,$site_instagram,$site_youtube,$site_footer_about);
 	  }
 }
