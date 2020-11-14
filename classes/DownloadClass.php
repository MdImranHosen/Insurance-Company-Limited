<?php 
/**
 * DownloadClass
 */
class DownloadClass extends Mainclass
{
	
// Download Category .......

 public function getDwonloadCategory(){
  try {
    $sql = "SELECT * FROM download_category ORDER BY dwf_cat_id DESC";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
 }
 public function addDownloadCategory($title) {

 try {
    
    $title = $this->fm->validation($title);
    $title = mysqli_real_escape_string($this->db->link, $title);

    if (empty($title)) {
      echo '<div class="alert alert-danger"> Title Field Must not be Empty!</div>';
    } else {
       $sql = "INSERT INTO download_category(dwf_cat_title) VALUES('$title')";
        $insert = $this->db->insert($sql);
        if ($insert) {
        echo '<div class="alert alert-success"> Added Successfully! </div><script> setTimeout(function(){ location.reload(); }, 4000); </script>';
        } else{
          echo '<div class="alert alert-danger"> Content not Added! </div>';
        }
    }
    	
    } catch (Exception $e) {
    	echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
}

public function deleteDownloadCategoryByCatId($id = NULL) {

try {
    $id    = $this->fm->validation($id);
    $id    = mysqli_real_escape_string($this->db->link, $id);
    $id    = preg_replace('/\D/','', $id);
    $id    = (int)$id;

    if (empty($id)) {
      echo '<div class="alert alert-danger"> Id is Required!</div>';
    } elseif (filter_var($id, FILTER_VALIDATE_INT) == false) {
      echo '<div class="alert alert-danger"> Invalid ID! </div>';
    } else {
  
    $sql = "DELETE FROM download_category WHERE dwf_cat_id = '$id'";
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

public function downloadCategoryStatusChangeById($status,$id) {
  try {
       $id     = $this->fm->validation($id);
       $status = $this->fm->validation($status);
       $id     = mysqli_real_escape_string($this->db->link, $id);
       $status = mysqli_real_escape_string($this->db->link, $status);
       $id     = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
       $id     = preg_replace('/\D/', '', $id);
       $id     = (int)$id;
       $status = (int)$status;

      if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
      } else {
        $sql = "UPDATE download_category SET dwf_cat_status = '$status' WHERE dwf_cat_id = '$id'";
        $result = $this->db->update($sql);
        if ($result) {
          echo '<div class="alert alert-success"> Status Updated Successfully! </div>';
          echo '<script> setTimeout(function(){
            location.reload();
          }, 2000); </script>';
        } else{
          echo '<div class="alert alert-danger"> Something went wrong! </div>';
        }
      }
    
  } catch (Exception $e) {
    echo '<div class="alert alert-danger"> Something went wrong! </div>';
  }
 }

 public function getDownloadCategoryOption(){
 	try {
 		$sql = "SELECT * FROM download_category WHERE dwf_cat_status = 1";
 		$result = $this->db->select($sql);
 		if ($result) {
 			$output = '';
 			while ($rows = $result->fetch_assoc()) {
 				$dwf_cat_title = $rows['dwf_cat_title'];
 				$output .= '<option value="'.$dwf_cat_title.'">'.$dwf_cat_title.'</option>';
 			}
 			echo $output;
 		}
 	} catch (Exception $e) {
 		
 	}
 }

 // Download Form Data...

 public function getDownloadFromData(){
  try {
    $sql = "SELECT * FROM download_forms ORDER BY dwf_id DESC";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
 }


 public function addDownloadFromData($title,$date,$cat,$file) {

 try {
    
    $title = $this->fm->validation($title);
    $date  = $this->fm->validation($date);
	$cat   = $this->fm->validation($cat);
    $title = mysqli_real_escape_string($this->db->link, $title);
    $date  = mysqli_real_escape_string($this->db->link, $date);
    $cat   = mysqli_real_escape_string($this->db->link, $cat);

    if (empty($title) || empty($file['name']) || empty($cat)) {
      echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
    } else {

    $logo_name = $file['name'];
    $logo_tem  = $file['tmp_name'];
    $logo_size = $file['size'];
    $logo_type = $file['type'];

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

       $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
       $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

       $sql = "INSERT INTO download_forms(dwf_title,dwf_date,dwf_file,dwf_cat_title) VALUES('$title','$date','$file_name','$cat')";
        $insert = $this->db->insert($sql);
        if ($insert) {
           
          $last_id = mysqli_insert_id($this->db->link);

          $upload_path = "../../document/download_forms/".$last_id."/";      
            if (!is_dir($upload_path)) {
              mkdir($upload_path, 0777, true);
            }
          
            $image_path = $upload_path.$file_name;
        
            if (move_uploaded_file($logo_tem, $image_path)) {
                echo '<div class="alert alert-success"> Added Successfully! </div><script> setTimeout(function(){ location.reload(); }, 4000); </script>';
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

public function deleteDownloadFromByCatId($id = NULL) {

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

    $filepath = "../../document/download_forms/".$id;

    if (glob($filepath."/*")) {

     array_map('unlink', glob($filepath."/*"));

     if (is_dir($filepath)) {
       rmdir($filepath);
     }
    }
  
    $sql = "DELETE FROM download_forms WHERE dwf_id = '$id'";
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

public function downloadStatusChangeById($status,$id) {
  try {
       $id     = $this->fm->validation($id);
       $status = $this->fm->validation($status);
       $id     = mysqli_real_escape_string($this->db->link, $id);
       $status = mysqli_real_escape_string($this->db->link, $status);
       $id     = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
       $id     = preg_replace('/\D/', '', $id);
       $id     = (int)$id;
       $status = (int)$status;

      if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
      } else {
        $sql = "UPDATE download_forms SET dwf_status = '$status' WHERE dwf_id = '$id'";
        $result = $this->db->update($sql);
        if ($result) {
          echo '<div class="alert alert-success"> Status Updated Successfully! </div>';
          echo '<script> setTimeout(function(){
            location.reload();
          }, 2000); </script>';
        } else{
          echo '<div class="alert alert-danger"> Something went wrong! </div>';
        }
      }
    
  } catch (Exception $e) {
    echo '<div class="alert alert-danger"> Something went wrong! </div>';
  }
 }

public function downloadCategoryDisplay(){
	try {
		$sql = "SELECT * FROM download_category WHERE dwf_cat_status = 1";
		$result = $this->db->select($sql);
		return $result;
	} catch (Exception $e) {
		
	}
}

public function downloadFromDataByCat($title){
	try {
	   $title = $this->fm->validation($title);
	   $title = mysqli_real_escape_string($this->db->link, $title);
	   if (!empty($title)) {
	   	$sql = "SELECT * FROM download_forms WHERE dwf_status = 1 AND dwf_cat_title = '$title'";
	   	$result = $this->db->select($sql);
	   	return $result;
	   }
	} catch (Exception $e) {
		
	}
}

}