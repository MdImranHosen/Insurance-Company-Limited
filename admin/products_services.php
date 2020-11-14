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
  <div id="servicesDetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body" id="products_services_content">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>
 <!-- End View Details Modal -->
<!-- Add Product Services Modal -->
<div id="addProductServicesModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Products & Services </strong></h4>
        <div id="products_services_message"></div>
      </div>
      <div class="modal-body">
         <form id="products_services_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div id="err_ps_icon" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="ps_icon"> Services Icon <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="ps_icon" id="ps_icon" value="flaticon-telegram-logo">
            <p style="color: red;"><small>Like: fa fa-facebook </small></p>
            <div id="err_ps_icon_msg"></div>
          </div>
        </div>
        <div id="err_ps_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="ps_title"> Services Name <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="ps_title" id="ps_title" placeholder="Products & Services Name">
            <div id="err_ps_title_msg"></div>
          </div>
        </div>
        <div id="err_ps_img" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="ps_img"> Services Image <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="ps_img" name="ps_img" accept="image/*">
            <div id="err_ps_img_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="ps_details"> Services Details </label>
          <div class="col-sm-10">
            <textarea class="form-control textarea" name="ps_details" rows="8" id="ps_details"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_ps_data" class="btn btn-success btn-lg"> Submit </button>
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

              <h3 class="box-title"> Products & Services </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-lg" data-target="#addProductServicesModal" data-toggle="modal"
                        title="Add Slide">
                  <i class="fa fa-plus"></i> Add Products & Services </button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="message_data"></div>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> NO </th>
                  <th> Services Title </th>
                  <th> Create Date </th>
                  <th> Photo </th>
                  <th> Action </th>
                </tr>
                </thead>
                <tbody>
                 <?php 
                  if (class_exists('ServicesClass')) {
                    $ps = new ServicesClass();
                    if (method_exists($ps, 'getProductsServicesData')) {
                      $result = $ps->getProductsServicesData();
                      if ($result) {
                        $i = 0;
                        while ($rows = $result->fetch_assoc()) {
                          $i++;

                        $img = "../images/services/".$rows['id']."/".$rows['ps_image'];
                        if (!file_exists($img)) {
                           $img = "../img/logo.png";
                         }
                 ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $rows['ps_title']; ?></td>
                   <td><?php echo $rows['create_date']; ?></td>
                   <td><img src="<?php echo $img; ?>" width="100" height="auto"></td>
                   <td><a class="btn btn-info onclick_data" data-psid="<?php echo $rows['id']; ?>" data-toggle="modal" data-target="#servicesDetails" href="#"><i class="fa fa-eye"></i> View </a>
                    <a href="services_edit.php?psuid=<?php echo $rows['id']; ?>" class="btn btn-warning"><i class="fa fa-edit"></i> Edit</a>
                    <button type="button" class="btn btn-danger onclic_del_services" data-servicesid="<?php echo $rows['id']; ?>"><i class="fa fa-trash-o"></i> Delete </button>
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
     $(document).on('click', '.onclic_del_services', (function() {
         var servicesid = $(this).data('servicesid');

          $.ajax({
                type: "post",
                url: "ajax/services_del_ajax.php",
                data: {servicesid:servicesid},
                success: function(del) {
                  $('#message_data').html(del);
                },
                error: function(err){
                  alert(err);
                }
          });

     }));

     $(document).on('click', '.onclick_data', (function() {

         var psid = $(this).data('psid');
          $.ajax({
                type: "post",
                url: "ajax/services_details_ajax.php",
                data: {psid:psid},
                success: function(data){
                  $('#products_services_content').html(data);
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

    $('#products_services_form').on('submit', function(e) {
      
      var ps_icon    = $('#ps_icon').val();
      var ps_title   = $('#ps_title').val();
      var ps_details = $('#ps_details').val();
      var ps_img     = $('#ps_img').prop('files')[0];
      
      
     if (ps_icon == "" && ps_title == "" && (document.getElementById("ps_img").files.length ==0)) {

        $('#err_ps_icon').addClass('has-error');
        $('#err_ps_title').addClass('has-error');
        $('#err_slide_bg_img').addClass('has-error');

        $('#err_ps_icon_msg').html("<div class='text-red'> Services Icon is Required!</div>");
        $('#err_ps_title_msg').html("<div class='text-red'> Services Name is Required!</div>");
        $('#err_ps_img_msg').html("<div class='text-red'> Services Image is Required!</div>");
          return false;
        } else if(ps_icon == "") {

        $('#err_ps_icon').addClass('has-error');
        $('#err_ps_icon_msg').html("<div class='text-red'> Services Icon is Required!</div>");
          return false;
        } else if(ps_title == "") {

        $('#err_ps_title').addClass('has-error');
        $('#err_ps_title_msg').html("<div class='text-red'> Services Name is Required!</div>");
          return false;
        } else if(document.getElementById("ps_img").files.length ==0) {

         $('#err_ps_img').addClass('has-error');
         $('#err_ps_img_msg').html("<div class='text-red'>Services Image is Required! </div>");         
         return false;
       } else{

            var form_data = new FormData();
            
            form_data.append('ps_icon', ps_icon);
            form_data.append('ps_title', ps_title);
            form_data.append('ps_img', ps_img);
            form_data.append('ps_details', ps_details);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/products_services_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(products_services_data){
                 $('#products_services_message').html(products_services_data);
               }
            });
            return false;
       }

    });
  });
</script>

