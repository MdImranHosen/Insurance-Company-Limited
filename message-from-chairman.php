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
         <!-- News Block Three -->
         <div class="row">
             <?php
             if (class_exists('EmployerClass')) {
               $emp = new EmployerClass();
               if (method_exists($emp, 'getBoardOfDirectors')) {
                $empdata = $emp->getBoardOfDirectors($pageReal);
                if ($empdata) {
                  while ($em_row = $empdata->fetch_assoc()) {
                    $em_id   = $em_row['em_id'];
                    $em_name = $em_row['em_name'];
                    $em_deg  = $em_row['em_designation'];
                    $em_fb   = $em_row['em_fb'];
                    $em_tw   = $em_row['em_tw'];
                    $em_pt   = $em_row['em_pt'];
                    $em_lk   = $em_row['em_lk'];
                    $em_type = $em_row['em_type'];
                    $em_img  = $em_row['em_photo'];
                    $em_des  = htmlspecialchars_decode(stripslashes($em_row['em_description']));
                    
                    $image = "images/".$em_type."/".$em_id."/".$em_img;
                    if (!file_exists($image)) {
                      $image = "img/logo.png";
                    }
              ?>
             <div class="col-lg-12 col-md-12 col-sm-12 imran_sbod">
                 <div class="inner-column">
                  <div class="ticket-form">
                  <img title="<?php echo $em_name; ?>" alt="<?php echo $em_name; ?>" src="<?php echo $image; ?>">
                  <h5><?php echo $em_name; ?></h5>
                  <p><?php echo $em_deg; ?></p>
                 </div>
                  <!-- Follow Us -->
                        <div class="follow-us">      
                            <ul class="social-icon-two social-icon-colored">
                               <?php if($em_fb){ ?>
                                <li><a href="https://fb.com/<?php echo $em_fb; ?>"><i class="fab fa-facebook-f"></i></a></li>
                               <?php } if($em_tw){ ?>
                                <li><a href="https://twitter.com/<?php echo $em_tw; ?>"><i class="fab fa-twitter"></i></a></li>
                               <?php } if($em_pt){ ?>
                                <li><a href="https://pinterest.com/<?php echo $em_pt; ?>"><i class="fab fa-pinterest"></i></a></li>
                               <?php } if($em_lk){ ?>
                                <li><a href="https://linkedin.com/<?php echo $em_lk; ?>"><i class="fab fa-linkedin"></i></a></li>
                               <?php } ?>
                            </ul>
                        </div>
                      </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 imran_sbod_details">   
                 <?php echo $em_des; ?>
                </div> 
             <?php } } } } ?>
            </div>
    </div>
    </div>   
    </div>
</div>
</div>
<!-- End Services Details Container -->
<!-- Main Footer -->
<?php include 'inc/footer.php'; ?>