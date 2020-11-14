<?php include 'inc/header.php'; ?>
<?php
$policyid = preg_replace('/\D/', '', $_GET['policyid']);
$policyid = htmlentities($policyid);

if (!isset($policyid) || $policyid == NULL) {
echo '<script>window.history.back();</script>';
}elseif($policyid==0){
echo '<script>window.history.back();</script>';
}else{
$policyid = (int)$policyid;
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
     if (method_exists($ps, 'psPolicyByPolicyId')) {
        $psdresult = $ps->psPolicyByPolicyId($policyid);
        if ($psdresult) {
            while ($prows = $psdresult->fetch_assoc()) {

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

        $page_url = strtolower(str_replace('_', '_', $services_url));
        $page_name = ucwords(str_replace('_', ' ', $services_url));                      

       $plicyimg = "images/services/".$services_url."/policy/".$policy_id."/".$policy_img;

        if (file_exists($plicyimg) != false){
           $plicyimg = "../images/services/".$services_url."/policy/".$policy_id."/".$policy_img;
         }else{
           $plicyimg = "../img/logo.png";
         }

    ?>
<!--Page Title-->
<section class="page_title_new" style="background-image:url(<?php echo BASE_PATH; ?>/img/title-background.jpg);">
<div class="auto-container">
 <div class="sec-title">
    <h1 class=" wow fadeInDown" data-wow-delay="500ms"> <?php echo $policy_name; ?> </h1>
    <p><a href="<?php echo BASE_PATH; ?>"><i class="fa fa-home"></i></a>  <span class="sep sep-1"> » </span> <a href="<?php echo BASE_PATH.$page_url; ?>"><?php echo $page_name; ?> </a> <span class="sep sep-1"> » </span> <?php echo $policy_name; ?> </p>
 </div>
</div>
</section>
<!--End Page Title-->
<!--Sidebar Page Container-->
<div class="sidebar-page-container services_page">
<div class="auto-container">
    <div class="row clearfix">    
    <!--Content Side / Blog Sidebar-->
    <?php include_once 'inc/services-policy-sidebar.php'; ?>
    <div class="content-side col-lg-8 col-md-12 col-sm-12">
    <div class="blog-single">
         <!-- News Block Three -->
        <div class="news-block">
            <h2><?php if (!empty($policy_name)) { echo $policy_name; } ?></h2>
            <div class="inner-box">

                <div class="image-box">
                    <figure class="image"><img src="<?php echo $plicyimg; ?>" alt=""></figure>
                </div>
                <div class="lower-content">  
                   <?php echo $policy_des; ?> 
                </div>
            </div>
        </div>
         <!-- Popular Products / Policies -->
         <hr class="imran_services_policy_bar">
         <div class="event-info-tabs tabs-box">
            <!--Tabs Box-->
            <ul class="tab-buttons clearfix">
                <li class="tab-btn active-btn" data-tab="#tab1">Highlights</li>
                <li class="tab-btn" data-tab="#tab2">Covered</li>
                <li class="tab-btn" data-tab="#tab3">Exclusions</li>
            </ul>
            <div class="tabs-content">
                <!--Tab-->
                <div class="tab active-tab" id="tab1">
                <?php if (!empty($highlights)) { echo $highlights; } ?>
                </div>
                <!--Tab-->
                <div class="tab" id="tab2">
                <?php if (!empty($covered)) { echo $covered; } ?>
                </div>
                <!--Tab-->
                <div class="tab" id="tab3">
                <?php if (!empty($exclusions)) { echo $exclusions; } ?>
                </div>
            </div>
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