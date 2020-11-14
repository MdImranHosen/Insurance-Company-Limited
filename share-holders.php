<?php include 'inc/header.php'; ?>

<div class="page-wrapper">
    <!-- Preloader -->
    <div class="preloader"></div>
 	<!-- Header span -->
    <!-- Header Span -->
    <span class="header-span"></span>
    <!-- Main Header-->
 <?php include 'inc/menu.php'; ?>
    <!--End Main Header -->
    <!--Page Title-->
<?php 
 if (realpath('inc/dropdown-page-title.php')) {
   include_once 'inc/dropdown-page-title.php';
 }
?>
    <!--End Page Title-->
<!--Sidebar Page Container-->
<div class="sidebar-page-container services_page">
<div class="auto-container">
    <div class="row clearfix">    
    <!--Content Side / Blog Sidebar-->
    <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
    <?php include_once 'inc/dropdown-sidebar.php'; ?>
    </div>
    <div class="content-side col-lg-8 col-md-12 col-sm-12">
    <div class="blog-single">
      <div class="row">  
         <!-- Share Holders Block -->
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 wow fadeInUp">

         <div class="inner-box">
          <?php 
           if (class_exists('ShareHoldersClass')) {
             $shc = new ShareHoldersClass();
             if (method_exists($shc, 'getShareHoldersPageTitleText')) {
               $shcdata = $shc->getShareHoldersPageTitleText();
               if ($shcdata) {
                  while ($shrow = $shcdata->fetch_assoc()) {
                ?>
            <h2><?php echo $shrow['share_holders_title']; ?></h2>
            <p><?php echo $shrow['share_holders_des']; ?></p>
            <?php } } } } ?>
            <div class="table-responsive">
            <table style="color: black;" class="table table-bordered">
                <thead>
                <tr style="background-color: #ADE1F9;">
                  <th> Sl.NO </th>
                  <th> Name </th>
                  <th> Position </th>
                  <th> No Of Share </th>
                  <th> Amount in TK </th>
                  <th> Percentage </th>
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
                </tr>
                </tfoot>
                 <?php } } } ?>                
              </table>
            </div>       
         </div>
        </div>
    </div>
    <!-- End Speakers Section -->
    </div>
    </div>
   
    </div>
</div>
</div>
<!-- End Services Details Container --> <!-- Main Footer -->
<?php include 'inc/footer.php'; ?>