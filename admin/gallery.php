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
<div id="addGallaryModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Gallary Image </strong></h4>
        <div id="msg_message"></div>
      </div>
      <div class="modal-body">
         <form id="gallary_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div id="err_content_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="content_title"> Content Title <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="content_title" id="content_title" placeholder="Content Title">
            <div id="err_content_title_msg"></div>
          </div>
        </div>
        <div id="err_gallery_image" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="gallery_image"> Image <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="gallery_image" name="gallery_image" accept="image/*">
            <div id="err_gallery_image_msg"></div>
            <span><small style="color: red;">Image Size Should be width:auto & Height: 370px!</small></span>
          </div>
        </div>
              
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_gallery_data" class="btn btn-success btn-lg"> Submit </button>
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

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header" style="margin-bottom: 20px;">
              <i class="fa fa-list"></i>

              <h3 class="box-title"> Gallary </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-lg" data-target="#addGallaryModal" data-toggle="modal"
                        title="Add Gallary">
                  <i class="fa fa-plus"></i> Add Gallary</button>
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
                  <th> Photo </th>
                  <th> Action </th>
                </tr>
                </thead>
                <tbody>
                 <?php 

                  if (class_exists('SlideContentClass')) {
                    $mgallary = new SlideContentClass();
                    if (method_exists($mgallary, 'getGallery')) {
                      $result = $mgallary->getGallery();
                      if ($result) {
                        $i = 0;
                        while ($rows = $result->fetch_assoc()) {
                          $i++;

                        $img = "../images/gallery/".$rows['mg_id']."/".$rows['gallery_image'];
                        if (!file_exists($img)) {
                           $img = "../images/gallery/1.jpg"; 
                         }
                 ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $rows['content_title']; ?></td>
                   <td><img src="<?php echo $img; ?>" width="100" height="auto"></td>
                   <td>
                    <a class="btn btn-danger onclick_gallery_data" data-gallery_id="<?php echo $rows['mg_id']; ?>" onClick="return confirm('Are you sure to Delete!');" href="#"><i class="fa fa-trash"></i> Delete </a>
                   </td>
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
     $(document).on('click', '.onclick_gallery_data', (function() {

         var gallery_id = $(this).data('gallery_id');

          $.ajax({
                type: "post",
                url: "ajax/gallery_del_ajax.php",
                data: {gallery_id:gallery_id},
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

    $('#gallary_form').on('submit', function(e) {

      var content_title = $('#content_title').val();
      var gallery_image = $('#gallery_image').prop('files')[0];
      
      if (content_title == "" && (document.getElementById("gallery_image").files.length ==0)) {

        $('#err_content_title').addClass('has-error');
        $('#err_gallery_image').addClass('has-error');
        $('#err_content_title_msg').html("<div class='text-red'> Content Title must not be Empty!</div>");
        $('#err_gallery_image_msg').html("<div class='text-red'> Image must not be Empty! </div>");
          return false;
        } else if(content_title == "") {

        $('#err_content_title').addClass('has-error');
        $('#err_content_title_msg').html("<div class='text-red'> Content Title must not be Empty!</div>");
          return false;
        } else if(document.getElementById("gallery_image").files.length ==0) {

         $('#err_gallery_image').addClass('has-error');
         $('#err_gallery_image_msg').html("<div class='text-red'> Image must not be Empty! </div>");
         return false;
       } else{

          var form_data = new FormData();

          form_data.append('content_title', content_title);
          form_data.append('gallery_image', gallery_image);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/gallery_add_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(gallary_data){
                 $('#msg_message').html(gallary_data);
               }
            });
            return false;
       }

    });
  });
</script>

