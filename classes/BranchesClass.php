<?php
/**
 * BranchesClass Class
 */
class BranchesClass extends Mainclass
{
	
 public function getBranchesClass() {

   try {
   	$sql = "SELECT * FROM branches ORDER BY branches_id ASC";
    $result = $this->db->select($sql);
    return $result;
   } catch (Exception $e) {
   	
   }
 }

  public function getDivisionByBranches($division=NULL) {

   try {
    $cond = '';
    if ($division != 'all') {
      $cond = "WHERE division = '$division'";
    }

    $sql = "SELECT * FROM branches ".$cond." ORDER BY branches_id ASC";
    $result = $this->db->select($sql);
    return $result;
   } catch (Exception $e) {
    
   }
 }

 public function getBranchesDivision(){
  try {
    $result = mysqli_query($this->db->link, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_NAME = 'branches' AND COLUMN_NAME = 'division'");
    $row = $result->fetch_array();
    $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));
    
    return $enumList;   
   
    
  } catch (Exception $e) {
    
  }
 }

public function addBranchesData($branches_name,$branches_address,$branches_phone,$branches_email,$division) {

  try {

        $branches_name    = $this->fm->validation($branches_name);
        $branches_address = $this->fm->validation($branches_address);
        $branches_phone   = $this->fm->validation($branches_phone);
        $branches_email   = $this->fm->validation($branches_email);
        $division         = $this->fm->validation($division);
            
        $branches_name = mysqli_real_escape_string($this->db->link, $branches_name);
        $branches_address = mysqli_real_escape_string($this->db->link, $branches_address);
        $branches_phone   = mysqli_real_escape_string($this->db->link, $branches_phone);
        $branches_email   = mysqli_real_escape_string($this->db->link, $branches_email);
        $division  = mysqli_real_escape_string($this->db->link, $division);      

        if (empty($branches_name) || empty($branches_address)) {
          echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
        } else {

            $sqlck = "SELECT * FROM branches WHERE branches_name = '$branches_name'";
            $resultck = $this->db->select($sqlck);
            if ($resultck != false) {
              echo '<div class="alert alert-danger">This: <strong>'.$branches_name.'</strong> Branches Name Already Exists!</div>';
            } else {

            $sql = "INSERT INTO branches(branches_name,branches_address,branches_phone,branches_email,division) VALUES('$branches_name','$branches_address','$branches_phone','$branches_email','$division')";
            $insert = $this->db->insert($sql);
            if ($insert) { 

              echo '<div class="alert alert-success"> Branches Added Successfully! </div>';
              echo '<script>setTimeout(function(){ location.reload();}, 3000);</script>';
            } else{
              echo '<div class="alert alert-danger"> Branches not Added! </div>';
            }
            }
         }
        	
        } catch (Exception $e) {
        	echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }

 

public function editBranchesById($branches_id=NULL) {

  try {

     $branches_id = $this->fm->validation($branches_id);
     $branches_id = mysqli_real_escape_string($this->db->link, $branches_id);
     $branches_id = preg_replace('/\D/','', $branches_id);
     $branches_id = (int)$branches_id;

     if (empty($branches_id)) {
      echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
     } else {

      $sql = "SELECT * FROM branches WHERE branches_id = '$branches_id'";
	    $result = $this->db->select($sql);
	    if ($result) {
	    	while ($rows = $result->fetch_assoc()) {
                
         $branches_id     = $rows['branches_id'];
	    	 $branches_name   = $rows['branches_name'];          
	    	 $branches_address= $rows['branches_address'];
         $branches_phone  = $rows['branches_phone'];
         $branches_email  = $rows['branches_email'];
         $division        = $rows['division'];

    $column_name = 'division_edit';

    $selectd = "<select style='cursor: pointer' class='form-control' id='".$column_name."' name='".$column_name."'>";

    $result = mysqli_query($this->db->link, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_NAME = 'branches' AND COLUMN_NAME = 'division'");
    $row = $result->fetch_array();
    $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));

    foreach($enumList as $value){
      $selected = '';
      if ($value == $division) {
         $selected = 'selected';
       }

       $selectd .= "<option ".$selected."  value='".$value."'>".$value."</option>";
    }  

    $selectd .= "</select>"; 

    echo $output = '<form id="branches_form_update" class="form-horizontal" method="post" action="">
        <input type="hidden" id="branches_id_edit" name="branches_id_edit" value="'.$branches_id.'"/>
        <div id="err_branches_name_edit" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="branches_name_edit"> Branches Name <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="branches_name_edit" id="branches_name_edit" value="'.$branches_name.'">
            <div id="err_branches_name_edit_msg"></div>
          </div>
        </div>        
        <div id="err_branches_address_edit" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="branches_address_edit"> Address <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="branches_address_edit" id="branches_address_edit" value="'.$branches_address.'">
            <div id="err_branches_address_edit_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="branches_phone_edit"> Phone Number </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="branches_phone_edit" id="branches_phone_edit" value="'.$branches_phone.'">
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="branches_email_edit"> Email </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="branches_email_edit" id="branches_email_edit" value="'.$branches_email.'">
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="division"> Division </label>
          <div class="col-sm-10">
            '.$selectd.'
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="update_branches_data" class="btn btn-success btn-lg"> Submit </button>
          </div>
        </div>
      </form> ';     
	    	}
	     }
     }
   		
   	} catch (Exception $e) {
   		echo '<div class="alert alert-danger"> Something went wrong. </div>';
   	}
   }

  public function updateBranchesDataById($branches_id,$branches_name,$branches_address,$branches_phone,$branches_email,$division) {

  try {
        $branches_id      = $this->fm->validation($branches_id);
        $branches_name    = $this->fm->validation($branches_name);
        $branches_address = $this->fm->validation($branches_address);
        $branches_phone   = $this->fm->validation($branches_phone);
        $branches_email   = $this->fm->validation($branches_email);
        $division         = $this->fm->validation($division);

        $branches_id = mysqli_real_escape_string($this->db->link, $branches_id);  
        $branches_name = mysqli_real_escape_string($this->db->link, $branches_name);
        $branches_address = mysqli_real_escape_string($this->db->link, $branches_address);
        $branches_phone   = mysqli_real_escape_string($this->db->link, $branches_phone);
        $branches_email   = mysqli_real_escape_string($this->db->link, $branches_email);
        $division  = mysqli_real_escape_string($this->db->link, $division); 
        $branches_id = preg_replace('/\D/', '', $branches_id);
        $branches_id = (int)$branches_id;  

        if (empty($branches_name) || empty($branches_address) || empty($branches_id)) {
          echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
        } else {  

            $sql = "UPDATE branches SET 
                    branches_name = '$branches_name',
                    branches_address = '$branches_address',
                    branches_phone = '$branches_phone',
                    branches_email = '$branches_email',
                    division = '$division'
                    WHERE branches_id = '$branches_id'";
            $result = $this->db->update($sql);
            if ($result) { 

              echo '<div class="alert alert-success"> Branches Updated Successfully! </div>';

              echo '<script>setTimeout(function(){ location.reload();}, 3000);</script>';
            } else{
              echo '<div class="alert alert-danger"> Branches not Updated! </div>';
            }
         }
          
        } catch (Exception $e) {
          echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }

   public function deleteBranchesById($branches_id=NULL){
    try {
      $branches_id = $this->fm->validation($branches_id);
      $branches_id = mysqli_real_escape_string($this->db->link, $branches_id);
      $branches_id = preg_replace('/\D/', '', $branches_id);
      $branches_id = (int)$branches_id;
      if (empty($branches_id)) {
       echo '<div class="alert alert-danger"> Id is Required. </div>';
      }else{
        $sql = "DELETE FROM branches WHERE branches_id = '$branches_id'";
        $result = $this->db->delete($sql);
        if ($result) {
          echo '<div class="alert alert-success">Deleted Successfully! </div>';
          echo '<script>setTimeout(function(){ location.reload();}, 3000);</script>';
        } else{
         echo '<div class="alert alert-danger"> Content not Deleted. </div>'; 
         }
      }
    } catch (Exception $e) {
      echo '<div class="alert alert-danger"> Something went wrong. </div>';
    }
   }

   public function divisionGet() {

    $column_name = 'division';

    $selectd = "<select style='cursor: pointer' class='form-control' id='".$column_name."' name='".$column_name."'>";

    $result = mysqli_query($this->db->link, "SELECT COLUMN_TYPE FROM INFORMATION_SCHEMA.COLUMNS
       WHERE TABLE_NAME = 'branches' AND COLUMN_NAME = 'division'");
    $row = $result->fetch_array();
    $enumList = explode(",", str_replace("'", "", substr($row['COLUMN_TYPE'], 5, (strlen($row['COLUMN_TYPE'])-6))));

    foreach($enumList as $value){
       $selectd .= "<option value='".$value."'>".$value."</option>";
    }  

    $selectd .= "</select>";
       
   echo $selectd;
  }

}