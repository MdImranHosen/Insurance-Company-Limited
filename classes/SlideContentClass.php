<?php
/**
 * SlideContentClass  
 */
class SlideContentClass extends Mainclass
{
	
	public function slideContentAdd($slide_title,$slide_bg_img) {

  try {
        
        $slide_title = $this->fm->validation($slide_title);
		    $slide_title = mysqli_real_escape_string($this->db->link, $slide_title);

        if (empty($slide_title) || empty($slide_bg_img['tmp_name'])) {
          echo '<div class="alert alert-danger"> Field Must not be Empty!</div>';
        } else {

        $logo_name = $slide_bg_img['name'];
        $logo_tem  = $slide_bg_img['tmp_name'];
        $logo_size = $slide_bg_img['size'];
        $logo_type = $slide_bg_img['type'];

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

         } else if(($width < 715 || $width > 725) || ($height < 495 || $height > 505 )) { 
			    
           echo "<div class='alert alert-danger'> Image Size Should be Width:720 px and Height: 500px ! </div>";
         } else {            
              
            $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
            $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

            $sql = "INSERT INTO slide_content(slide_title,slide_bg_img) VALUES('$slide_title','$file_name')";
            $insert = $this->db->insert($sql);
            if ($insert) {

                $last_id = mysqli_insert_id($this->db->link);

                $upload_path = "../../images/main-slider/".$last_id."/";
          
	            if (!is_dir($upload_path)) {
	              mkdir($upload_path, 0777, true);
	            }
              
                $image_path = $upload_path.$file_name;
            
                if (move_uploaded_file($logo_tem, $image_path)) {
                   echo '<div class="alert alert-success"> Slide Content Added Successfully! </div>';
                 } 
              
            } else{
              echo '<div class="alert alert-danger"> Slide Content not Added! </div>';
            }
         }
        }
        	
        } catch (Exception $e) {
        	echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }
  
    public function getSlideContentData() {

	   try {
	   	$sql = "SELECT * FROM slide_content ORDER BY slide_id DESC";
	    $result = $this->db->select($sql);
	    return $result;
	   } catch (Exception $e) {
	   	echo '<div class="alert alert-danger"> Something went wrong. </div>';
	   }
	 }

   public function slideContentDetails($slideid=NULL){
    try {

        $slideid = $this->fm->validation($slideid);
        $slideid = mysqli_real_escape_string($this->db->link, $slideid);
        $slideid = preg_replace('/[^-a-zA-Z0-9_]/','', $slideid);
        $slideid = (int)$slideid;

        if (empty($slideid)) {
          echo '<div class="alert alert-danger"> Slide ID Must not be Empty!</div>';
        } else {

        $sql = "SELECT * FROM slide_content WHERE slide_id = '$slideid'";
      $result = $this->db->select($sql);
      if ($result) {
        $output = '<table class="table table-bordered table-striped"><tbody>';
        while ($rows = $result->fetch_assoc()) {
                
          $slide_id    = $rows['slide_id'];
          $slide_title = $rows['slide_title'];
          $logo        = $rows['slide_bg_img'];          
          $image = "../images/main-slider/".$slide_id."/".$logo;

          
                  $output .= '<tr><th width="20%"> Slide Image </th>
                      <td><center><figure class="image-box"><img title="'.$slide_title.'" src="'.$image.'" style="max-width:90%;height:auto;"></figure></center></td>
                   </tr>
                   <tr>
                       <th width="20%"> Slide Title </th>
                       <td><b>'.$slide_title.'</b></td>
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

   public function slideContentDelete($slideid = NULL){
    try {
        $slideid = $this->fm->validation($slideid);
        $slideid = mysqli_real_escape_string($this->db->link, $slideid);
        $slideid = preg_replace('/[^-a-zA-Z0-9_]/','', $slideid);
        $slideid = (int)$slideid;

        if (empty($slideid)) {
          echo '<div class="alert alert-danger"> Slide ID Must not be Empty!</div>';
        } else { 

        $filepath = "../../images/main-slider/".$slideid;

        if (glob($filepath."/*")) {

         array_map('unlink', glob($filepath."/*"));

         if (is_dir($filepath)) {
           rmdir($filepath);
         }
        }

        $sql = "DELETE FROM slide_content WHERE slide_id = '$slideid'";
        $result = $this->db->delete($sql);
        if ($result) {
          echo '<div class="alert alert-success"> Slide Deleted Successfully! </div>';
        } else{
         echo '<div class="alert alert-danger"> Slide not Deleted. </div>'; 
         }
        }
      
    } catch (Exception $e) {
     echo '<div class="alert alert-danger"> Something went wrong. </div>'; 
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

 public function getHomeImageVideoMeg(){
  try {
    $sql = "SELECT * FROM image_video_welcome_msg ORDER BY id DESC LIMIT 1";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
 }

public function setImageVideoWelcome($url,$banner_image,$w_msg,$id) {
  try {
        
    $url   = $this->fm->validation($url);
    $w_msg = $this->fm->validation($w_msg);
    $id    = $this->fm->validation($id);
    $url   = mysqli_real_escape_string($this->db->link, $url);
    $w_msg = mysqli_real_escape_string($this->db->link, $w_msg);
    $id    = mysqli_real_escape_string($this->db->link, $id);
    $url   = filter_var($url, FILTER_SANITIZE_URL);

     if (empty($url) || empty($id)) {

      echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';

        } elseif(strlen($url) > 250){
         $msg = '<div class="alert alert-danger">YouTube URL Should be Lessthan 250 Characters.</div>';
         return $msg;
        }elseif(!filter_var($url, FILTER_VALIDATE_URL)){
         $msg = '<div class="alert alert-danger">YouTube Invalide URL.</div>';
         return $msg;
        } else{

        if (!empty($banner_image)) {

        $logo_name = $banner_image['name'];
        $logo_tem  = $banner_image['tmp_name'];
        $logo_size = $banner_image['size'];
        $logo_type = $banner_image['type'];

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

         } else {
              
            $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
            $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

            $upload_path = "../../img/banner_image";
          
              if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
              }

              if (glob($upload_path."/*")) {
                array_map('unlink', glob($upload_path."/*"));
               }
              
                $image_path = $upload_path.'/'.$file_name;
            
                if (move_uploaded_file($logo_tem, $image_path)) {
                   $sql = "UPDATE image_video_welcome_msg SET 
                  youtube_video_url = '$url',
                  banner_image      = '$file_name',
                  welcome_msg       = '$w_msg'
                  WHERE id = '$id'";
                 $result = $this->db->update($sql);

                 if ($result) {

                 echo '<div class="alert alert-success"> Content Updated Successfully! </div>';  
                 echo '<script>alert("Updated Successfully!"); </script>'; 
                 echo '<script>setTimeout(function(){
                    location.reload();
                  }, 6000);</script>';            
                  } else{
                  echo '<div class="alert alert-danger"> Content not Added! </div>';
                  }
                 }
             }
             
            } else{
             $sql = "UPDATE image_video_welcome_msg SET 
                  youtube_video_url = '$url',
                  welcome_msg       = '$w_msg'
                  WHERE id = '$id'";
             $result = $this->db->update($sql);

             if ($result) {

              echo '<div class="alert alert-success"> Content Updated Successfully! </div>';  
              echo '<script>alert("Updated Successfully!"); </script>'; 
              echo '<script>setTimeout(function(){
                    location.reload();
                  }, 6000);</script>';            
              } else{
              echo '<div class="alert alert-danger"> Content not Updated! </div>';
              }
                
              
            }
         }

        } catch (Exception $e) {
          echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }

   // Pagination Gallery..

   public function getGalleryLimit($start_from,$per_page) {
    try {
      $start_from = $this->fm->validation($start_from);
      $per_page   = $this->fm->validation($per_page);
      $start_from = mysqli_real_escape_string($this->db->link, $start_from);
      $per_page   = mysqli_real_escape_string($this->db->link, $per_page);
      $start_from = preg_replace('/\D/', '', $start_from);
      $per_page   = preg_replace('/\D/', '', $per_page);
      $start_from = (int)$start_from;
      $per_page   = (int)$per_page;

      $sql = "SELECT * FROM media_gallary WHERE status = 2 ORDER BY mg_id DESC LIMIT $start_from, $per_page";
      $result = $this->db->select($sql);
      if ($result) {
        return $result;
      }
    } catch (Exception $e) {
      
    }
   }

    public function galleryImagePaginations($per_page) {

     try {
      $per_page = $this->fm->validation($per_page);
      $per_page = mysqli_real_escape_string($this->db->link, $per_page);
      $per_page = preg_replace('/\D/', '', $per_page);
      $per_page = (int)$per_page;

      $sql = "SELECT * FROM media_gallary WHERE status = 2";
      $result = $this->db->select($sql);
      $total_row = $result->num_rows;
      $toral = ceil($total_row/$per_page);
      return $toral;
     } catch (Exception $e) {
      $msg = '<div class="alert alert-danger"> Something went wrong. </div>';
      return $msg;
     }
   }

    // Pagination Video Gallery..

   public function getMediaGalleryLimit($start_from,$per_page) {
    try {
      $start_from = $this->fm->validation($start_from);
      $per_page   = $this->fm->validation($per_page);
      $start_from = mysqli_real_escape_string($this->db->link, $start_from);
      $per_page   = mysqli_real_escape_string($this->db->link, $per_page);
      $start_from = preg_replace('/\D/', '', $start_from);
      $per_page   = preg_replace('/\D/', '', $per_page);
      $start_from = (int)$start_from;
      $per_page   = (int)$per_page;

      $sql = "SELECT * FROM media_gallary WHERE status = 1 ORDER BY mg_id DESC LIMIT $start_from, $per_page";
      $result = $this->db->select($sql);
      if ($result) {
        return $result;
      }
    } catch (Exception $e) {
      
    }
   }

    public function galleryVideoPaginations($per_page) {

     try {
      $per_page = $this->fm->validation($per_page);
      $per_page = mysqli_real_escape_string($this->db->link, $per_page);
      $per_page = preg_replace('/\D/', '', $per_page);
      $per_page = (int)$per_page;

      $sql = "SELECT * FROM media_gallary WHERE status = 1";
      $result = $this->db->select($sql);
      $total_row = $result->num_rows;
      $toral = ceil($total_row/$per_page);
      return $toral;
     } catch (Exception $e) {
      $msg = '<div class="alert alert-danger"> Something went wrong. </div>';
      return $msg;
     }
   }

   
}