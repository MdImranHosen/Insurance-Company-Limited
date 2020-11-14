<?php 
/**
 * FaqClass
 */
class FaqClass extends Mainclass
{
	
// FaqClass .......

 public function getFaq(){
  try {
    $sql = "SELECT faqs.*, products_services.ps_title as services_title FROM faqs JOIN products_services ON faqs.faq_ps_id = products_services.id ORDER BY faqs.faq_id DESC";
    $result = $this->db->select($sql);
    return $result;
  } catch (Exception $e) {
    
  }
 }

 public function getServicesFaqOption() {
  try {
    $sql = "SELECT * FROM products_services WHERE status = 1";
    $result = $this->db->select($sql);
    if ($result) {
      $output = '';
      while ($rows = $result->fetch_assoc()) {
        $id = $rows['id'];
        $ps_title = $rows['ps_title'];
        $output .= '<option value="'.$id.'">'.$ps_title.'</option>';
      }
      echo $output;
    }
  } catch (Exception $e) {
    
  }
 }

 public function addFaq($faq_ask,$faq_solution,$ps_id) {

  try {
    
    $faq_ask = $this->fm->validation($faq_ask);
    $faq_solution = $this->fm->validation($faq_solution);
    $ps_id = $this->fm->validation($ps_id);
    $faq_ask = mysqli_real_escape_string($this->db->link, $faq_ask);
    $faq_solution = mysqli_real_escape_string($this->db->link, $faq_solution);
    $ps_id = mysqli_real_escape_string($this->db->link, $ps_id);
    $ps_id = preg_replace('/\D/', '', $ps_id);
    $ps_id = (int)$ps_id;

    if (empty($faq_ask) || empty($faq_solution) || empty($ps_id)) {
      echo '<div class="alert alert-danger"> * Field Must not be Empty!</div>';
    } else {
       $sql = "INSERT INTO faqs(faq_ask,faq_solution,faq_ps_id) VALUES('$faq_ask','$faq_solution',$ps_id)";
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

public function deleteFaqByfId($id = NULL) {

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
  
    $sql = "DELETE FROM faqs WHERE faq_id = '$id'";
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

public function faqStatusChangeById($status,$id) {
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
        $sql = "UPDATE faqs SET faq_status = '$status' WHERE faq_id = '$id'";
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




public function getFaqBypsId($id = NULL) {
	try {
    $id    = $this->fm->validation($id);
    $id    = mysqli_real_escape_string($this->db->link, $id);
    $id    = preg_replace('/\D/','', $id);
    $id    = (int)$id;  

		$sql = "SELECT faqs.*, products_services.ps_title as services_title FROM faqs JOIN products_services ON faqs.faq_ps_id = products_services.id WHERE faqs.faq_status = 1 AND products_services.id = $id";
		$result = $this->db->select($sql);
		return $result;
   
	} catch (Exception $e) {
		
	}
}


}