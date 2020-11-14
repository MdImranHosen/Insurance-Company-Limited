<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SettingsClass')) {
 	  $settObj = new SettingsClass();

 	  if (method_exists($settObj, 'pageTitleDataByPageName')) {
 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['page_data']) && $_POST['page_data'] == 99) {
 	  	 $pagetid   = $_POST['pagetid'];
 	  	 $settObj->pageTitleDataByPageName($pagetid);
 	  	}
 	  }
 }
