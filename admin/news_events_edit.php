<?php include "inc/header.php"; ?>
<?php 
if ((Session::get('admin_type') != 2) || (Session::get('admin_ck') != 'emain_admin')) {
    Session::destroy();
    header("Location:login.php");
  }
  
if($_GET["nesuid"]) {

   $nesuid = preg_replace('/\D/', '', $_GET['nesuid']);
   $nesuid = htmlentities($nesuid);

 if (!isset($nesuid) || $nesuid == NULL) {
       header('Location:news_events.php');
  }elseif($nesuid==0){
    header('Location:news_events.php');
  }else{
   $nesuid = (int)$nesuid;
  }

} else{
 header('Location:news_events.php');
}

if (isset($_POST['save_news_events_data'])) {
  
   $news_events_id    = $_POST['news_events_id'];
   $news_events_title = $_POST['news_events_title'];
   $news_events_date  = $_POST['news_events_date'];
   $news_events_des   = $_POST['news_events_des'];
   $news_events_file  = $_FILES['news_events_file'];

   if (empty($news_events_title) || empty($news_events_date)) {
     $msg = '<div class="alert alert-danger"> * Field is Required.</div>';
   }else{
      if (class_exists('NewsEventsClass')) {
         $nesObj = new NewsEventsClass();
        if (method_exists($nesObj, 'newsEventsUpdateData')) {
          $msg = $nesObj->newsEventsUpdateData($news_events_id,$news_events_title,$news_events_date,$news_events_des,$news_events_file);
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

              <h3 class="box-title"><?php echo $pageName; ?> </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                 <button type="button" class="btn btn-danger" onclick="goBack()"> Go Back </button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="message_data"></div>
                 <?php 
                  if (class_exists('NewsEventsClass')) {
                    $nesObj = new NewsEventsClass();
                    if (method_exists($nesObj, 'getNewsEventsUpdate')) {
                      $result = $nesObj->getNewsEventsUpdate($nesuid);
                     if ($result) {
                     $action = $_SERVER['PHP_SELF'];

        $output = '<form id="news_events_update_form" class="form-horizontal" method="post" action="" enctype="multipart/form-data">';
        while ($rows = $result->fetch_assoc()) {
                
          $id      = $rows['news_events_id'];
          $title   = $rows['news_events_title'];
          $date    = $rows['news_events_date'];
          $details = $rows['news_events_des'];
          $logo    = $rows['news_events_file'];

          $image   = "../news_events/".$id."/".$logo;
          if (file_exists($image)) {
            $image   = "../news_events/".$id."/".$logo;
          } else{
            $image = "../img/logo.png";
          }

          
        $output .= '<div class="col-sm-12"><center><figure class="image-box"><img title="'.$title.'" src="'.$image.'" style="max-width:30%;height:auto;"></figure></center>
        </div>
        <input type="hidden" name="news_events_id" value="'.$id.'"/>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="news_events_file"> Change Image <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="news_events_file" name="news_events_file" accept="image/*">
            <p style="color: red;"><small>Image size should be 370 * 200 px.</small></p>
          </div>
        </div>
        <div id="err_news_events_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="news_events_title"> Title <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="news_events_title" id="news_events_title" value="'.$title.'">          
            <div id="err_news_events_title_msg"></div>
          </div>
        </div>
        <div id="err_news_events_date" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="news_events_date"> Date <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="news_events_date" id="news_events_date" value="'.$date.'">
            <div id="err_news_events_date_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="news_events_des"> Details </label>
          <div class="col-sm-10">
            <textarea class="form-control" name="news_events_des" rows="8" id="news_events_des">'.$details.'</textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_news_events_data" class="btn btn-success btn-lg"> Update </button>
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
    $('#news_events_des').summernote();
  });

  function goBack() {
    window.history.back();
  }
</script>