<?php
  include "../../classes/Mainclass.php";
 Session::checkSession();

 if (class_exists('FinancialIndicatorsClass')) {
 	  $fiObj = new FinancialIndicatorsClass();

 	  if (method_exists($fiObj, 'addFIAddData')) {

 	  	if (empty($_FILES['fi_doc']) || empty($_POST['fi_title'])) {
 	  	 	echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
 	  	 } else{
 	  	 	
 	  	    $fi_title = $_POST['fi_title'];
 	  	    $fi_date  = $_POST['fi_date'];
 	  	    $fir_type = $_POST['fir_type'];
            $fi_doc   = $_FILES['fi_doc'];	 
          
          $fiObj->addFIAddData($fi_title,$fi_date,$fir_type,$fi_doc);
 	  	 } 	  	
 	  }
 }
