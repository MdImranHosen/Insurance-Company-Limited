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
    <section class="content-header">
      <h1>
        Admin
        <small>Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Dashboard</a></li>
        <li class="active">Admin Panel</li>
      </ol>
    </section>
      <div class="clearfix"></div>
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-8 col-lg-offset-2">

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header" style="margin-bottom: 20px;">
              <i class="fa fa-list"></i>

              <h3 class="box-title"> Settings </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="settigs_message"></div>
                 <?php 

                  if (class_exists('SettingsClass')) {
                    $settings = new SettingsClass();
                    if (method_exists($settings, 'getSettingsData')) {
                      $result = $settings->getSettingsData();
                      if ($result) {
                        while ($rows = $result->fetch_assoc()) {

                        $img = "../img/".$rows['site_icon'];
                        if (!file_exists($img)) {
                           $img = "../img/bdevent24.png";
                         }

                        $img_logo = "../img/".$rows['site_logo'];
                        if (!file_exists($img_logo)) {
                           $img_logo = "../img/bdevent24.png";
                         }
                 ?>
                 <form id="settings_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

                <div id="err_site_logo" class="form-group has-feedback">
                 <label class="control-label col-sm-2" for="site_logo"> Site Logo </label>
                  <div class="col-sm-6">
                    <input type="file" class="form-control" id="site_logo" name="site_logo" accept="image/*">
                    <div id="err_site_logo_msg" class="text-red">Image Size Should be Width: 180px and Height: auto!</div>
                  </div>
                  <div class="col-sm-4">
                    <center><img src="<?php echo $img_logo; ?>" style="width: 200px; height: auto;border: 2px solid #ddd;padding: 3px;" ></center>
                  </div>
                </div>

                <div id="err_site_icon" class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_icon"> Tab Icon </label>
                  <div class="col-sm-6">
                    <input type="file" class="form-control" id="site_icon" name="site_icon" accept="image/*">
                    <div id="err_site_icon_msg" class="text-red">Image Size Should be Width: 50 px and Height: auto!</div>
                  </div>
                  <div class="col-sm-4">
                    <center><img src="<?php echo $img; ?>" style="width: 50px; height: auto;border: 2px solid #ddd;padding: 3px;" ></center>
                  </div>
                </div>

                <div id="err_site_name" class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_title"> Site Title <span style="color:red;font-size: 20px;">*</span></label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_title" id="site_title" value="<?php echo $rows['site_title']; ?>">
                    <div id="err_site_name_msg"></div>
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_meta_keyword"> Site Meta Keyword </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_meta_keyword" id="site_meta_keyword" value="<?php echo $rows['site_meta_keyword']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_meta_description"> Site Meta Description </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_meta_description" id="site_meta_description" value="<?php echo $rows['site_meta_description']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_copy_right"> Site Copy Right </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_copy_right" id="site_copy_right" value="<?php echo $rows['site_copy_right']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_url"> Site Url </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_url" id="site_url" value="<?php echo $rows['site_url']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_dev"> Site Develop by </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_dev" id="site_dev" value="<?php echo $rows['site_dev']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="develop_site_url"> Develop Site Url </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="develop_site_url" id="develop_site_url" value="<?php echo $rows['develop_site_url']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="opening_time"> Opening Time </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="opening_time" id="opening_time" value="<?php echo $rows['opening_time']; ?>">
                    <span class="text-red">Note: Day and Time Between must be used "=" Like: Sun - Thurs: = 10.0 am to 6.0 pm</span>
                  </div>
                </div>

                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_phone"> Site Phone </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_phone" id="site_phone" value="<?php echo $rows['site_phone']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_email"> Site Email </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_email" id="site_email" value="<?php echo $rows['site_email']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_address"> Site Address </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_address" id="site_address" value="<?php echo $rows['site_address']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_facebook"> Facebook </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_facebook" id="site_facebook" value="<?php echo $rows['site_facebook']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_twitter"> Twitter </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_twitter" id="site_twitter" value="<?php echo $rows['site_twitter']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_linkedin"> Linkedin </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_linkedin" id="site_linkedin" value="<?php echo $rows['site_linkedin']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_instagram"> Instagram </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_instagram" id="site_instagram" value="<?php echo $rows['site_instagram']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_youtube"> YouTube </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="site_youtube" id="site_youtube" value="<?php echo $rows['site_youtube']; ?>">
                  </div>
                </div>
                <div class="form-group has-feedback">
                  <label class="control-label col-sm-2" for="site_footer_about"> Footer About Us </label>
                  <div class="col-sm-10">
                    <textarea class="form-control textarea" rows="8" name="site_footer_about" id="site_footer_about"><?php echo $rows['site_footer_about']; ?></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="save_partner_data" class="btn btn-success btn-lg"> Update </button>
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

    $('#settings_form').on('submit', function(e) {

      var site_title        = $('#site_title').val();
      var site_logo         = $('#site_logo').prop('files')[0];
      var site_icon         = $('#site_icon').prop('files')[0];
      var site_meta_keyword = $('#site_meta_keyword').val();
      var site_meta_description = $('#site_meta_description').val();
      var site_copy_right   = $('#site_copy_right').val();
      var site_url          = $('#site_url').val(); 
      var site_dev          = $('#site_dev').val();
      var develop_site_url  = $('#develop_site_url').val();
      var opening_time      = $('#opening_time').val();
      var site_phone        = $('#site_phone').val();
      var site_email        = $('#site_email').val();
      var site_address      = $('#site_address').val();
      var site_facebook     = $('#site_facebook').val();
      var site_twitter      = $('#site_twitter').val();
      var site_linkedin     = $('#site_linkedin').val();
      var site_instagram    = $('#site_instagram').val();
      var site_youtube      = $('#site_youtube').val();
      var site_footer_about = $('#site_footer_about').val();
      
      
       if(site_title == "") {

        $('#err_site_name').addClass('has-error');
        $('#err_site_name_msg').html("<div class='text-red'> Site Title Field must not be Empty!</div>");
          return false;
        } else{

            var form_data = new FormData();

            form_data.append('site_title', site_title);
            form_data.append('site_logo', site_logo);
            form_data.append('site_icon', site_icon);
            form_data.append('site_meta_keyword', site_meta_keyword);
            form_data.append('site_meta_description', site_meta_description);
            form_data.append('site_copy_right', site_copy_right);
            form_data.append('site_url', site_url);
            form_data.append('site_dev', site_dev);
            form_data.append('develop_site_url', develop_site_url);
            form_data.append('opening_time', opening_time);
            form_data.append('site_phone', site_phone);
            form_data.append('site_email', site_email);
            form_data.append('site_address', site_address);
            form_data.append('site_facebook', site_facebook);
            form_data.append('site_twitter', site_twitter);
            form_data.append('site_linkedin', site_linkedin);
            form_data.append('site_instagram', site_instagram);
            form_data.append('site_youtube', site_youtube);
            form_data.append('site_footer_about', site_footer_about);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/settings_add_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(setting_data){
                 $('#settigs_message').html(setting_data);
               }
            });
            return false;
       }

    });
  });
</script>

