<div class="carousel-outer">
<div class="single-item-carousel owl-carousel owl-theme">
    <!-- Slide Item -->
    <?php 
     if (class_exists('SlideContentClass')) {
         $slide = new SlideContentClass();
         if (method_exists($slide, 'getSlideContent')) {
            $gets = $slide->getSlideContent();
            if ($gets) {
                while ($getrows = $gets->fetch_assoc()) {

             $slide_id    = $getrows['slide_id'];
             $slide_title = $getrows['slide_title'];
             $logo_slide  = $getrows['slide_bg_img'];
             $slide_image = "images/main-slider/".$slide_id."/".$logo_slide;

      if (!file_exists($slide_image)) {
       $slide_image = "images/main-slider/1.jpg";
      }
    ?>
    <!-- Testimonial Block -->
            <div class="testimonial-block">
                <div class="inner">
                    <img src="<?php echo $slide_image; ?>" alt="<?php echo $slide_title; ?>" title="<?php echo $slide_title; ?>">
                </div>
            </div>
   <?php  } } } } ?>
</div>
</div>
