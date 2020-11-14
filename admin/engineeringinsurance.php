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
  <div id="digitalInsuranceModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body" id="detail_digital_info"></div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>
 <!-- End View Details Modal -->
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

              <h3 class="box-title"> Digital Engineering Insurance </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="digital_info_del"></div>
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr style="font-weight:bold;font-size:20px;">
                  <th> Name </th>
                  <th> Address </th>
                  <th> Telephone </th>
                  <th> Cell Number </th>
                  <th> Action </th>                  
                </tr>
                </thead>
                <tbody>
            <?php 
              if (class_exists('DigitalInsurance')) {
                $obj = new DigitalInsurance();
                if (method_exists($obj, 'productByIdgetDigitalInsurance')) {
                  $result = $obj->productByIdgetDigitalInsurance($currentpage);
                  if ($result) {
                    while ($rows = $result->fetch_assoc()) {
                      $id = $rows['id'];
                      $name = $rows['name'];
                      $address = $rows['address'];
                      $telephone_number = $rows['telephone_number'];
                      $cell_number = $rows['cell_number'];
                      $fax_number= $rows['fax_number'];
                      $email_address = $rows['email_address'];
                      $insert_to_be_covered = $rows['insert_to_be_covered'];
                      $abiwb = $rows['abiwb'];
                      $watrywtc = $rows['watrywtc'];
                      $conoftbuil = $rows['conoftbuil'];
                      $locationotp = $rows['locationotp'];
                      $services_name = $rows['services_name'];
                      $status = $rows['status'];
                      $create_date = $rows['create_date'];
                 
                ?>
                 <tr>
                   <td><?php if (!empty($name)) { echo $name; } ?></td>
                   <td><?php if (!empty($address)) { echo $address; } ?></td>
                   <td><?php if (!empty($telephone_number)) { echo $telephone_number; } ?></td>
                   <td><?php if (!empty($cell_number)) { echo $cell_number; } ?></td>                  
                   <td>
                    <a class="btn btn-info onclick_data" data-dgitalinid="<?php echo $id; ?>" data-toggle="modal" data-target="#digitalInsuranceModal" href="#"><i class="fa fa-eye"></i> View </a> 

                    <?php if ($status != 0) { ?>
                    <button type="button" class="btn btn-warning onclic_del_digitalin" data-digidelin="<?php echo $id; ?>"><i class="fa fa-trash"></i> Delete </button>
                   <?php } ?>
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
<script src="js/digital_insurance.js"></script>

