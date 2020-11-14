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
 <!-- Modal -->
  <div id="branchesEdit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
          <div id="upmsg_message"></div>
        </div>
        <div class="modal-body" id="branches_des">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>

<!-- Add Partner Modal -->
<div id="addBranchesModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Branches </strong></h4>
        <div id="msg_message"></div>
      </div>
      <div class="modal-body">
         <form id="branches_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div id="err_branches_name" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="branches_name"> Branches Name <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="branches_name" id="branches_name" placeholder="Branches Name">
            <div id="err_branches_name_msg"></div>
          </div>
        </div>        
        <div id="err_branches_address" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="branches_address"> Address <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="branches_address" id="branches_address" placeholder="Address">
            <div id="err_branches_address_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="branches_phone"> Phone Number </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="branches_phone" id="branches_phone" placeholder="Phone Number">
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="branches_email"> Email </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="branches_email" id="branches_email" placeholder="Email">
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="division"> Division </label>
          <div class="col-sm-10">
            <?php 
               if (class_exists('BranchesClass')) {
                    $bs = new BranchesClass();
                    if (method_exists($bs, 'divisionGet')) {
                     $bs->divisionGet();
                    }
                }
            ?>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_branches_data" class="btn btn-success btn-lg"> Submit </button>
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

              <h3 class="box-title"> Branches List </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-lg" data-target="#addBranchesModal" data-toggle="modal"
                        title="Add Partner">
                  <i class="fa fa-plus"></i> Add Branches </button>
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
                  <th> Address </th>
                  <th> Phone </th>
                  <th> Email </th>
                  <th> Division </th>
                  <th> Action </th>
                </tr>
                </thead>
                <tbody>
                 <?php 

                  if (class_exists('BranchesClass')) {
                    $bs = new BranchesClass();
                    if (method_exists($bs, 'getBranchesClass')) {
                      $result = $bs->getBranchesClass();
                      if ($result) {
                        $i = 0;
                        while ($rows = $result->fetch_assoc()) {
                          $i++;
                        
                 ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $rows['branches_name']; ?></td>
                   <td><?php echo $rows['branches_address']; ?></td>
                   <td><?php echo $rows['branches_phone']; ?></td>
                   <td><?php echo $rows['branches_email']; ?></td>
                   <td><?php echo $rows['division']; ?></td>
                   <td width="20%"><a class="btn btn-warning onclick_data" data-branchesid="<?php echo $rows['branches_id']; ?>" data-toggle="modal" data-target="#branchesEdit" href="#"><i class="fa fa-edit"></i> Edit </a>
                   <button type="button" class="btn btn-danger onclick_del" data-branches_id="<?php echo $rows['branches_id']; ?>"><i class="fa fa-trash-o"></i> Delete </button>
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
     $(document).on('click', '.onclick_del', (function() {
         var branches_id = $(this).data('branches_id');

          $.ajax({
                type: "post",
                url: "ajax/branches_del_ajax.php",
                data: {branches_id:branches_id,branches_data:99},
                success: function(del){
                  $('#message_data').html(del);
                },
                error: function(err){
                  alert(err);
                }
          });

     }));

$(document).on('click', '.onclick_data', (function() {
   var branches_id = $(this).data('branchesid');
    $.ajax({
          type: "post",
          url: "ajax/branches_edit_ajax.php",
          data: {branches_id:branches_id,branches_data:99},
          success: function(data){
            $('#branches_des').html(data);

            // Update branches by branches id

    $('#branches_form_update').on('submit', function(e) {
      
      var branches_id      = $('#branches_id_edit').val();
      var branches_name    = $('#branches_name_edit').val();
      var branches_address = $('#branches_address_edit').val();
      var branches_phone   = $('#branches_phone_edit').val();
      var branches_email   = $('#branches_email_edit').val();
      var division         = $('#division_edit').val();
      
      if (branches_name == "" && branches_address == "") {

        $('#err_branches_name_edit').addClass('has-error');
        $('#err_branches_address_edit').addClass('has-error');
                  
        $('#err_branches_name_edit_msg').html("<div class='text-red'> Branches Name Field must not be Empty!</div>");
        $('#err_branches_address_edit_msg').html("<div class='text-red'> Branches Address must not be Empty!</div>");

          return false;
        } else if(branches_name == "") {

        $('#err_branches_name_edit').addClass('has-error');
        $('#err_branches_name_edit_msg').html("<div class='text-red'> Branches Name Field must not be Empty!</div>");
          return false;

        }else if(branches_address == "") {

         $('#err_branches_address_edit').addClass('has-error');
         $('#err_branches_address_edit_msg').html("<div class='text-red'> Branches Address must not be Empty! </div>");

         return false;
       } else{

          var form_data = new FormData();

            form_data.append('branches_id', branches_id);
            form_data.append('branches_name', branches_name);
            form_data.append('branches_address', branches_address);
            form_data.append('branches_phone', branches_phone);
            form_data.append('branches_email', branches_email);
            form_data.append('division', division);
            form_data.append('branches_data', 99);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/branches_update_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(branches_update){
                 $('#upmsg_message').html(branches_update);
               }
            });
            return false;
            }

            });
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

    $('#branches_form').on('submit', function(e) {

      var branches_name    = $('#branches_name').val();
      var branches_address = $('#branches_address').val();
      var branches_phone   = $('#branches_phone').val();
      var branches_email   = $('#branches_email').val();
      var division         = $('#division').val();
      
      
      if (branches_name == "" && branches_address == "") {

        $('#err_branches_name').addClass('has-error');
        $('#err_branches_address').addClass('has-error');
                  
        $('#err_branches_name_msg').html("<div class='text-red'> Branches Name Field must not be Empty!</div>");
        $('#err_branches_address_msg').html("<div class='text-red'> Branches Address must not be Empty!</div>");

          return false;
        } else if(branches_name == "") {

        $('#err_branches_name').addClass('has-error');
        $('#err_branches_name_msg').html("<div class='text-red'> Branches Name Field must not be Empty!</div>");
          return false;

        }else if(branches_address == "") {

         $('#err_branches_address').addClass('has-error');
         $('#err_branches_address_msg').html("<div class='text-red'> Branches Address must not be Empty! </div>");

         return false;
       } else{

          var form_data = new FormData();

            form_data.append('branches_name', branches_name);
            form_data.append('branches_address', branches_address);
            form_data.append('branches_phone', branches_phone);
            form_data.append('branches_email', branches_email);
            form_data.append('division', division);
            form_data.append('branches_data', 99);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/branches_add_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(branches_data){
                 $('#msg_message').html(branches_data);
               }
            });
            return false;
       }

    });
  });
</script>