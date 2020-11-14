<?php include "inc/header.php"; ?>
<?php

 if ((Session::get('admin_type') != 2) || (Session::get('admin_ck') != 'emain_admin')) {
    Session::destroy();
    header("Location:login.php");
  }

# Admin by Id Delete Action get Code....
 if (isset($_GET['deleteAdmin']) && $_GET['deleteAdmin']) {
    $adId = preg_replace('/[^-a-zA-Z0-9_]/','', $_GET['deleteAdmin']);
    $adId = (int)$adId;
    $msg  = $admin->supperAdminDeleted($adId);
 }

?>
 <!-- Modal -->
  <div id="contactDetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body">
          <div id="message_content"></div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <?php include "inc/header_bottom.php"; ?>
  <!-- Left side column. contains the logo and sidebar -->
<!--SideBar Start-->
  <?php include "inc/sidebar.php"; ?>
<!--SideBar End-->
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
     <?php if (realpath('inc/admin_title.php')) {
      include_once 'inc/admin_title.php';
    } ?> 
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-envelope"></i>

              <h3 class="box-title">Message</h3>
            </div>
            <div class="box-body">

                <?php if(isset($msg)){ echo $msg; } ?>
                
                <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>NO</th>
                  <th>Name</th>
                  <th>Phone</th>
                  <th>Email</th>
                  <th>Create Date</th>
                  <th>Action</th>
                </tr>
                </thead>
                <tbody>
                 <?php 
                  if (class_exists('Contactclass')) {
                  $contect = new Contactclass();
                  if(method_exists($contect, 'getContactMessageshow')) {
                  $contactData = $contect->getContactMessageshow();
                  if(!empty($contactData)) {
                    $i = 0;
                    while ($showData = $contactData->fetch_assoc()) {
                      $i++;
                      $id = $showData['id'];
                 ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $showData['name']; ?></td>
                   <td><?php echo $showData['phone']; ?></td>
                   <td><?php echo $showData['email']; ?></td>
                   <td><?php echo $showData['create_date']; ?></td>
                   <td>
                     <button type="button" data-toggle="modal" data-target="#contactDetails" class="btn btn-warning onclick_view_message" data-message_id="<?php echo $id; ?>"><i class="fa fa-eye"></i> View</button>
                      <a class="btn btn-danger" href="?deleteMessage=<?php echo $id; ?>"><i class="fa fa-trash"></i> Delete </a>
                    </td>
                 </tr>
                  
                 <?php } } } } ?>
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
     $(document).on('click', '.onclick_view_message', (function() {
         var message_id = $(this).data('message_id');
          $.ajax({
                type: "post",
                url: "ajax/contact_message_view_ajax.php",
                data: {message_id:message_id,message_data:99},
                success: function(data){
                  $('#message_content').html(data);
                },
                error: function(err){
                  alert(err);
                }
          });

     }));
  });
</script>