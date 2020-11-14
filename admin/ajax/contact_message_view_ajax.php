<?php
  if (realpath("../../classes/Mainclass.php")) {
  	include "../../classes/Mainclass.php";
  	 Session::checkSession();

	 if (class_exists('Contactclass')) {
	 	  $conObj = new Contactclass();

	 	  if (method_exists($conObj, 'contactViewMessageById')) {
	 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['message_data']) && $_POST['message_data'] == 99) {

	 	  	 $message_id = $_POST['message_id'];

	 	  	 $conObj->contactViewMessageById($message_id);
	 	  	}
	 	  }
	 }
 }
