<?php 
/**
 * OnlineClaim
 */
class OnlineClaim extends Mainclass
{

 public function getOnlineClaimData(){
  try {
    $sql = "SELECT * FROM online_claim ORDER BY id DESC";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
 }


 public function setOnlineClaimByUser($name_insured,$pcn_cnn,$dateol,$placeol,$natureol,$causeol,$vehicleno,$estol_ia,$contact_p,$address,$phone_n,$mobile_n,$fax_n,$email,$doc_one,$doc_two,$doc_three) {

 try {
    
    $name_insured = $this->fm->validation($name_insured);
    $pcn_cnn     = $this->fm->validation($pcn_cnn);
	  $dateol      = $this->fm->validation($dateol);
    $placeol     = $this->fm->validation($placeol);
    $natureol    = $this->fm->validation($natureol);
    $causeol     = $this->fm->validation($causeol);
    $vehicleno   = $this->fm->validation($vehicleno);
    $estol_ia    = $this->fm->validation($estol_ia);
    $contact_p   = $this->fm->validation($contact_p);
    $address     = $this->fm->validation($address);
    $phone_n     = $this->fm->validation($phone_n);
    $mobile_n    = $this->fm->validation($mobile_n);
    $fax_n       = $this->fm->validation($fax_n);
    $email       = $this->fm->validation($email);

    $name_insured = mysqli_real_escape_string($this->db->link, $name_insured);
    $pcn_cnn      = mysqli_real_escape_string($this->db->link, $pcn_cnn);
    $dateol       = mysqli_real_escape_string($this->db->link, $dateol);
    $placeol      = mysqli_real_escape_string($this->db->link, $placeol);
    $natureol     = mysqli_real_escape_string($this->db->link, $natureol);
    $causeol      = mysqli_real_escape_string($this->db->link, $causeol);
    $vehicleno    = mysqli_real_escape_string($this->db->link, $vehicleno);
    $estol_ia     = mysqli_real_escape_string($this->db->link, $estol_ia);
    $contact_p    = mysqli_real_escape_string($this->db->link, $contact_p);
    $address      = mysqli_real_escape_string($this->db->link, $address);
    $phone_n      = mysqli_real_escape_string($this->db->link, $phone_n);
    $mobile_n     = mysqli_real_escape_string($this->db->link, $mobile_n);
    $fax_n        = mysqli_real_escape_string($this->db->link, $fax_n);
    $email        = mysqli_real_escape_string($this->db->link, $email);

    if (empty($name_insured) || empty($pcn_cnn) || empty($dateol)) {
      echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
    } else {

   $fileType = array('pdf','doc','docx','xlsx','xls','ppt','pptx','jpg','png','jpeg');

   $sql = "INSERT INTO online_claim(name_insured,pcn_cnn,dateol,placeol,natureol,causeol,vehicleno,estol_ia,contact_p,address,phone_n,mobile_n,fax_n,email) VALUES('$name_insured','$pcn_cnn','$dateol','$placeol','$natureol','$causeol','$vehicleno','$estol_ia','$contact_p','$address','$phone_n','$mobile_n','$fax_n','$email')";
   $insert = $this->db->insert($sql);
   if ($insert) {
     
   $last_id = mysqli_insert_id($this->db->link);

   if (!empty($doc_one)) {

    $logo_name = $doc_one['name'];
    $logo_tem  = $doc_one['tmp_name'];
    $logo_size = $doc_one['size'];
    $logo_type = $doc_one['type'];
    $image_ext = explode(".", $logo_name);
    $file_extension = strtolower(end($image_ext));

    if ($logo_size > 20971520) {

      echo '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. (Max: 20 MB) </div>';
        
     } elseif (in_array($file_extension, $fileType) === false) {
         
      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $fileType).'</div>';

     } else{
      $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
      $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

      $upload_path = "../document/online_claim/".$last_id."/";   
      if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, true);
      }

      $image_path = $upload_path.$file_name;
      move_uploaded_file($logo_tem, $image_path);

     }
    }

    if (!empty($doc_two)) {

    $logo_name = $doc_two['name'];
    $logo_tem  = $doc_two['tmp_name'];
    $logo_size = $doc_two['size'];
    $logo_type = $doc_two['type'];
    $image_ext = explode(".", $logo_name);
    $file_extension = strtolower(end($image_ext));

    if ($logo_size > 20971520) {

      echo '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. (Max: 20 MB) </div>';
        
     } elseif (in_array($file_extension, $fileType) === false) {
         
      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $fileType).'</div>';

     } else{
      $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
      $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

      $upload_path = "../document/online_claim/".$last_id."/";   
      if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, true);
      }

      $image_path = $upload_path.$file_name;
      move_uploaded_file($logo_tem, $image_path);

     }
    }

    if (!empty($doc_three)) {

    $logo_name = $doc_three['name'];
    $logo_tem  = $doc_three['tmp_name'];
    $logo_size = $doc_three['size'];
    $logo_type = $doc_three['type'];
    $image_ext = explode(".", $logo_name);
    $file_extension = strtolower(end($image_ext));

    if ($logo_size > 20971520) {

      echo '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. (Max: 20 MB) </div>';
        
     } elseif (in_array($file_extension, $fileType) === false) {
         
      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $fileType).'</div>';

     } else{
      $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
      $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

      $upload_path = "../document/online_claim/".$last_id."/";   
      if (!is_dir($upload_path)) {
        mkdir($upload_path, 0777, true);
      }

      $image_path = $upload_path.$file_name;
      move_uploaded_file($logo_tem, $image_path);

     }
    }
  
  echo '<div class="alert alert-success"> Sent Successfully! </div>';
  

   } else{
      echo '<div class="alert alert-danger"> Can not Sent! </div>';
     }   
   }
    	
  } catch (Exception $e) {
    echo '<div class="alert alert-danger"> Something went wrong. </div>';
 }
}

public function deleteOnlineClaimById($id = NULL) {

try {
    $id = $this->fm->validation($id);
    $id = mysqli_real_escape_string($this->db->link, $id);
    $id = preg_replace('/\D/','', $id);
    $id = (int)$id;

    if (empty($id)) {
      echo '<div class="alert alert-danger"> Id is Required!</div>';
    } elseif (filter_var($id, FILTER_VALIDATE_INT) == false) {
      echo '<div class="alert alert-danger"> Invalid ID! </div>';
    } else {

    $filepath = "../../document/online_claim/".$id;

    if (glob($filepath."/*")) {

     array_map('unlink', glob($filepath."/*"));

     if (is_dir($filepath)) {
       rmdir($filepath);
     }
    }
  
    $sql = "DELETE FROM online_claim WHERE id = '$id'";
    $result = $this->db->delete($sql);
    if ($result) {
      echo '<div class="alert alert-success"> Deleted Successfully! </div><script>location.reload();</script>';
    } else{
     echo '<div class="alert alert-danger"> Not Deleted. </div>'; 
     }
    }
  
} catch (Exception $e) {
 echo '<div class="alert alert-danger"> Something went wrong. </div>'; 
}
}


public function viewOnlineClaimById($id = NULL){
	try {
    $id = $this->fm->validation($id);
    $id = mysqli_real_escape_string($this->db->link, $id);
    $id = preg_replace('/\D/','', $id);
    $id = (int)$id;

    if (empty($id)) {
      echo '<div class="alert alert-danger"> Id is Required!</div>';
    } elseif (filter_var($id, FILTER_VALIDATE_INT) == false) {
      echo '<div class="alert alert-danger"> Invalid ID! </div>';
    } else { 

		$sql = "SELECT * FROM online_claim WHERE id = '$id'";
		$result = $this->db->select($sql);
		if ($result) {
     $output = '<table class="table"><tbody>';
      while ($rows = $result->fetch_assoc()) {
        $id           = $rows['id'];
        $name_insured = $rows['name_insured'];
        $pcn_cnn      = $rows['pcn_cnn'];
        $dateol       = $rows['dateol'];
        $placeol      = $rows['placeol'];
        $natureol     = $rows['natureol'];
        $causeol      = $rows['causeol'];
        $vehicleno    = $rows['vehicleno'];
        $estol_ia     = $rows['estol_ia'];
        $contact_p    = $rows['contact_p'];
        $address      = $rows['address'];
        $phone_n      = $rows['phone_n'];
        $mobile_n     = $rows['mobile_n'];
        $fax_n        = $rows['fax_n'];
        $email        = $rows['email'];

        $documents = '';

        if (file_exists('../../document/online_claim/'.$id)) {

          $fileDir = '../../document/online_claim/'.$id;

        if (is_dir($fileDir)) {
          if (glob($fileDir."/*")) {
            
             $files = glob($fileDir."/*.*");
              for ($i=0; $i<count($files); $i++)
              {
                $num = $files[$i];

               // $link = ltrim($num, "../");

                $documents .= '<tr><td>Documents</td><td><a download="" class="btn btn-success" href="'.$num.'"><i class="fa fa-download"></i> Download</a></td></tr>';
                }

          }
         }
        }   

        $output .= '<tr><td>Name of the Insured</td><td>'.$name_insured.'</td></tr><tr><td>Policy/Certificate No./Cover Note No </td><td>'.$pcn_cnn.'</td></tr><tr><td>Date of Loss</td><td>'.$dateol.'</td></tr><tr><td>Place of Loss </td><td>'.$placeol.'</td></tr><tr><td> Nature of Loss </td><td>'.$natureol.'</td></tr><tr><td>Cause of Loss</td><td>'.$causeol.'</td></tr><tr><td> Vehicle No. (If Motor Claim) </td><td>'.$vehicleno.'</td></tr><tr><td> Estimated of Loss, if any </td><td>'.$estol_ia.'</td></tr><tr><td> Contact Person Name </td><td>'.$contact_p.'</td></tr><tr><td> Address </td><td>'.$address.'</td></tr><tr><td> Phone No </td><td>'.$phone_n.'</td></tr><tr><td> Mobile No </td><td>'.$mobile_n.'</td></tr><tr><td> Fax No </td><td>'.$fax_n.'</td></tr><tr><td> Email </td><td>'.$email.'</td></tr>'.$documents;
      }

      $output .= '</tbody></table>';
      echo $output;

    }
   }
	} catch (Exception $e) {
		
	}
}



}