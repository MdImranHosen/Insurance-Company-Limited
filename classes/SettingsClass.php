<?php
/**
 * SettingsClass 
 */
class SettingsClass extends Mainclass
{

 public function getAllBranceCount(){
    try {
     $sql = "SELECT count(branches_id) as brancesall FROM branches";
     $result = $this->db->select($sql);
     return $result;        
    } catch (Exception $e) {
        
    }
 }
 public function getTotalPolicy(){
    try {
     $sql = "SELECT count(policy_id) as totalPolicy FROM policy";
     $result = $this->db->select($sql);
     return $result;        
    } catch (Exception $e) {
        
    }
 }
 public function getTotalOnlineClaim(){
    try {
     $sql = "SELECT count(id) as totalOnlineClaim FROM online_claim";
     $result = $this->db->select($sql);
     return $result;        
    } catch (Exception $e) {
        
    }
 }

  public function getTotalMessage(){
    try {
     $sql = "SELECT count(id) as totalMessage FROM contacts";
     $result = $this->db->select($sql);
     return $result;        
    } catch (Exception $e) {
        
    }
  }
  public function getTotalEventNews(){
    try {
     $sql = "SELECT count(news_events_id) as totalEventNews FROM news_events";
     $result = $this->db->select($sql);
     return $result;        
    } catch (Exception $e) {
        
    }
  }

  public function getTotalVideo(){
    try {
     $sql = "SELECT count(mg_id) as totalVideo FROM media_gallary WHERE status = 1";
     $result = $this->db->select($sql);
     return $result;        
    } catch (Exception $e) {
        
    }
  }

  public function getTotalResume(){
    try {
     $sql = "SELECT count(resume_id) as totalResume FROM resume";
     $result = $this->db->select($sql);
     return $result;        
    } catch (Exception $e) {
        
    }
  }

  public function getTotalBoardOfDirectors(){
    try {
     $sql = "SELECT count(em_id) as tbod FROM employers WHERE em_type = 'board_of_directors'";
     $result = $this->db->select($sql);
     return $result;        
    } catch (Exception $e) {
        
    }
  }

  public function getTopMenuAll(){
   try {
     $sql = "SELECT * FROM top_menu WHERE parent = 0 AND status = 1";
     $result = $this->db->select($sql);
     return $result;
   } catch (Exception $e) {
     
   }
  }
  public function getSubmenuallbymainm($menu_id){
   try {
     $menu_id = $this->fm->validation($menu_id);
     $menu_id = mysqli_real_escape_string($this->db->link, $menu_id);
     $sql = "SELECT * FROM top_menu WHERE  parent = '$menu_id' AND status = 1";
     $result = $this->db->select($sql);
     return $result;
   } catch (Exception $e) {
     
   }
  }

	public function getSettingsData(){
	   try {
		$sql = "SELECT * FROM settings WHERE id =1";
		$result = $this->db->select($sql);
		return $result;
		} catch (Exception $e) {
			$msg = '<div class="alert alert-danger"> Something went wrong. </div>';
			return $msg;
		}
	}

	 public function updateSettingsData($site_title,$site_icon,$site_logo,$meta_keyword,$meta_desc_on,$s_copy_right,$site_url,$site_dev,$dev_site_url,$opening_time,$site_phone,$site_email,$site_address,$site_facebook,$site_twitter,$site_linkedin,$site_instagram,$site_youtube,$site_footer_about) {

        try {

        $site_title     = $this->fm->validation($site_title);
    	  $meta_keyword   = $this->fm->validation($meta_keyword);
        $meta_desc_on   = $this->fm->validation($meta_desc_on);
        $s_copy_right   = $this->fm->validation($s_copy_right);
        //$site_url       = $this->fm->validation($site_url);
        $site_dev       = $this->fm->validation($site_dev);
        $opening_time   = $this->fm->validation($opening_time);
        $site_phone     = $this->fm->validation($site_phone);
        $site_email     = $this->fm->validation($site_email);
        $site_address   = $this->fm->validation($site_address);
        $site_facebook  = $this->fm->validation($site_facebook);
        $site_twitter   = $this->fm->validation($site_twitter);
        $site_linkedin  = $this->fm->validation($site_linkedin);
        $site_instagram = $this->fm->validation($site_instagram);
        $site_youtube   = $this->fm->validation($site_youtube);
        $site_footer_about = $this->fm->validation($site_footer_about);
        
        $site_title     = mysqli_real_escape_string($this->db->link, $site_title);
        $meta_keyword   = mysqli_real_escape_string($this->db->link, $meta_keyword);
        $meta_desc_on   = mysqli_real_escape_string($this->db->link, $meta_desc_on);
        $s_copy_right   = mysqli_real_escape_string($this->db->link, $s_copy_right);
        $site_url       = mysqli_real_escape_string($this->db->link, $site_url);
        $site_dev       = mysqli_real_escape_string($this->db->link, $site_dev);
        $dev_site_url   = mysqli_real_escape_string($this->db->link, $dev_site_url);
        $opening_time   = mysqli_real_escape_string($this->db->link, $opening_time);
        $site_phone     = mysqli_real_escape_string($this->db->link, $site_phone);
        $site_email     = mysqli_real_escape_string($this->db->link, $site_email);
        $site_address   = mysqli_real_escape_string($this->db->link, $site_address);
        $site_facebook  = mysqli_real_escape_string($this->db->link, $site_facebook);
        $site_twitter   = mysqli_real_escape_string($this->db->link, $site_twitter);
        $site_linkedin  = mysqli_real_escape_string($this->db->link, $site_linkedin);
        $site_instagram = mysqli_real_escape_string($this->db->link, $site_instagram);
        $site_youtube   = mysqli_real_escape_string($this->db->link, $site_youtube);
        $site_footer_about = mysqli_real_escape_string($this->db->link, $site_footer_about);

        $permitted = array('png', 'jpg', 'jpeg', 'gif');

        if (!empty($site_icon) && !empty($site_logo)) {

        $icon_name = $site_icon['name'];
        $icon_tem  = $site_icon['tmp_name'];
        $icon_size = $site_icon['size'];
        $icon_type = $site_icon['type'];        

        $icon_ext = explode(".", $icon_name);

		$icon_extension = strtolower(end($icon_ext));

        $icon_data = getimagesize($icon_tem);
        $icon_width   = $icon_data[0];
        $icon_height  = $icon_data[1];

        $logo_name = $site_logo['name'];
        $logo_tem  = $site_logo['tmp_name'];
        $logo_size = $site_logo['size'];
        $logo_type = $site_logo['type'];

        $image_ext = explode(".", $logo_name);

		$file_extension = strtolower(end($image_ext));

        $imgdata = getimagesize($logo_tem);
        $width   = $imgdata[0];
        $height  = $imgdata[1];

        if (empty($site_title)) {
          echo '<div class="alert alert-danger"> Site Title Should not be Empty!</div>';
        }  elseif ($icon_size > 100000) {
             
	      echo '<div class="alert alert-danger" role="alert">  Sorry, Icon size Less then 1MB. </div>';

         } elseif (in_array($icon_extension, $permitted) === false) {
             
	      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

         } else if(($icon_width<10 || $icon_width>55)) {
			    
           echo "<div class='alert alert-danger'> Icon Size Should width 40-55px !! </div>";
         } elseif ($logo_size > 500000) {
             
	      echo '<div class="alert alert-danger" role="alert">  Sorry, Logo size Less then 5MB. </div>';

         } elseif (in_array($file_extension, $permitted) === false) {
             
	      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

         } else if(($width<150 || $width>200)) {
			    
           echo "<div class='alert alert-danger'> Logo Size Should be Width: 150-200px and Height: auto! </div>";
         } else {
              
            $icon_file = strtolower(preg_replace('/\s+/', '_', $icon_name));
            $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
            $icon_file = mysqli_real_escape_string($this->db->link, $icon_file);
            $file_name = mysqli_real_escape_string($this->db->link, $file_name);

            $upload_path = "../../img/";
          
            if (!is_dir($upload_path)) {
              mkdir($upload_path, 0777, true);
            }
              
            $icon_path  = $upload_path.$icon_file;
            $image_path = $upload_path.$file_name;
        
            move_uploaded_file($icon_tem, $icon_path);
            move_uploaded_file($logo_tem, $image_path);

            /*$sql = "INSERT INTO settings(site_title,site_logo,site_icon,site_meta_keyword,site_meta_description,site_copy_right,site_dev) VALUES('$site_title','$file_name','$icon_file','$meta_keyword','$meta_desc_on','$s_copy_right','$site_dev')";*/

            $sql = "UPDATE settings SET site_title = '$site_title', site_logo = '$file_name', site_icon = '$icon_file', site_meta_keyword = '$meta_keyword', site_meta_description = '$meta_desc_on', site_copy_right = '$s_copy_right', site_url = '$site_url', site_dev = '$site_dev', develop_site_url = '$dev_site_url', opening_time = '$opening_time', site_phone = '$site_phone', site_email = '$site_email', site_address = '$site_address', site_facebook = '$site_facebook', site_twitter = '$site_twitter', site_linkedin = '$site_linkedin', site_instagram = '$site_instagram', site_youtube = '$site_youtube', site_footer_about = '$site_footer_about' WHERE id = 1";
            $result = $this->db->update($sql);
            if ($result) {
               echo '<script> alert("Updated Successfully!"); </script>';
            } else{
              echo '<div class="alert alert-danger"> Not Updated! </div>';
            }

          }
         } elseif (!empty($site_icon) && empty($site_logo)) {

        $icon_name = $site_icon['name'];
        $icon_tem  = $site_icon['tmp_name'];
        $icon_size = $site_icon['size'];
        $icon_type = $site_icon['type'];        

        $icon_ext = explode(".", $icon_name);

		$icon_extension = strtolower(end($icon_ext));

        $icon_data = getimagesize($icon_tem);
        $icon_width   = $icon_data[0];
        $icon_height  = $icon_data[1];

        if (empty($site_title)) {
          echo '<div class="alert alert-danger"> Site Title Should not be Empty!</div>';
        }  elseif ($icon_size > 100000) {
             
	      echo '<div class="alert alert-danger" role="alert">  Sorry, Icon size Less then 1MB. </div>';

         } elseif (in_array($icon_extension, $permitted) === false) {
             
	      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

         } elseif(($icon_width<40 || $icon_width>55)) {
			    
           echo "<div class='alert alert-danger'> Icon width Size Should be 40-55px ! </div>";
         } else {
              
            $icon_file = strtolower(preg_replace('/\s+/', '_', $icon_name));
            $icon_file = mysqli_real_escape_string($this->db->link, $icon_file);

            $upload_path = "../../img/";
          
            if (!is_dir($upload_path)) {
              mkdir($upload_path, 0777, true);
            }
              
            $icon_path  = $upload_path.$icon_file;
        
            move_uploaded_file($icon_tem, $icon_path);

            $sql = "UPDATE settings SET site_title = '$site_title', site_icon = '$icon_file', site_meta_keyword = '$meta_keyword', site_meta_description = '$meta_desc_on', site_copy_right = '$s_copy_right', site_url = '$site_url', site_dev = '$site_dev', develop_site_url = '$dev_site_url', opening_time = '$opening_time', site_phone = '$site_phone', site_email = '$site_email', site_address = '$site_address', site_facebook = '$site_facebook', site_twitter = '$site_twitter', site_linkedin = '$site_linkedin', site_instagram = '$site_instagram', site_youtube = '$site_youtube', site_footer_about = '$site_footer_about' WHERE id = 1";
            $result = $this->db->update($sql);
            if ($result) {
              echo '<script> alert("Updated Successfully!"); </script>';
            } else{
              echo '<div class="alert alert-danger">Not Updated! </div>';
            }

          }
         } elseif (empty($site_icon) && !empty($site_logo)) {

	        $logo_name = $site_logo['name'];
	        $logo_tem  = $site_logo['tmp_name'];
	        $logo_size = $site_logo['size'];
	        $logo_type = $site_logo['type'];

	        $image_ext = explode(".", $logo_name);

			$file_extension = strtolower(end($image_ext));

	        $imgdata = getimagesize($logo_tem);
	        $width   = $imgdata[0];
	        $height  = $imgdata[1];

	        if (empty($site_title)) {
	          echo '<div class="alert alert-danger">Site Title Should not be Empty!</div>';
	        } elseif ($logo_size > 500000) {
	             
		      echo '<div class="alert alert-danger" role="alert">  Sorry, Logo size Less then 5MB. </div>';

	         } elseif (in_array($file_extension, $permitted) === false) {
	             
		      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

	         } else if(($width<150 || $width>200)) {
				    
	           echo "<div class='alert alert-danger'> Logo Size Should be Width: 150-200px and Height: auto ! </div>";
	         } else {
	              
	            $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
                $file_name = mysqli_real_escape_string($this->db->link, $file_name);

	            $upload_path = "../../img/";
	          
	            if (!is_dir($upload_path)) {
	              mkdir($upload_path, 0777, true);
	            }
	              
	            $image_path = $upload_path.$file_name;
	        
	            move_uploaded_file($logo_tem, $image_path);

	            $sql = "UPDATE settings SET site_title = '$site_title', site_logo = '$file_name', site_meta_keyword = '$meta_keyword', site_meta_description = '$meta_desc_on', site_copy_right = '$s_copy_right', site_url = '$site_url', site_dev = '$site_dev', develop_site_url = '$dev_site_url', opening_time = '$opening_time', site_phone = '$site_phone', site_email = '$site_email', site_address = '$site_address', site_facebook = '$site_facebook', site_twitter = '$site_twitter', site_linkedin = '$site_linkedin', site_instagram = '$site_instagram', site_youtube = '$site_youtube', site_footer_about = '$site_footer_about' WHERE id = 1";
	            $result = $this->db->update($sql);
	            if ($result) {
	              echo '<script> alert("Updated Successfully!"); </script>';
	            } else{
	              echo '<div class="alert alert-danger"> Not Updated! </div>';
	            }

	          }
          } else{

	        if (empty($site_title)) {
	          echo '<div class="alert alert-danger"> Site Title Should not be Empty!</div>';
	        } else {
	            $sql = "UPDATE settings SET site_title = '$site_title', site_meta_keyword = '$meta_keyword', site_meta_description = '$meta_desc_on', site_copy_right = '$s_copy_right', site_url = '$site_url', site_dev = '$site_dev', develop_site_url = '$dev_site_url', opening_time = '$opening_time', site_phone = '$site_phone', site_email = '$site_email', site_address = '$site_address', site_facebook = '$site_facebook', site_twitter = '$site_twitter', site_linkedin = '$site_linkedin', site_instagram = '$site_instagram', site_youtube = '$site_youtube', site_footer_about = '$site_footer_about' WHERE id = 1";
	            $result = $this->db->update($sql);
	            if ($result) {
	               echo '<script> alert("Updated Successfully!"); </script>';
	            } else{
	              echo '<div class="alert alert-danger"> Not Updated! </div>';
	            }

	          }

          }
        	
        } catch (Exception $e) {
        	echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }

   public function getAboutsData() {
     try {
      $sql = "SELECT * FROM abouts WHERE status = 1 ORDER BY id LIMIT 1";
      $result = $this->db->select($sql);
      if ($result) {
            return $result;
        }  
     } catch (Exception $e) {
         
     }
   }
   public function ourMissionVissionUpData($our_vision_mission,$vm_id){
    try {
     $our_vision_mission = $this->fm->validation($our_vision_mission);
     $vm_id = $this->fm->validation($vm_id);
     $our_vision_mission = mysqli_real_escape_string($this->db->link, $our_vision_mission);
     $vm_id = mysqli_real_escape_string($this->db->link, $vm_id);
     $vm_id = (int)$vm_id;
     $vm_id = preg_replace('/\D/', '', $vm_id);

     if (empty($our_vision_mission) || empty($vm_id)) {
      echo '<div class="alert alert-danger"> Field is Required!</div>';     
    } elseif(filter_var($vm_id, FILTER_VALIDATE_INT) == false){
      echo '<div class="alert alert-danger"> Invalid Id!</div>';
    }else{
     $sql = "UPDATE abouts SET our_mission = '$our_vision_mission' WHERE id = '$vm_id'";
     $result = $this->db->update($sql);
     if ($result) {
         echo '<div class="alert alert-success"> Updated Successfully! </div>';
     } else{
        echo '<div class="alert alert-danger"> Not Updated!</div>'; 
     }
    }
    } catch (Exception $e) {
        
    }
   }

public function companyProfileUpdate($company_profile,$cp_id){
  try {
    
     $company_profile = $this->fm->validation($company_profile);
     $cp_id = $this->fm->validation($cp_id);
     $company_profile = mysqli_real_escape_string($this->db->link, $company_profile);
     $cp_id = mysqli_real_escape_string($this->db->link, $cp_id);
     $cp_id = (int)$cp_id;
     $cp_id = preg_replace('/\D/', '', $cp_id);

     if (empty($company_profile) || empty($cp_id)) {
      echo '<div class="alert alert-danger"> Field is Required!</div>';     
    } elseif(filter_var($cp_id, FILTER_VALIDATE_INT) == false){
      echo '<div class="alert alert-danger"> Invalid Id!</div>';
    }else{

     $sql = "UPDATE abouts SET company_profile = '$company_profile' WHERE id = '$cp_id'";
     $result = $this->db->update($sql);
     if ($result) {
         echo '<div class="alert alert-success"> Updated Successfully! </div>';
     } else{
        echo '<div class="alert alert-danger"> Not Updated!</div>'; 
     }
    }
    } catch (Exception $e) {
        
    }
   }


    public function aboutUsAddData($about_us,$about_id){
    try {
     $about_us    = $this->fm->validation($about_us);
     $about_id    = $this->fm->validation($about_id);
     $about_us    = mysqli_real_escape_string($this->db->link, $about_us);
     $about_id    = mysqli_real_escape_string($this->db->link, $about_id);
     $about_id = (int)$about_id;
     $about_id = preg_replace('/\D/', '', $about_id);

     if (empty($about_us) || empty($about_id)) {
      echo '<div class="alert alert-danger"> Field is Required!</div>';     
    } elseif(filter_var($about_id, FILTER_VALIDATE_INT) == false){
      echo '<div class="alert alert-danger"> Invalid Id!</div>';
    }else{

     $sql = "UPDATE abouts SET about_us = '$about_us' WHERE id = '$about_id'";
     $result = $this->db->update($sql);
     if ($result) {
         echo '<div class="alert alert-success"> Updated Successfully! </div>';
         echo '<script>setTimeout(function(){ location.reload(); }, 3000);</script>';
     } else{
        echo '<div class="alert alert-danger"> Not Updated!</div>'; 
     }
    }
    } catch (Exception $e) {
        
    }
   }

public function careerPageUpdateData($career,$id){

    try {
     $career = $this->fm->validation($career);
     $id     = $this->fm->validation($id);
     $career = mysqli_real_escape_string($this->db->link, $career);
     $id     = mysqli_real_escape_string($this->db->link, $id);
     $id     = (int)$id;
     $id     = preg_replace('/\D/', '', $id);

    if (empty($career) || empty($id)) {
      echo '<div class="alert alert-danger"> Field is Required!</div>';     
    } elseif(filter_var($id, FILTER_VALIDATE_INT) == false){
      echo '<div class="alert alert-danger"> Invalid Id!</div>';
    }else{

     $sql = "UPDATE abouts SET career = '$career' WHERE id = '$id'";
     $result = $this->db->update($sql);
     if ($result) {
         echo '<div class="alert alert-success"> Updated Successfully! </div>';
         echo '<script>setTimeout(function(){ location.reload(); }, 3000);</script>';
     } else{
        echo '<div class="alert alert-danger"> Not Updated!</div>'; 
     }
    }
    } catch (Exception $e) {
        
    }
   }

   public function getPageTitleByPageName($page_name=NULL) {
    try {
     $page_name = $this->fm->validation($page_name);
     $page_name = mysqli_real_escape_string($this->db->link, $page_name);
     $page_name = strtolower(str_replace("_","-",$page_name));
     if (!empty($page_name)) {
         $sql = "SELECT * FROM top_menu WHERE external_link = '$page_name'";
         $result = $this->db->select($sql);
         return $result;
     }
        
    } catch (Exception $e) {
        
    }
   }

public function pageTitleDataByPageName($id=NULL){
  try {

     $id = $this->fm->validation($id);
     $id = mysqli_real_escape_string($this->db->link, $id);
     $id = preg_replace('/\D/','', $id);
     $id = (int)$id;

     if (empty($id)) {
      echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
     } else {

      $sql = "SELECT * FROM top_menu WHERE  menu_id = '$id'";
      $result = $this->db->select($sql);
      if ($result) {
        while ($rows = $result->fetch_assoc()) {
                
         $menu_id    = $rows['menu_id'];
         $page_title = $rows['page_title'];

         echo '<form id="pagetitled_form" action="" method="post"><table width="100%" border="1"><tr style="text-align:center;"><td width="20%" style="background: #F9F9F9;"><h2> Page Title </h2></td><td width="60%"><input type="hidden" id="menut_id" value="'.$menu_id.'"/><input type="text" style="padding:30px;font-size:25px;" class="form-control" id="paged_title" name="paged_title" value="'.$page_title.'"/></td><td width="15%"><button type="submit" style="padding-top: 18px;padding-bottom: 18px;" class="btn btn-danger btn-block"> Update </button></td></tr></table></form>';
      }
    }
  }
    
  } catch (Exception $e) {
    
  }
 }

 public function pageTitleDataUpdateByPageName($id,$title){

    try {

     $id    = $this->fm->validation($id);   
     $title = $this->fm->validation($title);
     $id    = mysqli_real_escape_string($this->db->link, $id);
     $title = mysqli_real_escape_string($this->db->link, $title);
     $id    = (int)$id;
     $id    = preg_replace('/\D/', '', $id);

    if (empty($id) || empty($title)) {
      echo '<div class="alert alert-danger"> Field is Required!</div>';     
    } elseif(filter_var($id, FILTER_VALIDATE_INT) == false) {
      echo '<div class="alert alert-danger"> Invalid Id!</div>';
    }else{
     $sql = "UPDATE top_menu SET page_title = '$title' WHERE menu_id = '$id'";
     $result = $this->db->update($sql);
     if ($result) {
         echo '<div class="alert alert-success"> Updated Successfully! </div>';
         echo '<script> setTimeout(function(){
            location.reload();
         }, 3000); </script>';
     } else{
        echo '<div class="alert alert-danger"> Not Updated!</div>'; 
     }
    }  
    } catch (Exception $e) {
        
    }
 }
	
}