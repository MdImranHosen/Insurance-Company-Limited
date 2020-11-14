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
<!-- Schedule Section Style two -->
<section class="schedule-section imran_schedule_style style-three">
<div class="auto-container">
<?php
 if (class_exists('BranchesClass')) {
   $brc = new BranchesClass(); 
 ?>
<div class="schedule-tabs style-three tabs-box"> 
<!--Tabs Box-->  
<?php 
 if (method_exists($brc, 'getBranchesDivision')) {
    $enumList = $brc->getBranchesDivision(); 
    if ($enumList) {
      $selected = '<div class="btns-box"><ul class="tab-buttons event_tabs clearfix"><li class="tab-btn active-btn" data-tab="#all"><span class="imran_division">All</span></li>';
      foreach($enumList as $value){
      $val_url = strtolower($value);
      $selected .= '<li class="tab-btn" data-tab="#'.$val_url.'"><span class="imran_division">'.$value.'</span></li>';
       
    }
    $selected .= '</ul></div>';
    echo $selected;
?>
<div class="tabs-content">
<!--Tab-->
<div class="tab active-tab" id="all">

  <div class="schedule-timeline row">
     <?php 
       if (method_exists($brc, 'getDivisionByBranches')) {
          $result = $brc->getDivisionByBranches('all');
          if ($result) {
            while ($rows = $result->fetch_assoc()) {
     ?>
      <!-- schedule Block -->
      <div class="schedule-block col-lg-4  col-md-4  col-sm-12">
          <div class="inner-box branches_style wow zoomIn" data-wow-delay="500ms">
              <div class="inner">
                  <h4> <?php echo $rows['branches_name']; ?> </h4>
                  <div class="text"><p><?php echo $rows['branches_address']; ?> </p>
                   <p> <?php echo $rows['branches_phone']; ?> </p>
                   <p><?php echo $rows['branches_email']; ?></p>
                 </div>
              </div>
          </div>
      </div>
      <?php } } } ?>

  </div>
</div>
<!--Tab-->
<?php
 foreach ($enumList as $value) {
   $val_url = strtolower($value);
 ?>

<div class="tab" id="<?php echo $val_url; ?>">
  <div class="schedule-timeline row">
     <!-- schedule Block -->
      <?php 
       if (method_exists($brc, 'getDivisionByBranches')) {
          $result = $brc->getDivisionByBranches($val_url);
          if ($result) {
            while ($rows = $result->fetch_assoc()) {
     ?>
      <!-- schedule Block -->
      <div class="schedule-block col-lg-4  col-md-4  col-sm-12">
          <div class="inner-box branches_style">
              <div class="inner">
                  <h4> <?php echo $rows['branches_name']; ?> </h4>
                  <div class="text"><p><?php echo $rows['branches_address']; ?> </p>
                   <p> <?php echo $rows['branches_phone']; ?> </p>
                   <p><?php echo $rows['branches_email']; ?></p>
                 </div>
              </div>
          </div>
      </div>
      <?php } } } ?>
  </div>
</div>
<?php } ?>
</div>
<?php } } ?>
</div>
<?php } ?>
</div>
</section>
<!--End schedule Section -->
<!-- Main Footer -->
<?php include 'inc/footer.php'; ?>