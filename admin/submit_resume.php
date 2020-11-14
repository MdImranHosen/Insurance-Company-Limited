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
        <td width="15%" style="background: #3C8DBC;color: white;"><h2> Page Title </h2></td>
        <td width="70%"><p> <?php echo htmlspecialchars_decode(stripcslashes($prows['page_title'])); ?> </p></td>
        <td width="10%"><button type="button" class="btn btn-primary btn-lg btn-block onclick_pagetext" style="padding-top: 18px;padding-bottom: 18px;" data-pagetid="<?php echo $prows['menu_id']; ?>" title="Page Title">
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
    <!-- /. tools -->
  </div>
  <div class="box-body">
    <?php 
       if (isset($msg)) {
         echo $msg;
       }
    ?>
    <div id="resume_message_data"></div>
     <table id="example1" class="table table-bordered table-striped">
      <thead>
      <tr>
        <th> NO </th>
        <th> Name </th>
        <th> Email </th>
        <th> Phone </th>
        <th> Address </th>
        <th width="5%"> Document </th>
        <th> Action </th>
      </tr>
      </thead>
      <tbody>
       <?php 
        if (class_exists('Contactclass')) {
          $conObj = new Contactclass();
          if (method_exists($conObj, 'getResumeData')) {
            $result = $conObj->getResumeData();
            if ($result) {
              $i = 0;
              while ($rows = $result->fetch_assoc()) {
                $i++;   

                $id           = $rows['resume_id'];
                $resume_name  = $rows['resume_name'];
                $resume_email = $rows['resume_email'];
                $resume_phone = $rows['resume_phone'];
                $resume_addrs = $rows['resume_address'];
                $resume_file  = $rows['resume_file'];

              $docfile = "../resume/".$id."/".$resume_file;
              if (!file_exists($docfile)) {
                 $docfile = "../document/logo.png";
               }
       ?>
       <tr>
         <td><?php echo $i; ?></td>
         <td><?php echo $resume_name; ?></td>
         <td><?php echo $resume_email; ?></td>
         <td><?php echo $resume_phone; ?></td>
         <td><?php echo $resume_addrs; ?></td>
         <td><a download="" class="btn btn-info" href="<?php echo $docfile; ?>"><i class="fa fa-download"></i> Download</a></td>        
         <td style="text-align: center;">         
          <button type="button" class="btn btn-danger onclic_del_resume" data-resumeid="<?php echo $id; ?>" ><i class="fa fa-trash-o"></i> Delete </button>
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

    $(document).on('click', '.onclic_del_resume', (function() {
         var resumeid = $(this).data('resumeid');
          $.ajax({
                type: "post",
                url: "ajax/resume_del_ajax.php",
                data: {resumeid:resumeid,resume_del:98},
                success: function(del_resume) {
                  $('#resume_message_data').html(del_resume);
                },
                error: function(err){
                  alert(err);
                }
          });

     }));
  });
</script>