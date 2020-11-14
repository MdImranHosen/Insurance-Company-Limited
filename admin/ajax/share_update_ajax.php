<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('ShareHoldersClass')) {
 	  $sho = new ShareHoldersClass();

 	  if (method_exists($sho, 'editShareHolsersDataById')) {
 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['share_data']) && $_POST['share_data'] == 99) {

 	  	 $sh_id       = $_POST['sh_id'];
 	  	 $name        = $_POST['name_edit'];
 	  	 $position    = $_POST['position_edit'];
 	  	 $no_of_share = $_POST['no_of_share_edit'];
 	  	 $amount      = $_POST['amount_edit'];
 	  	 $percentage  = $_POST['percentage_edit'];

 	  	 $sho->editShareHolsersDataById($sh_id,$name,$position,$no_of_share,$amount,$percentage);
 	  	}
 	  }
 }
