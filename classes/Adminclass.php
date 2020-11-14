<?php
/**
 * User for admin controller
 */
class Adminclass extends Mainclass
{

// Admin Login Script......
   public function admin_loginchak($admin_email,$admin_pass,$admin_type){

        $admin_email = $this->fm->validation($admin_email);
        $admin_pass  = $this->fm->validation($admin_pass);
        $admin_type  = $this->fm->validation($admin_type);
        
        $admin_email = mysqli_real_escape_string($this->db->link, $admin_email);
        $admin_pass  = mysqli_real_escape_string($this->db->link, $admin_pass);
        $admin_type  = mysqli_real_escape_string($this->db->link, $admin_type);
        $admin_email = filter_var($admin_email, FILTER_SANITIZE_EMAIL);

        if (empty($admin_email) || empty($admin_pass) || empty($admin_type)) {
        	$msg = '<div class="alert alert-warning" role="alert">
                  Field Must not be Empty!
                 </div>';
        	return $msg;

        } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
        	$msg = '<div class="alert alert-danger" role="alert">
                  Invalid Email.
                 </div>';
                 return $msg;
        } else{
           $admin_pass = md5($admin_pass);
           $query = "SELECT * FROM tbl_admin WHERE email = '$admin_email' AND password = '$admin_pass' AND type = 2";
           $result = $this->db->select($query);
           if ($result != false) {
           	  $value = $result->fetch_assoc();
           	  Session::set("login", true);
           	  Session::set("id", $value['id']);
              Session::set("name", $value['name']);
           	  Session::set("admin_email", $value['email']);
              Session::set("admin_type", $value['type']);
              Session::set("admin_ck", "emain_admin");

              $id = $value['id'];
              $dt = date("d-m-Y-h:i:sa");
              $access_token_insert = md5($admin_email.$id.$dt);
              Session::set("access_token", $access_token_insert);
             $sqlAccessToken = "INSERT INTO access_token (adminId,TOKEN) VALUES('$id','$access_token_insert')";
             $this->db->insert($sqlAccessToken);
           	  header("Location:index.php");
           }else{
           	 $msg = '<div class="alert alert-info" role="alert">
                  Wrong Information Included!
                 </div>';
        	return $msg;
           }
        }
	}

  public function admin_subcheck($admin_email,$admin_pass,$admin_type) {

        $admin_email = $this->fm->validation($admin_email);
        $admin_pass  = $this->fm->validation($admin_pass);
        $admin_type  = $this->fm->validation($admin_type);

        $admin_email = mysqli_real_escape_string($this->db->link, $admin_email);
        $admin_pass  = mysqli_real_escape_string($this->db->link, $admin_pass);
        $admin_type  = mysqli_real_escape_string($this->db->link, $admin_type);
        $admin_email = filter_var($admin_email, FILTER_SANITIZE_EMAIL);

        if (empty($admin_email) || empty($admin_pass) || empty($admin_type)) {
          $msg = '<div class="alert alert-warning" role="alert">
                  Field Must not be Empty!
                 </div>';
          return $msg;

        } elseif (!filter_var($admin_email, FILTER_VALIDATE_EMAIL)) {
          $msg = '<div class="alert alert-danger" role="alert">
                  Invalid Email.
                 </div>';
                 return $msg;
        } else{
           $admin_pass = md5($admin_pass);
           $query = "SELECT * FROM tbl_admin WHERE email = '$admin_email' AND password = '$admin_pass' AND type = 1";
           $result = $this->db->select($query);
           if ($result != false) {
              $value = $result->fetch_assoc();
              Session::set("login", true);
              Session::set("id", $value['id']);
              Session::set("name", $value['name']);
              Session::set("admin_email", $value['email']);
              Session::set("admin_type", $value['type']);
              Session::set("admin_ck", "sub_admin");

              $id = $value['id'];
              $dt = date("d-m-Y-h:i:sa");
              $access_token_insert = md5($admin_email.$id.$dt);
              Session::set("access_token", $access_token_insert);
             $sqlAccessToken = "INSERT INTO access_token (adminId,TOKEN) VALUES('$id','$access_token_insert')";
             $this->db->insert($sqlAccessToken);
              header("Location:event.php");
           }else{
             $msg = '<div class="alert alert-info" role="alert">
                  Wrong Information Included!
                 </div>';
          return $msg;
           }
        }

  }

 
    // Access Token Check Login ...
    public function checkAdminLogin($access_token){
        $sql = "SELECT * FROM access_token WHERE TOKEN = '$access_token'";
        $result = $this->db->select($sql);
        return $result;
    }
	
	public function getAllPerticpents($event_id){
	    $sql = "SELECT * FROM `participants` WHERE `event_id`=$event_id";
        $result = $this->db->select($sql);
        return $result;
	
	}

    // Get Super Admin Data Show.....
    public function superAdminDataGet(){
      $sql = "SELECT id,name,email,type,create_date FROM tbl_admin ORDER BY id DESC";
      $result = $this->db->select($sql);
      return $result;
    } 
    // Add Supper Admin Data ......
    public function addAdminData($name,$email,$password,$type) {
         
         $name     = $this->fm->validation($name);
         $email    = $this->fm->validation($email);
         $password = $this->fm->validation($password);
         $type     = $this->fm->validation($type);

         $name     = mysqli_real_escape_string($this->db->link, $name);
         $email    = mysqli_real_escape_string($this->db->link, $email);
         $password = mysqli_real_escape_string($this->db->link, $password);
         $type     = mysqli_real_escape_string($this->db->link, $type);

         $email = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (empty($name) || empty($email) || empty($password) || empty($type)) {
         echo '<div class="alert alert-warning" role="alert">
                  Name,Email,Type,Password Field Must not be Empty!
                 </div>';

        } elseif ((strlen($password) < 6) || (strlen($password) > 32)) {
           echo '<div class="alert alert-danger" role="alert">
                  You should choose a strong password, between 6 to 32 characters 
                 </div>';
        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          echo '<div class="alert alert-danger" role="alert">
                  Invalid Email.
                 </div>';
        } else{
            
            $checksql = "SELECT * FROM tbl_admin WHERE email = '$email'";
            $emailCheck = $this->db->select($checksql);
            if ($emailCheck != false) {
               echo '<div class="alert alert-danger" role="alert">
                  '.$email.' Already Exists.
                 </div>';
            } else{
            $password = md5($password);
            $sql = "INSERT INTO tbl_admin (name,email,password,type) VALUES ('$name','$email','$password','$type')";
            $result = $this->db->insert($sql);
            if($result){
                echo '<div class="alert alert-success" role="alert">
                  Admin Add Successfully!
                 </div>';
            } else{
               echo '<div class="alert alert-danger" role="alert">
                  Something Went Wrong!
                 </div>';
            }
          }
        }
    }
    // Supper Admin Delete...
    public function supperAdminDeleted($adId){
      $sql = "DELETE FROM tbl_admin WHERE id = '$adId'";
      $del = $this->db->delete($sql);
      if($del){
        $msg = '<div class="alert alert-success" role="alert">
              Admin Deleted Successfully!
             </div>';
             return $msg;
        }else{
           $msg = '<div class="alert alert-danger" role="alert">
              Admin not Deleted!
             </div>';
             return $msg; 
        }
    }
    // Edit for admin Id by Data show...
    public function adminDataShowById($adminId){
      $sql = "SELECT * FROM tbl_admin WHERE id = '$adminId'";
      $result = $this->db->select($sql);
      return $result;
    }

    // Admin By Id Data Update...
    public function updateAdminByIdData($data){

         $admin_Id  = $data['admin_Id'];
         $name      = $data['admin_name'];
         $email     = $data['admin_email'];
         $password  = $data['admin_new_password'];
         $cpassword = $data['admin_confirm_password'];
         
         $admin_Id  = $this->fm->validation($admin_Id);
         $name      = $this->fm->validation($name);
         $email     = $this->fm->validation($email);
         $password  = $this->fm->validation($password);
         
         $admin_Id  = mysqli_real_escape_string($this->db->link, $admin_Id);
         $name      = mysqli_real_escape_string($this->db->link, $name);
         $email     = mysqli_real_escape_string($this->db->link, $email);
         $password  = mysqli_real_escape_string($this->db->link, $password);
         $cpassword = mysqli_real_escape_string($this->db->link, $cpassword);
         $email     = filter_var($email, FILTER_SANITIZE_EMAIL);

        if (empty($name) || empty($email)) {
          $msg = '<div class="alert alert-warning" role="alert">
                  Name, Email Field Must not be Empty!
                 </div>';
          return $msg;

        } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          $msg = '<div class="alert alert-danger" role="alert">
                  Invalid Email.
                 </div>';
                 return $msg;
        } else{
            
        if(!empty($password)){
          if ($password != $cpassword) {
            $msg = '<div class="alert alert-warning" role="alert">
                  Password and Confirm Password Not Match!
                 </div>';
          return $msg;
          }else{
            $password = md5($password);
            $upd = "UPDATE tbl_admin SET name = '$name', email = '$email', password = '$password' WHERE id = '$admin_Id'";
          } } else{
            $upd = "UPDATE tbl_admin SET name = '$name', email = '$email' WHERE id = '$admin_Id'";
          }

            $result = $this->db->update($upd);
            if($result){
                $msg = '<div class="alert alert-success" role="alert">
                  Admin Updated Successfully!
                 </div>';
                 return $msg;
            } else{
               $msg = '<div class="alert alert-danger" role="alert">
                  Not Updated! 
                 </div>';
                 return $msg; 
            }
        }
    }


    
     
     //User By Id Edit code here....
     public function getUserEditById($data,$file,$id){
         $name     = $data['USER_FULL_NAME'];
         $email    = $data['USER_EMAIL'];
         $phone    = $data['USER_MOBILE'];
         $h_add    = $data['USER_HOME_ADDRESS'];
         $o_add    = $data['USER_OFFICE_ADDRESS'];
         $point    = $data['USER_POINT'];
         $password = $data['USER_PASSWORD'];
         
         $name     = $this->fm->validation($name);
         $email    = $this->fm->validation($email);
         $phone    = $this->fm->validation($phone);
         $h_add    = $this->fm->validation($h_add);
         $o_add    = $this->fm->validation($o_add);
         $point    = $this->fm->validation($point);
         $password = $this->fm->validation($password);

         $name     = mysqli_real_escape_string($this->db->link, $name);
         $email    = mysqli_real_escape_string($this->db->link, $email);
         $phone    = mysqli_real_escape_string($this->db->link, $phone);
         $h_add    = mysqli_real_escape_string($this->db->link, $h_add);
         $o_add    = mysqli_real_escape_string($this->db->link, $o_add);
         $point    = mysqli_real_escape_string($this->db->link, $point);
         $password = mysqli_real_escape_string($this->db->link, $password);
         $email = filter_var($email, FILTER_SANITIZE_EMAIL);
         
         
         $permitted    = array('png', 'jpg', 'jpeg', 'gif');
         $file_name    = $file['USER_PROFILE_IMAGE']['name'];
         $file_size    = $file['USER_PROFILE_IMAGE']['size'];
         $file_temp    = $file['USER_PROFILE_IMAGE']['tmp_name'];
         $div          = explode('.', $file_name);
         $image_ext    = strtolower(end($div));

        if (empty($name) || empty($email) || empty($phone) || empty($password)) {
        	$msg = '<div class="alert alert-warning" role="alert">
                  Name,Email,Phone,password Field Must not be Empty!
                 </div>';
        	return $msg;

        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        	$msg = '<div class="alert alert-danger" role="alert">
                  Invalid Email.
                 </div>';
                 return $msg;
        } else{
            /*$imagecheck = "images/".$id."/".$file_name;
            
            $checksql = "SELECT * FROM USER WHERE USER_FULL_NAME = '$name' AND USER_EMAIL = '$email' AND USER_MOBILE = '$phone' AND USER_PASSWORD = '$password' AND USER_HOME_ADDRESS = '$h_add' AND USER_OFFICE_ADDRESS = '$o_add' AND USER_POINT = '$point' AND USER_PROFILE_IMAGE = '$imagecheck' AND USER_ID = '$id'";
            $emailCheck = $this->db->select($checksql);
            if ($emailCheck == true){
               $msg = '<div class="alert alert-danger" role="alert">
                  User Data Does Not Change!
                 </div>';
                 return $msg; 
            } else{*/
                
                
            if(!empty($file_name)){
            
             if ($file_size > 500000) {
             
	      $msg = '<div class="alert alert-danger" role="alert"> 
	             Sorry, your file is too large.
	      </div>';
	      return $msg;
            
	      
         }elseif (in_array($image_ext, $permitted) === false) {
             
	      $msg = '<div class="alert alert-danger" role="alert">
	      You can uploads only:-'.implode(', ', $permitted).'</div>';
	      return $msg;
            
	      
         } else{
             
                /////////////
        $unique_image = $div[0].'.'.$image_ext;
        
        $upload_path = "../user_app/images/".$id."/";
        
        if (!is_dir($upload_path)) {    // Direcatory checking 
        mkdir($upload_path, 0777, true);
        }
        
         if (glob($upload_path."*")) {
             
             array_map('unlink', glob($upload_path."*"));
             
          }
          
          $image_path = $upload_path.$unique_image;
          
             /////////
            
            move_uploaded_file($file_temp, $image_path);
            
            $sqlup = "UPDATE USER SET 
                        USER_FULL_NAME      = '$name',
                        USER_EMAIL          = '$email',
                        USER_MOBILE         = '$phone',
                        USER_PASSWORD       = '$password',
                        USER_HOME_ADDRESS   = '$h_add',
                        USER_OFFICE_ADDRESS = '$o_add',
                        USER_POINT          = '$point',
                        USER_PROFILE_IMAGE = '$image_path'
                        WHERE USER_ID       = '$id'";
            $result = $this->db->update($sqlup);
            if($result){
                $msg = '<div class="alert alert-success" role="alert">
                  User Edit Successfully!
                 </div>';
                 return $msg;
            } else{
               $msg = '<div class="alert alert-danger" role="alert">
                  Something Went Wrong!
                 </div>';
                 return $msg; 
            }
            
            } 
                
            } else{
                
                $sqlup = "UPDATE USER SET 
                        USER_FULL_NAME      = '$name',
                        USER_EMAIL          = '$email',
                        USER_MOBILE         = '$phone',
                        USER_PASSWORD       = '$password',
                        USER_HOME_ADDRESS   = '$h_add',
                        USER_OFFICE_ADDRESS = '$o_add',
                        USER_POINT          = '$point'
                        WHERE USER_ID       = '$id'";
            $result = $this->db->update($sqlup);
            if($result){
                $msg = '<div class="alert alert-success" role="alert">
                  User Edit Successfully!
                 </div>';
                 return $msg;
            } else{
               $msg = '<div class="alert alert-danger" role="alert">
                  Something Went Wrong!
                 </div>';
                 return $msg; 
            }
            }
            
          /*}*/
        } 
     }
     

  
  // Get Contact us User Message List
   public function getContactUserMessageList(){
    $sql = "SELECT CONTACTS.*, USER.USER_FULL_NAME, USER.USER_EMAIL, USER.USER_MOBILE  FROM CONTACTS JOIN USER ON USER.USER_ID = CONTACTS.USER_ID WHERE USER.USER_ID = CONTACTS.USER_ID  ORDER BY CONTACTS.C_ID DESC";
    $result = $this->db->select($sql);
    return $result;
  }
  
  public function getUserMessageViewId($id){
    $sql = "SELECT CONTACTS.*, USER.USER_FULL_NAME, USER.USER_EMAIL, USER.USER_MOBILE  FROM CONTACTS JOIN USER ON USER.USER_ID = CONTACTS.USER_ID WHERE USER.USER_ID = CONTACTS.USER_ID  AND CONTACTS.C_ID = '$id'";
    $result = $this->db->select($sql);
    return $result;
  }
    /* User Message Seen ok */
  public function getUserMessageViewokId($id){
    $sql = "UPDATE CONTACTS SET STATUS = '0' WHERE user_id = '$id'";
    $result = $this->db->update($sql);
    return $result;
  }
  
}
