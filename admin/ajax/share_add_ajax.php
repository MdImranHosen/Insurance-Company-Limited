<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('ShareHoldersClass')) {
 	  $sho = new ShareHoldersClass();

 	  if (method_exists($sho, 'addShareHolsersData')) {
 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['share_data']) && $_POST['share_data'] == 99) {
 	  	 
 	  	 $name        = $_POST['name'];
 	  	 $position    = $_POST['position'];
 	  	 $no_of_share = $_POST['no_of_share'];
 	  	 $amount      = $_POST['amount'];
 	  	 $percentage  = $_POST['percentage'];

 	  	 $sho->addShareHolsersData($name,$position,$no_of_share,$amount,$percentage);
 	  	}
 	  }
 }
