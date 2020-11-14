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
<div class="content-side col-lg-12 col-md-12 col-sm-12">
<div class="blog-single wow fadeInDown" data-wow-delay="500ms">
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

<div class="download_page_style">
  <?php 
    if (class_exists('DownloadClass')) {
      $dwObj = new DownloadClass();
      if (method_exists($dwObj, 'downloadCategoryDisplay')) { 

        $result = $dwObj->downloadCategoryDisplay();
        if ($result) {

          $catoutput = '';

          while ($rows = $result->fetch_assoc()) {

            $dwf_cat_id    = $rows['dwf_cat_id'];
            $dwf_cat_title = $rows['dwf_cat_title'];            

            $catoutput .= '<h2>'.$dwf_cat_title.'</h2>';

            if (method_exists($dwObj, 'downloadFromDataByCat')) {
              $dwfData = $dwObj->downloadFromDataByCat($dwf_cat_title);

              if ($dwfData) {
                $dwfoutput = '<ul class="github_imranhosen_annual_des">';
                while ($dwrow = $dwfData->fetch_assoc()) {
                   $dwf_id    = $dwrow['dwf_id'];
                   $dwf_title = $dwrow['dwf_title'];
                   $dwf_date  = $dwrow['dwf_date'];
                   $dwf_file  = $dwrow['dwf_file'];

                   $docfile = "document/download_forms/".$dwf_id."/".$dwf_file;
                    if (!file_exists($docfile)) {
                       $docfile = "document/logo.png";
                      }

                  $dwfoutput .= '<li><a title="Download" href="'.$docfile.'" download=""> <i class="fa fa-download"></i>'.$dwf_title.' - '.$dwf_date.'</a></li>';

               
              }
             $dwfoutput .= '</ul>';

             $catoutput .= $dwfoutput;

            }            
           }
       } 
    echo $catoutput;

  } } } ?>

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