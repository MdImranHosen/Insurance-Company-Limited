<?php
/**
 * ServicesClass
 */
class ServicesClass extends Mainclass
{
	
	public function productsServicesAdd($ps_icon,$ps_title,$ps_img,$ps_details) {

       try {
        
        $ps_icon    = $this->fm->validation($ps_icon);
        $ps_title   = $this->fm->validation($ps_title);
		    $ps_details = $this->fm->validation($ps_details);
        $ps_icon    = mysqli_real_escape_string($this->db->link, $ps_icon);
		    $ps_title   = mysqli_real_escape_string($this->db->link, $ps_title);
        $ps_details = mysqli_real_escape_string($this->db->link, $ps_details);

        $logo_name = $ps_img['name'];
        $logo_tem  = $ps_img['tmp_name'];
        $logo_size = $ps_img['size'];
        $logo_type = $ps_img['type'];

        $permitted = array('png', 'jpg', 'jpeg', 'gif');

        $image_ext = explode(".", $logo_name);

		    $file_extension = strtolower(end($image_ext));

        if (empty($ps_title) || empty($ps_icon)) {
          echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
        } elseif ($logo_size > 5242880) {

	      echo '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';

         } elseif (in_array($file_extension, $permitted) === false) {
             
	      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

         } else {

            $sqlck = "SELECT * FROM products_services WHERE ps_title = '$ps_title'";
            $resultck = $this->db->select($sqlck);
            if ($resultck != false) {
              echo '<div class="alert alert-danger"> This:'.$ps_title.' Name Already Exists!</div>';
            } else {

            $ps_url = strtolower(preg_replace('/\s+/', '_', $ps_title));
              
            $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
            $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

            $sql = "INSERT INTO products_services(ps_icon,ps_title,ps_url,ps_image,ps_details) VALUES('$ps_icon','$ps_title','$ps_url','$file_name','$ps_details')";
            $insert = $this->db->insert($sql);
            if ($insert) {

                $last_id = mysqli_insert_id($this->db->link);

                $upload_path = "../../images/services/".$last_id."/";
          
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
         }
        	
        } catch (Exception $e) {
        	echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }
  
    public function getProductsServicesData(){

	   try {
	   	$sql = "SELECT * FROM products_services WHERE status = 1 ORDER BY id ASC";
	    $result = $this->db->select($sql);
	    return $result;
	   } catch (Exception $e) {
	   	echo '<div class="alert alert-danger"> Something went wrong. </div>';
	   }
	 }

   public function productsServicesDetails($id=NULL){
    try {

        $id = $this->fm->validation($id);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $id = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
        $id = (int)$id;

        if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } else {

        $sql = "SELECT * FROM products_services WHERE id = '$id'";
      $result = $this->db->select($sql);
      if ($result) {
        $output = '<table class="table table-bordered table-striped"><tbody>';
        while ($rows = $result->fetch_assoc()) {
                
          $id         = $rows['id'];
          $ps_title   = $rows['ps_title'];
          $ps_details = htmlspecialchars_decode(stripslashes($rows['ps_details']));
          $create_date= $rows['create_date'];

          $logo  = $rows['ps_image'];
          $image = "../images/services/".$id."/".$logo;

          
                $output .= '<tr style="font-weight:bold;font-size:20px;">
                      <th width="20%"> Services Title: </th>
                       <td><b>'.$ps_title.'</b></td>
                     </tr><tr style="font-weight:bold;font-size:20px;"><th width="20%"> Image: </th>
                      <td><center><figure class="image-box"><img title="'.$ps_title.'" src="'.$image.'" style="max-width:90%;height:auto;"></figure></center></td>
                   </tr>
                   <tr style="font-weight:bold;font-size:20px;">
                       <th width="20%"> Create Date: </th>
                       <td><b>'.$create_date.'</b></td>
                   </tr>
                   <tr>
                       <th style="font-weight:bold;font-size:20px;" width="20%"> Details: </th>
                       <td>'.$ps_details.'</td>
                   </tr>';               
        }
        $output .= '</tbody></table>';
        echo $output;
      }
       }
      
    } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
   }

   public function productsServicesDelid($servicesid = NULL) {
    
    try {
        $servicesid = $this->fm->validation($servicesid);
        $servicesid = mysqli_real_escape_string($this->db->link, $servicesid);
        $servicesid = preg_replace('/[^-a-zA-Z0-9_]/','', $servicesid);
        $servicesid = (int)$servicesid;

        if (empty($servicesid)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } else { 

        $filepath = "../../images/services/".$servicesid;

        if (glob($filepath."/*")) {

         array_map('unlink', glob($filepath."/*"));

         if (is_dir($filepath)) {
           rmdir($filepath);
         }
        }

        $sql = "DELETE FROM products_services WHERE id = '$servicesid'";
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


 public function productsServicesUpdate($id=NULL){
    try {

        $id = $this->fm->validation($id);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $id = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
        $id = preg_replace('/\D/', '', $id);
        $id = (int)$id;

        if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } else {

        $sql = "SELECT * FROM products_services WHERE id = '$id'";
        $result = $this->db->select($sql);
        return $result;
       }
      
    } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
   }

  public function productsServicesUpdateData($id,$ps_title_up,$ps_details_up,$ps_image_up) {

       try {

        $id         = $this->fm->validation($id);
        $ps_title   = $this->fm->validation($ps_title_up);
        $ps_details = $this->fm->validation($ps_details_up);
        $id         = mysqli_real_escape_string($this->db->link, $id);
        $ps_title   = mysqli_real_escape_string($this->db->link, $ps_title);
        $ps_details = mysqli_real_escape_string($this->db->link, $ps_details);

       if (!empty($ps_image_up['name'])) {

        $logo_name = $ps_image_up['name'];
        $logo_tem  = $ps_image_up['tmp_name'];
        $logo_size = $ps_image_up['size'];
        $logo_type = $ps_image_up['type'];

        $permitted = array('png', 'jpg', 'jpeg', 'gif');

        $image_ext = explode(".", $logo_name);

        $file_extension = strtolower(end($image_ext));

        if (empty($ps_title)) {
          $msg = '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
          return $msg;
        } elseif ($logo_size > 5242880) {

        $msg = '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';
        return $msg;
        } elseif (in_array($file_extension, $permitted) === false) {
             
        $msg = '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';
         return $msg;
         } else {
          //$ps_url = strtolower(preg_replace('/\s+/', '_', $ps_title));

          $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
          $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

          $filepath = "../images/services/".$id;

          if (glob($filepath."/*")) {
           array_map('unlink', glob($filepath."/*"));

           if (is_dir($filepath)) {
            rmdir($filepath);
           }
          }

           $upload_path = '../images/services/'.$id.'/';             
          
           if (!is_dir($upload_path)) {
              mkdir($upload_path, 0777, true);
            }
              
           $image_path = $upload_path.$file_name;

           if (move_uploaded_file($logo_tem, $image_path)) {

          $sqlup = "UPDATE products_services SET 
                               ps_title   = '$ps_title',
                               ps_image   = '$file_name',
                               ps_details = '$ps_details'
                               WHERE id = '$id'";
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

         // $ps_url = strtolower(preg_replace('/\s+/', '_', $ps_title));

          $sql = "UPDATE products_services SET ps_title = '$ps_title', ps_details = '$ps_details' WHERE id = '$id'";
            $result = $this->db->update($sql);
            if ($result) {
              $msg = '<div class="alert alert-success"> Updated Successfully! </div>';
              return $msg;
            } else{
              $msg = '<div class="alert alert-danger"> Content not Updated! </div>';
              return $msg;
            }
        }
          
        } catch (Exception $e) {
          $msg = '<div class="alert alert-danger"> Something went wrong. </div>';
          return $msg;
        }
   }

 public function productsServicesByCurrentPage($psurl = NULL){
    try {

        $psurl = $this->fm->validation($psurl);
        $psurl = mysqli_real_escape_string($this->db->link, $psurl);
        $psurl = preg_replace('/[^-a-zA-Z0-9_]/','', $psurl);
        $psurl = strtolower(str_replace('-', '_', $psurl));

        if (empty($psurl)) {
          $msg = '<div class="alert alert-danger"> Action Must not be Empty!</div>';
          return $msg;
        } else {

        $sql = "SELECT * FROM products_services WHERE status = 1 AND ps_url = '$psurl'";
        $result = $this->db->select($sql);
        return $result;
       }
      
    } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
   }
 public function productsServicesByAdminCurrentPage($psurl = NULL) {
    try {

        $psurl = $this->fm->validation($psurl);
        $psurl = mysqli_real_escape_string($this->db->link, $psurl);
        $psurl = preg_replace('/[^-a-zA-Z0-9_]/','', $psurl);
        $psurl = strtolower(str_replace('-', '_', $psurl));

        if (empty($psurl)) {
          $msg = '<div class="alert alert-danger"> Action Must not be Empty!</div>';
          return $msg;
        } else {

        $sql = "SELECT * FROM products_services WHERE ps_url = '$psurl'";
        $result = $this->db->select($sql);
        return $result;
       }
      
    } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
   }

public function getWhoAreyouManu(){
  try {
    $sql = "SELECT * FROM top_menu WHERE parent = 2 AND status = 1";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
}
public function getByPageNameSidebar($path){
  try {
    $path = $this->fm->validation($path);
    $path = mysqli_real_escape_string($this->db->link, $path);
    $sql = "SELECT * FROM top_menu WHERE parent = (SELECT parent FROM top_menu WHERE external_link = '$path') AND status = 1";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
}
public function getByPageNameManu($path){
  try {
    $path = $this->fm->validation($path);
    $path = mysqli_real_escape_string($this->db->link, $path);
    $sql = "SELECT * FROM top_menu WHERE parent = (SELECT menu_id FROM top_menu WHERE external_link = '$path') AND status = 1";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
}

public function getByPageTitle($path){
  try {
    $path = $this->fm->validation($path);
    $path = mysqli_real_escape_string($this->db->link, $path);
    $sql = "SELECT *, (SELECT label FROM top_menu WHERE external_link = '$path') AS pagename FROM top_menu WHERE menu_id = (SELECT parent FROM top_menu WHERE external_link = '$path') AND status = 1";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
}

public function getAllServicesInsurance(){
  try {
    $sql = "SELECT * FROM products_services WHERE status = 1";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
}

 public function servicesStatusChangeById($id,$status){
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
        $sql = "UPDATE products_services SET status = '$status' WHERE id = '$id'";
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





  public function getSlideContent() {
    try {
      $sql = "SELECT * FROM slide_content WHERE status = 1 ORDER BY slide_id DESC";
      $result = $this->db->select($sql);
      if ($result) {
       return $result;
      }
    } catch (Exception $e) {
      
    }
   }
   
   public function mediaGallaryYouTubeUrlAdd($content_title,$youtube_video_url) {
    try {
        
        $title = $this->fm->validation($content_title);
        $url   = $this->fm->validation($youtube_video_url);
        $title = mysqli_real_escape_string($this->db->link, $title);
        $url   = mysqli_real_escape_string($this->db->link, $url);
        $url   = filter_var($url, FILTER_SANITIZE_URL);   


      if (empty($title) || empty($url)) {

          echo '<div class="alert alert-danger"> Field Must not be Empty!</div>';

        } elseif(strlen($url) > 250){
         $msg = '<div class="alert alert-danger">YouTube URL Should be Lessthan 250 Characters</div>';
         return $msg;
        }elseif(!filter_var($url, FILTER_VALIDATE_URL)){
         $msg = '<div class="alert alert-danger">YouTube Invalide URL.</div>';
         return $msg;
        } else{

          $sql = "INSERT INTO media_gallary(content_title,youtube_video_url,status) VALUES('$title','$url','1')";
          $insert = $this->db->insert($sql);

            if ($insert) {
              echo '<div class="alert alert-success"> Media Content Added Successfully! </div>';              
            } else{
              echo '<div class="alert alert-danger"> Media Content not Added! </div>';
            }
        }
          
        } catch (Exception $e) {
          echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }

   public function getMediaGallery() {
    try {
      $sql = "SELECT * FROM media_gallary WHERE status = 1 ORDER BY mg_id DESC";
      $result = $this->db->select($sql);
      if ($result) {
        return $result;
      }
    } catch (Exception $e) {
      
    }
   }

   public function getGallery() {
    try {
      $sql = "SELECT * FROM media_gallary WHERE status = 2 ORDER BY mg_id DESC";
      $result = $this->db->select($sql);
      if ($result) {
        return $result;
      }
    } catch (Exception $e) {
      
    }
   }

   public function galleryImageAdd($content_title,$gallery_image) {

    try {
        
        $title = $this->fm->validation($content_title);
        $title = mysqli_real_escape_string($this->db->link, $title); 

      if (empty($title)) {

          echo '<div class="alert alert-danger"> Field Must not be Empty!</div>';

        } elseif(strlen($title) > 350){
         $msg = '<div class="alert alert-danger">Content Title Should be Lessthan 350 Characters</div>';
         return $msg;
        } elseif (!empty($gallery_image)) {
        
        $logo_name = $gallery_image['name'];
        $logo_tem  = $gallery_image['tmp_name'];
        $logo_size = $gallery_image['size'];
        $logo_type = $gallery_image['type'];

        $permitted = array('png', 'jpg', 'jpeg', 'gif');

        $image_ext = explode(".", $logo_name);

        $file_extension = strtolower(end($image_ext));

        $imgdata = getimagesize($logo_tem);
        $width   = $imgdata[0];
        $height  = $imgdata[1];

        if ($logo_size > 5242880) {

        echo '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';

         } elseif (in_array($file_extension, $permitted) === false) {
             
        echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

         } else if($height < 365 || $height > 375 ) { 
          
           echo "<div class='alert alert-danger'> Image Size Should Height 370 px ! </div>";
         } else {
              
            $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
            $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

            $sql = "INSERT INTO media_gallary(content_title,gallery_image,status) VALUES('$title','$file_name','2')";
            $insert = $this->db->insert($sql);
            if ($insert) {

                $last_id = mysqli_insert_id($this->db->link);

                $upload_path = "../../images/gallery/".$last_id."/";
          
              if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
              }
              
                $image_path = $upload_path.$file_name;
            
                if (move_uploaded_file($logo_tem, $image_path)) {
                   echo '<div class="alert alert-success"> Gallery Content Added Successfully! <span style="color:white;font-size:18px;font-weight: bold;"> Image: '.$file_name.'</span> </div>';
                 } 
              
            } else{
              echo '<div class="alert alert-danger"> Gallery Content not Added! </div>';
            }
         }
        }
          
        } catch (Exception $e) {
          echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }

   public function galleryImageDelete($gallery_id = NULL) {
    try {
       $gallery_id = $this->fm->validation($gallery_id);
       $gallery_id = mysqli_real_escape_string($this->db->link, $gallery_id);
       $gallery_id = preg_replace('/[^-a-zA-Z0-9_]/','', $gallery_id);
       $gallery_id = preg_replace('/\D/', '', $gallery_id);
       $gallery_id = (int)$gallery_id;

        if (empty($gallery_id)) {
          echo '<div class="alert alert-danger"> Gallery ID Must not be Empty!</div>';
        } else { 

        $filepath = "../../images/gallery/".$gallery_id;

        if (glob($filepath."/*")) {

         array_map('unlink', glob($filepath."/*"));

         if (is_dir($filepath)) {
           rmdir($filepath);
         }
        }

        $sql = "DELETE FROM media_gallary WHERE mg_id = '$gallery_id'";
        $result = $this->db->delete($sql);
        if ($result) {
          echo '<div class="alert alert-success"> Gallery Image Deleted Successfully! </div>';
        } else{
         echo '<div class="alert alert-danger"> Gallery Image not Deleted. </div>'; 
         }
        }
      
    } catch (Exception $e) {
     echo '<div class="alert alert-danger"> Something went wrong. </div>'; 
    }
   }

   public function mediaGalleryImageDelete($gallery_id = NULL) {
    
    try {
       $gallery_id = $this->fm->validation($gallery_id);
       $gallery_id = mysqli_real_escape_string($this->db->link, $gallery_id);
       $gallery_id = preg_replace('/[^-a-zA-Z0-9_]/','', $gallery_id);
       $gallery_id = preg_replace('/\D/', '', $gallery_id);
       $gallery_id = (int)$gallery_id;

        if (empty($gallery_id)) {
          echo '<div class="alert alert-danger"> Gallery ID Must not be Empty!</div>';
        } else {

        $sql = "DELETE FROM media_gallary WHERE mg_id = '$gallery_id'";
        $result = $this->db->delete($sql);
        if ($result) {
          echo '<div class="alert alert-success"> Gallery Content Deleted Successfully! </div>';
        } else{
         echo '<div class="alert alert-danger"> Gallery Content not Deleted. </div>'; 
         }
        }
      
    } catch (Exception $e) {
     echo '<div class="alert alert-danger"> Something went wrong. </div>'; 
    }
   }


   public function addpsPolicyData($services_url,$policy_name,$policy_img,$policy_des,$highlights,$covered,$exclusions) {

       try {
        
        $services_url = $this->fm->validation($services_url);
        $policy_name  = $this->fm->validation($policy_name);
        $policy_des   = $this->fm->validation($policy_des);
        $highlights   = $this->fm->validation($highlights);
        $covered      = $this->fm->validation($covered);
        $exclusions   = $this->fm->validation($exclusions);
        $services_url = mysqli_real_escape_string($this->db->link, $services_url);
        $policy_name  = mysqli_real_escape_string($this->db->link, $policy_name);
        $policy_des   = mysqli_real_escape_string($this->db->link, $policy_des);
        $highlights   = mysqli_real_escape_string($this->db->link, $highlights);
        $covered      = mysqli_real_escape_string($this->db->link, $covered);
        $exclusions   = mysqli_real_escape_string($this->db->link, $exclusions);        

        $logo_name = $policy_img['name'];
        $logo_tem  = $policy_img['tmp_name'];
        $logo_size = $policy_img['size'];
        $logo_type = $policy_img['type'];

        $permitted = array('png', 'jpg', 'jpeg', 'gif');

        $image_ext = explode(".", $logo_name);

        $file_extension = strtolower(end($image_ext));

        if (empty($policy_name) || empty($services_url)) {
          echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
        } elseif ($logo_size > 5242880) {

        echo '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';

         } elseif (in_array($file_extension, $permitted) === false) {
             
        echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

         } else {

            $sqlck = "SELECT * FROM policy WHERE policy_status = 1 AND services_url = '$services_url' AND policy_name = '$policy_name'";
            $resultck = $this->db->select($sqlck);
            if ($resultck != false) {
              echo '<div class="alert alert-danger"> This:'.$policy_name.' Policy Name Already Exists!</div>';
            } else {

            $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
            $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

            $sql = "INSERT INTO policy(services_url,policy_name,policy_img,policy_des,highlights,covered,exclusions) VALUES('$services_url','$policy_name','$file_name','$policy_des','$highlights','$covered','$exclusions')";
            $insert = $this->db->insert($sql);
            if ($insert) {

                $last_id = mysqli_insert_id($this->db->link);

                $upload_path = "../../images/services/".$services_url."/policy/".$last_id."/";
          
              if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
              }
              
                $image_path = $upload_path.$file_name;
            
                if (move_uploaded_file($logo_tem, $image_path)) {
                    echo '<div class="alert alert-success"> Added Successfully! </div><script>setTimeout(function(){ location.reload(); }, 2000); </script>';
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

   public function psPolicyByAdminCurrentPage($path = NULL){

    try {

       $path = $this->fm->validation($path);
       $path = mysqli_real_escape_string($this->db->link, $path);
       $path = preg_replace('/[^-a-zA-Z0-9_]/','', $path);

        if (empty($path)) {
          echo '<div class="alert alert-danger"> Page Name is Required!</div>';
        } else { 
         $sql = "SELECT * FROM policy WHERE services_url = '$path' ORDER BY policy_id DESC";
         $result = $this->db->select($sql);
         return $result;
        }
      
    } catch (Exception $e) {
      
    }
   }

   public function psPolicyByCurrentPage($path = NULL) {

    try {

       $path = $this->fm->validation($path);
       $path = mysqli_real_escape_string($this->db->link, $path);
       $path = preg_replace('/[^-a-zA-Z0-9_]/','', $path);
       $path = strtolower(str_replace('-', '_', $path));

        if (empty($path)) {
          echo '<div class="alert alert-danger"> Page Name is Required!</div>';
        } else { 
         $sql = "SELECT * FROM policy WHERE policy_status = 1 AND services_url = '$path' ORDER BY policy_id DESC";
         $result = $this->db->select($sql);
         return $result;
        }
      
    } catch (Exception $e) {
      
    }
   }

   public function getpsPolicyByServices($page_url) {

    try {
      
     $page_url = $this->fm->validation($page_url);
     $page_url = mysqli_real_escape_string($this->db->link, $page_url);
     $sql = "SELECT * FROM policy WHERE services_url = '$page_url' AND policy_status = 1 ORDER BY policy_id DESC";
     $result = $this->db->select($sql);
     return $result;
      
    } catch (Exception $e) {
      
    }
   }

    public function psPolicyByPolicyId($id=NULL){
    try {

        $id = $this->fm->validation($id);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $id = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
        $id = preg_replace('/\D/', '', $id);
        $id = (int)$id;

        if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } else {

        $sql = "SELECT * FROM policy WHERE policy_status = 1 AND policy_id = '$id'";
        $result = $this->db->select($sql);
        return $result;
       }
      
    } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
   }
  

   public function viewpsPolicyDataByPId($services_url,$policy_id){
    try {

        $policy_id    = $this->fm->validation($policy_id);
        $services_url = $this->fm->validation($services_url);
        $policy_id    = mysqli_real_escape_string($this->db->link, $policy_id);
        $services_url = mysqli_real_escape_string($this->db->link, $services_url);
        $services_url = preg_replace('/[^-a-zA-Z0-9_]/','', $services_url);
        $policy_id    = preg_replace('/\D/', '', $policy_id);
        $policy_id    = (int)$policy_id;

       if (empty($policy_id) || empty($services_url)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } else {

        $sql = "SELECT * FROM policy WHERE services_url = '$services_url' AND  policy_id = '$policy_id'";
      $result = $this->db->select($sql);
      if ($result) {
        $output = '<table class="table table-bordered table-striped"><tbody>';
        while ($prows = $result->fetch_assoc()) {
                
      $policy_id     = $prows['policy_id'];
      $services_url  = $prows['services_url'];
      $policy_name   = $prows['policy_name'];
      $policy_img    = $prows['policy_img'];
      $policy_status = $prows['policy_status'];
      $pcreate_date  = $prows['create_date'];

      $policy_des = htmlspecialchars_decode(stripslashes($prows['policy_des']));
      $highlights = htmlspecialchars_decode(stripslashes($prows['highlights']));
      $covered = htmlspecialchars_decode(stripslashes($prows['covered']));
      $exclusions = htmlspecialchars_decode(stripslashes($prows['exclusions']));                      

      $plicyimg = "../../images/services/".$services_url."/policy/".$policy_id."/".$policy_img;

      if (file_exists($plicyimg) != false) {
       $plicyimg = "../images/services/".$services_url."/policy/".$policy_id."/".$policy_img;
      } else{
        $plicyimg = "../img/logo.png";
      }

          
        $output .= '<tr style="font-weight:bold;font-size:20px;">
              <th width="20%"> Policy Name: </th>
               <td><b>'.$policy_name.'</b></td>
             </tr><tr style="font-weight:bold;font-size:20px;"><th width="20%"> Image: </th>
              <td><center><figure class="image-box"><img title="'.$policy_name.'" src="'.$plicyimg.'" style="max-width:90%;height:auto;"></figure></center></td>
           </tr>
           <tr style="font-weight:bold;font-size:20px;">
               <th width="20%"> Create Date: </th>
               <td><b>'.$pcreate_date.'</b></td>
           </tr>
           <tr>
               <th style="font-weight:bold;font-size:20px;" width="20%"> Details: </th>
               <td>'.$policy_des.'</td>
           </tr>
           <tr>
               <th style="font-weight:bold;font-size:20px;" width="20%"> Highlights: </th>
               <td>'.$highlights.'</td>
           </tr>
           <tr>
               <th style="font-weight:bold;font-size:20px;" width="20%"> Covered: </th>
               <td>'.$covered.'</td>
           </tr>
           <tr>
               <th style="font-weight:bold;font-size:20px;" width="20%"> Exclusions: </th>
               <td>'.$exclusions.'</td>
           </tr>';               
        }
        $output .= '</tbody></table>';
        echo $output;
      } else {
         echo '<div class="alert alert-danger"> Something went wrong. </div>';
      }

     }
      
    } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
   }


 public function policyStatusChangeByPId($policy_status,$policy_id) {
  try {
       $policy_id     = $this->fm->validation($policy_id);
       $policy_status = $this->fm->validation($policy_status);
       $policy_id     = mysqli_real_escape_string($this->db->link, $policy_id);
       $policy_status = mysqli_real_escape_string($this->db->link, $policy_status);
       $policy_id     = preg_replace('/[^-a-zA-Z0-9_]/','', $policy_id);
       $policy_id     = preg_replace('/\D/', '', $policy_id);
       $policy_id     = (int)$policy_id;
       $policy_status = (int)$policy_status;

      if (empty($policy_id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
      } else { 
        $sql = "UPDATE policy SET policy_status = '$policy_status' WHERE policy_id = '$policy_id'";
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

 public function psPolicyDeleteByPId($services_url,$policy_id){
    try {

        $policy_id    = $this->fm->validation($policy_id);
        $services_url = $this->fm->validation($services_url);
        $policy_id    = mysqli_real_escape_string($this->db->link, $policy_id);
        $services_url = mysqli_real_escape_string($this->db->link, $services_url);
        $services_url = preg_replace('/[^-a-zA-Z0-9_]/','', $services_url);
        $policy_id    = preg_replace('/\D/', '', $policy_id);
        $policy_id    = (int)$policy_id;

        if (empty($policy_id) || empty($services_url)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } else {             

        $filepath = "../../images/services/".$services_url."/policy/".$policy_id;

        if (glob($filepath."/*")) {

         array_map('unlink', glob($filepath."/*"));

         if (is_dir($filepath)) {
           rmdir($filepath);
         }
        }
       
       $sql = "DELETE FROM policy WHERE services_url = '$services_url' AND policy_id = '$policy_id'";
       $result = $this->db->delete($sql);
       if ($result) {
         echo '<div class="alert alert-success"> Successfully Deleted!</div>';
         echo '<script>setTimeout(function(){ location.reload(); }, 2000); </script>';
       } else{
        echo '<div class="alert alert-danger"> Not Deleted!</div>';
       }

     }
      
    } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
   }


  public function psPolicyDataUpdateBypId($id=NULL){
    try {

        $id = $this->fm->validation($id);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $id = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
        $id = preg_replace('/\D/', '', $id);
        $id = (int)$id;

        if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } else {

        $sql = "SELECT * FROM policy WHERE policy_id = '$id'";
        $result = $this->db->select($sql);
        return $result;
       }
      
    } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
   }

  public function psPolicyUpdateDataById($policy_id,$services_url,$policy_name,$policy_des,$highlights,$covered,$exclusions,$policy_img) {

       try {

        $policy_id   = $this->fm->validation($policy_id);
        $services_url= $this->fm->validation($services_url);
        $policy_name = $this->fm->validation($policy_name);
        $policy_des  = $this->fm->validation($policy_des);
        $highlights  = $this->fm->validation($highlights);
        $covered     = $this->fm->validation($covered);
        $exclusions  = $this->fm->validation($exclusions);
        $policy_id   = mysqli_real_escape_string($this->db->link, $policy_id);
        $services_url= mysqli_real_escape_string($this->db->link, $services_url);
        $policy_name = mysqli_real_escape_string($this->db->link, $policy_name);
        $policy_des  = mysqli_real_escape_string($this->db->link, $policy_des);
        $highlights  = mysqli_real_escape_string($this->db->link, $highlights);
        $covered     = mysqli_real_escape_string($this->db->link, $covered);
        $exclusions  = mysqli_real_escape_string($this->db->link, $exclusions);

       if (!empty($policy_img['name'])) {

        $logo_name = $policy_img['name'];
        $logo_tem  = $policy_img['tmp_name'];
        $logo_size = $policy_img['size'];
        $logo_type = $policy_img['type'];

        $permitted = array('png', 'jpg', 'jpeg', 'gif');

        $image_ext = explode(".", $logo_name);

        $file_extension = strtolower(end($image_ext));

        if (empty($policy_name)) {
          $msg = '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
          return $msg;
        } elseif ($logo_size > 5242880) {

        $msg = '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';
        return $msg;
        } elseif (in_array($file_extension, $permitted) === false) {
             
        $msg = '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';
         return $msg;
         } else {

          $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
          $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

          $filepath = "../images/services/".$services_url."/policy/".$policy_id;

          if (glob($filepath."/*")) {
           array_map('unlink', glob($filepath."/*"));

           if (is_dir($filepath)) {
            rmdir($filepath);
           }
          }

           $upload_path = "../images/services/".$services_url."/policy/".$policy_id."/";             
          
           if (!is_dir($upload_path)) {
              mkdir($upload_path, 0777, true);
            }
              
           $image_path = $upload_path.$file_name;

           if (move_uploaded_file($logo_tem, $image_path)) {

          $sqlup = "UPDATE policy SET 
                     policy_name = '$policy_name',
                     policy_img  = '$file_name',
                     policy_des  = '$policy_des',
                     highlights  = '$highlights',
                     covered     = '$covered',
                     exclusions = '$exclusions'
                     WHERE services_url = '$services_url' AND policy_id = '$policy_id'";
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

          $sql = "UPDATE policy SET 
                     policy_name = '$policy_name',
                     policy_des  = '$policy_des',
                     highlights  = '$highlights',
                     covered     = '$covered',
                     exclusions = '$exclusions'
                     WHERE services_url = '$services_url' AND policy_id = '$policy_id'";
            $result = $this->db->update($sql);
            if ($result) {
              $msg = '<div class="alert alert-success"> Updated Successfully! </div>';
              return $msg;
            } else{
              $msg = '<div class="alert alert-danger"> Content not Updated! </div>';
              return $msg;
            }
        }
          
        } catch (Exception $e) {
          $msg = '<div class="alert alert-danger"> Something went wrong. </div>';
          return $msg;
        }
   }

   
}