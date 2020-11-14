<?php
/**
 * DigitalInsurance Class
 */
class DigitalInsurance extends Mainclass
{
	
    public function setProductBuyByUser($name,$address,$telephone_number,$cell_number,$fax_number,$email_address,$insert_to_be_covered,$abiwb,$watrywtc,$conoftbuil,$occupation,$locationotp,$services_name) {

	 try {
	    
	    $name = $this->fm->validation($name);
	    $address = $this->fm->validation($address);
		$telephone_number = $this->fm->validation($telephone_number);
	    $cell_number = $this->fm->validation($cell_number);
	    $fax_number = $this->fm->validation($fax_number);
	    $email_address = $this->fm->validation($email_address);
	    $insert_to_be_covered = $this->fm->validation($insert_to_be_covered);
	    $abiwb = $this->fm->validation($abiwb);
	    $watrywtc = $this->fm->validation($watrywtc);
	    $conoftbuil  = $this->fm->validation($conoftbuil);
	    $occupation  = $this->fm->validation($occupation);
	    $locationotp = $this->fm->validation($locationotp);
	    $services_name = $this->fm->validation($services_name);	   

	    $name = mysqli_real_escape_string($this->db->link, $name);
	    $address = mysqli_real_escape_string($this->db->link, $address);
	    $telephone_number = mysqli_real_escape_string($this->db->link, $telephone_number);
	    $cell_number = mysqli_real_escape_string($this->db->link, $cell_number);
	    $fax_number = mysqli_real_escape_string($this->db->link, $fax_number);
	    $email_address = mysqli_real_escape_string($this->db->link, $email_address);
	    $insert_to_be_covered = mysqli_real_escape_string($this->db->link, 
	    $insert_to_be_covered);
	    $abiwb = mysqli_real_escape_string($this->db->link, $abiwb);
	    $watrywtc = mysqli_real_escape_string($this->db->link, $watrywtc);
	    $conoftbuil  = mysqli_real_escape_string($this->db->link, $conoftbuil);
	    $occupation  = mysqli_real_escape_string($this->db->link, $occupation);
	    $locationotp = mysqli_real_escape_string($this->db->link, $locationotp);
	    $services_name = mysqli_real_escape_string($this->db->link, $services_name);    

	    if (empty($name) || empty($address) || empty($telephone_number) || empty($cell_number) || empty($email_address)) {
	      echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
	    } else {

	   $sql = "INSERT INTO digital_product_buy(name,address,telephone_number,cell_number,fax_number,email_address,insert_to_be_covered,abiwb,watrywtc,conoftbuil,occupation,locationotp,services_name) VALUES('$name','$address','$telephone_number','$cell_number','$fax_number','$email_address','$insert_to_be_covered','$abiwb','$watrywtc','$conoftbuil','$occupation','$locationotp','$services_name')";
	   $insert = $this->db->insert($sql);
	   if ($insert) {	  
	  
	  echo '<div class="alert alert-success"> Sent Successfully! </div>';
	  

	   } else{
	      echo '<div class="alert alert-danger"> Can not Sent! </div>';
	     }   
	   }
	    	
	  } catch (Exception $e) {
	    echo '<div class="alert alert-danger"> Something went wrong. </div>';
	 }
	 }	

 public function productByIdgetDigitalInsurance($psurl = NULL) {

    try {
        $psurl = $this->fm->validation($psurl);
        $psurl = mysqli_real_escape_string($this->db->link, $psurl);
        $psurl = preg_replace('/[^-a-zA-Z0-9_]/','', $psurl);

        if (empty($psurl)) {
          $msg = '<div class="alert alert-danger"> Action Should not be Empty!</div>';
          return $msg;
        } else {

        $sql = "SELECT * FROM digital_product_buy WHERE services_name = '$psurl'";
        $result = $this->db->select($sql);
        return $result;
       }
      
    } catch (Exception $e) {
      $result = '<div class="alert alert-danger"> Something went wrong. </div>';
      return $result;
    }
   }

   public function getDigitalInsuranceById($id = NULL) {

    try {
        $id = $this->fm->validation($id);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $id = preg_replace('/[^-a-zA-Z0-9_]/','', $id);

        if (empty($id)) {
          $msg = '<div class="alert alert-danger"> Action Should not be Empty!</div>';
          return $msg;
        } else {

        $sql = "SELECT * FROM digital_product_buy WHERE id = '$id'";
        $result = $this->db->select($sql);
        if ($result) {
        	$output = '<table class="table"><tbody>';
        	while ($rows = $result->fetch_assoc()) {

        	    $id = $rows['id'];
		        $name = $rows['name'];
		        $address = $rows['address'];
		        $telephone_number = $rows['telephone_number'];
		        $cell_number = $rows['cell_number'];
		        $fax_number= $rows['fax_number'];
		        $email_address = $rows['email_address'];
		        $insert_to_be_covered = $rows['insert_to_be_covered'];
		        $abiwb = $rows['abiwb'];
		        $watrywtc = $rows['watrywtc'];
		        $conoftbuil = $rows['conoftbuil'];
		        $locationotp = $rows['locationotp'];
		        $services_name = $rows['services_name'];
		        $status = $rows['status'];
		        $create_date = $rows['create_date'];

        	    $output .= '<tr><th>Name </th><td>'.$name.'</td></tr><tr><th>Address </th><td>'.$address.'</td></tr><tr><th>Telephone Number</th><td>'.$telephone_number.'</td></tr><tr><th>Cell Number</th><td>'.$cell_number.'</td></tr><tr><th>Fax Number</th><td>'.$fax_number.'</td></tr><tr><th>Email Address</th><td>'.$email_address.'</td></tr><tr><th>Interest to be Covered</th><td>'.$insert_to_be_covered.'</td></tr><tr><th>Amount to be Insured with breakup</th><td>'.$abiwb.'</td></tr><tr><th>What are the Risks you want to cover?</th><td>'.$watrywtc.'</td></tr><tr><th>Construction of the building </th><td>'.$conoftbuil.'</td></tr><tr><th>Occupation</th><td>'.$locationotp.'</td></tr><tr><th>Location of the Project</th><td>'.$services_name.'</td></tr><tr><th>Create Date </th><td>'.$create_date.'</td></tr>';	
        	}
        	$output .= '</tbody></table>';
        	return $output;
        }
       }
      
    } catch (Exception $e) {
      $result = '<div class="alert alert-danger"> Something went wrong. </div>';
      return $result;
    }
   }

   public function delDigitalInsuranceById($id = NULL) {
    
    try {
       $id = $this->fm->validation($id);
       $id = mysqli_real_escape_string($this->db->link, $id);
       $id = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
       $id = preg_replace('/\D/', '', $id);
       $id = (int)$id;

        if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } else {

        $sql = "DELETE FROM digital_product_buy WHERE id = '$id'";
        $result = $this->db->delete($sql);
        if ($result) {
          echo '<div class="alert alert-success"> Content Deleted Successfully! </div>';
        } else{
         echo '<div class="alert alert-danger"> Content not Deleted. </div>'; 
         }
        }
      
    } catch (Exception $e) {
     echo '<div class="alert alert-danger"> Something went wrong. </div>'; 
    }
   }


}