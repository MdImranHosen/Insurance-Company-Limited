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
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Admin
        <small>Panel</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Contact</a></li>
        <li class="active">Admin Panel</li>
      </ol>
    </section>
    <div class="clearfix"></div>
    <!-- Main content -->
    <section class="content">
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <section class="col-lg-12 connectedSortable">

          <!-- quick email widget -->
          <div class="box box-info">
            <div class="box-header">
              <i class="fa fa-comment"></i>

              <h3 class="box-title">Message List</h3>
              <!-- tools box -->
             <!-- <div class="pull-right box-tools">
                <button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
                        title="Remove">
                  <i class="fa fa-times"></i></button>
              </div>-->
              <!-- /. tools -->
            </div>
            <div class="box-body">
               <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th> NO </th>
                  <th> Name </th>
                  <th> Email </th>
                  <th> Subject </th>
                  <th> Message</th>
                  <th> Action </th>
                </tr>
                </thead>
                <tbody>
                <?php
                if (class_exists('Contactclass')) {

                	 $ctc = new Contactclass();
                     
                     if (method_exists($ctc, 'getContactMessageshow')) {

                     $getdata = $ctc->getContactMessageshow();
                     if ($getdata) {
                     	$i=0;
                     	while ($rows = $getdata->fetch_assoc()) {
                     		$i++;
                 ?>
                 <tr>
                   <td><?php echo $i; ?></td>
                   <td><?php echo $rows['name']; ?></td>
                   <td><?php echo $rows['email']; ?></td>
                   <td><?php echo $rows['subject']; ?></td>
                   <td><?php echo $rows['message']; ?></td>
                 </tr>
                <?php 
                  	}  }  }  }
                ?>
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
