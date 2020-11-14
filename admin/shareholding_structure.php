<?php include "inc/header.php"; ?>
<?php 
if ((Session::get('admin_type') != 2) || (Session::get('admin_ck') != 'emain_admin')) {
    Session::destroy();
    header("Location:login.php");
  }
  

if (isset($_POST['save_fi_data'])) {
  
   $fi_id    = $_POST['fi_id'];
   $fi_title = $_POST['fi_title'];
   $fi_date  = $_POST['fi_date'];
   $fi_des   = $_POST['fi_des'];
   $fi_img   = $_FILES['fi_img'];

   if (empty($fi_title)) {
     $msg = '<div class="alert alert-danger"> * Field is Required.</div>';
   }else{
      if (class_exists('FinancialIndicatorsClass')) {
         $fiObj = new FinancialIndicatorsClass();
        if (method_exists($fiObj, 'financialIndicatorsUpdate')) {
          $msg = $fiObj->financialIndicatorsUpdate($fi_id,$fi_title,$fi_date,$fi_des,$fi_img,$currentpage);
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
      if (class_exists('FinancialIndicatorsClass')) {
        $fiObj = new FinancialIndicatorsClass();
        if (method_exists($fiObj, 'financialIndicatorsByPageNameType')) {
          $result = $fiObj->financialIndicatorsByPageNameType($currentpage);
         if ($result) {
         $action = $_SERVER['PHP_SELF'];

        $output = '<form id="fi_shstc_update_form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">';
        while ($rows = $result->fetch_assoc()) {
                
          $id       = $rows['fi_id'];
          $fi_title = $rows['fi_title'];
          $fi_date  = $rows['fi_date'];
          $fi_type  = $rows['fi_type'];
          $logo     = $rows['fi_file'];
          $fi_des  = htmlspecialchars_decode(stripslashes($rows['fi_des']));
          $image    = "../images/".$fi_type."/".$id."/".$logo;
          if (!file_exists($image)) {
           $image = "../img/logo.png";
         }
          
        $output .= '<div class="col-sm-12"><center><figure class="image-box"><img title="'.$fi_title.'" src="'.$image.'" style="max-width:60%;height:auto;"></figure></center><br>
        </div>
        <input type="hidden" name="fi_id" value="'.$id.'"/>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="fi_img"> Change Image </label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="fi_img" name="fi_img" accept="image/*">
          </div>
        </div>
        <div id="err_fi_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="fi_title"> Title <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="fi_title" id="fi_title" value="'.$fi_title.'">
            <div id="err_fi_title_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="fi_date"> Date </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="fi_date" id="fi_date" value="'.$fi_date.'">
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="fi_des"> Description </label>
          <div class="col-sm-10">
            <textarea class="form-control" name="fi_des" rows="8" id="fi_des">'.$fi_des.'</textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_fi_data" class="btn btn-success btn-lg"> Update </button>
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
<script type="text/javascript">
  $(document).ready(function(){
  $('#fi_des').summernote();
  });
</script>