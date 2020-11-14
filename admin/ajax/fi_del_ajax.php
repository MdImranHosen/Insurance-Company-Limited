<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('FinancialIndicatorsClass')) {
 	  $fiObj = new FinancialIndicatorsClass();

 	  if (method_exists($fiObj, 'financialIndicatursDelById')) {
 	  	if($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['fi_data']) && $_POST['fi_data'] == 99) {
 	  	 
 	  	 $fi_id   = $_POST['fi_id'];
 	  	 $fi_type = $_POST['fi_type'];

 	  	 $fiObj->financialIndicatursDelById($fi_type,$fi_id);
 	  	}
 	  }
 }
