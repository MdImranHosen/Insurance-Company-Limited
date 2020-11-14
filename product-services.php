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
<section style="background-color: #F9F9F9;margin-top: 5px;">
     <div class="auto-container">
      <div class="row" style="background-color: #F9F9F9;">
        <div class="col-lg-12 services_fbpage">
          <div class="row">
          <?php
          if (class_exists('ServicesClass')) {
            $ps = new ServicesClass();
            if (method_exists($ps, 'getByPageNameManu')) {
                $psresult = $ps->getByPageNameManu($currentpage);
                   if ($psresult) {
                    while ($psrows = $psresult->fetch_assoc()) {
                        $menu_id = $psrows['menu_id'];
                        $label = $psrows['label'];
                        $url   = $psrows['external_link'];                        
                        $psurl = BASE_PATH.$url; 
                        ?>
            <div class="col-lg-4">
              <div class="event_financial_indicators_style wow fadeInUp" data-wow-delay="500ms">
               <h3><?php echo $label; ?></h3> 
              <a href="<?php echo $psurl; ?>"> <i class="icon flaticon-next" aria-hidden="true"></i> Services Details </a>
              </div>
            </div>
           <?php } } } } ?>         
        </div>
        </div>
      </div>
    </div>
    </section>
<!-- End Services Details Container -->
    <!-- Main Footer -->
<?php include 'inc/footer.php'; ?>