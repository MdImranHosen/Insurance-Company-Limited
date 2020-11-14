<?php include "inc/header.php"; ?>
<?php 
if ((Session::get('admin_type') != 2) || (Session::get('admin_ck') != 'emain_admin')) {
    Session::destroy();
    header("Location:login.php");
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
        <section class="col-lg-12">

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header" style="margin-bottom: 20px;">
              <i class="fa fa-edit fa-lg"></i>

              <h3 class="box-title"> <?php echo $pageName; ?> </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="alert_message"></div>
                 <?php 

                  if (class_exists('SettingsClass')) {
                    $settings = new SettingsClass();
                    if (method_exists($settings, 'getAboutsData')) {
                      $result = $settings->getAboutsData();
                      if ($result) {
                        while ($rows = $result->fetch_assoc()) {

                 ?>
                 <form id="mv_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $rows['id']; ?>" name="vm_id" id="vm_id">               

                <div id="err_vision_mission" class="form-group has-feedback">                  
                  <div class="col-sm-12">
                    <div id="err_vision_mission_msg"></div>
                    <textarea class="form-control" rows="12" name="our_vision_mission" id="our_vision_mission"><?php echo $rows['our_mission']; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-4 col-sm-4">
                    <button type="submit" name="save_mission_vision" class="btn btn-danger btn-block"> Update </button>
                  </div>
                </div>
              </form> 
          <?php  } } } } ?>

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

    $('#mv_form').on('submit', function(e) {

      var our_vision_mission = $('#our_vision_mission').val();
      var vm_id = $('#vm_id').val();
      
       if(our_vision_mission == "") {

        $('#err_vision_mission').addClass('has-error');
        $('#err_vision_mission_msg').html("<div class='text-red'> Field must not be Empty!</div>");
          return false;
        } else{

            var form_data = new FormData();

            form_data.append('our_vision_mission', our_vision_mission);
            form_data.append('vm_id', vm_id);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/mission_vission.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(mv_data){
                 $('#alert_message').html(mv_data);
               }
            });
          return false;
       }

    });
  });
</script>

