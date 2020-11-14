<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('ShareHoldersClass')) {
 	  $sho = new ShareHoldersClass();

 	  if (method_exists($sho, 'shareHolsersTextEditById')) {
 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['share_text_data']) && $_POST['share_text_data'] == 99) {
 	  	 
 	  	 $shtid = $_POST['shtid'];

 	  	 $sho->shareHolsersTextEditById($shtid);
 	  	}
 	  }
 }
