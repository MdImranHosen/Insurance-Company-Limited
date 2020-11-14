<?php include "inc/header.php"; ?>
<?php 
if ((Session::get('admin_type') != 2) || (Session::get('admin_ck') != 'emain_admin')) {
    Session::destroy();
    header("Location:login.php");
  }

?>
<body class="hold-transition skin-blue sidebar-mini" onload="instantiateTextbox();">
<div class="wrapper">

  <?php include "inc/header_bottom.php"; ?>
  <!-- Left side column. contains the logo and sidebar -->
<!--SideBar Start-->
  <?php include "inc/sidebar.php"; ?>
<!--SideBar End-->
<style type="text/css">
  .invalid-feedback{color: red;display: none;}
</style>

 <!-- Modal -->
  <div id="slideDetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body" id="slide_content">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>

<!-- Add Vendors Modal -->
<div id="addSlideContentModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Slide Content </strong></h4>
        <div id="slide_message"></div>
      </div>
      <div class="modal-body">
         <form id="slide_content_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">       

        <div id="err_slide_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="slide_title"> Slide Title <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="slide_title" id="slide_title" placeholder="Slide Title">
            <div id="err_slide_title_msg"></div>
          </div>
        </div>
        <div id="err_slide_bg_img" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="slide_bg_img"> Image <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <p class="text-red"><small> Image Width: 720px and Height: 500px; </small></p>
            <input type="file" class="form-control" id="slide_bg_img" name="slide_bg_img" accept="image/*">
            <div id="err_slide_bg_img_msg"></div>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_slide_data" class="btn btn-success btn-lg"> Submit </button>
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

<!-- Add Vendors Modal -->

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

              <h3 class="box-title"> Slide Content </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-lg" data-target="#addSlideContentModal" data-toggle="modal"
                        title="Add Slide">
                  <i class="fa fa-plus"></i> Add Slide Content </button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="message_data"></div>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> NO </th>
                  <th> Slide Title </th>
                  <th> Create Date </th>
                  <th> Photo </th>
                  <th> Action </th>
                </tr>
                </thead>
                <tbody>
                 <?php 
                  if (class_exists('SlideContentClass')) {
                    $slidecont = new SlideContentClass();
                    if (method_exists($slidecont, 'getSlideContentData')) {
                      $result = $slidecont->getSlideContentData();
                      if ($result) {
                        $i = 0;
                        while ($rows = $result->fetch_assoc()) {
                          $i++;

                        $img = "../images/main-slider/".$rows['slide_id']."/".$rows['slide_bg_img'];
                        if (!file_exists($img)) {
                           $img = "../img/logo.png";
                         }
                 ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $rows['slide_title']; ?></td>
                   <td><?php echo $rows['create_date']; ?></td>
                   <td><img src="<?php echo $img; ?>" width="100" height="auto"></td>
                   <td><a class="btn btn-info onclick_data" data-slideid="<?php echo $rows['slide_id']; ?>" data-toggle="modal" data-target="#slideDetails" href="#"><i class="fa fa-eye"></i> View </a>
                    <button type="button" class="btn btn-danger onclic_del_slide" data-slidedelid="<?php echo $rows['slide_id']; ?>"><i class="fa fa-trash-o"></i> Delete </button>
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
     $(document).on('click', '.onclic_del_slide', (function() {
         var slidedelid = $(this).data('slidedelid');

          $.ajax({
                type: "post",
                url: "ajax/slide_del_ajax.php",
                data: {slidedelid:slidedelid},
                success: function(del){
                  $('#message_data').html(del);
                },
                error: function(err){
                  alert(err);
                }
          });

     }));

     $(document).on('click', '.onclick_data', (function() {
         var slideid = $(this).data('slideid');
          $.ajax({
                type: "post",
                url: "ajax/slide_details_ajax.php",
                data: {slideid:slideid},
                success: function(data){
                  $('#slide_content').html(data);
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

    $('#slide_content_form').on('submit', function(e) {
      
      var slide_title     = $('#slide_title').val();
      var slide_bg_img    = $('#slide_bg_img').prop('files')[0];
      
      
     if (slide_title == "" && (document.getElementById("slide_bg_img").files.length ==0)) {

        $('#err_slide_title').addClass('has-error');
        $('#err_slide_bg_img').addClass('has-error');

        $('#err_slide_title_msg').html("<div class='text-red'> Slide Title must not be Empty!</div>");
        $('#err_slide_bg_img_msg').html("<div class='text-red'> Slide BG Image must not be Empty! </div>");

          return false;
        } else if(slide_title == "") {

        $('#err_slide_title').addClass('has-error');
        $('#err_slide_title_msg').html("<div class='text-red'> Slide Title must not be Empty!</div>");
          return false;

        } else if(document.getElementById("slide_bg_img").files.length ==0) {

         $('#err_slide_bg_img').addClass('has-error');
         $('#err_slide_bg_img_msg').html("<div class='text-red'> Slide BG Image must not be Empty! </div>");
         
         return false;
       } else{

            var form_data = new FormData();
            
            form_data.append('slide_title', slide_title);
            form_data.append('slide_bg_img', slide_bg_img);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/slide_content_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(slide_data){
                 $('#slide_message').html(slide_data);
               }
            });
            return false;
       }

    });
  });
</script>

