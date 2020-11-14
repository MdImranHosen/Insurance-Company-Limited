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
              <div id="get_message"></div>
                 <?php 

                  if (class_exists('SlideContentClass')) {
                    $scc = new SlideContentClass();
                    if (method_exists($scc, 'getHomeImageVideoMeg')) {
                      $result = $scc->getHomeImageVideoMeg();
                      if ($result) {
                        while ($rows = $result->fetch_assoc()) {
                      $id = $rows['id'];
                      $youtube_video_url = $rows['youtube_video_url'];
                      $welcome_msg  = $rows['welcome_msg'];
                      $img_logo = "../img/banner_image/".$rows['banner_image'];
                      if (!file_exists($img_logo)) {
                        $img_logo = "../img/logo.png";
                      } 
                    
                 ?>
                 <form id="home_image_video_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                <input type="hidden" name="ivw_id" id="ivw_id" value="<?php echo $id; ?>">
                <div class="col-sm-12">
                  <div class="row">
                    <div class="col-lg-offset-2 col-8">
                      <center><img src="<?php echo $img_logo; ?>" style="width: 100%; height: auto;border: 2px solid #ddd;padding: 3px;margin-bottom: 7px;" ></center>
                    </div>
                  </div>                    
                </div>
                <div class="form-group has-feedback">
                 <label class="control-label col-sm-2" for="banner_image"> Welcome Model Image </label>
                  <div class="col-sm-10" style="border: 2px solid red;padding: 10px;">              
                    <input type="file" class="form-control" id="banner_image" name="banner_image" accept="image/*">
                  </div>                  
                </div>
                <div class="form-group has-feedback">
                <label class="control-label col-sm-2" for="welcome_msg"> Welcome Model Text  </label>
                <div class="col-sm-10">               
                  <textarea  class="form-control" rows="8" name="welcome_msg" id="welcome_msg">
                  <?php echo $welcome_msg; ?>                  
                  </textarea>
                </div>
              </div> 

               <div class="col-sm-12" style="margin-top: 20px;margin-bottom: 5px;">
                  <div class="row">
                    <div class="col-sm-offset-2 col-sm-8">

                      <?php echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
                      "<iframe width=\"100%\" height=\"315\" src=\"//www.youtube.com/embed/$1?autoplay=1&rel=0&controls=0&showinfo=0&mute=1\" frameborder=\"0\" volume=\"0\" allowfullscreen></iframe>", 
                      $youtube_video_url); ?>
                    </div>
                  </div>                    
                </div>      

              <div id="err_youtube_video_url" class="form-group has-feedback">
                <label class="control-label col-sm-2" for="youtube_video_url"> YouTube Video url <span style="color:red;font-size: 20px;">*</span> </label>
                <div class="col-sm-10" style="border: 2px solid red;padding: 10px;">
                  <input type="text" class="form-control" name="youtube_video_url" id="youtube_video_url" value="<?php echo $youtube_video_url; ?>">
                  <div id="err_youtube_video_url_msg"></div>
                </div>                
              </div> 

                          

                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="save" class="btn btn-success btn-lg"> Update </button>
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

    $('#welcome_msg').summernote();

    $('#home_image_video_form').on('submit', function(e) {

      var banner_image      = $('#banner_image').prop('files')[0];
      var youtube_video_url = $('#youtube_video_url').val();
      var welcome_msg       = $('#welcome_msg').val();
      var ivw_id            = $('#ivw_id').val();      
      
       if(youtube_video_url == "") {

        $('#err_youtube_video_url').addClass('has-error');
        $('#err_youtube_video_url_msg').html("<div class='text-red'> YouTube url field is Required!</div>");
          return false;
        } else{

            var form_data = new FormData();            
            form_data.append('banner_image', banner_image);
            form_data.append('youtube_video_url', youtube_video_url);
            form_data.append('welcome_msg', welcome_msg);
            form_data.append('ivw_id', ivw_id);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/home_image_video_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(set_data){
                 $('#get_message').html(set_data);
               }
            });
            return false;
       }

    });
  });
</script>

