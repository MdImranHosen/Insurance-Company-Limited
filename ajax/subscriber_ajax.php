<?php
include '../classes/Mainclass.php';

if (class_exists('Contactclass')) {
	$obj = new Contactclass();
	if (method_exists($obj, 'addSubscriber')) {

		$sb_email = $_POST['sb_email'];

		echo $data = $obj->addSubscriber($sb_email);
	}
}


