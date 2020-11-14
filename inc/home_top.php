<?php
  if (class_exists('SlideContentClass')) {
    $scc = new SlideContentClass();
    if (method_exists($scc, 'getHomeImageVideoMeg')) {
      $result = $scc->getHomeImageVideoMeg();
      if ($result) {
        while ($rows = $result->fetch_assoc()) {
      $youtube_video_url = $rows['youtube_video_url'];
      $model_image = $rows['banner_image'];
      $welcome_msg  = htmlspecialchars_decode(stripcslashes($rows['welcome_msg']));
      $banner_image = "img/banner_image/".$model_image;
      if (!file_exists($banner_image)) {
        $banner_image = "img/logo.png";
      }    
 ?>
<!-- About Section -->
<section class="about-section-two padding-top">
<div class="anim-icons full-width">
    <span class="icon icon-circle-blue wow fadeIn"></span>
    <span class="icon icon-dots wow fadeInleft"></span>
    <span class="icon icon-circle-1 wow zoomIn"></span>
</div> 
<div class="auto-container">
  <div class="row">
    <!-- Image Column -->
<div class="image-column col-lg-8 col-md-12 col-sm-12 wow slideInLeft imaranhosen_git_imgslider" data-wow-delay="500ms">
<!-- <img src="<?php echo $banner_image; ?>" alt="Image"> -->
<?php include_once 'slide_banner.php'; ?>
</div>
<!-- Content Column -->
<div class="content-column col-lg-4 col-md-12 col-sm-12 order-2">
<div class="row">
<div class="about-block col-lg-12 col-md-12 col-sm-12">
    <div class="inner-box">
    <!-- <img src="<?php echo $banner_image; ?>" alt="Image"> -->
    <?php
     if (class_exists('EmployerClass')) {
       $emObj = new EmployerClass();
       if (method_exists($emObj, 'getCharimanSpace')) {
         $csdata = $emObj->getCharimanSpace();
         if ($csdata) {
           while ($csrow = $csdata->fetch_assoc()) {
             $chairman_space_id    = $csrow['chairman_space_id'];
             $chairman_space_title = $csrow['chairman_space_title'];
             $chairman_space_img   = $csrow['chairman_space_img'];
             $chairman_space_text  = $csrow['chairman_space_text'];

             $cs_img = "img/chairman_space/".$chairman_space_id."/".$chairman_space_img;
             if (file_exists($cs_img) != false) {
               $cs_img = "img/chairman_space/".$chairman_space_id."/".$chairman_space_img;
             }else{
              $cs_img = "img/logo.png";
             }
        ?>
      <div class="card charman_space wow slideInRight" data-wow-delay="500ms">  
      <a href="message-from-chairman"><p><?php if (!empty($chairman_space_title)) {
        echo $chairman_space_title;
      } ?></p>   
      <img src="<?php if (!empty($cs_img)) { echo $cs_img; } ?>"> <span> <?php if (!empty($chairman_space_text)) { echo $chairman_space_text; } ?> </span><button type="button" class="align-self-end btn imran-btn-style btn-sm float-right"> See More </button></a>
    </div>
      <?php } } } } ?>    
    </div>
</div>                
<div class="about-block col-lg-12 col-md-12 col-sm-12">
    <div class="inner-box wow zoomIn" data-wow-delay=500ms>
       <?php echo preg_replace("/\s*[a-zA-Z\/\/:\.]*youtube.com\/watch\?v=([a-zA-Z0-9\-_]+)([a-zA-Z0-9\/\*\-\_\?\&\;\%\=\.]*)/i",
          "<iframe width=\"100%\" height=\"215\" src=\"//www.youtube.com/embed/$1?autoplay=1&rel=0&controls=0&showinfo=0&mute=1\" frameborder=\"0\" volume=\"0\" allowfullscreen></iframe>", 
          $youtube_video_url); ?>
      <!-- <iframe width="100%" height="215" src="https://www.youtube.com/embed/xIaQhVdbCxc?autoplay=1&rel=0&controls=0&showinfo=0&mute=1" frameborder="0" volume="0" allowfullscreen></iframe> -->
    </div>
</div>
</div>
</div>

</div>
</div>
</section>
<!--End About Section -->
<!-- Modal -->

<!-- <div class="modal fade" id="welcomeMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <span class="modal_dismiss" data-dismiss="modal"><span aria-hidden="true">&times;</span></span>
  <div class="modal-dialog" role="document">
    <div class="modal-content">      
      <div class="modal-body">
        
      </div>
    </div>
  </div>
</div> -->

<!-- Modal -->
<div class="modal fade" id="welcomeMessageModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog github_mdimranhosen_welcomemodal" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title welcome_modal_title" id="exampleModalLabel"> Welcome </h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php if (!empty($model_image)) { ?>
          <img src="<?php echo $banner_image; ?>" style="width: 100%;max-width: 100%;">

       <?php } ?>        
        <?php if (!empty($welcome_msg)) { echo $welcome_msg; } ?>
      </div>
    </div>
  </div>
</div>
<?php  } } } } ?>