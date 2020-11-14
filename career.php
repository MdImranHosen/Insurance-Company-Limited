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
 if (realpath('inc/page_title.php')) {
   include_once 'inc/page_title.php';
 }
 ?>
<!--End Page Title-->
<!--Sidebar Page Container-->
<div class="sidebar-page-container services_page">
<div class="auto-container">
    <div class="row clearfix">    
    <!--Content Side / Blog Sidebar-->
    <div class="content-side col-lg-8 col-md-12 col-sm-12">
    <div class="blog-single wow slideInLeft" data-wow-delay="500ms">
         <!-- News Block Three -->
        <div class="news-block">
            <div class="inner-box" style="background-color: #F9F9F9;">
              <div class="lower-content">
                   <?php 
                   if (class_exists("SettingsClass")) {
                       $settings = new SettingsClass();
                      if (method_exists($settings, 'getAboutsData')) {
                        $about_result = $settings->getAboutsData();
                        if ($about_result) {
                          while ($about_rows = $about_result->fetch_assoc()) {

                            $career = $about_rows['career'];
                            echo htmlspecialchars_decode(stripslashes($career));
                   } } } }
                  ?>
          </div>             
            </div>
        </div>
    </div>
    </div>
   <!--Sidebar Side-->
        <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
            <aside class="sidebar padding-left wow slideInRight" data-wow-duration="2s" data-wow-delay="500ms">
                <div class="sidebar-widget categories">
                    <h4 class="sidebar-title resume_button"><a style="color: white;" href="<?php echo BASE_PATH; ?>submit-resume">Submit Resume </a></h4>
                </div>
            </aside>
        </div>
    </div>
</div>
</div>
<!-- End Services Details Container -->
<!-- Main Footer -->
<?php include 'inc/footer.php'; ?>