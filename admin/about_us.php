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
              <i class="fa fa-list"></i>

              <h3 class="box-title"> <?php echo $pageName; ?> </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="abouts_message"></div>
                 <?php 

                  if (class_exists('SettingsClass')) {
                    $settings = new SettingsClass();
                    if (method_exists($settings, 'getAboutsData')) {
                      $result = $settings->getAboutsData();
                      if ($result) {
                        while ($rows = $result->fetch_assoc()) {

                 ?>
                 <form id="about_us_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <input type="hidden" value="<?php echo $rows['id']; ?>" name="about_us_id" id="about_us_id">

                <div id="err_about_us" class="form-group has-feedback">
                  <div class="col-sm-12">
                    <div id="err_about_us_msg"></div>
                    <textarea class="form-control" rows="8" name="about_us" id="about_us"><?php echo $rows['about_us']; ?></textarea>
                    <span style="color: red;">* This Field is Required! </span>
                  </div>
                </div> 
                <div class="form-group">
                  <div class="col-sm-offset-3 col-sm-6">
                    <button type="submit" name="save_about_data" class="btn btn-success btn-block btn-xl"> Update </button>
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
    
    $('#about_us').summernote();

    $('#about_us_form').on('submit', function(e) {

      var about_us    = $('#about_us').val();
      var about_us_id = $('#about_us_id').val();
      
       if(about_us == "") {

        $('#err_about_us').addClass('has-error');
        $('#err_about_us_msg').html("<div class='text-red'> About Us must not be Empty!</div>");
          return false;
        } else{

            var form_data = new FormData();

            form_data.append('about_us', about_us);
            form_data.append('about_us_id', about_us_id);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/aboutus_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(about_us_data){
                 $('#abouts_message').html(about_us_data);
               }
            });
          return false;
       }

    });
  });
</script>

