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
    <div class="sidebar-side col-lg-3 col-md-12 col-sm-12">
    <?php include_once 'inc/dropdown-sidebar.php'; ?>
    </div> 
    <div class="content-side col-lg-9 col-md-12 col-sm-12">
    <div class="blog-single wow slideInRight" data-wow-delay="500ms">
         <!-- News Block Three -->
        <div class="news-block">
            <div class="inner-box" style="background-color: #F9F9F9;">
                <h1 class="annual_reports_style">
               <?php 
                 if (class_exists('SettingsClass')) {
                   $settings = new SettingsClass();
                   if (method_exists($settings, 'getPageTitleByPageName')) {
                     $pageTitleData = $settings->getPageTitleByPageName($currentpage);
                     if ($pageTitleData) {
                        while ($prows = $pageTitleData->fetch_assoc()) {
                         echo $prows['page_title'];
                 } } } } ?>
                </h1>
    <ul class="github_imranhosen_annual_des">
      <?php 
        if (class_exists('FinancialIndicatorsClass')) {
          $fiObj = new FinancialIndicatorsClass();
          if (method_exists($fiObj, 'financialIndicaPageNameTypeDisplay')) {      

            $result = $fiObj->financialIndicaPageNameTypeDisplay($currentpage);
            if ($result) {

              while ($rows = $result->fetch_assoc()) {

                $id       = $rows['fi_id'];
                $fi_title = $rows['fi_title'];
                $fi_date  = $rows['fi_date'];
                $fi_type  = $rows['fi_type'];
                $file     = $rows['fi_file'];

              $docfile = "document/".$fi_type."/".$id."/".$file;
              if (!file_exists($docfile)) {
                 $docfile = "document/logo.png";
               }
        ?>

        <li><a href="<?php echo $docfile; ?>" download=""> <i class="fa fa-download"></i> <?php echo $fi_title." - ".$fi_date; ?> </a></li>
       
      <?php  } } } } ?>

    </ul>              
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