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
                $empdata = $emp->getBoardOfDirectors('senior_development_team');
                if ($empdata) {
                  while ($em_row = $empdata->fetch_assoc()) {
                    $em_id   = $em_row['em_id'];
                    $em_name = $em_row['em_name'];
                    $em_deg  = $em_row['em_designation'];
                    $em_des  = $em_row['em_description'];
                    $em_fb   = $em_row['em_fb'];
                    $em_tw   = $em_row['em_tw'];
                    $em_pt   = $em_row['em_pt'];
                    $em_lk   = $em_row['em_lk'];
                    $em_type = $em_row['em_type'];
                    $em_img  = $em_row['em_photo'];
                    
                    $image = "images/".$em_type."/".$em_id."/".$em_img;
                    if (!file_exists($image)) {
                      $image = "img/logo.png";
                    }
              ?>
             <div class="col-lg-4 col-md-4 col-sm-6 imran_sbod">
                 <a href="senior-development-team/<?php echo $em_id; ?>">
                  <img title="<?php echo $em_name; ?>" alt="<?php echo $em_name; ?>" src="<?php echo $image; ?>">
                  <h5><?php echo $em_name; ?></h5>
                  <p><?php echo $em_deg; ?></p>
                 </a>
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