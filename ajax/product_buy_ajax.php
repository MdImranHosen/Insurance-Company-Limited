<?php
include '../classes/Mainclass.php';

if (class_exists('DigitalInsurance')) {
	$obj = new DigitalInsurance();
	if (method_exists($obj, 'setProductBuyByUser')) {

	  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_buy_data']) && $_POST['product_buy_data'] == 98) {

		$name = $_POST['name'];
		$address = $_POST['address'];
		$telephone_number = $_POST['telephone_number'];
		$cell_number = $_POST['cell_number'];
		$fax_number = $_POST['fax_number'];
		$email_address = $_POST['email_address'];
		$insert_to_be_covered = $_POST['insert_to_be_covered'];
		$abiwb = $_POST['abiwb'];
		$watrywtc = $_POST['watrywtc'];
		$conoftbuil  = $_POST['conoftbuil'];
		$occupation  = $_POST['occupation'];
		$locationotp = $_POST['locationotp'];
		$services_name= $_POST['services_name']; 		

		$data = $obj->setProductBuyByUser($name,$address,$telephone_number,$cell_number,$fax_number,$email_address,$insert_to_be_covered,$abiwb,$watrywtc,$conoftbuil,$occupation,$locationotp,$services_name);
	 }
	}
}