<?php
/**
 * EmployerClass 
 */
class EmployerClass extends Mainclass{

public function addBoardOfDirector($bod_name,$bod_deg,$bod_img,$bod_des,$bod_fb,$bod_tw,$bod_pt,$bod_lk,$em_type) {

 try {
    
    $bod_name = $this->fm->validation($bod_name);
    $bod_deg  = $this->fm->validation($bod_deg);
	  $bod_des  = $this->fm->validation($bod_des);
	  $bod_fb   = $this->fm->validation($bod_fb);
	  $bod_tw   = $this->fm->validation($bod_tw);
	  $bod_pt   = $this->fm->validation($bod_pt);
	  $bod_lk   = $this->fm->validation($bod_lk);
	  $em_type  = $this->fm->validation($em_type);
    $bod_name = mysqli_real_escape_string($this->db->link, $bod_name);
    $bod_deg  = mysqli_real_escape_string($this->db->link, $bod_deg);
    $bod_des  = mysqli_real_escape_string($this->db->link, $bod_des);
    $bod_fb   = mysqli_real_escape_string($this->db->link, $bod_fb);
    $bod_tw   = mysqli_real_escape_string($this->db->link, $bod_tw);
    $bod_pt   = mysqli_real_escape_string($this->db->link, $bod_pt);
    $bod_lk   = mysqli_real_escape_string($this->db->link, $bod_lk);
    $em_type  = mysqli_real_escape_string($this->db->link, $em_type);

    $logo_name = $bod_img['name'];
    $logo_tem  = $bod_img['tmp_name'];
    $logo_size = $bod_img['size'];
    $logo_type = $bod_img['type'];

    $permitted = array('png', 'jpg', 'jpeg', 'gif');

    $image_ext = explode(".", $logo_name);

	  $file_extension = strtolower(end($image_ext));

	  $imgdata = getimagesize($logo_tem);
    $width   = $imgdata[0];
    $height  = $imgdata[1];

    if (empty($bod_name) || empty($bod_deg) || empty($logo_name)) {
      echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
    } elseif ($logo_size > 5242880) {

      echo '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';

     } elseif (in_array($file_extension, $permitted) === false) {
         
      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

     } elseif(($width < 216 || $width > 232) || ($height < 248 || $height > 267 )) {
          
           echo "<div class='alert alert-danger'> Image Size Should be Width 225 px <strong> * </strong> Height 250 px! </div>";
     } else {

       $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
       $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

       $sql = "INSERT INTO employers(em_name,em_designation,em_photo,em_description,em_fb,em_tw,em_pt,em_lk,em_type) VALUES('$bod_name','$bod_deg','$file_name','$bod_des','$bod_fb','$bod_tw','$bod_pt','$bod_lk','$em_type')";
        $insert = $this->db->insert($sql);
        if ($insert) {
           
          $last_id = mysqli_insert_id($this->db->link);

          $upload_path = "../../images/".$em_type."/".$last_id."/";      
            if (!is_dir($upload_path)) {
              mkdir($upload_path, 0777, true);
            }
          
            $image_path = $upload_path.$file_name;
        
            if (move_uploaded_file($logo_tem, $image_path)) {
                echo '<div class="alert alert-success"> Added Successfully! </div><script>location.reload();</script>';
             }
         
        } else{
          echo '<div class="alert alert-danger"> Content not Added! </div>';
        }
     }
    	
    } catch (Exception $e) {
    	echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
}

public function getBoardOfDirectors($em_type){
	try {
	$em_type  = $this->fm->validation($em_type);
    $em_type = mysqli_real_escape_string($this->db->link, $em_type);
	 $sql = "SELECT * FROM employers WHERE em_type = '$em_type' AND em_status = 1";
	 $result = $this->db->select($sql);
	 return $result;	
	} catch (Exception $e) {
		
	}
}

public function boardOfDirectorsDetailsid($em_type,$id=NULL){
try {

    $id = $this->fm->validation($id);
    $id = mysqli_real_escape_string($this->db->link, $id);
    $id = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
    $id = preg_replace('/\D/','', $id);
    $id = (int)$id;

    if (empty($id)) {
      echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
    } elseif (filter_var($id, FILTER_VALIDATE_INT) == false) {
     echo '<div class="alert alert-danger"> Invalid ID! </div>';
    } else {

    $sql = "SELECT * FROM employers WHERE em_type = '$em_type' AND em_id = '$id'";
    $result = $this->db->select($sql);
   if ($result) {
    $output = '<table class="table table-bordered table-striped"><tbody>';
    while ($rows = $result->fetch_assoc()) {
            
      $id      = $rows['em_id'];
      $em_name = $rows['em_name'];
      $em_deg  = $rows['em_designation'];      
      $em_fb   = $rows['em_fb'];
      $em_tw   = $rows['em_tw'];
      $em_pt   = $rows['em_pt'];
      $em_lk   = $rows['em_lk'];
      $em_des  = htmlspecialchars_decode(stripslashes($rows['em_description']));

      $logo  = $rows['em_photo'];

      $image = "../../images/".$em_type."/".$id."/".$logo;
      if (file_exists($image)) {
        $image = "../images/".$em_type."/".$id."/".$logo;
      }else{
        $image = "../img/logo.png";
      }
      
      $output .= '<tr style="font-weight:bold;font-size:20px;">          
           <td colspan="2"><b>'.$em_name.'</b></td>
         </tr><tr style="font-weight:bold;font-size:20px;">
          <td colspan="2"><center><figure class="image-box"><img title="'.$em_name.'" src="'.$image.'" style="max-width:100%;height:auto;"></figure></center></td>
       </tr>
       <tr style="font-weight:bold;font-size:20px;">
           <td><b>Designation</b></td>
           <td><b>'.$em_deg.'</b></td>
       </tr>
       <tr>
           <td colspan="2">'.$em_des.'</td>
       </tr><tr><td>Facebook:</td><td> <a target="_blank" href="https://facebook.com/'.$em_fb.'"><i class="fa fa-facebook"></i></a></td></tr>
       <tr><td>Twitter:</td><td> <a target="_blank" href="https://www.twitter.com/'.$em_tw.'"><i class="fa fa-twitter"></i></a></td></tr><tr><td>Pinterest:</td><td> <a target="_blank" href="https://www.pinterest.com/'.$em_pt.'"><i class="fa fa-pinterest"></i></a></td></tr><tr><td>Linkedin:</td><td> <a target="_blank" href="https://www.linkedin.com/'.$em_lk.'"><i class="fa fa-linkedin"></i></a></td></tr>';          
    }
    $output .= '</tbody></table>';
    echo $output;
  }
   }
  
} catch (Exception $e) {
  echo '<div class="alert alert-danger"> Something went wrong. </div>';
}
}

public function boardOfDirectorsDelid($em_type,$id = NULL) {

try {
    $id      = $this->fm->validation($id);
    $em_type = $this->fm->validation($em_type);
    $id      = mysqli_real_escape_string($this->db->link, $id);
    $em_type = mysqli_real_escape_string($this->db->link, $em_type);
    $id      = preg_replace('/\D/','', $id);
    $id      = (int)$id;

    if (empty($id)) {
      echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
    } elseif (filter_var($id, FILTER_VALIDATE_INT) == false) {
      echo '<div class="alert alert-danger"> Invalid ID! </div>';
    } else { 

    $filepath = "../../images/".$em_type."/".$id;

    if (glob($filepath."/*")) {

     array_map('unlink', glob($filepath."/*"));

     if (is_dir($filepath)) {
       rmdir($filepath);
     }
    }

    $sql = "DELETE FROM employers WHERE em_type = '$em_type' AND em_id = '$id'";
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

public function boardOfDirectorsUpdateById($em_type,$id = NULL){
 try {
 	  $id      = $this->fm->validation($id);
 	  $em_type = $this->fm->validation($em_type);
    $id      = mysqli_real_escape_string($this->db->link, $id);
    $em_type = mysqli_real_escape_string($this->db->link, $em_type);
    $id      = preg_replace('/\D/','', $id);
    $id      = (int)$id;

    if (empty($id)) {
      echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
    } elseif (filter_var($id, FILTER_VALIDATE_INT) == false) {
      echo '<div class="alert alert-danger"> Invalid ID! </div>';
    } else {
    	$sql = "SELECT * FROM employers WHERE em_type = '$em_type' AND em_id = '$id'";
    	$result = $this->db->select($sql);
    	if ($result) {
    		return $result;
    	}	
    }
 } catch (Exception $e) {
 	
 }
}

 public function boardOfDirectorsUpdate($id,$bod_name,$bod_deg,$bod_des,$bod_img,$bod_fb,$bod_tw,$bod_pt,$bod_lk,$em_type) {

    try {

    $id       = $this->fm->validation($id);
    $bod_name = $this->fm->validation($bod_name);
    $bod_deg  = $this->fm->validation($bod_deg);
	  $bod_des  = $this->fm->validation($bod_des);
	  $bod_fb   = $this->fm->validation($bod_fb);
	  $bod_tw   = $this->fm->validation($bod_tw);
	  $bod_pt   = $this->fm->validation($bod_pt);
	  $bod_lk   = $this->fm->validation($bod_lk);
	  $em_type  = $this->fm->validation($em_type);
	  $id       = mysqli_real_escape_string($this->db->link, $id);
    $bod_name = mysqli_real_escape_string($this->db->link, $bod_name);
    $bod_deg  = mysqli_real_escape_string($this->db->link, $bod_deg);
    $bod_des  = mysqli_real_escape_string($this->db->link, $bod_des);
    $bod_fb   = mysqli_real_escape_string($this->db->link, $bod_fb);
    $bod_tw   = mysqli_real_escape_string($this->db->link, $bod_tw);
    $bod_pt   = mysqli_real_escape_string($this->db->link, $bod_pt);
    $bod_lk   = mysqli_real_escape_string($this->db->link, $bod_lk);
    $em_type  = mysqli_real_escape_string($this->db->link, $em_type);
	
    if (!empty($bod_img['name'])) {

       $logo_name = $bod_img['name'];
       $logo_tem  = $bod_img['tmp_name'];
       $logo_size = $bod_img['size'];
       $logo_type = $bod_img['type'];

       $permitted = array('png', 'jpg', 'jpeg', 'gif');
       $image_ext = explode(".", $logo_name);
       $file_extension = strtolower(end($image_ext));

       $imgdata = getimagesize($logo_tem);
       $width   = $imgdata[0];
       $height  = $imgdata[1];

       if (empty($bod_name) || empty($bod_deg)) {
          $msg = '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
          return $msg;
        } elseif ($logo_size > 5242880) {

        $msg = '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';
        return $msg;
        } elseif (in_array($file_extension, $permitted) === false) {
             
        $msg = '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';
         return $msg;
        } elseif($em_type != ('message_from_chairman' || 'message_from_managing_director_and_ceo')) {

          if (($width < 216 || $width > 232) || ($height < 248 || $height > 267 )) {
            $msg = "<div class='alert alert-danger'> Image Size Should Width 225 px <strong> * </strong> Height 250 px! </div>";
           return $msg;
          }else{
            $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));

          $filepath = "../images/".$em_type."/".$id;

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

          $sqlup = "UPDATE employers SET 
                   em_name        = '$bod_name',
                   em_designation = '$bod_deg',
                   em_photo       = '$file_name',
                   em_description = '$bod_des',
                   em_fb          = '$bod_fb',
                   em_tw          = '$bod_tw',
                   em_pt          = '$bod_pt',
                   em_lk          = '$bod_lk'
                   WHERE em_type = '$em_type' AND em_id = '$id'";
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
          
           
        } else {

          $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));

          $filepath = "../images/".$em_type."/".$id;

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

          $sqlup = "UPDATE employers SET 
                   em_name        = '$bod_name',
                   em_designation = '$bod_deg',
                   em_photo       = '$file_name',
                   em_description = '$bod_des',
                   em_fb          = '$bod_fb',
                   em_tw          = '$bod_tw',
                   em_pt          = '$bod_pt',
                   em_lk          = '$bod_lk'
                   WHERE em_type = '$em_type' AND em_id = '$id'";
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

          if (empty($bod_name) || empty($bod_deg)) {
          $msg = '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
          return $msg;
        } else{
          $sql = "UPDATE employers SET
                   em_name        = '$bod_name',
                   em_designation = '$bod_deg',
                   em_description = '$bod_des',
                   em_fb          = '$bod_fb',
                   em_tw          = '$bod_tw',
                   em_pt          = '$bod_pt',
                   em_lk          = '$bod_lk'
                   WHERE em_type = '$em_type' AND em_id = '$id'";
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
          
        } catch (Exception $e) {
          $msg = '<div class="alert alert-danger"> Something went wrong. </div>';
          return $msg;
        }
   }
 
 public function getCharimanSpace(){
  try {
    $sql = "SELECT * FROM chairman_space ORDER BY chairman_space_id DESC LIMIT 1";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
 }

 public function chairmanSpaceUpdateById($id,$cs_title,$cs_text,$cs_img){

   try {

    $id       = $this->fm->validation($id);
    $cs_title = $this->fm->validation($cs_title);
    $cs_text  = $this->fm->validation($cs_text);
    $id       = mysqli_real_escape_string($this->db->link, $id);
    $cs_title = mysqli_real_escape_string($this->db->link, $cs_title);
    $cs_text  = mysqli_real_escape_string($this->db->link, $cs_text);

    if (empty($cs_title) || empty($cs_text)) {
      $msg = '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
      return $msg;
    } else{ 
  
    if (!empty($cs_img['name'])) {

       $logo_name = $cs_img['name'];
       $logo_tem  = $cs_img['tmp_name'];
       $logo_size = $cs_img['size'];
       $logo_type = $cs_img['type'];

       $permitted = array('png', 'jpg', 'jpeg', 'gif');
       $image_ext = explode(".", $logo_name);
       $file_extension = strtolower(end($image_ext));

       $imgdata = getimagesize($logo_tem);
       $width   = $imgdata[0];
       $height  = $imgdata[1];

       if ($logo_size > 1048576) {
        $msg = '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';
        return $msg;
        } elseif (in_array($file_extension, $permitted) === false) {             
        $msg = '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';
         return $msg;
        } elseif (($width < 155 || $width > 165) || ($height < 120 || $height > 130 )) {
            $msg = "<div class='alert alert-danger'> Image Size Should 155-165 <strong> * </strong> 120-130 PX! </div>";
           return $msg;
        } else {

          $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));

          $filepath = "../img/chairman_space/".$id;

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

          $sqlup = "UPDATE chairman_space SET 
                     chairman_space_title = '$cs_title',
                     chairman_space_text  = '$cs_text',
                     chairman_space_img   = '$file_name'
                     WHERE chairman_space_id = '$id'";
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

          $sql = "UPDATE chairman_space SET 
                     chairman_space_title = '$cs_title',
                     chairman_space_text  = '$cs_text'                     
                     WHERE chairman_space_id = '$id'";
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
        } catch (Exception $e) {
          $msg = '<div class="alert alert-danger"> Something went wrong. </div>';
          return $msg;
        }
 }




}