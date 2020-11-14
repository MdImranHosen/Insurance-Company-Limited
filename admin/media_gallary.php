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

<!-- Add Mdeia Gallary Content Modal -->
<div id="addMediaGallaryModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Gallary YouTube Video URL </strong></h4>
        <div id="msg_message"></div>
      </div>
      <div class="modal-body">
         <form id="media_gallary_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div id="err_content_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="content_title"> Content Title <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="content_title" id="content_title" placeholder="Content Title">
            <div id="err_content_title_msg"></div>
          </div>
        </div>

        <div id="err_youtube_video_url" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="youtube_video_url"> YouTube Video url <span style="color:red;font-size: 20px;">*</span> </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="youtube_video_url" id="youtube_video_url" placeholder="YouTube Video url">
            <div id="err_youtube_video_url_msg"></div>
          </div>
        </div>
       
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_media_gallery_data" class="btn btn-success btn-lg"> Submit </button>
          </div>
        </div>
      </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
      </div>
    </div>

  </div>
</div>

<!-- Add Event Modal -->

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
        <section class="col-lg-12 connectedSortable">

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header" style="margin-bottom: 20px;">
              <i class="fa fa-list"></i>

              <h3 class="box-title"> Media Gallary </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-lg" data-target="#addMediaGallaryModal" data-toggle="modal"
                        title="Add Media Gallary Content">
                  <i class="fa fa-plus"></i> Add Media Gallary Content</button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="message_data"></div>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> NO </th>
                  <th> Title </th>
                  <th> Video </th>
                  <th> Action </th>
                </tr>
                </thead>
                <tbody>
                 <?php 

                  if (class_exists('SlideContentClass')) {
                    $mgallary = new SlideContentClass();
                    if (method_exists($mgallary, 'getMediaGallery')) {
                      $result = $mgallary->getMediaGallery();
                      if ($result) {
                        $i = 0;
                        while ($rows = $result->fetch_assoc()) {
                          $i++;
                  ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $rows['content_title']; ?></td>
                   <td><?php 
                   echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
                      "<iframe width=\"420\" height=\"230\" src=\"//www.youtube.com/embed/$1\" frameborder=\"0\" allowfullscreen></iframe>",
                      $rows['youtube_video_url']);
                    ?></td>
                   <td><a class="btn btn-danger onclick_mgallery_data" data-mgallery_id="<?php echo $rows['mg_id']; ?>" href="#"><i class="fa fa-trash"></i> Delete </a></td>
                 </tr>
                <?php  } } } } ?>
                </tbody>
              </table>
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
     $(document).on('click', '.onclick_mgallery_data', (function() {
         var mgallery_id = $(this).data('mgallery_id');

          $.ajax({
                type: "post",
                url: "ajax/mgallery_del_ajax.php",
                data: {mgallery_id:mgallery_id},
                success: function(del){
                  $('#message_data').html(del);
                },
                error: function(err){
                  alert(err);
                }
          });
     }));
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){

    $('#media_gallary_form').on('submit', function(e) {

      var content_title     = $('#content_title').val();
      var youtube_video_url = $('#youtube_video_url').val();
      
      if (content_title == "" && youtube_video_url == "") {

        $('#err_content_title').addClass('has-error');
        $('#err_youtube_video_url').addClass('has-error');
        $('#err_content_title_msg').html("<div class='text-red'> Content Title must not be Empty!</div>");
        $('#err_youtube_video_url_msg').html("<div class='text-red'> YouTube video url must not be Empty! </div>");
          return false;
        } else if(content_title == "") {

        $('#err_content_title').addClass('has-error');
        $('#err_content_title_msg').html("<div class='text-red'> Content Title must not be Empty!</div>");
          return false;
        } else if(youtube_video_url == "") {

         $('#err_youtube_video_url').addClass('has-error');
         $('#err_youtube_video_url_msg').html("<div class='text-red'> YouTube video url must not be Empty! </div>");
         return false;
       } else{

          var form_data = new FormData();

          form_data.append('content_title', content_title);
          form_data.append('youtube_video_url', youtube_video_url);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/media_gallary_add_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(media_gallary_data){
                 $('#msg_message').html(media_gallary_data);
               }
            });
            return false;
       }

    });
  });
</script>

