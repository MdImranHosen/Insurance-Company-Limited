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
    <div class="blog-single wow fadeInUp" data-wow-delay="800ms">
         <!-- News Block Three -->
        <div class="news-block">
            <div class="inner-box">
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
          $logo     = $rows['fi_file'];
          $fi_des  = htmlspecialchars_decode(stripslashes($rows['fi_des']));
          $image    = "images/".$fi_type."/".$id."/".$logo;
          if (!file_exists($image)) {
           $image = "img/logo.png";
         }


        ?>
        <div class="image-box">
            <figure class="image"><img src="<?php echo $image; ?>" alt=""></figure>
        </div>
        <div class="lower-content">
            <ul class="post-info">
                <li><span class="far fa-time"></span> <?php echo $fi_date; ?></li>
            </ul>    
            <h2><?php echo $fi_title; ?></h2>
            <p><?php echo $fi_des; ?></p>
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