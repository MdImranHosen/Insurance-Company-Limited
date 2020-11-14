<?php
if (class_exists('SettingsClass')) {
$sobj = new SettingsClass();
if (method_exists($sobj, 'getSettingsData')) {
$sifo = $sobj->getSettingsData();
if ($sifo) {
$sirows = $sifo->fetch_assoc();
?> 
<!-- Main Footer -->
<footer class="main-footer" style="background: #F0F0F0;">
<!--Widgets Section-->
<div class="widgets-section">
<div class="auto-container">
<div class="row">
<!--Big Column-->
<div class="big-column col-xl-6 col-lg-6 col-md-12 col-sm-12">
<div class="row">
<!--Footer Column-->
<div class="footer-column col-xl-7 col-lg-6 col-md-6 col-sm-6">
    <div class="footer-widget about-widget">
        <div class="logo">
            <a href="<?php echo BASE_PATH; ?>">
              <center><img style="border-radius: 5px;width: 90%;" src="<?php echo BASE_PATH; ?>/img/<?php echo $sirows['site_logo']; ?>" alt="" /></center> 
            </a>
        </div>
        <div class="text">
            <p><?php echo htmlspecialchars_decode(stripslashes($sirows['site_footer_about'])); ?></p>           
        </div>
        <ul class="social-icon-one social-icon-colored">
            <li><a target="_blank" href="<?php echo $sirows['site_facebook']; ?>"><i class="fab fa-facebook-f"></i></a></li>
            <li><a target="_blank" href="<?php echo $sirows['site_twitter']; ?>"><i class="fab fa-twitter"></i></a></li>
            <li><a target="_blank" href="<?php echo $sirows['site_linkedin']; ?>"><i class="fab fa-linkedin-in"></i></a></li>
            <li><a target="_blank" href="<?php echo $sirows['site_youtube']; ?>"><i class="fab fa-youtube"></i></a></li>
            <li><a target="_blank" href="<?php echo $sirows['site_instagram']; ?>"><i class="fab fa-instagram"></i></a></li>
          </ul> 
    </div>
</div>

<!--Footer Column-->
<div class="footer-column col-xl-5 col-lg-6 col-md-6 col-sm-6">
    <div class="footer-widget useful-links">
        <h2 class="widget-title">Who we are </h2>
        <ul class="user-links">
            <li><a href="<?php echo BASE_PATH; ?>"><i class="fa fa-home"></i> Home </a></li>
            <li><a href="<?php echo BASE_PATH; ?>about-us"><i class="fa fa-globe"></i> About Us </a></li>
            <li><a href="<?php echo BASE_PATH; ?>our-vision-mission"><i class="icon flaticon-target"></i> Our Vision & Mission </a></li>
            <li><a href="<?php echo BASE_PATH; ?>media-gallery"><i class="icon flaticon-arrows-2" aria-hidden="true"></i> Video Gallery </a></li>
            <li><a href="<?php echo BASE_PATH; ?>gallery"><i class="icon flaticon-4-square-shapes"></i> Photo Gallery </a></li>
            <li><a href="<?php echo BASE_PATH; ?>contact-us"> <i class="icon flaticon-chat"></i> Contact Us </a></li>
        </ul>
    </div>
</div>
</div>
</div>

<!--Big Column-->
<div class="big-column col-xl-6 col-lg-6 col-md-12 col-sm-12">
<div class="row">
<!--Footer Column-->
<div class="footer-column col-lg-6 col-md-6 col-sm-6">
    <!--Footer Column-->
    <div class="footer-widget contact-widget">
        <h2 class="widget-title"> Useful Links  </h2>
         <!--Footer Column-->
        <div class="widget-content">
         <ul class="user-links">
           <li><a href="<?php echo BASE_PATH; ?>product-services"><i class="icon flaticon-royal-crown-of-elegant-vintage-design" aria-hidden="true"></i> Product & Services </a></li>
           <li><a href="<?php echo BASE_PATH; ?>news-events"><i class="icon flaticon-business" aria-hidden="true"></i> Events & News </a></li>
            <li><a href="<?php echo BASE_PATH; ?>directors-employers-list"><i class="fa fa-users"></i> Directors & Employers List </a></li>
            <li><a href="<?php echo BASE_PATH; ?>branches"><i class="icon flaticon-snowflake"></i> Branches </a></li>
            <li><a href="<?php echo BASE_PATH; ?>financial-strength"><i class="icon flaticon-graph-1"></i> Financial Strength </a></li>
            <li><a href="<?php echo BASE_PATH; ?>unsettled-claim-information"><i class="icon flaticon-desktop-computer-with-magnifying-lens-focusing-on-data"></i> Unsettled Claim Information </a></li>
            <li><a href="<?php echo BASE_PATH; ?>agent-license"><i class="fa fa-download"></i> Agent License </a></li> 
         </ul>
        </div>
    </div>
</div>

<!--Footer Column-->
<div class="footer-column col-lg-6 col-md-6 col-sm-6">
    <!--Footer Column-->
    <div class="footer-widget instagram-widget">
        <h2 class="widget-title"> Connect with Us </h2>
        <div class="widget-content">
          <div class="outer clearfix">
              <ul class="contact-list">
                <li>
                    <span class="icon flaticon-mail"></span>
                    <div class="text"><a href="mailto:<?php echo $sirows['site_email']; ?>"> <?php echo $sirows['site_email']; ?> </a></div>
                </li>
                <li>
                    <span class="icon flaticon-phone"></span>
                    <div class="text"><a href="tel:<?php echo $sirows['site_phone']; ?>"> <?php echo $sirows['site_phone']; ?> </a></div>
                </li>
                <li>
                    <span class="icon flaticon-clock"></span>
                    <div class="text"><?php  
                    echo str_replace("=","",$sirows['opening_time']);
                    ?></div>
                </li>
                <li>
                    <span class="icon flaticon-placeholder"></span>
                    <div class="text"><?php echo $sirows['site_address']; ?></div>
                </li>
            </ul>
            </div>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>

<!--Footer Bottom-->
<div class="footer-bottom">                    
<div class="auto-container">
<div class="inner-container clearfix">
<div class="copyright-text">
<p> Copyright © <?php echo $sirows['site_copy_right']; ?>. All Rights Reserved by <a target="_blank" href="<?php echo $sirows['develop_site_url']; ?>"><?php echo $sirows['site_dev']; ?></a></p>
</div>
</div>
</div>
</div>
</footer>
<!-- End Footer -->
<?php } } } ?>

</div>
<!--End pagewrapper-->
<!--Scroll to top-->
<div class="scroll-to-top scroll-to-target" data-target="html"><span class="fa fa-angle-double-up"></span></div>
<script src="<?php echo BASE_PATH; ?>js/jquery.js"></script>
<script src="<?php echo BASE_PATH; ?>js/popper.min.js"></script>
<script src="<?php echo BASE_PATH; ?>js/bootstrap.min.js"></script>
<script src="<?php echo BASE_PATH; ?>js/jquery-ui.js"></script>
<script src="<?php echo BASE_PATH; ?>js/jquery.fancybox.js"></script>
<script src="<?php echo BASE_PATH; ?>js/appear.js"></script>
<script src="<?php echo BASE_PATH; ?>js/owl.js"></script>
<script src="<?php echo BASE_PATH; ?>js/jquery.countdown.js"></script>
<script src="<?php echo BASE_PATH; ?>js/wow.js"></script>
<script src="<?php echo BASE_PATH; ?>js/parallax.min.js"></script>
<script src="<?php echo BASE_PATH; ?>js/validate.js"></script>
<script src="<?php echo BASE_PATH; ?>js/script.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="<?php echo BASE_PATH; ?>js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo BASE_PATH; ?>js/bootstrap-select.min.js"></script>
<!-- Color Setting -->
<script src="<?php echo BASE_PATH; ?>js/color-settings.js"></script>
</body>
</html>