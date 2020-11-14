<?php
/**
 * Contactclass
 */
class Contactclass extends Mainclass{
	
	public function getContactMessage($name,$phone,$email,$subject,$message,$related_into) {

    	try {

        $name     = $this->fm->validation($name);
        $phone    = $this->fm->validation($phone);
        $email    = $this->fm->validation($email);
        $subject  = $this->fm->validation($subject);
        $message  = $this->fm->validation($message);
        $related_into  = $this->fm->validation($related_into);
        
        $name     = mysqli_real_escape_string($this->db->link, $name);
        $phone    = mysqli_real_escape_string($this->db->link, $phone);
        $email    = mysqli_real_escape_string($this->db->link, $email);
        $subject  = mysqli_real_escape_string($this->db->link, $subject);
        $message  = mysqli_real_escape_string($this->db->link, $message);
        $related_into  = mysqli_real_escape_string($this->db->link, $related_into);
        $email    = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (empty($name) || empty($phone) || empty($email) || empty($subject) || empty($message) || empty($related_into)) {
          $msg = '<div class="alert alert-danger" role="alert"> Field must not be Empty.</div>';
           return $msg;
        } elseif (strlen($name) > 50) {
          $msg = '<div class="alert alert-danger" role="alert"> Name Characters length is too long.</div>';
          return $msg;
        } elseif ((strlen($phone) > 20) && (strlen($phone) < 11)) {
          $msg = '<div class="alert alert-danger" role="alert"> Phone Number Minimum 11 and Maximum 16 Digit.</div>';
          return $msg;
        } elseif (strlen($email) > 50) {
          $msg = '<div class="alert alert-danger" role="alert"> Email Characters length is too long.</div>';
          return $msg;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $msg = '<div class="alert alert-danger" role="alert"> Invalid Email. </div>';
           return $msg;
        } else{
          $sql = "INSERT INTO contacts(name,phone,email,subject,message,related_into) VALUES('$name','$phone','$email','$subject','$message','$related_into')";
          $insert = $this->db->insert($sql);
          if ($insert) {
            $msg = '<div class="alert alert-success"> Message Send Successfully! </div>';
            return $msg;
          }else{
            $msg = '<div class="alert alert-danger" role="alert"> Something went wrong. </div>';
           return $msg;
          }
        }
        } catch (Exception $e) {
          $msg = '<div class="alert alert-danger" role="alert"> Something went wrong. </div>';
           return $msg; 
        }
	}

	public function getContactMessageshow() {

		$sql = "SELECT * FROM contacts ORDER BY id DESC";
		$result = $this->db->select($sql);
		return $result;
	}
  public function contactViewMessageById($id=NULL){
   try {
     $id = $this->fm->validation($id);
     $id = mysqli_real_escape_string($this->db->link, $id);
     $id = preg_replace('/\D/', '', $id);
     $id = (int)$id;
     if (empty($id)) {
       echo '<div class="alert alert-danger"> ID is Required! </div>';
     } else{
       $sql = "SELECT * FROM contacts WHERE id = '$id'";
       $result = $this->db->select($sql);
       if ($result) {
        $output = '<table class="table table-bordered"><tbody>';
         while ($rows = $result->fetch_assoc()) {
           $id = $rows['id'];
           $name = $rows['name'];
           $phone = $rows['phone'];
           $email = $rows['email'];
           $subject = $rows['subject'];
           $message = $rows['message'];
           $related_into = $rows['related_into'];
           $create_date = $rows['create_date'];

           $output .= '<tr><th>Name: </th><td>'.$name.'</td></tr><tr><th>Phone: </th><td>'.$phone.'</td></tr><tr><th>Email</th><td>'.$email.'</td></tr><tr><th>Subject: </th><td>'.$subject.'</td></tr><tr><th>Related Info: </th><td>'.$related_into.'</td></tr><tr><th>Message: </th><td>'.$message.'</td></tr><tr><th>Date:</th><td>'.$create_date.'</td></tr>';

         }
         $output .= '</tbody></table>';
         echo $output;
       }
     }
   } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong! </div>';
   }
  }

  public function addSubscriber($email) {

      try {

        $email    = $this->fm->validation($email);
        $email    = mysqli_real_escape_string($this->db->link, $email);
        $email    = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (empty($email)) {
          $msg = '<div class="alert alert-danger" role="alert"> Field must not be Empty.</div>';
           return $msg;
        } elseif (strlen($email) > 50) {
          $msg = '<div class="alert alert-danger" role="alert"> Email Characters length is too long.</div>';
          return $msg;
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $msg = '<div class="alert alert-danger" role="alert"> Invalid Email. </div>';
           return $msg;
        } else{
          
          $sqlck = "SELECT * FROM subscriber WHERE email = '$email'";
          $result = $this->db->select($sqlck);
          if ($result != false) {
            $msg = '<div class="alert alert-danger" role="alert">'.$email.' Already Exists.</div>';
            return $msg;
          } else{
            $sql = "INSERT INTO subscriber(email) VALUES('$email')";
            $insert = $this->db->insert($sql);
            if ($insert) {
              $msg = '<div class="alert alert-success"> Subscribe Successfully! </div>';
              return $msg;
            } else{
              $msg = '<div class="alert alert-danger" role="alert"> Something went wrong. </div>';
             return $msg;
            }
            }
          
         }
        } catch (Exception $e) {
          $msg = '<div class="alert alert-danger" role="alert"> Something went wrong. </div>';
           return $msg; 
        }
  }

  public function getSubscriber() {
    
    try {

    $sql = "SELECT * FROM subscriber ORDER BY id DESC";
    $result = $this->db->select($sql);
    return $result;
      
    } catch (Exception $e) {
      $msg = '<div class="alert alert-danger" role="alert"> Something went wrong. </div>';
      return $msg;
    }
  }

  public function sendResumetoSite($first_name,$last_name,$re_email,$phone_num,$re_address,$rem_file) {

    try {
        
        $first_name = $this->fm->validation($first_name);
        $last_name  = $this->fm->validation($last_name);
        $re_email   = $this->fm->validation($re_email);
        $phone_num  = $this->fm->validation($phone_num);
        $re_address = $this->fm->validation($re_address);

        $first_name = mysqli_real_escape_string($this->db->link, $first_name);
        $last_name  = mysqli_real_escape_string($this->db->link, $last_name);
        $re_email   = mysqli_real_escape_string($this->db->link, $re_email);
        $phone_num  = mysqli_real_escape_string($this->db->link, $phone_num);
        $re_address = mysqli_real_escape_string($this->db->link, $re_address);
        $re_email   = filter_var($re_email, FILTER_SANITIZE_EMAIL);

      if (empty($first_name) || empty($first_name) || empty($first_name) || empty($first_name) || empty($first_name)) {

          echo '<div class="alert alert-danger"> Field Must not be Empty!</div>';

        } elseif((strlen($first_name) > 50) || (strlen($last_name) > 50)){
        echo '<div class="alert alert-danger"> First and Last Name Should be Lessthan 50 Characters</div>';
        } elseif((strlen($re_email) > 50) || (strlen($re_email) < 5)){
        echo '<div class="alert alert-danger"> Email must be between 5 - 50 Characters. </div>';
        } elseif((strlen($phone_num) > 16) || (strlen($phone_num) < 9)){
        echo '<div class="alert alert-danger"> Phone Number must be between 9 - 16 Characters. </div>';
        } elseif(filter_var($re_email, FILTER_VALIDATE_EMAIL) == false){
         echo '<div class="alert alert-danger"> Invalid Email Address. </div>';
        }  elseif (!empty($rem_file['name'])) {
        
        $logo_name = $rem_file['name'];
        $logo_tem  = $rem_file['tmp_name'];
        $logo_size = $rem_file['size'];
        $logo_type = $rem_file['type'];

        $permitted = array('pdf', 'doc', 'docx', 'txt','ppt','pptx');

        $image_ext = explode(".", $logo_name);

        $file_extension = strtolower(end($image_ext));

        if ($logo_size > 5242880) {

        echo '<div class="alert alert-danger" role="alert">  Sorry, your file is too large. </div>';

         } elseif (in_array($file_extension, $permitted) === false) {
             
        echo '<div class="alert alert-danger" role="alert"> You can uploads only:-'.implode(', ', $permitted).'</div>';

         } else {

            $name = $first_name." ".$last_name;
              
            $file_name = strtolower(preg_replace('/\s+/', '_', $logo_name));
            $file_name   = mysqli_real_escape_string($this->db->link, $file_name);

            $sql = "INSERT INTO resume(resume_name,resume_email,resume_phone,resume_address,resume_file) VALUES('$name','$re_email','$phone_num','$re_address','$file_name')";
            $insert = $this->db->insert($sql);
            if ($insert) {

                $last_id = mysqli_insert_id($this->db->link);

                $upload_path = "../resume/".$last_id."/";
          
              if (!is_dir($upload_path)) {
                mkdir($upload_path, 0777, true);
              }
              
                $image_path = $upload_path.$file_name;
            
                if (move_uploaded_file($logo_tem, $image_path)) {
                   echo '<div class="alert alert-success"> Resume Sent Successfully! <span style="color:white;font-size:18px;font-weight: bold;"> File Name is: '.$file_name.'</span> </div>';
                 } 
              
            } else{
              echo '<div class="alert alert-danger"> Resume can not Sent! </div>';
            }
         }
        } else{
          echo '<div class="alert alert-danger"> File Should not be Empty! </div>';
        }
          
        } catch (Exception $e) {
          echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }

public function getResumeData(){
 try {
   $sql = "SELECT * FROM resume ORDER BY resume_id DESC";
   $result = $this->db->select($sql);
   return $result;
 } catch (Exception $e) {
   
 }
}

public function sendResumetoDeleteById($id=NULL) {

    try {
        $id = $this->fm->validation($id);
        $id = mysqli_real_escape_string($this->db->link, $id);
        $id = preg_replace('/\D/','', $id);
        $id = (int)$id;

        if (empty($id)) {
          echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
        } elseif (filter_var($id, FILTER_VALIDATE_INT) == false) {
          echo '<div class="alert alert-danger"> Invalid ID! </div>';
        } else { 

        $filepath = "../../resume/".$id;

        if (glob($filepath."/*")) {

         array_map('unlink', glob($filepath."/*"));

         if (is_dir($filepath)) {
           rmdir($filepath);
         }
        }

        $sql = "DELETE FROM resume WHERE  resume_id = '$id'";
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
	
}