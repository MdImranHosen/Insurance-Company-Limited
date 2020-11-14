<?php include 'inc/header.php'; ?>
<?php
$psurl = preg_replace('/\D/', '', $_GET['psurl']);
$psurl = htmlentities($psurl);

if (!isset($psurl) || $psurl == NULL) {
header('Location: '.BASE_PATH.'/product-services');
}elseif($psurl==0){
header('Location: '.BASE_PATH.'/product-services');
}else{
$psurl = (int)$psurl;
}
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
 <?php
    if (class_exists('ServicesClass')) {
     $ps = new ServicesClass();
     if (method_exists($ps, 'productsServicesUpdate')) {
        $psdresult = $ps->productsServicesUpdate($psurl);
        if ($psdresult) {
            while ($psdrows = $psdresult->fetch_assoc()) {
        $psd_title  = $psdrows['ps_title'];
        $psd_details = htmlspecialchars_decode(stripslashes($psdrows['ps_details']));

     $img = "images/services/".$psdrows['id']."/".$psdrows['ps_image'];

    if (file_exists($img) != false) {         
         $img = "../images/services/".$psdrows['id']."/".$psdrows['ps_image'];
       } else{         
         $img = "../img/logo.png";
       }

    ?>
<!--Page Title-->
<section class="page_title_new" style="background-image:url(<?php echo BASE_PATH; ?>/img/title-background.jpg);">
<div class="auto-container">
 <div class="sec-title">
    <h1><?php echo $psd_title; ?></h1>
    <p><a href="<?php echo BASE_PATH; ?>"><i class="fa fa-home"></i></a> <span class="sep sep-1"> » </span> <a href="<?php echo BASE_PATH; ?>product-services">Products & Services </a> <span class="sep sep-1"> » </span> <?php echo $psd_title; ?> </p>
 </div>
</div>
</section>
<!--End Page Title-->
<!--Sidebar Page Container-->
<div class="sidebar-page-container services_page">
<div class="auto-container">
    <div class="row clearfix">
    
    <!--Content Side / Blog Sidebar-->
    <div class="content-side col-lg-8 col-md-12 col-sm-12">
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
    </div>
    </div>   
        <!--Sidebar Side-->
        <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
            <aside class="sidebar padding-left">

                <!-- Category Widget -->
                <div class="sidebar-widget categories">
                    <h4 class="sidebar-title">Products & Services</h4>
                    <div class="widget-content">
                        <!-- Blog Category -->
                        <ul class="blog-categories">
                    <?php 
                        if (method_exists($ps, 'getProductsServicesData')) {
                               $psresult = $ps->getProductsServicesData();
                               if ($psresult) {
                                while ($psrows = $psresult->fetch_assoc()) {
                                    $psid     = $psrows['id'];
                                    $ps_icon  = $psrows['ps_icon'];
                                    $ps_title = $psrows['ps_title'];
                                    $ps_url   = $psrows['ps_url'];
                                    
                                    $psurl = BASE_PATH."product-services/".$psid;
                                  echo '<li><a href="'.$psurl.'"><i class="icon '.$ps_icon.'"></i> '. $ps_title.'<span>>></span></a></li>';
                                } } } ?>

                        </ul>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</div>
</div>
<!-- End Services Details Container -->
<?php  } } } } ?>
    <!-- Main Footer -->
<?php include 'inc/footer.php'; ?>