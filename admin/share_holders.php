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
  <div id="shareHoldersEdit" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"></h4>
          <div id="upmsg_message"></div>
        </div>
        <div class="modal-body" id="share_des">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal"> Close </button>
        </div>
      </div>
    </div>
  </div>

<!-- Add Partner Modal -->
<div id="addShareHoldersModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"><strong> Add Share Holders </strong></h4>
        <div id="msg_message"></div>
      </div>
      <div class="modal-body">
         <form id="shareholders_form" class="form-horizontal" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

        <div id="err_name" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="name"> Name <span style="color:red;font-size: 20px;"> * </span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="name" id="name" placeholder="Share Holders Name">
            <div id="err_name_msg"></div>
          </div>
        </div>        
        <div id="err_position" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="position"> Position <span style="color:red;font-size: 20px;">*</span></label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="position" id="position" placeholder="Position">
            <div id="err_position_msg"></div>
          </div>
        </div>
        <div id="err_no_of_share" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="no_of_share"> No of Share <span style="color:red;font-size: 20px;">*</span> </label>
          <div class="col-sm-10">
            <input type="text" onkeypress="return isNumberKey(this);" class="form-control" name="no_of_share" id="no_of_share" placeholder="No of Share">
            <div id="err_no_of_share_msg"></div>
          </div>
        </div>
        <div id="err_amount" class="form-group has-feedback">
          <label class="control-label col-sm-2" for="amount"> Amount in TK <span style="color:red;font-size: 20px;">*</span> </label>
          <div class="col-sm-10">
            <input type="text" onkeypress="return isNumberKey(this);" class="form-control" name="amount" id="amount" placeholder="Amount in TK">
            <div id="err_amount_msg"></div>
          </div>
        </div>
        <div class="form-group has-feedback">
          <label class="control-label col-sm-2" for="percentage"> Percentage </label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="percentage" id="percentage" placeholder="percentage">
          </div>
        </div>
        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" name="save_share_data" class="btn btn-success btn-lg"> Submit </button>
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
        <section class="col-lg-12">
          <div class="box box-info">
            <div class="box-body">
              <div id="err_text_edit_msg"></div>                
               <div id="share_text_des">            
                <?php 
                   if (class_exists('ShareHoldersClass')) {
                     $shc = new ShareHoldersClass();
                     if (method_exists($shc, 'getShareHoldersPageTitleText')) {
                       $shcdata = $shc->getShareHoldersPageTitleText();
                       if ($shcdata) {
                          while ($shrow = $shcdata->fetch_assoc()) {
                ?>
                <table border="1"> 
                <tr style="text-align: center;">
                  <td width="30%"><h2> <?php echo $shrow['share_holders_title']; ?> </h2></td>
                  <td style="padding-top: 12px;font-size: 17px;" width="50%"><p><?php echo $shrow['share_holders_des']; ?></p></td>
                  <td width="10%"><button type="button" class="btn btn-info onclick_shtext" data-shtid="<?php echo $shrow['id']; ?>" title="Share Holders">
                  <i class="fa fa-edit"></i> Edit </button></td>
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
              <h3 class="box-title"> Share Holders </h3>
              <!-- tools box -->
             <div class="pull-right box-tools">
                <button type="button" class="btn btn-success btn-lg" data-target="#addShareHoldersModal" data-toggle="modal"
                        title="Add Share Holders">
                  <i class="fa fa-plus"></i> Add Share Holders </button>
              </div>
              <!-- /. tools -->
            </div>
            <div class="box-body">              
              <div id="message_data"></div>
              <div class="table-responsive">
               <table id="sharehtable" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> NO </th>
                  <th> Name </th>
                  <th> Position </th>
                  <th> No Of Share </th>
                  <th> Amount in TK </th>
                  <th> Percentage </th>
                  <th> Action </th>
                </tr>
                </thead>
               
                 <?php 

                  if (class_exists('ShareHoldersClass')) {
                    $sh = new ShareHoldersClass();
                    if (method_exists($sh, 'getShareHolders')) {
                      $result = $sh->getShareHolders();
                      if ($result) {
                        echo '<tbody>';
                        $no_of_share_total = 0;
                        $total_amount = 0;
                        $i = 0;
                        while ($rows = $result->fetch_assoc()) {
                          $i++;
                       $no_of_share_total += $rows['no_of_share'];
                       $total_amount += $rows['amount'];
                        
                 ?>
                 <tr>
                   <td><?php echo $i; ?> </td>
                   <td><?php echo $rows['name']; ?></td>
                   <td><?php echo $rows['position']; ?></td>
                   <td><?php echo $rows['no_of_share']; ?></td>
                   <td><?php echo $rows['amount']; ?></td>
                   <td><?php echo $rows['percentage']; ?></td>
                   <td width="20%"><a class="btn btn-warning onclick_data" data-sharehol_id="<?php echo $rows['id']; ?>" data-toggle="modal" data-target="#shareHoldersEdit" href="#"><i class="fa fa-edit"></i> Edit </a>
                   <button type="button" class="btn btn-danger onclick_del" data-sharehol_delid="<?php echo $rows['id']; ?>"><i class="fa fa-trash-o"></i> Delete </button>
                   </td>
                 </tr>
                <?php  } ?>
                </tbody>
                <tfoot>
                  <tr>
                  <th> </th>
                  <th> </th>
                  <th> </th>
                  <th style="border-top: 2px solid #000000;border-bottom: 2px solid #000;"> <?php echo $no_of_share_total.".0000"; ?> </th>
                  <th style="border-top: 2px solid #000000;border-bottom: 2px solid #000;"> <?php echo $total_amount.".0000";; ?> </th>
                  <th style="border-top: 2px solid #000000;border-bottom: 2px solid #000;"> 100% </th>
                  <th> </th>
                </tr>
                </tfoot>

                 <?php } } } ?>                
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
<script type="text/javascript" src="js/share-holders.js"></script>