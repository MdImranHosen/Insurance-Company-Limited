<?php include "inc/header.php"; ?>
<?php 
if ((Session::get('admin_type') != 2) || (Session::get('admin_ck') != 'emain_admin')) {
    Session::destroy();
    header("Location:login.php");
  }
  
if($_GET["psuid"]) {

   $psuid = preg_replace('/\D/', '', $_GET['psuid']);
   $psuid = htmlentities($psuid);

 if (!isset($psuid) || $psuid == NULL) {
       echo '<script> window.history.back();</script>';
  }elseif($psuid==0){
    echo '<script> window.history.back();</script>';
  }else{
   $psuid = (int)$psuid;
  }

} else{
 echo '<script> window.history.back();</script>';
}

if (isset($_POST['save_ps_data_up'])) {
  
   $id            = $_POST['id'];
   $ps_title_up   = $_POST['ps_title_up'];
   $ps_details_up = $_POST['ps_details_up'];
   $ps_image_up   = $_FILES['ps_image_up'];

   if (empty($ps_title_up) || empty($ps_details_up)) {
     $msg = '<div class="alert alert-danger"> * Field is Required.</div>';
   }else{
      if (class_exists('ServicesClass')) {
         $ps = new ServicesClass();
        if (method_exists($ps, 'productsServicesUpdateData')) {
          $msg = $ps->productsServicesUpdateData($id,$ps_title_up,$ps_details_up,$ps_image_up);
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

              <h3 class="box-title"> Services Update </h3>
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
                    if (method_exists($ps, 'productsServicesUpdate')) {
                      $result = $ps->productsServicesUpdate($psuid);
                     if ($result) {
                     $action = $_SERVER['PHP_SELF'];

        $output = '<form id="services_update_form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">';
        while ($rows = $result->fetch_assoc()) {
                
          $id         = $rows['id'];
          $ps_title   = $rows['ps_title'];
          $ps_details = $rows['ps_details'];
          $logo       = $rows['ps_image'];

          $image = "../images/services/".$id."/".$logo;
          if (!file_exists($image)) {
             $image = "../img/logo.png";
           }

          
        $output .= '<h2><strong>'.$ps_title.'</strong></h2><div class="row"><div class="col-sm-6 col-sm-offset-2"><center><figure class="image-box"><img title="'.$ps_title.'" src="'.$image.'" style="max-width:100%;height:auto;"></figure></center><br>
        </div></div>
        <input type="hidden" name="id" value="'.$id.'"/>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="ps_image_up"> Change Image <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="ps_image_up" name="ps_image_up" accept="image/*">
          </div>
        </div>
        <div id="err_ps_title_up" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="ps_title_up"> Services Name <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="ps_title_up" id="ps_title_up" value="'.$ps_title.'">
            <div id="err_ps_title_up_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="ps_details_up"> Services Details </label>
          <div class="col-sm-10">
            <textarea class="form-control" name="ps_details_up" rows="8" id="ps_details_up">'.$ps_details.'</textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_ps_data_up" class="btn btn-success btn-lg"> Update </button>
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
 $('#ps_details_up').summernote();
});

function goBack() {
  window.history.back();
}
</script>


