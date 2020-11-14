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
  <div id="psPolicyDetails" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
        </div>
        <div class="modal-body" id="policy_data_view">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>
 <!-- End View Details Modal -->
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
<div id="addPSPolicyModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Policy </strong></h4>
        <div id="ps_policy_message"></div>
      </div>
      <div class="modal-body">
         <form id="ps_policy_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
         <input type="hidden" name="services_url" id="services_url" value="<?php echo $currentpage; ?>">
        <div id="err_policy_name" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="policy_name"> Policy Name <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="policy_name" id="policy_name" placeholder="Policy Name">
            <div id="err_policy_name_msg"></div>
          </div>
        </div>
        <div id="err_policy_img" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="policy_img"> Image <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="policy_img" name="policy_img" accept="image/*">
            <p style="color: red;"><small></small></p>
            <div id="err_policy_img_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="policy_des"> Policy Details </label>
          <div class="col-sm-10">
            <textarea class="form-control" name="policy_des" rows="8" id="policy_des"></textarea>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="highlights"> Highlights </label>
          <div class="col-sm-10">
            <textarea class="form-control textarea" name="highlights" rows="8" id="highlights"></textarea>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="covered"> Covered </label>
          <div class="col-sm-10">
            <textarea class="form-control textarea" name="covered" rows="8" id="covered"></textarea>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="exclusions"> Exclusions </label>
          <div class="col-sm-10">
            <textarea class="form-control textarea" name="exclusions" rows="8" id="exclusions"></textarea>
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_policy_data" class="btn btn-success btn-lg"> Submit </button>
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
   <?php 
    if (class_exists('ServicesClass')) {
      $ps = new ServicesClass();
      if (method_exists($ps, 'productsServicesByAdminCurrentPage')) {
        $result = $ps->productsServicesByAdminCurrentPage($currentpage);
        if ($result) {
          while ($rows = $result->fetch_assoc()) {
            $id         = $rows['id'];
            $ps_title   = $rows['ps_title'];
            $ps_url     = $rows['ps_url'];
            $ps_details = htmlspecialchars_decode(stripslashes($rows['ps_details']));
            $ps_image   = $rows['ps_image'];
            $status     = $rows['status'];
            $create_date= $rows['create_date'];

          $img = "../images/services/".$id."/".$ps_image;
          if (!file_exists($img)) {
             $img = "../img/logo.png";
           }
   ?>
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12">
          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header" style="margin-bottom: 20px;">
              <i class="fa fa-list"></i>

              <h3 class="box-title"> <?php echo $ps_title; ?> </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <a href="#imran_policy" class="btn btn-success btn-lg"
                        title="Policy">
                  <i class="fa fa-list"></i> Policy </a>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="message_data"></div>
               <table class="table table-bordered table-striped">
                <thead>
                <tr style="font-weight:bold;font-size:20px;">
                  <th width="20%"> Status & Action </th>
                  <td>
                    <?php if ($status != 0) { ?>
                    <button type="button" class="btn btn-success" style="margin-right:5%;cursor: unset;"><i class="fa fa-eye"></i> Site View Active </button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-warning" style="margin-right:5%;cursor: unset;
                    "><i class="fa fa-eye-slash"></i> Site View Deactivate </button>
                    <?php } ?>
                    <a class="btn btn-info onclick_data" data-psid="<?php echo $id; ?>" data-toggle="modal" data-target="#servicesDetails" href="#"><i class="fa fa-eye"></i> View </a>
                    <a href="services_edit.php?psuid=<?php echo $id; ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>                   
                    

                    <?php if ($status != 0) { ?>
                    <button type="button" class="btn btn-warning onclic_del_services" data-servicesid="<?php echo $id; ?>" data-status="0"><i class="fa fa-exclamation-triangle"></i> Disable </button>
                   <?php } else{ ?>
                    <button type="button" class="btn btn-success onclic_del_services" data-servicesid="<?php echo $id; ?>" data-status="1"><i class="fa fa-check"></i>
                      Enable
                    </button>
                   <?php } ?>
                  </td>
                </tr>
                </thead>
                <tbody>
                 <tr style="font-weight:bold;font-size:20px;">
                   <td>Services Name: </td>
                   <td><?php if (!empty($ps_title)) { echo $ps_title; } ?></td>
                 </tr>
                 <tr style="font-weight:bold;font-size:20px;">
                   <td width="20%">Image: </td>                   
                   <td><img src="<?php echo $img; ?>" style="max-width:90%;height:auto;"></td>
                 </tr>
                 <tr style="font-weight:bold;font-size:20px;">
                   <td> Create Date: </td>
                   <td><?php if (!empty($create_date)) { echo $create_date; } ?></td>
                 </tr>
                 <tr>
                   <td style="font-weight:bold;font-size:20px;" width="20%"> Details: </td>
                   <td><?php if (!empty($ps_details)) { echo $ps_details; } ?></td>
                 </tr>
                </tbody>
              </table>
            </div>
          </div>

        </section>

        <section class="col-lg-12" id="imran_policy">
          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header" style="margin-bottom: 20px;">
              <i class="fa fa-list"></i>

              <h3 class="box-title"> <?php echo $ps_title; ?> Policy </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-lg" data-target="#addPSPolicyModal" data-toggle="modal"
                        title="Add Policy">
                  <i class="fa fa-plus"></i>  Add Policy </button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">
              <div id="policy_data_status"></div>
               <table class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> No </th>
                  <th>Policy Name</th>
                  <th>Create Date</th>
                  <th>Image </th>
                  <th>Status</th>
                  <th>Action</th>                 
                </tr>
                </thead>
                <tbody>
               <?php 
                if (method_exists($ps, 'psPolicyByAdminCurrentPage')) {
                  $psdata = $ps->psPolicyByAdminCurrentPage($currentpage);
                  if ($psdata) {
                    $pi = 0;
                    while ($prows = $psdata->fetch_assoc()) {
                      $pi++;

                      $policy_id     = $prows['policy_id'];
                      $services_url  = $prows['services_url'];
                      $policy_name   = $prows['policy_name'];
                      $policy_img    = $prows['policy_img'];
                      $policy_status = $prows['policy_status'];
                      $pcreate_date  = $prows['create_date'];

                      $policy_des = htmlspecialchars_decode(stripslashes($prows['policy_des']));
                      $highlights = htmlspecialchars_decode(stripslashes($prows['highlights']));
                      $covered = htmlspecialchars_decode(stripslashes($prows['covered']));
                      $exclusions = htmlspecialchars_decode(stripslashes($prows['exclusions']));                      

                    $plicyimg = "../images/services/".$services_url."/policy/".$policy_id."/".$policy_img;
                    if (!file_exists($plicyimg)) {
                       $plicyimg = "../img/logo.png";
                     }
               ?>
                 <tr style="font-weight:bold;font-size:20px;">
                   <td><?php echo $pi; ?></td>
                   <td><?php if (!empty($policy_name)) { echo $policy_name; } ?></td>
                   <td><?php if (!empty($pcreate_date)) { echo $pcreate_date; } ?></td>
                   <td><img src="<?php echo $plicyimg; ?>" width="100" height="auto"></td>
                   <td>
                    <?php if ($policy_status != 0) { ?>
                    <button type="button" class="btn btn-success btn-block" style="cursor: unset;
                    "><i class="fa fa-eye"></i> Site View Active </button>
                    <?php } else { ?>
                    <button type="button" class="btn btn-warning btn-block" style="cursor: unset;
                    "><i class="fa fa-eye-slash"></i> Site View Deactivate </button>
                    <?php } ?>
                   </td>
                    <td>    
                    <a class="btn btn-info onclick_policy_data" data-pspolicyid="<?php echo $policy_id; ?>" data-ps_plicy_url="<?php echo $services_url;  ?>" data-toggle="modal" data-target="#psPolicyDetails" href="#"><i class="fa fa-eye"></i> View </a>
                    <a href="policy_edit.php?psplicyid=<?php echo $policy_id; ?>" class="btn btn-primary"><i class="fa fa-edit"></i> Edit</a>  

                    <?php if ($policy_status != 0) { ?>
                    <button type="button" class="btn btn-warning onclic_policy_status" data-policyid="<?php echo $policy_id; ?>" data-policy_status="0"><i class="fa fa-exclamation-triangle"></i> Disable </button>
                   <?php } else{ ?>
                    <button type="button" class="btn btn-success onclic_policy_status" data-policyid="<?php echo $policy_id; ?>" data-policy_status="1"><i class="fa fa-check"></i>
                      Enable
                    </button>
                   <?php } ?>
                   <button type="button" class="btn btn-danger onclic_del_policy" data-policydelid="<?php echo $policy_id; ?>" data-pscurrentp="<?php echo $services_url; ?>"><i class="fa fa-trash"></i>
                      Delete
                    </button>
                  </td>
                 </tr>
                <?php } } } ?>
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
  <?php  } } } } ?>
  </div>
  <!-- /.content-wrapper -->
<?php include "inc/footer.php"; ?>
<script src="js/services_policy.js"></script>

