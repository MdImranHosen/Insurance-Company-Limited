<?php include 'inc/header.php'; ?>
<div class="page-wrapper">
<!-- Preloader -->
<div class="preloader"></div>
<!-- Header span -->
<?php include 'inc/menu.php'; ?>
<!-- Banner Section -->
<?php  include 'inc/home_top.php'; ?>
<!--End Banner Section -->    
    <!-- Product & Services Section Two -->
<section class="schedule-section imran_schedule_style style-three">
<div class="auto-container services_fbpage">
  <h2> <span id="services_name"> Fire </span> </h2>
<?php
 if (class_exists('ServicesClass')) {
   $psObj = new ServicesClass();
 ?>
<div class="schedule-tabs style-three tabs-box"> 
<!--Tabs Box-->  
<?php 
 if (method_exists($psObj, 'getProductsServicesData')) {
   $psdata = $psObj->getProductsServicesData();
    if ($psdata) {

      $selected = '<div class="btns-box"><ul class="tab-buttons event_tabs imran_services_tab clearfix">';
      $ps_i = 1;
      while ($psrow = $psdata->fetch_assoc()) {
         $ps_url    =  $psrow['ps_url'];
         $ps_title  =  $psrow['ps_title'];

         if (!empty($ps_title)) {
          $ex_data = explode(" ", $ps_title);
          $tab_title =  $ex_data[0];
         }else{
          $tab_title = '';
         }

         if ($ps_i == 1) {
            $active_btn = "active-btn";
         }else{ 
            $active_btn = '';
         }   

         $selected .= '<li data-services="'.$tab_title.'" class="onclickservicestab tab-btn '.$active_btn.'" data-tab="#'.$ps_url.'"><span class="imran_division">'.$tab_title.'</span></li>'; 

         $ps_i++;
      }    

    $selected .= '</ul></div>';
    echo $selected;
  } }
?>

<div class="tabs-content">
<!--Tab-->
<?php
if (method_exists($psObj, 'getProductsServicesData')) {
$psdata = $psObj->getProductsServicesData();
if ($psdata) {

 $ps_im = 1;
 $content = '';
while ($pscrow = $psdata->fetch_assoc()) {
   $psc_id     =  $pscrow['id'];
   $psc_url    =  $pscrow['ps_url'];
   $psc_title  =  $pscrow['ps_title'];
   $ps_details =  htmlspecialchars_decode(stripcslashes($pscrow['ps_details']));
   $desc       = $psObj->textShorten($ps_details, 250);
   $pspage_url = str_replace('_', '-', $psc_url);

   if ($ps_im == 1) {
      $active_tab = "active-tab";
   }else{ 
      $active_tab = '';
   } 

$content .='<div class="tab '.$active_tab.'" id="'.$psc_url.'">
  <div class="schedule-timeline row">
      <div class="schedule-block col-lg-12  col-md-12  col-sm-12">
          <div >
              <div class=" github_imranhosen_services text-center">
                  <h4>'.$psc_title.'</h4>
                  <div class="text mdimranhosen_github_serte"><p> '.$desc.' </p>
                  <a href="'.$pspage_url.'" class="btn imran-btn-style">View More</a>
                 </div>
                 <h3>So, let\'s get started.</h3>
                 <div class="row justify-content-center">
                   <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                   <div class="row">
                    <div class="services_policy_owl owl-carousel owl-theme">

                    <div class="item github_imranhosen_policy wow zoomIn">
                     <a href="#"><img src="images/policy/icon-buy_policy.png"/>
                     <p> Buy Policy </p></a>
                    </div>
                    <div class="item github_imranhosen_policy wow zoomIn">
                     <a href="#"><img src="images/policy/icon-renew_policy.png"/>
                     <p> Renew Policy </p></a>
                    </div>
                    <div class="item github_imranhosen_policy wow zoomIn">
                     <a href="faq/'.$psc_id.'"><img src="images/policy/icon-faq.png"/>
                     <p> Faq </p></a>
                    </div>
                    </div>

                    </div>

                    </div>
                 </div>
              </div>
          </div>
      </div>
  </div>
</div>';
 $ps_im++; 
 }
 echo $content;
 } }
?>
</div>

</div>
<?php } ?>
</div>
</section>
<!--End Product & Services Section -->
<!-- News Section -->
  <?php 
  if (realpath("inc/news_event.php")) {
       include 'inc/news_event.php';
   }
  ?>
<!--End News Section -->
<?php include 'inc/footer.php'; ?> 
<script src="js/jquery.mousewheel.min.js"></script>
<script src="js/news.events.owl.js"></script>
  <script type="text/javascript">
    $(window).on('load',function(){
        $('#welcomeMessageModal').modal('show');
    });
</script>
<script type="text/javascript">
  $(document).ready(function(){

$(document).on('click', '.onclickservicestab', (function() {
     var services   = $(this).data('services');

     $('#services_name').html(services);

 }));
});
</script>