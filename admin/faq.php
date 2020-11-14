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
<!-- Add Faq Faq Modal -->
<div id="addFaqModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Faq </strong></h4>
        <div id="faq_message"></div>
      </div>
      <div class="modal-body">
         <form id="faq_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div id="err_faq_ps_id" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="faq_ps_id"> Services <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <select class="form-control" name="faq_ps_id" id="faq_ps_id">
              <option value="0" style="cursor: pointer;display: hidden;"> Select Services </option>
                <?php 
                  if (class_exists('FaqClass')) {
                    $faqObj = new FaqClass();
                    if (method_exists($faqObj, 'getServicesFaqOption')) {
                       $faqObj->getServicesFaqOption();
                    }}
               ?>
            </select>
            <div id="err_faq_ps_id_msg"></div>
          </div>
        </div> 
        <div id="err_faq_ask" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="faq_ask"> Ask Question <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="faq_ask" id="faq_ask" placeholder="Faq Title">
            <div id="err_faq_ask_msg"></div>
          </div>
        </div>
        <div id="err_faq_solution" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="faq_solution"> Answer <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <textarea rows="8" class="form-control" name="faq_solution" id="faq_solution">              
            </textarea>
            <div id="err_faq_solution_msg"></div>
          </div>
        </div>                 
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_faq_data" class="btn btn-success btn-lg"> Submit </button>
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
<section class="col-lg-12">
<!-- quick email widget -->
<div class="box box-info">
  <div class="box-header" style="margin-bottom: 20px;">
    <i class="fa fa-list"></i>
    <h3 class="box-title"> Faq </h3>
    <!-- tools box -->
   <div class="pull-right box-tools">
      <button type="button" class="btn btn-success btn-lg" data-target="#addFaqModal" data-toggle="modal"
              title="Add Faq">
        <i class="fa fa-plus"></i> Add Faq </button>
    </div>
    <!-- /. tools -->
  </div>
  <div class="box-body">
    <div id="faq_message_data"></div>
    <div class="table-responsive">
     <table class="table table-bordered table-striped">
      <thead>
      <tr>
        <th> NO </th>
        <th> FAQ </th>
        <th> Solution </th>
        <th>Services</th>
        <th width="5%"> Status </th>
        <th> Action </th>
      </tr>
      </thead>
      <tbody>
       <?php 
        if (class_exists('FaqClass')) {
          $faqObj = new FaqClass();
          if (method_exists($faqObj, 'getFaq')) {
            $faqData = $faqObj->getFaq();
            if ($faqData) {
              $f = 0;
              while ($frows = $faqData->fetch_assoc()) {
                $f++;                          
                $faq_id       = $frows['faq_id'];
                $faq_ask      = $frows['faq_ask'];
                $faq_solution = $frows['faq_solution'];
                $faq_status   = $frows['faq_status'];
                $services_title = $frows['services_title'];
       ?>
       <tr>
         <td><?php echo $f; ?></td>
         <td><?php echo $faq_ask; ?></td>
         <td><?php echo $faq_solution; ?></td>
         <td><?php echo $services_title; ?></td>
         <td>
           <?php if ($faq_status != 0) { ?>
          <button type="button" class="btn btn-success btn-block" style="cursor: unset;
          "><i class="fa fa-eye"></i> Active </button>
          <?php } else { ?>
          <button type="button" class="btn btn-warning btn-block" style="cursor: unset;
          "><i class="fa fa-eye-slash"></i> Deactivate </button>
          <?php } ?>
         </td>
         <td style="width: max-content;display: inline-block;float: right;">
          <?php if ($faq_status != 0) { ?>
          <button type="button" class="btn btn-warning onclick_faq_status" data-faq_status_id="<?php echo $faq_id; ?>" data-faq_status="0"><i class="fa fa-exclamation-triangle"></i> Disable </button>
          <?php } else { ?>
          <button type="button" class="btn btn-success  onclick_faq_status" data-faq_status_id="<?php echo $faq_id; ?>" data-faq_status="1"><i class="fa  fa-check"></i> Enable </button>
          <?php } ?>
          <button type="button" class="btn btn-danger onclic_del_faq" data-faq_id="<?php echo $faq_id; ?>"><i class="fa fa-trash-o"></i> Delete </button>
         </td>
       </tr>
      <?php  } } } } ?>
      </tbody>
    </table>
  </div>
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
<script type="text/javascript" src="js/faq.js"></script>