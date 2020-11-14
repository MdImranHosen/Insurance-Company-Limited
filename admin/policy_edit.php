<?php include "inc/header.php"; ?>
<?php 
if ((Session::get('admin_type') != 2) || (Session::get('admin_ck') != 'emain_admin')) {
    Session::destroy();
    header("Location:login.php");
  }
  
if($_GET["psplicyid"]) {

   $psplicyid = preg_replace('/\D/', '', $_GET['psplicyid']);
   $psplicyid = htmlentities($psplicyid);

 if (!isset($psplicyid) || $psplicyid == NULL) {
       echo '<script> window.history.back();</script>';
  }elseif($psplicyid==0){
    echo '<script> window.history.back();</script>';
  }else{
   $psplicyid = (int)$psplicyid;
  }

} else{
 echo '<script> window.history.back();</script>';
}

if (isset($_POST['save_policy_data_up'])) {
  
   $policy_id   = $_POST['policy_id'];
   $services_url= $_POST['services_url'];
   $policy_name = $_POST['policy_name'];
   $policy_des  = $_POST['policy_des'];
   $highlights  = $_POST['highlights'];
   $covered     = $_POST['covered'];
   $exclusions  = $_POST['exclusions'];
   $policy_img  = $_FILES['policy_img'];

   if (empty($policy_name)) {
     $msg = '<div class="alert alert-danger"> * Field is Required.</div>';
   }else{
      if (class_exists('ServicesClass')) {
         $ps = new ServicesClass();
        if (method_exists($ps, 'psPolicyUpdateDataById')) {
          $msg = $ps->psPolicyUpdateDataById($policy_id,$services_url,$policy_name,$policy_des,$highlights,$covered,$exclusions,$policy_img);
        }
      }
   }
}
?>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

  <?php include "inc/header_bottom.php"; ?>
  <!-- Left side column. contains the logo and sidebar -->
<!--SideBar Start-->
  <?php include "inc/sidebar.php"; ?>
<!--SideBar End-->
<style type="text/css">
  .invalid-feedback{color: red;display: none;}
</style>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <?php if (realpath('inc/admin_title.php')) {
      include_once 'inc/admin_title.php';
    } ?> 
      <div class="clearfix"></div>
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">
          <?php 
            if (!empty($msg)) {
              echo $msg;
            }
          ?>
          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header" style="margin-bottom: 20px;">
              <i class="fa fa-list"></i>

              <h3 class="box-title">Policy Update </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                 <button type="button" class="btn btn-danger" onclick="goBack()"> Go Back </button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="message_data"></div>
         <?php 
          if (class_exists('ServicesClass')) {
            $ps = new ServicesClass();
            if (method_exists($ps, 'psPolicyDataUpdateBypId')) {
              $result = $ps->psPolicyDataUpdateBypId($psplicyid);
             if ($result) {
             $action = $_SERVER['PHP_SELF'];

        $output = '<form id="policy_update_form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">';
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

          $plicyimg = "../images/services/".$services_url."/policy/".$policy_id."/".$policy_img;
          if (!file_exists($plicyimg)) {
             $plicyimg = "../img/logo.png";
           }

          
        $output .= '<div class="col-sm-12"><center><figure class="image-box"><img title="'.$policy_name.'" src="'.$plicyimg.'" style="max-width:30%;height:auto;"></figure></center>
        </div>
        <input type="hidden" name="policy_id" value="'.$policy_id.'"/>
        <input type="hidden" name="services_url" value="'.$services_url.'"/>

        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="policy_img"> Change Image </label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="policy_img" name="policy_img" accept="image/*">
          </div>
        </div>
        <div id="err_policy_name" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="policy_name"> Services Name <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="policy_name" id="policy_name" value="'.$policy_name.'">
            <div id="err_policy_name_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="policy_des"> Policy Details </label>
          <div class="col-sm-10">
            <textarea class="form-control" name="policy_des" rows="8" id="policy_des">'.$policy_des.'</textarea>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="highlights"> Highlights </label>
          <div class="col-sm-10">
            <textarea class="form-control textarea" name="highlights" rows="8" id="highlights">'.$highlights.'</textarea>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="covered"> Covered </label>
          <div class="col-sm-10">
            <textarea class="form-control textarea" name="covered" rows="8" id="covered">'.$covered.'</textarea>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="exclusions"> Exclusions </label>
          <div class="col-sm-10">
            <textarea class="form-control textarea" name="exclusions" rows="8" id="exclusions">'.$exclusions.'</textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_policy_data_up" class="btn btn-success btn-lg"> Update </button>
          </div>
        </div>';               
        }
        $output .= '</form>';
        echo $output;
      } } } ?>
                
            </div>
          </div>

        </section>
        <!-- /.Left col -->
      </div>
      <!-- /.row (main row) -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include "inc/footer.php"; ?>
<script>
$(document).ready(function(){
 $('#policy_des').summernote();
});

function goBack() {
  window.history.back();
}
</script>