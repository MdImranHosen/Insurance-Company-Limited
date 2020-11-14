<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('ShareHoldersClass')) {
 	  $sho = new ShareHoldersClass();

 	  if (method_exists($sho, 'editShareHolserstextDataById')) {
 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['share_text_data']) && $_POST['share_text_data'] == 99) {

 	  	 $sht_id    = $_POST['sht_id'];
 	  	 $sht_title = $_POST['sht_title'];
 	  	 $sht_text  = $_POST['sht_text'];

 	  	 $sho->editShareHolserstextDataById($sht_id,$sht_title,$sht_text);
 	  	}
 	  }
 }
