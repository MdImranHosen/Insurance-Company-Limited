<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('ShareHoldersClass')) {
 	  $sho = new ShareHoldersClass();

 	  if (method_exists($sho, 'shareHolsersDelById')) {
 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['share_data']) && $_POST['share_data'] == 99) {
 	  	 
 	  	 $sharehol_delid = $_POST['sharehol_delid'];

 	  	 $sho->shareHolsersDelById($sharehol_delid);
 	  	}
 	  }
 }
