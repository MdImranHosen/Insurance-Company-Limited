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
 <!-- Start View Details Modal -->
  <div id="newsEventsDetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body" id="news_events_content">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>
 <!-- End View Details Modal -->
<!-- Add Product Services Modal -->
<div id="addNewsEventsModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add <?php echo $pageName; ?> </strong></h4>
        <div id="news_events_message"></div>
      </div>
      <div class="modal-body">
         <form id="news_events_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div id="err_news_events_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="news_events_title"> Title <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="news_events_title" id="news_events_title" placeholder="News & Events Title">
            <div id="err_news_events_title_msg"></div>
          </div>
        </div>
        <div id="err_news_events_date" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="news_events_date"> Date <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="news_events_date" id="news_events_date" placeholder="Events Date">
            <div id="err_news_events_date_msg"></div>
          </div>
        </div>
        <div id="err_news_events_img" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="news_events_img"> Image <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="news_events_img" name="news_events_img" accept="image/*">
            <div id="err_news_events_img_msg"><span class="text-red"><small>Image size should be Width 370 px * Height 200 PX </small></span></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="news_events_des"> Details </label>
          <div class="col-sm-10">
            <textarea class="form-control" name="news_events_des" rows="8" id="news_events_des"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_news_events_data" class="btn btn-success btn-lg"> Submit </button>
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

<!-- Add Products Services Modal -->

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

              <h3 class="box-title"> <?php echo $pageName; ?> </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-lg" data-target="#addNewsEventsModal" data-toggle="modal"
                        title="Add Slide">
                  <i class="fa fa-plus"></i> Add <?php echo $pageName; ?> </button>
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
                  <th> Create Date </th>
                  <th> Photo </th>
                  <th> Action </th>
                </tr>
                </thead>
                <tbody>
                 <?php 
                  if (class_exists('NewsEventsClass')) {
                    $neObj = new NewsEventsClass();
                    if (method_exists($neObj, 'getNewsEventsData')) {
                      $result = $neObj->getNewsEventsData();
                      if ($result) {
                        $i = 0;
                        while ($rows = $result->fetch_assoc()) {
                          $i++;
                          $news_events_id    = $rows['news_events_id'];
                          $news_events_title = $rows['news_events_title'];
                          $news_events_file  = $rows['news_events_file'];
                          $create_date       = $rows['create_date'];

                        $img = "../news_events/".$news_events_id."/".$news_events_file;
                        if (!file_exists($img)) {
                           $img = "../img/logo.png";
                         }
                 ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $news_events_title; ?></td>
                   <td><?php echo $create_date; ?></td>
                   <td><img src="<?php echo $img; ?>" width="100" height="auto"></td>
                   <td><a class="btn btn-info onclick_data" data-newseventsid="<?php echo $rows['news_events_id']; ?>" data-toggle="modal" data-target="#newsEventsDetails" href="#"><i class="fa fa-eye"></i> View </a>
                    <a href="news_events_edit.php?nesuid=<?php echo $news_events_id; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-danger onclic_del" data-news_events_delid="<?php echo $news_events_id; ?>"><i class="fa fa-trash-o"></i> Delete </button>
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
     $(document).on('click', '.onclic_del', (function() {
         var news_events_delid = $(this).data('news_events_delid');

          $.ajax({
                type: "post",
                url: "ajax/news_events_del_ajax.php",
                data: {news_events_delid:news_events_delid,news_events_del_data:99},
                success: function(del) {
                  $('#message_data').html(del);
                },
                error: function(err){
                  alert(err);
                }
          });

     }));

     $(document).on('click', '.onclick_data', (function() {

         var newseventsid = $(this).data('newseventsid');
          $.ajax({
                type: "post",
                url: "ajax/news_events_details_ajax.php",
                data: {newseventsid:newseventsid,newsevents_data:99},
                success: function(news_events_data){
                  $('#news_events_content').html(news_events_data);
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

     $('#news_events_des').summernote();

    $('#news_events_form').on('submit', function(e) {
      
      var news_events_title = $('#news_events_title').val();
      var news_events_date  = $('#news_events_date').val();
      var news_events_des   = $('#news_events_des').val();
      var news_events_img   = $('#news_events_img').prop('files')[0];      
      
     if (news_events_title == "" && news_events_date == "" && (document.getElementById("news_events_img").files.length ==0)) {

        $('#err_news_events_title').addClass('has-error');
        $('#err_news_events_date').addClass('has-error');
        $('#err_news_events_img_img').addClass('has-error');

        $('#err_news_events_title_msg').html("<div class='text-red'> Title is Required!</div>");
        $('#err_news_events_date_msg').html("<div class='text-red'> Date is Required!</div>");
        $('#err_news_events_img_msg').html("<div class='text-red'> Image is Required!</div>");
          return false;
        } else if(news_events_title == "") {

        $('#err_news_events_title').addClass('has-error');
        $('#err_news_events_title_msg').html("<div class='text-red'> Title is Required!</div>");
          return false;
        } else if(news_events_date == "") {

        $('#err_news_events_date').addClass('has-error');
        $('#err_news_events_date_msg').html("<div class='text-red'> Date is Required!</div>");
          return false;
        } else if(document.getElementById("news_events_img").files.length ==0) {

         $('#err_news_events_img').addClass('has-error');
         $('#err_news_events_img_msg').html("<div class='text-red'> Image is Required! </div>");         
         return false;
       } else{

            var form_data = new FormData();
            
            form_data.append('news_events_title', news_events_title);
            form_data.append('news_events_date', news_events_date);
            form_data.append('news_events_img', news_events_img);
            form_data.append('news_events_des', news_events_des);
            form_data.append('news_events_add_data', 99);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/news_events_add_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(news_eventsadd_data){
                 $('#news_events_message').html(news_eventsadd_data);
               }
            });
            return false;
       }

    });
  });
</script>

