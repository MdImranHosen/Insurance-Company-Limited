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
  <div id="bodDetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body" id="bod_content">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>
 <!-- End View Details Modal -->
<!-- Add Product Services Modal -->
<div id="addBoardOfDirectorsModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add <?php echo $pageName; ?> </strong></h4>
        <div id="bod_message"></div>
      </div>
      <div class="modal-body">
         <form id="board_of_directors_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div id="err_bod_name" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="bod_name"> Name <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_name" id="bod_name" placeholder="Enter Name">
            <div id="err_bod_name_msg"></div>
          </div>
        </div>
        <div id="err_bod_designation" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="bod_designation"> Designation <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_designation" id="bod_designation" placeholder="Enter Designation">
            <div id="err_bod_designation_msg"></div>
          </div>
        </div>
        <div id="err_bod_img" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="bod_img"> Photo <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <span class="text-red">Image Size Should be Width 225 px <strong> * </strong> Height 250 px! </span>
            <input type="file" class="form-control" id="bod_img" name="bod_img" accept="image/*">
            <div id="err_bod_img_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="bod_description"> Description </label>
          <div class="col-sm-10">
            <textarea class="form-control" name="bod_description" rows="8" id="bod_description"></textarea>
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="bod_fb"> Facebook </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_fb" id="bod_fb" placeholder="Facebook Username">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="bod_tw"> Twitter </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_tw" id="bod_tw" placeholder="Twitter Username">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="bod_pt"> Pinterest </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_pt" id="bod_pt" placeholder="Pinterest Username">
          </div>
        </div>
        <div class="form-group">
          <label class="control-label col-sm-2" for="bod_lk"> Linkedin </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="bod_lk" id="bod_lk" placeholder="Linkedin Username">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_bod_data" class="btn btn-success btn-lg"> Submit </button>
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
                <button type="button" class="btn btn-success btn-lg" data-target="#addBoardOfDirectorsModal" data-toggle="modal"
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
                  <th> Name </th>
                  <th> Designation </th>
                  <th> Photo </th>
                  <th> Action </th>
                </tr>
                </thead>
                <tbody>
                 <?php 
                  if (class_exists('EmployerClass')) {
                    $em = new EmployerClass();
                    if (method_exists($em, 'getBoardOfDirectors')) {
                      $result = $em->getBoardOfDirectors('senior_development_team');
                      if ($result) {
                        $i = 0;
                        while ($rows = $result->fetch_assoc()) {
                          $i++;

                        $img = "../images/senior_development_team/".$rows['em_id']."/".$rows['em_photo'];
                        if (!file_exists($img)) {
                           $img = "../img/logo.png";
                         }
                 ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $rows['em_name']; ?></td>
                   <td><?php echo $rows['em_designation']; ?></td>
                   <td><img src="<?php echo $img; ?>" width="100" height="auto"></td>
                   <td><a class="btn btn-info onclick_data" data-bodvid="<?php echo $rows['em_id']; ?>" data-toggle="modal" data-target="#bodDetails" href="#"><i class="fa fa-eye"></i> View </a>
                    <a href="senior_development_team_edit.php?bodeid=<?php echo $rows['em_id']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-danger onclic_del_bod" data-bod_id="<?php echo $rows['em_id']; ?>"><i class="fa fa-trash-o"></i> Delete </button>
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
     $(document).on('click', '.onclic_del_bod', (function() {
         var bod_id = $(this).data('bod_id');
         var em_type = "senior_development_team";
          $.ajax({
                type: "post",
                url: "ajax/bod_del_ajax.php",
                data: {bod_id:bod_id,em_type:em_type},
                success: function(del) {
                  $('#message_data').html(del);
                },
                error: function(err){
                  alert(err);
                }
          });

     }));

     $(document).on('click', '.onclick_data', (function() {

         var bodvid = $(this).data('bodvid');
         var em_type = "senior_development_team";
          $.ajax({
                type: "post",
                url: "ajax/bod_details_ajax.php",
                data: {bodvid:bodvid,em_type:em_type},
                success: function(data){
                  $('#bod_content').html(data);
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
     //Text Editor 
    $('#bod_description').summernote();

    $('#board_of_directors_form').on('submit', function(e) {
      
      var bod_name = $('#bod_name').val();
      var bod_designation = $('#bod_designation').val();
      var bod_description = $('#bod_description').val();
      var bod_fb = $('#bod_fb').val();
      var bod_tw = $('#bod_tw').val();
      var bod_pt = $('#bod_pt').val();
      var bod_lk = $('#bod_lk').val();
      var em_type= "senior_development_team"; 
      var bod_img= $('#bod_img').prop('files')[0];
      
      
     if (bod_name == "" && bod_designation == "" && (document.getElementById("bod_img").files.length ==0)) {

        $('#err_bod_name').addClass('has-error');
        $('#err_bod_designation').addClass('has-error');
        $('#err_bod_img').addClass('has-error');

        $('#err_bod_name_msg').html("<div class='text-red'> Name is Required!</div>");
        $('#err_bod_designation_msg').html("<div class='text-red'> Designation is Required!</div>");
        $('#err_bod_img_msg').html("<div class='text-red'> Image is Required!</div>");
          return false;
        } else if(bod_name == "") {

        $('#err_bod_name').addClass('has-error');
        $('#err_bod_name_msg').html("<div class='text-red'> Name is Required!</div>");
          return false;
        } else if(bod_designation == "") {

        $('#err_bod_designation').addClass('has-error');
        $('#err_bod_designation_msg').html("<div class='text-red'> Designation is Required!</div>");
          return false;
        } else if(document.getElementById("bod_img").files.length ==0) {

         $('#err_bod_img').addClass('has-error');
         $('#err_bod_img_msg').html("<div class='text-red'>Photo is Required! </div>");         
         return false;
       } else{

            var form_data = new FormData();
            
            form_data.append('bod_name', bod_name);
            form_data.append('bod_designation', bod_designation);
            form_data.append('bod_img', bod_img);
            form_data.append('bod_description', bod_description);
            form_data.append('bod_fb', bod_fb);
            form_data.append('bod_tw', bod_tw);
            form_data.append('bod_pt', bod_pt);
            form_data.append('bod_lk', bod_lk);
            form_data.append('em_type', em_type);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/board_of_directors_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(bod_data){
                 $('#bod_message').html(bod_data);
               }
            });
            return false;
       }

    });
  });
</script>

