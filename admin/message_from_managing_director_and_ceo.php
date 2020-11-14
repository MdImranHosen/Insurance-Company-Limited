<?php include "inc/header.php"; ?>
<?php 
if ((Session::get('admin_type') != 2) || (Session::get('admin_ck') != 'emain_admin')) {
    Session::destroy();
    header("Location:login.php");
  }
  
if (isset($_POST['save_bod_data'])) {
  
   $bod_id   = $_POST['bod_id'];
   $bod_name = $_POST['bod_name'];
   $bod_deg  = $_POST['bod_deg'];
   $bod_des  = $_POST['bod_des'];
   $bod_fb   = $_POST['bod_fb'];
   $bod_tw   = $_POST['bod_tw'];
   $bod_pt   = $_POST['bod_pt'];
   $bod_lk   = $_POST['bod_lk'];
   $bod_img  = $_FILES['bod_img'];
   $em_type  = "message_from_managing_director_and_ceo";

   if (empty($bod_name) || empty($bod_deg)) {
     $msg = '<div class="alert alert-danger"> * Field is Required.</div>';
   }else{
      if (class_exists('EmployerClass')) {
         $em = new EmployerClass();
        if (method_exists($em, 'boardOfDirectorsUpdate')) {
          $msg = $em->boardOfDirectorsUpdate($bod_id,$bod_name,$bod_deg,$bod_des,$bod_img,$bod_fb,$bod_tw,$bod_pt,$bod_lk,$em_type);
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
              <i class="fa fa-edit fa-lg"></i>
              <h3 class="box-title"> <?php echo $pageName; ?> </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                 <button type="button" class="btn btn-danger" onclick="goBack()"> Go Back </button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="message_data"></div>
     <?php 
      if (class_exists('EmployerClass')) {
        $em = new EmployerClass();
        if (method_exists($em, 'boardOfDirectorsUpdateById')) {
          $result = $em->boardOfDirectorsUpdateById('message_from_managing_director_and_ceo','3');
         if ($result) {
         $action = $_SERVER['PHP_SELF'];

        $output = '<form id="bod_update_form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">';
        while ($rows = $result->fetch_assoc()) {
                
          $id       = $rows['em_id'];
          $bod_name = $rows['em_name'];
          $bod_deg  = $rows['em_designation'];          
          $bod_fb   = $rows['em_fb'];
          $bod_tw   = $rows['em_tw'];
          $bod_pt   = $rows['em_pt'];
          $bod_lk   = $rows['em_lk'];
          $logo     = $rows['em_photo'];
          $bod_des  = htmlspecialchars_decode(stripslashes($rows['em_description']));
          $image    = "../images/message_from_managing_director_and_ceo/".$id."/".$logo;
          if (!file_exists($image)) {
           $image = "../img/logo.png";
         }
          
        $output .= '<div class="col-sm-12"><center><figure class="image-box"><img title="'.$bod_name.'" src="'.$image.'" style="max-width:30%;height:auto;"></figure></center>
        </div>
        <input type="hidden" name="bod_id" value="'.$id.'"/>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="bod_img"> Change Image </label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="bod_img" name="bod_img" accept="image/*">
          </div>
        </div>
        <div id="err_bod_name" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="bod_name"> Name <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_name" id="bod_name" value="'.$bod_name.'">
            <div id="err_bod_name_msg"></div>
          </div>
        </div>
        <div id="err_bod_deg" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="bod_deg"> Designation <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_deg" id="bod_deg" value="'.$bod_deg.'">
            <div id="err_bod_deg_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="bod_des"> Description </label>
          <div class="col-sm-10">
            <textarea class="form-control" name="bod_des" rows="8" id="bod_des">'.$bod_des.'</textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="bod_fb"> Facebook </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_fb" id="bod_fb" value="'.$bod_fb.'">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="bod_tw"> Twitter </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_tw" id="bod_tw" value="'.$bod_tw.'">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="bod_pt"> Pinterest </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_pt" id="bod_pt" value="'.$bod_pt.'">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="bod_lk"> Linkedin </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_lk" id="bod_lk" value="'.$bod_lk.'">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_bod_data" class="btn btn-success btn-lg"> Update </button>
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