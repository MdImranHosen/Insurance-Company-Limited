<?php include 'inc/header.php'; ?>
<?php
if ($_GET['nedid']) {

    $nedid = preg_replace('/\D/', '', $_GET['nedid']);
    $nedid = htmlentities($nedid);

    if (!isset($nedid) || $nedid == NULL) {
    header('Location: '.BASE_PATH.'news-events');
    }elseif($nedid==0){
    header('Location: '.BASE_PATH.'news-events');
    }else{
    $nedid = (int)$nedid;
    }
}else{ header('Location: '.BASE_PATH.'news-events'); }
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
if (class_exists('NewsEventsClass')) {
  $neObj = new NewsEventsClass();
  if (method_exists($neObj, 'getNewsEventsUpdate')) {
    $result = $neObj->getNewsEventsUpdate($nedid);
    if ($result) {
      while ($rows = $result->fetch_assoc()) {
        $ne_id  = $rows['news_events_id'];
        $title  = $rows['news_events_title'];
        $date   = $rows['news_events_date'];
        $file   = $rows['news_events_file'];
        $des    = htmlspecialchars_decode(stripcslashes($rows['news_events_des']));
        $c_date = $rows['create_date'];       

      $img = "news_events/".$ne_id."/".$file;
      if (file_exists($img) != false) {         
         $img = "../news_events/".$ne_id."/".$file;
       } else{         
         $img = "../img/logo.png";
       }
?>
<!--Page Title-->
<section class="page_title_new" style="background-image:url(<?php echo BASE_PATH; ?>/img/title-background.jpg);">
<div class="auto-container">
 <div class="sec-title">
    <h1><?php echo $pageName; ?></h1>
    <p><a href="<?php echo BASE_PATH; ?>"><i class="fa fa-home"></i></a> <span class="sep sep-1"> » </span> <a href="<?php echo BASE_PATH; ?>news-events"> News & Events </a> <span class="sep sep-1"> » </span> <?php echo $title; ?> </p>
 </div>
</div>
</section>
<!--End Page Title-->
<!--Sidebar Page Container-->
<div class="sidebar-page-container services_page">
<div class="auto-container">
    <div class="row clearfix">    
    <!--Content Side / Blog Sidebar-->
    <!--Sidebar Side-->
<div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
    <aside class="sidebar">
        <!-- Category Widget -->
        <div class="sidebar-widget categories">
            <h4 style="background: #6D0D67;color: white;padding: 10px;" class="sidebar-title"> News & Events </h4>
            <div class="widget-content">
                <!-- Blog Category -->
                <ul class="blog-categories">
              <?php
                  if (method_exists($neObj, 'getNewsEventsDataDetailsSided')) {
                    $neddata = $neObj->getNewsEventsDataDetailsSided();
                    if ($neddata) {
                      while ($nedrows = $neddata->fetch_assoc()) {
                        $ned_id    = $nedrows['news_events_id'];
                        $ned_title = $nedrows['news_events_title'];

                        if ($ned_id == $nedid) {
                                $active = 'class="active"';
                            }else{
                                $active = '';
                            }

                            $ned_title = $neObj->textShorten($ned_title, 40);
                            
                            $url = BASE_PATH."news-events-details/".$ned_id;
                          echo '<li '.$active.'><a href="'.$url.'">'.$ned_title.'</a></li>';
                    } } } ?>

                </ul>
            </div>
        </div>

    </aside>
</div>

    <div class="content-side col-lg-8 col-md-12 col-sm-12">
    <div class="blog-single">
         <!-- News Block Three -->
        <div class="news-block">
            <div class="inner-box">
              <div class="image-box">
                <div style="padding: 8px 2px;font-size: 20px;"><i class="fa fa-clock"></i><?php if (!empty($date)) { echo $date; } ?></div>
                <figure class="image"><img src="<?php echo $img; ?>" alt=""></figure>
               </div>
                <div class="lower-content">  
                   <?php if (!empty($des)) { echo $des; } ?> 
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>
</div>
<!-- End Services Details Container -->
<?php  } } } } ?>
    <!-- Main Footer -->
<?php include 'inc/footer.php'; ?>