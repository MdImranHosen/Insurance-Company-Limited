<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('DigitalInsurance')) {
 	  $obj = new DigitalInsurance(); 	  

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['digital_status']) && $_POST['digital_status'] == 99) {

 	  	if (empty($_POST['dgitalinid']) || empty($_POST['digital_status'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Should not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($obj, 'getDigitalInsuranceById')) {
 	  	 
 	  	   $dgitalinid = $_POST['dgitalinid'];

 	  	   echo $obj->getDigitalInsuranceById($dgitalinid);
 	  	 }
 	  	}
 	  }

 	  if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['digidelin']) && $_POST['digital_del'] == 99) {

 	  	if (empty($_POST['digidelin']) || empty($_POST['digital_del'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Should not be Empty!</div>';
 	  	 } else{

 	  	 if (method_exists($obj, 'delDigitalInsuranceById')) {
 	  	 
 	  	   $digidelin = $_POST['digidelin'];

 	  	   $obj->delDigitalInsuranceById($digidelin);
 	  	 }
 	  	}
 	  }


 	  

 	  

 }
