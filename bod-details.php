<?php include 'inc/header.php'; ?>
<?php
$em_url = preg_replace('/\D/', '', $_GET['em_url']);
$em_url = htmlentities($em_url);

if (!isset($em_url) || $em_url == NULL) {
header('Location: '.BASE_PATH.'/board-of-directors');
}elseif($em_url==0) {
header('Location: '.BASE_PATH.'/board-of-directors');
}else{
$em_url = (int)$em_url;
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
      if (class_exists('EmployerClass')) {
        $em = new EmployerClass();
        if (method_exists($em, 'boardOfDirectorsUpdateById')) {
          $result = $em->boardOfDirectorsUpdateById('board_of_directors',$em_url);
         if ($result) {
        while ($rows = $result->fetch_assoc()) {
                
          $em_id   = $rows['em_id'];
          $em_name = $rows['em_name'];
          $em_deg  = $rows['em_designation'];          
          $em_fb   = $rows['em_fb'];
          $em_tw   = $rows['em_tw'];
          $em_pt   = $rows['em_pt'];
          $em_lk   = $rows['em_lk'];
          $em_type = $rows['em_type'];
          $logo    = $rows['em_photo'];
          $em_des  = htmlspecialchars_decode(stripslashes($rows['em_description']));

          $image    = "../../images/".$em_type."/".$em_id."/".$logo;
          if (!file_exists($image)) {
            $image    = "../images/".$em_type."/".$em_id."/".$logo;
          }else{
             $image = "../img/logo.png";
          }
  ?>
<!--Page Title-->
<section class="page_title_new" style="background-image:url(<?php echo BASE_PATH; ?>/img/title-background.jpg);">
<div class="auto-container">
 <div class="sec-title">
    <h1><?php echo $em_name; ?></h1>
    <p><a href="<?php echo BASE_PATH; ?>"><i class="fa fa-home"></i></a> <span class="sep sep-1"> » </span> <a href="<?php echo BASE_PATH; ?>board-of-directors"> Board of Directors</a> <span class="sep sep-1"> » <?php echo $em_name; ?> </span></p>
 </div>
</div>
</section>
<!--End Page Title-->
<!--Sidebar Page Container-->
<div class="sidebar-page-container services_page">
<div class="auto-container">
    <div class="row clearfix">
    <!--Content Side / Blog Sidebar-->
    <div class="sidebar-side col-lg-4 col-md-12 col-sm-12">
    <?php include_once 'inc/about_sidebar.php'; ?>
    </div> 
    <div class="content-side col-lg-8 col-md-12 col-sm-12">
    <div class="blog-single">
         <!-- News Block Three -->
         <div class="row">
             <div class="col-lg-4 col-md-12 col-sm-12 imran_sbod">
                 <div class="inner-column">
                  <div class="ticket-form">
                  <img title="<?php echo $em_name; ?>" src="<?php echo $image; ?>">
                  <h5><?php echo $em_name; ?></h5>
                  <p><?php echo $em_deg; ?></p>
                 </div>
                  <!-- Follow Us -->
                  <div class="follow-us">    
                      <ul class="social-icon-two social-icon-colored">
                      <?php if ($em_fb) { ?>
                          <li><a href="https://facebook.com/<?php echo $em_fb; ?>"><i class="fab fa-facebook-f"></i></a></li>
                       <?php } if ($em_tw) { ?>
                          <li><a href="https://www.twitter.com/<?php echo $em_tw; ?>"><i class="fab fa-twitter"></i></a></li>
                        <?php } if ($em_pt) { ?>
                          <li><a href="https://www.pinterest.com/<?php echo $em_pt; ?>"><i class="fab fa-pinterest"></i></a></li>
                        <?php } if ($em_lk) { ?>
                          <li><a href="https://www.linkedin.com/<?php echo $em_lk; ?>"><i class="fab fa-linkedin"></i></a></li>
                        <?php } ?>
                      </ul>
                  </div>
                </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 imran_sbod_details wow fadeInUp" data-wow-delay="500ms">   
                  <?php echo $em_des; ?>
                </div>
        </div>
    </div>
    </div>   
    </div>
</div>
</div>
<!-- End Services Details Container -->
<?php } } } } ?>

  <!-- Main Footer -->
<?php include 'inc/footer.php'; ?>