<?php
/**
 * NewsEventsClass
 */
class NewsEventsClass extends Mainclass
{
	
	public function addNewsEvents($title,$date,$img,$des) {

       try {
        
        $title = $this->fm->validation($title);
        $date  = $this->fm->validation($date);
		    $des   = $this->fm->validation($des);
        $title = mysqli_real_escape_string($this->db->link, $title);
		    $date  = mysqli_real_escape_string($this->db->link, $date);
        $des   = mysqli_real_escape_string($this->db->link, $des);

        if (empty($date) || empty($title) || empty($img['name'])) {
         echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
        } else {

        $logo_name = $img['name'];
        $logo_tem  = $img['tmp_name'];
        $logo_size = $img['size'];
        $logo_type = $img['type'];

        $permitted = array('png', 'jpg', 'jpeg', 'gif');

        $image_ext = explode(".", $logo_name);

		   $file_extension = strtolower(end($image_ext));

		   $imagedata = getimagesize($logo_tem);
		   $width     = $imagedata[0];
		   $height    = $imagedata[1];

        if ($logo_size > 5242880) {

	      echo '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';

         } elseif (in_array($file_extension, $permitted) === false) {
             
	      echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

        } elseif(($width < 365 || $width > 375 ) || ($height < 195 || $height > 205)){
          echo '<div class="alert alert-danger"> Image size should be 370 * 200 PX </div>';
        } else {
              
            $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
            $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

            $sql = "INSERT INTO news_events(news_events_title,news_events_date,news_events_file,news_events_des) VALUES('$title','$date','$file_name','$des')";
            $insert = $this->db->insert($sql);
            if ($insert) {

                $last_id = mysqli_insert_id($this->db->link);

                $upload_path = "../../news_events/".$last_id."/";
          
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
 	
  
	public function getNewsEventsData(){

	   try {
	   	$sql = "SELECT * FROM news_events WHERE news_events_status = 1 ORDER BY news_events_id DESC";
	    $result = $this->db->select($sql);
	    return $result;
	   } catch (Exception $e) {
	   	echo '<div class="alert alert-danger"> Something went wrong. </div>';
	   }
	 }

	public function getNewsEventsDataHomePage(){

	   try {
	   	$sql = "SELECT * FROM news_events WHERE news_events_status = 1 ORDER BY news_events_id DESC LIMIT 20";
	    $result = $this->db->select($sql);
	    return $result;
	   } catch (Exception $e) {
	   	echo '<div class="alert alert-danger"> Something went wrong. </div>';
	   }
	 }

	public function getNewsEventsDataDetailsSided(){

	   try {
	   	$sql = "SELECT * FROM news_events WHERE news_events_status = 1 ORDER BY news_events_id DESC LIMIT 10";
	    $result = $this->db->select($sql);
	    return $result;
	   } catch (Exception $e) {
	   	echo '<div class="alert alert-danger"> Something went wrong. </div>';
	   }
	 }

   public function newsEventsDetailsid($id=NULL){
    try {

        $id = $this->fm->validation($id);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $id = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
        $id = preg_replace('/\D/', '', $id);
        $id = (int)$id;

        if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } elseif(filter_var($id, FILTER_VALIDATE_INT) == false){
          echo '<div class="alert alert-danger"> Invalid Id!</div>';
        } else {

        $sql = "SELECT * FROM news_events WHERE news_events_id = '$id'";
        $result = $this->db->select($sql);

        if ($result) {
         $output = '<table class="table table-bordered table-striped"><tbody>';
         while ($rows = $result->fetch_assoc()) {
                
          $id      = $rows['news_events_id'];
          $title   = $rows['news_events_title'];
          $date    = $rows['news_events_date'];
          $details = htmlspecialchars_decode(stripslashes($rows['news_events_des']));

          $logo  = $rows['news_events_file'];
          $image = "../../news_events/".$id."/".$logo;

          if (file_exists($image)) {
           $image = "../news_events/".$id."/".$logo;
	      }else{
	        $image = "../img/logo.png";
	      }

          
                $output .= '<tr style="font-weight:bold;font-size:20px;">
                      <th width="20%"> Title: </th>
                       <td><b>'.$title.'</b></td>
                     </tr><tr style="font-weight:bold;font-size:20px;"><th width="20%"> Image: </th>
                      <td><figure class="image-box"><img title="'.$title.'" src="'.$image.'" style="max-width:90%;height:auto;"></figure></td>
                   </tr>
                   <tr style="font-weight:bold;font-size:20px;">
                       <th width="20%"> Date: </th>
                       <td><b>'.$date.'</b></td>
                   </tr>
                   <tr>
                       <th style="font-weight:bold;font-size:20px;" width="20%"> Details: </th>
                       <td>'.$details.'</td>
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

   public function newsEventsDelid($id = NULL) {
    
    try {
        $id = $this->fm->validation($id);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $id = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
        $id = preg_replace('/\D/', '', $id);
        $id = (int)$id;

        if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } elseif(filter_var($id, FILTER_VALIDATE_INT) == false){
          echo '<div class="alert alert-danger"> Invalid Id!</div>';
        } else { 

        $filepath = "../../news_events/".$id;

        if (glob($filepath."/*")) {

         array_map('unlink', glob($filepath."/*"));

         if (is_dir($filepath)) {
           rmdir($filepath);
         }
        }

        $sql = "DELETE FROM news_events WHERE news_events_id = '$id'";
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

 public function getNewsEventsUpdate($id=NULL){
    try {

        $id = $this->fm->validation($id);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $id = preg_replace('/[^-a-zA-Z0-9_]/','', $id);
        $id = preg_replace('/\D/', '', $id);
        $id = (int)$id;

        if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } else {
        $sql = "SELECT * FROM news_events WHERE news_events_id = '$id'";
        $result = $this->db->select($sql);
        return $result;
       }
      
    } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
   }

  public function newsEventsUpdateData($id,$title,$date,$details,$file) {

       try {

        $id      = $this->fm->validation($id);
        $title   = $this->fm->validation($title);
        $date    = $this->fm->validation($date);
        $details = $this->fm->validation($details);
        $id      = mysqli_real_escape_string($this->db->link, $id);
        $title   = mysqli_real_escape_string($this->db->link, $title);
        $date    = mysqli_real_escape_string($this->db->link, $date);
        $details = mysqli_real_escape_string($this->db->link, $details);

       if (!empty($file['name'])) {

        $logo_name = $file['name'];
        $logo_tem  = $file['tmp_name'];
        $logo_size = $file['size'];
        $logo_type = $file['type'];

        $permitted = array('png', 'jpg', 'jpeg', 'gif');

        $image_ext = explode(".", $logo_name);

        $file_extension = strtolower(end($image_ext));

        $imagedata = getimagesize($logo_tem);
        $width  = $imagedata[0];
        $height = $imagedata[1];

        if (empty($title) || empty($date)) {
          $msg = '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
          return $msg;
        } elseif ($logo_size > 5242880) {

        $msg = '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';
        return $msg;
        } elseif (in_array($file_extension, $permitted) === false) {
             
        $msg = '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';
         return $msg;
        } elseif(($width < 365 || $width > 375) || ($height < 195 || $height > 205)){
        $msg = '<div class="alert alert-danger" role="alert">  Image size should be 370 * 200 px </div>';
        return $msg;
        } else {

          $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
          $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

          $filepath = "../news_events/".$id;

          if (glob($filepath."/*")) {
           array_map('unlink', glob($filepath."/*"));

           if (is_dir($filepath)) {
            rmdir($filepath);
           }
          }

           $upload_path = '../news_events/'.$id.'/';             
          
           if (!is_dir($upload_path)) {
              mkdir($upload_path, 0777, true);
            }
              
           $image_path = $upload_path.$file_name;

           if (move_uploaded_file($logo_tem, $image_path)) {

          $sqlup = "UPDATE news_events SET 
                               news_events_title = '$title',
                               news_events_date  = '$date',
                               news_events_file  = '$file_name',
                               news_events_des   = '$details'
                               WHERE news_events_id = '$id'";
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

          $sql = "UPDATE news_events SET 
                   news_events_title = '$title',
                   news_events_date  = '$date',
                   news_events_des   = '$details'
                   WHERE news_events_id = '$id'";
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

// News - Events Pagination ..

    public function getNewsEventsDataLimit($start_from,$per_page){

     try {
      $start_from = $this->fm->validation($start_from);
      $per_page   = $this->fm->validation($per_page);
      $start_from = mysqli_real_escape_string($this->db->link, $start_from);
      $per_page   = mysqli_real_escape_string($this->db->link, $per_page);
      $start_from = preg_replace('/\D/', '', $start_from);
      $per_page   = preg_replace('/\D/', '', $per_page);
      $start_from = (int)$start_from;
      $per_page   = (int)$per_page;

      $sql = "SELECT * FROM news_events WHERE news_events_status = 1 ORDER BY news_events_id DESC LIMIT $start_from, $per_page";
      $result = $this->db->select($sql);
      return $result;
     } catch (Exception $e) {
      $msg = '<div class="alert alert-danger"> Something went wrong. </div>';
      return $msg;
     }
   }

 public function newsEventsPaginations($per_page) {

     try {
      $per_page = $this->fm->validation($per_page);
      $per_page = mysqli_real_escape_string($this->db->link, $per_page);
      $per_page = preg_replace('/\D/', '', $per_page);
      $per_page = (int)$per_page;

      $sql = "SELECT * FROM news_events WHERE news_events_status = 1";
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