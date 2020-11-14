<?php
include '../classes/Mainclass.php';

if (class_exists('Contactclass')) {
	$obj = new Contactclass();
	if (method_exists($obj, 'getContactMessage')) {

		$name    = $_POST['name'];
		$phone   = $_POST['phone'];
		$email   = $_POST['email'];
		$subject = $_POST['subject'];
		$message = $_POST['message'];
		$related_into = $_POST['related_into'];

		echo $data = $obj->getContactMessage($name,$phone,$email,$subject,$message,$related_into);
	}
}


