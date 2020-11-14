<?php
include '../classes/Mainclass.php';

if (class_exists('OnlineClaim')) {
	$obj = new OnlineClaim();
	if (method_exists($obj, 'setOnlineClaimByUser')) {

	  if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['online_claim_data']) && $_POST['online_claim_data'] == 98) {

		$name_insured  = $_POST['name_insured'];
		$pcn_cnn       = $_POST['pcn_cnn'];
		$dateol        = $_POST['dateol'];
		$placeol       = $_POST['placeol'];
		$natureol      = $_POST['natureol'];
		$causeol       = $_POST['causeol'];
		$vehicleno     = $_POST['vehicleno'];
		$estol_ia      = $_POST['estol_ia'];
		$contact_p     = $_POST['contact_p'];
		$address       = $_POST['address'];
		$phone_n       = $_POST['phone_n'];
		$mobile_n      = $_POST['mobile_n'];
		$fax_n         = $_POST['fax_n'];
		$email         = $_POST['email'];
        
        if (isset($_FILES['doc_one'])) {  //
        	$doc_one = $_FILES['doc_one'];
        }else{
        	$doc_one = '';
        }

        if (isset($_FILES['doc_two'])) {
        	$doc_two = $_FILES['doc_two'];
        }else{
        	$doc_two = '';
        }

        if (isset($_FILES['doc_three'])) {
        	$doc_three = $_FILES['doc_three'];
        }else{
        	$doc_three = '';
        }
		

		$data = $obj->setOnlineClaimByUser($name_insured,$pcn_cnn,$dateol,$placeol,$natureol,$causeol,$vehicleno,$estol_ia,$contact_p,$address,$phone_n,$mobile_n,$fax_n,$email,$doc_one,$doc_two,$doc_three);
	 }
	}
}