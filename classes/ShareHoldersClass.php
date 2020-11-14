<?php
/**
 * ShareHoldersClass Class
 */
class ShareHoldersClass extends Mainclass
{

 public function getShareHoldersPageTitleText() {
  try {
    $sql = "SELECT * FROM share_holders_text ORDER BY id DESC LIMIT 1";
    $result = $this->db->select($sql);
    return $result;
   } catch (Exception $e) {
    
   }
 }
 public function shareHolsersTextEditById($id){
  try {

     $id = $this->fm->validation($id);
     $id = mysqli_real_escape_string($this->db->link, $id);
     $id = preg_replace('/\D/','', $id);
     $id = (int)$id;

     if (empty($id)) {
      echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
     } else {

      $sql = "SELECT * FROM share_holders_text WHERE id = '$id'";
      $result = $this->db->select($sql);
      if ($result) {
        while ($rows = $result->fetch_assoc()) {
                
         $id                  = $rows['id'];
         $share_holders_title = $rows['share_holders_title'];     
         $share_holders_des   = $rows['share_holders_des'];

         echo '<form id="shtext_form"  method="post" action=""><table width="100%" border="1"><tr style="text-align:center;"><td width="30%"><input type="hidden" id="sht_id" value="'.$id.'"/><input type="text" style="padding:20px;font-size:25px;" class="form-control" id="sht_title" name="sht_title" value="'.$share_holders_title.'"/></td><td style="font-size: 17px;" width="50%"><input type="text" class="form-control" style="padding:20px;" id="sht_text" name="sht_text" value="'.$share_holders_des.'"/></td><td width="15%"><button type="submit" class="btn btn-danger">Update</button></td></tr></table></form>';
      }
    }
  }
    
  } catch (Exception $e) {
    
  }
 }

 public function editShareHolserstextDataById($id,$sht_title,$sht_text){

   try {

      $id        = $this->fm->validation($id);
      $sht_title = $this->fm->validation($sht_title);
      $sht_text  = $this->fm->validation($sht_text);

      $id        = mysqli_real_escape_string($this->db->link, $id);
      $sht_title = mysqli_real_escape_string($this->db->link, $sht_title);
      $sht_text  = mysqli_real_escape_string($this->db->link, $sht_text);
      $id        = preg_replace('/\D/', '', $id);
      $id        = (int)$id;  

        if (empty($sht_title) || empty($sht_text) || empty($id)) {
          echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
        } else { 

            $sql = "UPDATE share_holders_text SET 
                    share_holders_title = '$sht_title',
                    share_holders_des   = '$sht_text'
                    WHERE id  = '$id'";
            $result = $this->db->update($sql);
            if ($result) { 

              echo '<div class="alert alert-success"> Updated Successfully! </div>';

              echo '<script>setTimeout(function(){ location.reload();}, 3000);</script>';
            } else{
              echo '<div class="alert alert-danger"> Not Updated! </div>';
            }
         }
          
        } catch (Exception $e) {
          echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
 }
	
 public function getShareHolders() {

   try {
   	$sql = "SELECT * FROM share_holders WHERE status = 1 ORDER BY id ASC";
    $result = $this->db->select($sql);
    return $result;
   } catch (Exception $e) {
   	
   }
 }

public function addShareHolsersData($name,$position,$no_of_share,$amount,$percentage) {

  try {

        $name        = $this->fm->validation($name);
        $position    = $this->fm->validation($position);
        $no_of_share = $this->fm->validation($no_of_share);
        $amount      = $this->fm->validation($amount);
        $percentage  = $this->fm->validation($percentage);
            
        $name    = mysqli_real_escape_string($this->db->link, $name);
        $position  = mysqli_real_escape_string($this->db->link, $position);
        $no_of_share = mysqli_real_escape_string($this->db->link, $no_of_share);
        $amount = mysqli_real_escape_string($this->db->link, $amount);
        $percentage = mysqli_real_escape_string($this->db->link, $percentage);      

        if (empty($name) || empty($position) || empty($no_of_share) || empty($amount)) {
          echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
        } else {

            $sql = "INSERT INTO share_holders(name,position,no_of_share,amount,percentage) VALUES('$name','$position','$no_of_share','$amount','$percentage')";
            $insert = $this->db->insert($sql);
            if ($insert) { 
              echo '<div class="alert alert-success"> Added Successfully! </div>';
              echo '<script>setTimeout(function(){ location.reload();}, 3000);</script>';
            } else{
              echo '<div class="alert alert-danger"> Not Added! </div>';
            }
         }
        	
        } catch (Exception $e) {
        	echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }

 

public function shareHolsersEditById($id=NULL) {

  try {

     $id = $this->fm->validation($id);
     $id = mysqli_real_escape_string($this->db->link, $id);
     $id = preg_replace('/\D/','', $id);
     $id = (int)$id;

     if (empty($id)) {
      echo '<div class="alert alert-danger"> ID Must not be Empty!</div>';
     } else {

      $sql = "SELECT * FROM share_holders WHERE status = 1 AND id = '$id'";
	    $result = $this->db->select($sql);
	    if ($result) {
	    	while ($rows = $result->fetch_assoc()) {
                
         $id          = $rows['id'];
	    	 $name        = $rows['name'];     
	    	 $position    = $rows['position'];
         $no_of_share = $rows['no_of_share'];
         $amount      = $rows['amount'];
         $percentage  = $rows['percentage'];    

    echo $output = '<form id="share_form_update" class="form-horizontal" method="post" action="">
        <input type="hidden" id="sh_id" name="sh_id" value="'.$id.'"/>
        <div id="err_name_edit" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="name_edit"> Name <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name_edit" id="name_edit" value="'.$name.'">
            <div id="err_name_edit_msg"></div>
          </div>
        </div>        
        <div id="err_position_edit" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="position_edit"> Position <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="position_edit" id="position_edit" value="'.$position.'">
            <div id="err_position_edit_msg"></div>
          </div>
        </div>
        <div id="err_no_of_share_edit" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="no_of_share_edit"> No of Share <span style="color:red;font-size: 20px;">*</span> </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="no_of_share_edit" id="no_of_share_edit" value="'.$no_of_share.'">
            <div id="err_no_of_share_edit_msg"></div>
          </div>
        </div>
        <div id="err_amount_edit" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="amount_edit"> Amount <span style="color:red;font-size: 20px;">*</span> </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="amount_edit" id="amount_edit" value="'.$amount.'">
            <div id="err_amount_edit_msg"></div>
          </div>
        </div>
        <div id="err_percentage_edit" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="percentage_edit"> Percentage <span style="color:red;font-size: 20px;">*</span> </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="percentage_edit" id="percentage_edit" value="'.$percentage.'">
            <div id="err_percentage_edit_msg"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="update_data" class="btn btn-success btn-lg"> Submit </button>
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

  public function editShareHolsersDataById($id,$name,$position,$no_of_share,$amount,$percentage) {

  try {
      $id          = $this->fm->validation($id);
      $name        = $this->fm->validation($name);
      $position    = $this->fm->validation($position);
      $no_of_share = $this->fm->validation($no_of_share);
      $amount      = $this->fm->validation($amount);
      $percentage  = $this->fm->validation($percentage);

      $id      = mysqli_real_escape_string($this->db->link, $id);
      $name    = mysqli_real_escape_string($this->db->link, $name);
      $position= mysqli_real_escape_string($this->db->link, $position);
      $no_of_share = mysqli_real_escape_string($this->db->link, $no_of_share);
      $amount = mysqli_real_escape_string($this->db->link, $amount);
      $percentage = mysqli_real_escape_string($this->db->link, $percentage);
      $id = preg_replace('/\D/', '', $id);
      $id = (int)$id;    

        if (empty($name) || empty($position) || empty($no_of_share) || empty($amount) || empty($id)) {
          echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
        } else { 

            $sql = "UPDATE share_holders SET 
                    name        = '$name',
                    position    = '$position',
                    no_of_share = '$no_of_share',
                    amount      = '$amount',
                    percentage  = '$percentage'
                    WHERE status = 1 AND id = '$id'";
            $result = $this->db->update($sql);
            if ($result) { 

              echo '<div class="alert alert-success"> Updated Successfully! </div>';

              echo '<script>setTimeout(function(){ location.reload();}, 3000);</script>';
            } else{
              echo '<div class="alert alert-danger"> Not Updated! </div>';
            }
         }
          
        } catch (Exception $e) {
          echo '<div class="alert alert-danger"> Something went wrong. </div>';
        }
   }

   public function shareHolsersDelById($id=NULL) {
    try {
      $id = $this->fm->validation($id);
      $id = mysqli_real_escape_string($this->db->link, $id);
      $id = preg_replace('/\D/', '', $id);
      $id = (int)$id;
      if (empty($id)) {
       echo '<div class="alert alert-danger"> Id is Required. </div>';
      }else{
        $sql = "DELETE FROM share_holders WHERE id = '$id'";
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
   

}