<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('SettingsClass')) {
 	  $settObj = new SettingsClass();

 	  if (method_exists($settObj, 'pageTitleDataUpdateByPageName')) {
 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['page_datas']) && $_POST['page_datas'] == 99) {

 	  	 $menut_id    = $_POST['menut_id'];
 	  	 $paged_title = $_POST['paged_title'];
 	  	 $settObj->pageTitleDataUpdateByPageName($menut_id,$paged_title);
 	  	}
 	  }
 }
