<?php
include '../classes/Mainclass.php';

if (class_exists('Contactclass')) {
	$obj = new Contactclass();
	if (method_exists($obj, 'sendResumetoSite')) {

	  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['resume_data']) && $_POST['resume_data'] == 98) {

		$first_name  = $_POST['first_name'];
		$last_name   = $_POST['last_name'];
		$re_email    = $_POST['re_email'];
		$phone_num   = $_POST['phone_num'];
		$re_address  = $_POST['re_address'];
		$rem_file    = $_FILES['rem_file'];

		echo $data = $obj->sendResumetoSite($first_name,$last_name,$re_email,$phone_num,$re_address,$rem_file);
	 }
	}
}