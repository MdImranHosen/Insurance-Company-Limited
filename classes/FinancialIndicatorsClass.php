<?php
/**
 * FinancialIndicatorsClass 
 */
class FinancialIndicatorsClass extends Mainclass{

public function addFIAddData($fi_title,$fi_date,$fi_type,$fi_file) {

 try {
    
    $fi_title = $this->fm->validation($fi_title);
    $fi_date  = $this->fm->validation($fi_date);
	  $fi_type   = $this->fm->validation($fi_type);
    $fi_title = mysqli_real_escape_string($this->db->link, $fi_title);
    $fi_date  = mysqli_real_escape_string($this->db->link, $fi_date);
    $fi_type   = mysqli_real_escape_string($this->db->link, $fi_type);

    if (empty($fi_title) || empty($fi_file['name'])) {
      echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
    } else {

    $logo_name = $fi_file['name'];
    $logo_tem  = $fi_file['tmp_name'];
    $logo_size = $fi_file['size'];
    $logo_type = $fi_file['type'];

    $permitted = array('pdf', 'doc', 'docx', 'xlsx', 'xls', 'ppt', 'pptx');

    $image_ext = explode(".", $logo_name);

	  $file_extension = strtolower(end($image_ext));

	  $imgdata = getimagesize($logo_tem);
    $width   = $imgdata[0];
    $height  = $imgdata[1];

    if ($logo_size > 20971520) {

      echo '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. (Max: 20 MB) </div>';
        
     } elseif (in_array($file_extension, $permitted) === false) {
         
      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

     } else {

      # $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
       $file_name   = mysqli_real_escape_string($this->db->link, $logo_name);

       $sql = "INSERT INTO financial_indicators(fi_title,fi_date,fi_file,fi_type) VALUES('$fi_title','$fi_date','$file_name','$fi_type')";
        $insert = $this->db->insert($sql);
        if ($insert) {
           
          $last_id = mysqli_insert_id($this->db->link);

          $upload_path = "../../document/".$fi_type."/".$last_id."/";      
            if (!is_dir($upload_path)) {
              mkdir($upload_path, 0777, true);
            }
          
            $image_path = $upload_path.$file_name;
        
            if (move_uploaded_file($logo_tem, $image_path)) {
                echo '<div class="alert alert-success"> Added Successfully! </div>';
             }
         
        } else{
          echo '<div class="alert alert-danger"> Content not Added! </div>';
        }
     }
    }
    	
    } catch (Exception $e) {
    	echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
}


public function financialIndicatursDelById($fi_type,$id = NULL) {

try {
    $id      = $this->fm->validation($id);
    $fi_type = $this->fm->validation($fi_type);
    $id      = mysqli_real_escape_string($this->db->link, $id);
    $fi_type = mysqli_real_escape_string($this->db->link, $fi_type);
    $id      = preg_replace('/\D/','', $id);
    $id      = (int)$id;

    if (empty($id)) {
      echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
    } elseif (filter_var($id, FILTER_VALIDATE_INT) == false) {
      echo '<div class="alert alert-danger"> Invalid ID! </div>';
    } else { 

    $filepath = "../../document/".$fi_type."/".$id;

    if (glob($filepath."/*")) {

     array_map('unlink', glob($filepath."/*"));

     if (is_dir($filepath)) {
       rmdir($filepath);
     }
    }

    $sql = "DELETE FROM financial_indicators WHERE fi_type = '$fi_type' AND fi_id = '$id'";
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

public function financialIndicatorsByPageNameType($type = NULL) {

 try {
 	$type = $this->fm->validation($type);
    $type = mysqli_real_escape_string($this->db->link, $type);

    if (empty($type)) {
      echo '<div class="alert alert-danger"> Page Name Must not be Empty!</div>';
    } else {
    	$sql = "SELECT * FROM financial_indicators WHERE fi_type = '$type' ORDER BY fi_id DESC";
    	$result = $this->db->select($sql);
    	if ($result) {
    		return $result;
    	}	
    }
 } catch (Exception $e) {
 	
 }
}

public function financialIndicaPageNameTypeDisplay($type = NULL) {

 try {
 	$type = $this->fm->validation($type);
    $type = mysqli_real_escape_string($this->db->link, $type);
    $type = strtolower(str_replace("-","_",$type));

    if (empty($type)) {
      echo '<div class="alert alert-danger"> Page Name Must not be Empty!</div>';
    } else {
    	$sql = "SELECT * FROM financial_indicators WHERE fi_status = 1 AND fi_type = '$type' ORDER BY fi_id DESC";
    	$result = $this->db->select($sql);
    	if ($result) {
    		return $result;
    	}	
    }
 } catch (Exception $e) {
 	
 }
}

 public function financialIndicatorsUpdate($id,$fi_title,$fi_date,$fi_des,$fi_img,$fi_type) {

    try {

    $id       = $this->fm->validation($id);
    $fi_title = $this->fm->validation($fi_title);
    $fi_date  = $this->fm->validation($fi_date);
	  $fi_des   = $this->fm->validation($fi_des);
	  $fi_type  = $this->fm->validation($fi_type);
	  $id       = mysqli_real_escape_string($this->db->link, $id);
    $fi_title = mysqli_real_escape_string($this->db->link, $fi_title);
    $fi_date  = mysqli_real_escape_string($this->db->link, $fi_date);
    $fi_des   = mysqli_real_escape_string($this->db->link, $fi_des);
    $fi_type  = mysqli_real_escape_string($this->db->link, $fi_type);
	
    if (!empty($fi_img['name'])) {

       $logo_name = $fi_img['name'];
       $logo_tem  = $fi_img['tmp_name'];
       $logo_size = $fi_img['size'];
       $logo_type = $fi_img['type'];

       $permitted = array('png', 'jpg', 'jpeg', 'gif');
       $image_ext = explode(".", $logo_name);
       $file_extension = strtolower(end($image_ext));

       $imgdata = getimagesize($logo_tem);
       $width   = $imgdata[0];
       $height  = $imgdata[1];

       if (empty($fi_title)) {
          $msg = '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
          return $msg;
        } elseif ($logo_size > 5242880) {

        $msg = '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';
        return $msg;
        } elseif (in_array($file_extension, $permitted) === false) {
             
        $msg = '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';
         return $msg;
        } else{
            
          $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
          $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

          $filepath = "../images/".$fi_type."/".$id;

          if (glob($filepath."/*")) {
           array_map('unlink', glob($filepath."/*"));

          if (is_dir($filepath)) {
            rmdir($filepath);
            }
           }             
          
           if (!is_dir($filepath)) {
              mkdir($filepath, 0777, true);
            }
              
           $image_path = $filepath.'/'.$file_name;

           if (move_uploaded_file($logo_tem, $image_path)) {

          $sqlup = "UPDATE financial_indicators SET
                      fi_title = '$fi_title',
                      fi_date  = '$fi_date',
                      fi_file  = '$file_name',
                      fi_des   = '$fi_des'
                      WHERE fi_type = '$fi_type' AND fi_id = '$id'";
            $resultu = $this->db->update($sqlup);
            if ($resultu) {
            $msg = '<div class="alert alert-success"> Updated Successfully! </div>';
             return $msg;
              } else{
              $msg = '<div class="alert alert-danger"> Content not Updated! </div>';
              return $msg;
            }
           } else{
              $msg = '<div class="alert alert-danger"> File Not Updated! </div>';
              return $msg;
            }
          }

        } else{

        if (empty($fi_title)) {
          $msg = '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
          return $msg;
         } else{
          $sql = "UPDATE financial_indicators SET
                   fi_title = '$fi_title',
                   fi_date  = '$fi_date',
                   fi_des   = '$fi_des'
                   WHERE fi_type = '$fi_type' AND fi_id = '$id'";
            $result = $this->db->update($sql);
            if ($result) {
              $msg = '<div class="alert alert-success"> Updated Successfully! </div>';
              return $msg;
            } else{
              $msg = '<div class="alert alert-danger"> Content not Updated! </div>';
              return $msg;
            }
           }
        }
     //End
        } catch (Exception $e) {
          $msg = '<div class="alert alert-danger"> Something went wrong. </div>';
          return $msg;
        }
   }

public function fiDisableById($id=NULL) {

  try {

   	$id = $this->fm->validation($id);
    $id = mysqli_real_escape_string($this->db->link, $id);
    $id = preg_replace('/\D/','', $id);
    $id = (int)$id;

    if (empty($id)) {
      $msg = '<div class="alert alert-danger"> ID Must not be Empty!</div>';
      return $msg;
    } elseif (filter_var($id, FILTER_VALIDATE_INT) == false) {
      $msg = '<div class="alert alert-danger"> Invalid ID! </div>';
      return $msg;
    } else {
      $sql = "UPDATE financial_indicators SET 
                fi_status = 0
                WHERE fi_id = '$id'";
      $result = $this->db->update($sql);
      if ($result) {
      	$msg = '<div class="alert alert-danger"> Disable Successfully!</div>';
      	return $msg;
      }else{
      	$msg = '<div class="alert alert-danger"> Something went wrong!</div>';
        return $msg;
      }
    }
   	  	
   	} catch (Exception $e) {
   		$msg = '<div class="alert alert-danger"> Something went wrong!</div>';
        return $msg;
   	}
 }

 public function fiEnableById($id=NULL){

  try {

   	$id = $this->fm->validation($id);
    $id = mysqli_real_escape_string($this->db->link, $id);
    $id = preg_replace('/\D/','', $id);
    $id = (int)$id;

    if (empty($id)) {
      $msg = '<div class="alert alert-danger"> ID Must not be Empty!</div>';
      return $msg;
    } elseif (filter_var($id, FILTER_VALIDATE_INT) == false) {
      $msg = '<div class="alert alert-danger"> Invalid ID! </div>';
      return $msg;
    } else {
      $sql = "UPDATE financial_indicators SET 
                fi_status = 1
                WHERE fi_id = '$id'";
      $result = $this->db->update($sql);
      if ($result) {
      	$msg = '<div class="alert alert-danger"> Enable Successfully!</div>';
      	return $msg;
      }else{
      	$msg = '<div class="alert alert-danger"> Something went wrong!</div>';
        return $msg;
      }
    }
   	  	
   	} catch (Exception $e) {
   		$msg = '<div class="alert alert-danger"> Something went wrong!</div>';
        return $msg;
   	}
 }

}