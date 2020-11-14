<?php include "inc/header.php"; ?>
<?php 
if ((Session::get('admin_type') != 2) || (Session::get('admin_ck') != 'emain_admin')) {
    Session::destroy();
    header("Location:login.php");
  }else{
    if (class_exists('FinancialIndicatorsClass')) {
      $fiObj = new FinancialIndicatorsClass();
      if (method_exists($fiObj, 'fiDisableById')) {
        if (isset($_GET['fidid'])) {
          $fidid = $_GET['fidid'];
          $fidid = preg_replace('/\D/', '', $fidid);
          $fidid = (int)$fidid;      
          if (!empty($fidid)) {
            $msg = $fiObj->fiDisableById($fidid);
          }
        }
      }

      if (method_exists($fiObj, 'fiEnableById')) {
        if (isset($_GET['fieid'])) {
          $fieid = $_GET['fieid'];
          $fieid = preg_replace('/\D/', '', $fieid);
          $fieid = (int)$fieid;      
          if (!empty($fieid)) {
            $msg = $fiObj->fiEnableById($fieid);
          }
        }
      } 
   }
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
<div id="addFinancialReportsModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add <?php echo $pageName; ?> </strong></h4>
        <div id="fi_message"></div>
      </div>
      <div class="modal-body">
         <form id="fi_data_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div id="err_content_title" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="fi_title"> Title <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="fi_title" id="fi_title" placeholder="Content Title">
            <div id="err_content_title_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="fi_date"> Date </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="fi_date" id="fi_date" placeholder="Enter Date">
          </div>
        </div>
        <input type="hidden" name="fir_type" id="fir_type" value="<?php echo $currentpage; ?>">
        <div id="err_fi_doc" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="fi_doc"> Document <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="file" class="form-control" id="fi_doc" name="fi_doc" 
            accept=".xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf">
            <div id="err_fi_doc_msg"></div>
            <span><small style="color: red;"> File Should be ( .xlsx,.xls,.doc,.docx,.ppt,.pptx,.txt,.pdf ) ( Max Size: 20 MB )!</small></span>
          </div>
        </div>
              
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_gallery_data" class="btn btn-success btn-lg"> Submit </button>
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
<div class="box box-info">
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
      <table width="100%" border="1">
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
<section class="col-lg-12 connectedSortable">
<!-- quick email widget -->
<div class="box box-info">
  <div class="box-header" style="margin-bottom: 20px;">
    <i class="fa fa-list"></i>

    <h3 class="box-title"> <?php echo $pageName; ?> </h3>
    <!-- tools box -->
   <div class="pull-right box-tools">
      <button type="button" class="btn btn-success btn-lg" data-target="#addFinancialReportsModal" data-toggle="modal"
              title="Add Reports">
        <i class="fa fa-plus"></i> Add <?php echo $pageName; ?> </button>
    </div>
    <!-- /. tools -->
  </div>
  <div class="box-body">
    <?php 
       if (isset($msg)) {
         echo $msg;
       }
    ?>
    <div id="message_data"></div>
     <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th> NO </th>
        <th> Title </th>
        <th> Date </th>
        <th> Document </th>
        <th width="5%"> Status </th>
        <th> Action </th>
      </tr>
      </thead>
      <tbody>
       <?php 
        if (class_exists('FinancialIndicatorsClass')) {
          $fiObj = new FinancialIndicatorsClass();
          if (method_exists($fiObj, 'financialIndicatorsByPageNameType')) {
            $result = $fiObj->financialIndicatorsByPageNameType($currentpage);
            if ($result) {

              $i = 0;

              while ($rows = $result->fetch_assoc()) {

                $i++;                          
                $id       = $rows['fi_id'];
                $fi_title = $rows['fi_title'];
                $fi_date  = $rows['fi_date'];
                $fi_type  = $rows['fi_type'];
                $file     = $rows['fi_file'];
                $status   = $rows['fi_status'];

              $docfile = "../document/".$fi_type."/".$id."/".$file;
              if (!file_exists($docfile)) {
                 $docfile = "../document/logo.png";
               }
       ?>
       <tr>
         <td><?php echo $i; ?></td>
         <td><?php echo $fi_title; ?></td>
         <td><?php echo $fi_date; ?></td>
         <td><a download="" class="btn btn-info" href="<?php echo $docfile; ?>"><i class="fa fa-download"></i> Download</a></td>
         <td>
           <?php if ($status != 0) { ?>
          <button type="button" class="btn btn-success btn-block" style="cursor: unset;
          "><i class="fa fa-eye"></i> Active </button>
          <?php } else { ?>
          <button type="button" class="btn btn-warning btn-block" style="cursor: unset;
          "><i class="fa fa-eye-slash"></i> Deactivate </button>
          <?php } ?>
         </td>
         <td style="text-align: center;">
          <?php if ($status != 0) { ?>
          <a href="?fidid=<?php echo $id; ?>" class="btn btn-warning"><i class="fa fa-exclamation-triangle"></i> Disable </a>
          <?php } else { ?>
          <a href="?fieid=<?php echo $id; ?>" class="btn btn-success"><i class="fa  fa-check"></i> Enable </a>
          <?php } ?>
          <button type="button" class="btn btn-danger onclic_del_fi" data-fid_type="<?php echo $fi_type; ?>" data-fi_id="<?php echo $id; ?>"><i class="fa fa-trash-o"></i> Delete </button>
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
<script type="text/javascript" src="js/financial_indi_page_title.js"></script>