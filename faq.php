<?php include 'inc/header.php'; ?>
<?php
$psid = preg_replace('/\D/', '', $_GET['psid']);
$psid = htmlentities($psid);

if (!isset($psid) || $psid == NULL) {
header('Location: '.BASE_PATH);
}elseif($psid==0){
header('Location: '.BASE_PATH);
}else{
$psid = (int)$psid;

?>
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
<div class="blog-single wow fadeInUp" data-wow-delay="500ms">
     <!-- News Block Three -->
    <div class="news-block">
        <div class="inner-box" style="background-color: #F9F9F9;">

          <!-- <h1 class="annual_reports_style faq_page_title_style"> FAQ </h1> -->
          <?php 

           if (class_exists('FaqClass')) {
            $faqObj = new FaqClass();
            if (method_exists($faqObj, 'getFaqBypsId')) {
              $faqData = $faqObj->getFaqBypsId($psid);
              if ($faqData) {
                while ($frows = $faqData->fetch_assoc()) {                      
                  $faq_id       = $frows['faq_id'];
                  $faq_ask      = $frows['faq_ask'];
                  $faq_solution = $frows['faq_solution'];
                  $faq_status   = $frows['faq_status'];
                  $services_title = $frows['services_title'];
          ?>
          <div class="faq_page_style">
            <h3><?php if (!empty($faq_ask)) { echo $faq_ask; } ?></h3>
            <hr class="github_mdimranhosen_faq">
            <p><?php if (!empty($faq_solution)) { echo $faq_solution; } ?></p>
          </div> 
          <?php } } } } ?>
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
<?php } ?>