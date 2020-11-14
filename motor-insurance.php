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
 <?php
    if (class_exists('ServicesClass')) {
     $ps = new ServicesClass();
     if (method_exists($ps, 'productsServicesByCurrentPage')) {
        $psdresult = $ps->productsServicesByCurrentPage($currentpage);
        if ($psdresult) {
            while ($psdrows = $psdresult->fetch_assoc()) {
        $psd_title  = $psdrows['ps_title'];
        $psd_details = htmlspecialchars_decode(stripslashes($psdrows['ps_details']));

     $img = "images/services/".$psdrows['id']."/".$psdrows['ps_image'];

    if (file_exists($img) != false) {         
         $img = "images/services/".$psdrows['id']."/".$psdrows['ps_image'];
       } else{         
         $img = "img/logo.png";
       }

    ?>
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
    <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
    <?php include_once 'inc/dropdown-sidebar.php'; ?>
    </div>
    <div class="content-side col-lg-9 col-md-12 col-sm-12">
    <div class="blog-single">
         <!-- News Block Three -->
        <div class="news-block">
            <div class="inner-box">
                <div class="image-box">
                    <figure class="image"><img src="<?php echo $img; ?>" alt=""></figure>
                </div>
                <div class="lower-content">  
                   <?php echo $psd_details; ?> 
                </div>
            </div>
        </div>

         <!-- Popular Products / Policies -->
         <hr class="imran_services_policy_bar">
        <div class="comments-area github_imranhosen_popular_policy">
            <div class="group-title">
                <h1> Popular Products / Policies </h1>
            </div>
          
          <?php 
                if (method_exists($ps, 'psPolicyByCurrentPage')) {
                  $psdata = $ps->psPolicyByCurrentPage($currentpage);
                  if ($psdata) {
                    while ($prows = $psdata->fetch_assoc()) {

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

                    $plicyimg = "images/services/".$services_url."/policy/".$policy_id."/".$policy_img;
                    if (!file_exists($plicyimg)) {
                       $plicyimg = "img/logo.png";
                     }
               ?>
            <div class="comment-box">
                <div class="comment">
                    <div class="comment-info">
                        <div class="name"> <span class="imran_circal"></span> 
                            <?php if (!empty($policy_name)) { echo $policy_name; } ?> 
                        </div>
                    </div>      
                    <div class="text"> <?php 
                     if (!empty($policy_des)) {
                        echo $ps->textShorten($policy_des, 250);
                     }
                    ?> </div>
                    <a href="policy/<?php echo $policy_id; ?>" class="btn btn-sm imran-btn-style"><span class="btn-title">View More </span></a>
                </div>
            </div>
         <?php } } } ?>            
        </div>
    <!-- Popular Products / Policies -->


      </div>
     </div>
    </div>
</div>
</div>
<!-- End Services Details Container -->
<?php  } } } } ?>
    <!-- Main Footer -->
<?php include 'inc/footer.php'; ?>