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
        <div class="news-block">
            <div class="inner-box wow fadeInUp" data-wow-delay="500ms">
                <div class="lower-content imran_text_style">  
               <?php 
             if (class_exists("SettingsClass")) {
                 $settings = new SettingsClass();
                if (method_exists($settings, 'getAboutsData')) {
                  $about_result = $settings->getAboutsData();
                  if ($about_result) {
                    while ($about_rows = $about_result->fetch_assoc()) {

                    $company_profile = $about_rows['company_profile'];
                    echo htmlspecialchars_decode(stripslashes($company_profile));
             } } } }
            ?>
                </div>
            </div>
        </div>
    </div>
    </div>   
    </div>
</div>
</div>
<!-- End Services Details Container -->
    <!-- Main Footer -->
<?php include 'inc/footer.php'; ?>