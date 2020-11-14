<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('ShareHoldersClass')) {
 	  $sho = new ShareHoldersClass();

 	  if (method_exists($sho, 'shareHolsersEditById')) {
 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['share_data']) && $_POST['share_data'] == 99) {
 	  	 
 	  	 $sharehol_id = $_POST['sharehol_id'];

 	  	 $sho->shareHolsersEditById($sharehol_id);
 	  	}
 	  }
 }
