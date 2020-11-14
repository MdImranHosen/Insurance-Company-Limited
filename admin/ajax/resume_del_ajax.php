<?php
if (realpath("../../classes/Mainclass.php")) {
include '../../classes/Mainclass.php';
Session::checkSession();

if (class_exists('Contactclass')) {
	$obj = new Contactclass();
	if (method_exists($obj, 'sendResumetoDeleteById')) {

	  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resume_del']) && $_POST['resume_del'] == 98) {
		$resumeid  = $_POST['resumeid'];
		$obj->sendResumetoDeleteById($resumeid);
	 }
	}
  }
}