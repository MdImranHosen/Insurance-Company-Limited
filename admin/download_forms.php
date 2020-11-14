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
<!-- Add Financal Reports Modal -->
<div id="addDownloadFromModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add <?php echo $pageName; ?> </strong></h4>
        <div id="dwf_message"></div>
      </div>
      <div class="modal-body">
         <form id="dwf_data_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div id="err_dwf_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="dwf_title"> Title <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="dwf_title" id="dwf_title" placeholder="Title">
            <div id="err_dwf_title_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="dwf_date"> Date </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="dwf_date" id="dwf_date" placeholder="Enter Date">
          </div>
        </div>
        <div id="err_dwf_cat_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="dwf_cat_title"> Category </label>
          <div class="col-sm-10">
            <select class="form-control" name="dwf_cat_title" id="dwf_cat_title">
              <option value="" style="cursor: pointer;display: hidden;">Select Category Title </option>
                <?php 
                  if (class_exists('DownloadClass')) {
                    $dwObj = new DownloadClass();
                    if (method_exists($dwObj, 'getDownloadCategoryOption')) {
                       $dwObj->getDownloadCategoryOption();
                    }}
               ?>
            </select>
            <div id="err_dwf_cat_title_msg"></div>
          </div>
        </div>
        <div id="err_dwf_file" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="dwf_file"> Document <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="dwf_file" name="dwf_file" 
            accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf">
            <div id="err_dwf_file_msg"></div>
            <span><small style="color: red;"> File Should be ( .xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf ) ( Max Size: 20 MB )!</small></span>
          </div>
        </div>              
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_dwf_data" class="btn btn-success btn-lg"> Submit </button>
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
<!-- Add Download Category Modal -->
<div id="addDwonloadCatModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Category </strong></h4>
        <div id="cat_message"></div>
      </div>
      <div class="modal-body">
         <form id="download_cat_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div id="err_category_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="category_title"> Category Title <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="category_title" id="category_title" placeholder="Category Title">
            <div id="err_category_title_msg"></div>
          </div>
        </div>              
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_dcategory_data" class="btn btn-success btn-lg"> Submit </button>
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
<div class="box box-default">
  <div class="box-body">
    <div id="page_message"></div>             
     <div id="page_title_data">         
      <?php 
         if (class_exists('SettingsClass')) {
           $settings = new SettingsClass();
           if (method_exists($settings, 'getPageTitleByPageName')) {
             $pageTitleData = $settings->getPageTitleByPageName($currentpage);
             if ($pageTitleData) {
                while ($prows = $pageTitleData->fetch_assoc()) {
      ?>
      <table width="100%">
      <tr style="text-align: center;">
        <td width="20%" style="background: #F9F9F9;"><h2> Page Title </h2></td>
        <td width="60%"><h2> <?php echo $prows['page_title']; ?> </h2></td>
        <td width="10%"><button type="button" class="btn btn-default btn-lg btn-block onclick_pagetext" style="padding-top: 18px;padding-bottom: 18px;" data-pagetid="<?php echo $prows['menu_id']; ?>" title="Page Title">
        <i style="font-size: 28px;" class="fa fa-edit fa-xl"></i> Edit </button></td>
      </tr>
       </table>
     <?php } } } } ?>
     </div>             
  </div>
</div>
</section>

<section class="col-lg-12">
<!-- quick email widget -->
<div class="box box-success">
  <div class="box-header" style="margin-bottom: 20px;">
    <i class="fa fa-list"></i>

    <h3 class="box-title"> <?php echo $pageName; ?> </h3>
    <!-- tools box -->
   <div class="pull-right box-tools">
      <button type="button" class="btn btn-success btn-lg" data-target="#addDownloadFromModal" data-toggle="modal"
              title="Add Reports">
        <i class="fa fa-plus"></i> Add <?php echo $pageName; ?> </button>
    </div>
    <!-- /. tools -->
  </div>
  <div class="box-body">
    <div id="message_data"></div>
    <div class="table-responsive">
     <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th> NO </th>
        <th> Title </th>
        <th> Date </th>
        <th>Category</th>
        <th> Document </th>
        <th width="5%"> Status </th>
        <th> Action </th>
      </tr>
      </thead>
      <tbody>
       <?php 
        if (class_exists('DownloadClass')) {
          $dwObj = new DownloadClass();
          if (method_exists($dwObj, 'getDownloadFromData')) {
            $result = $dwObj->getDownloadFromData();
            if ($result) {

              $i = 0;

              while ($rows = $result->fetch_assoc()) {

                $i++;                          
                $dwf_id     = $rows['dwf_id'];
                $dwf_title  = $rows['dwf_title'];
                $dwf_date   = $rows['dwf_date'];
                $cat_title  = $rows['dwf_cat_title'];
                $file       = $rows['dwf_file'];
                $dwf_status = $rows['dwf_status'];

              $docfile = "../document/download_forms/".$dwf_id."/".$file;
              if (!file_exists($docfile)) {
                 $docfile = "../document/logo.png";
               }
       ?>
       <tr>
         <td><?php echo $i; ?></td>
         <td><?php echo $dwf_title; ?></td>
         <td><?php echo $dwf_date; ?></td>
         <td><?php echo $cat_title; ?></td>
         <td><a download="" class="btn btn-info" href="<?php echo $docfile; ?>"><i class="fa fa-download"></i> Download</a></td>
         <td>
           <?php if ($dwf_status != 0) { ?>
          <button type="button" class="btn btn-success btn-block" style="cursor: unset;
          "><i class="fa fa-eye"></i> Active </button>
          <?php } else { ?>
          <button type="button" class="btn btn-warning btn-block" style="cursor: unset;
          "><i class="fa fa-eye-slash"></i> Deactivate </button>
          <?php } ?>
         </td>
         <td style="width: max-content;display: inline-block;float: right;">
          <?php if ($dwf_status != 0) { ?>
          <button type="button" class="btn btn-warning onclick_dwf_status" data-dwf_status_id="<?php echo $dwf_id; ?>" data-dwf_status="0"><i class="fa fa-exclamation-triangle"></i> Disable </button>
          <?php } else { ?>
          <button type="button" class="btn btn-success onclick_dwf_status" data-dwf_status_id="<?php echo $dwf_id; ?>" data-dwf_status="1"><i class="fa  fa-check"></i> Enable </button>
          <?php } ?>
          <button type="button" class="btn btn-danger onclic_del_dwf" data-dwf_id="<?php echo $dwf_id; ?>"><i class="fa fa-trash-o"></i> Delete </button>
         </td>
       </tr>
      <?php  } } } } ?>
      </tbody>
    </table>
  </div>
  </div>
</div>
</section>

<section class="col-lg-12">
<!-- quick email widget -->
<div class="box box-info">
  <div class="box-header" style="margin-bottom: 20px;">
    <i class="fa fa-list"></i>
    <h3 class="box-title"> Download Category </h3>
    <!-- tools box -->
   <div class="pull-right box-tools">
      <button type="button" class="btn btn-success btn-lg" data-target="#addDwonloadCatModal" data-toggle="modal"
              title="Add Download Category">
        <i class="fa fa-plus"></i> Add Category </button>
    </div>
    <!-- /. tools -->
  </div>
  <div class="box-body">
    <div id="cat_message_data"></div>
    <div class="table-responsive">
     <table class="table table-bordered table-striped">
      <thead>
      <tr>
        <th> NO </th>
        <th> Title </th>
        <th> Date </th>
        <th width="5%"> Status </th>
        <th> Action </th>
      </tr>
      </thead>
      <tbody>
       <?php 
        if (class_exists('DownloadClass')) {
          $dwObj = new DownloadClass();
          if (method_exists($dwObj, 'getDwonloadCategory')) {
            $dcdata = $dwObj->getDwonloadCategory();
            if ($dcdata) {
              $c = 0;
              while ($dcrows = $dcdata->fetch_assoc()) {
                $c++;                          
                $dwf_cat_id          = $dcrows['dwf_cat_id'];
                $dwf_cat_title       = $dcrows['dwf_cat_title'];
                $dwf_cat_create_date = $dcrows['dwf_cat_create_date'];
                $dwf_cat_status      = $dcrows['dwf_cat_status'];
       ?>
       <tr>
         <td><?php echo $c; ?></td>
         <td><?php echo $dwf_cat_title; ?></td>
         <td><?php echo $dwf_cat_create_date; ?></td>
         <td>
           <?php if ($dwf_cat_status != 0) { ?>
          <button type="button" class="btn btn-success btn-block" style="cursor: unset;
          "><i class="fa fa-eye"></i> Active </button>
          <?php } else { ?>
          <button type="button" class="btn btn-warning btn-block" style="cursor: unset;
          "><i class="fa fa-eye-slash"></i> Deactivate </button>
          <?php } ?>
         </td>
         <td style="width: max-content;display: inline-block;float: right;">
          <?php if ($dwf_cat_status != 0) { ?>
          <button type="button" class="btn btn-warning onclick_cat_status" data-cat_status_id="<?php echo $dwf_cat_id; ?>" data-cat_status="0"><i class="fa fa-exclamation-triangle"></i> Disable </button>
          <?php } else { ?>
          <button type="button" class="btn btn-success  onclick_cat_status" data-cat_status_id="<?php echo $dwf_cat_id; ?>" data-cat_status="1"><i class="fa  fa-check"></i> Enable </button>
          <?php } ?>
          <button type="button" class="btn btn-danger onclic_del_cat" data-cat_id="<?php echo $dwf_cat_id; ?>"><i class="fa fa-trash-o"></i> Delete </button>
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
<script type="text/javascript" src="js/financial_indi_page_title.js"></script>
<script type="text/javascript" src="js/download_froms.js"></script>