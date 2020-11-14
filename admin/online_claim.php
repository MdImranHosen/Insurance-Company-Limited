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
<div id="onlineClaimViewById" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Online Claim </strong></h4>
      </div>
      <div class="modal-body">
        <div id="view_online_claim_data"></div> 
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
        <th> Name of the Insured </th>
        <th> Policy/Certificate No./Cover Note No  </th>
        <th> Contact Person </th>
        <th class="text-center"> Action </th>
      </tr>
      </thead>
      <tbody>
       <?php 
        if (class_exists('OnlineClaim')) {
          $ocObj = new OnlineClaim();
          if (method_exists($ocObj, 'getOnlineClaimData')) {
            $result = $ocObj->getOnlineClaimData();
            if ($result) {

              $i = 0;

              while ($rows = $result->fetch_assoc()) {               

                $i++;                          
                $id           = $rows['id'];
                $name_insured = $rows['name_insured'];
                $pcn_cnn      = $rows['pcn_cnn'];
                $dateol       = $rows['dateol'];
                $placeol      = $rows['placeol'];
                $natureol     = $rows['natureol'];
                $causeol      = $rows['causeol'];
                $vehicleno    = $rows['vehicleno'];
                $estol_ia     = $rows['estol_ia'];
                $contact_p    = $rows['contact_p'];
                $address      = $rows['address'];
                $phone_n      = $rows['phone_n'];
                $mobile_n     = $rows['mobile_n'];
                $fax_n        = $rows['fax_n'];
                $email        = $rows['email'];
              
       ?>
       <tr>
         <td><?php echo $i; ?></td>
         <td><?php echo $name_insured; ?></td>
         <td><?php echo $pcn_cnn; ?></td>
         <td><?php echo $contact_p; ?></td>
         <!-- <td><a download="" class="btn btn-info" href="<?php #echo $docfile; ?>"><i class="fa fa-download"></i> Download</a></td> -->
         
         <td style="text-align: center;">

          <a href="javascript:void(0)" data-target="#onlineClaimViewById" data-toggle="modal" class="btn btn-success onclic_view_oc" data-vocid="<?php echo $id; ?>"><i class="fa fa-exclamation-triangle"></i> View </a>
          
          <button type="button" class="btn btn-danger onclic_del_oc" data-ocid="<?php echo $id; ?>"><i class="fa fa-trash-o"></i> Delete </button>
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

<script type="text/javascript">
  $(document).ready(function(){
   $(document).on('click', '.onclic_del_oc', (function() {
       var ocid   = $(this).data('ocid');
        $.ajax({
              type: "post",
              url: "ajax/online_claim_ajax.php",
              data: {ocid:ocid,oc_data:99},
              success: function(del) {
                $('#message_data').html(del);
              },
              error: function(err){
                alert(err);
              }
        });

   }));

  $(document).on('click', '.onclic_view_oc', (function() {
       var vocid   = $(this).data('vocid');
        $.ajax({
              type: "post",
              url: "ajax/online_claim_ajax.php",
              data: {vocid:vocid,viewoc_data:99},
              success: function(onvdata) {
                $('#view_online_claim_data').html(onvdata);
              //  alert("Ok Working Fine");
              },
              error: function(err) {
                alert(err);
              }
        });

   }));  

});
</script>