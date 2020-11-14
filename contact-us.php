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
<div class="clearfix"></div>
<!--Page Title-->
<?php 
 if (realpath('inc/page_title.php')) {
   include_once 'inc/page_title.php';
 }
 ?>
<!--End Page Title-->
<?php
if (class_exists('SettingsClass')) {
$sobj = new SettingsClass();
if (method_exists($sobj, 'getSettingsData')) {
$sifo = $sobj->getSettingsData();
if ($sifo) {
$sirows = $sifo->fetch_assoc();
?> 
<!-- Contact Page Section -->
<section class="contact-page-section">
<div class="auto-container">
<div class="row clearfix">
<div class="contact-column col-lg-4 col-md-12 col-sm-12 order-2">
<div class="inner-column wow slideInRight" data-wow-delay="600ms">
    <div class="imran_sec-title">
        <h2>Contact Info</h2>
    </div>
    <ul class="contact-info">
        <li>
            <span class="icon fa fa-clock"></span>
            <p><strong> Opening Time </strong></p>
            <p> <?php echo str_replace("=","",$sirows['opening_time']); ?></p>
        </li>

        <li>
            <span class="icon fa fa-phone-volume"></span> 
            <p><strong> Call Us</strong></p>
            <p> <?php echo $sirows['site_phone']; ?> </p>
        </li>
        <li>
            <span class="icon fa fa-envelope"></span> 
            <p><strong> Mail Us </strong></p>
            <p><a href="mailto:<?php echo $sirows['site_email']; ?>"><?php echo $sirows['site_email']; ?></a></p>
        </li>
        <li>
            <span class="icon fa fa-map-marker-alt"></span> 
            <p><strong><?php echo $sirows['site_address']; ?> </strong></p>
            <p></p>
        </li>
      </ul>
    <ul class="social-icon-two social-icon-colored">
        <li><a target="_blank" href="<?php echo $sirows['site_facebook']; ?>"><i class="fab fa-facebook"></i></a></li>
        <li><a target="_blank" href="<?php echo $sirows['site_twitter']; ?>"><i class="fab fa-twitter"></i></a></li>
        <li><a target="_blank" href="<?php echo $sirows['site_linkedin']; ?>"><i class="fab fa-linkedin-in"></i></a></li>
        <li><a target="_blank" href="<?php echo $sirows['site_instagram']; ?>"><i class="fab fa-instagram"></i></a></li>
        <li><a target="_blank" href="<?php echo $sirows['site_youtube']; ?>"><i class="fab fa-youtube"></i></a></li>
    </ul>
</div>
</div>
<!-- Form Column -->
<div class="form-column col-lg-8 col-md-12 col-sm-12">
<div class="inner-column wow slideInLeft" data-wow-delay="600ms">
    <div class="contact-form">
        <div class="imran_sec-title">
            <h2>Get in Touch</h2>
            <div id="contact_msg"></div>
        </div>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" id="contact-form">
            <div class="row clearfix">
                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <input type="text" name="name" id="name" placeholder="Name" required="">
                </div>
                
                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <input type="text" name="phone" id="phone" placeholder="Phone" required="">
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <input type="email" name="email" id="email" placeholder="Email" required="">
                </div>

                <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                    <input type="text" name="subject" id="subject" placeholder="Subject" required="">
                </div>
                
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <textarea name="message" id="message" placeholder="Message"></textarea>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <select id="related_into">                        
                        <?php 
                         if (class_exists('ServicesClass')) {
                            $serc = new ServicesClass();
                            if (method_exists($serc, 'getProductsServicesData')) {
                               $sdic = $serc->getProductsServicesData();
                               if ($sdic) {
                                  $output = '<option style="cursor: pointer;display: none;" value=""> Related Info </option>';
                                   while ($sdrow = $sdic->fetch_assoc()) {
                                       $service_name = $sdrow['ps_title'];
                                       $output .= '<option value="'.$service_name.'">'.$service_name.'</option>';
                                   }
                                   $output .= '<option value="Others">Others</option>';
                                   echo $output;
                               }
                            }
                         }
                        ?>
                    </select>
                </div>
                
                <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                    <button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="btn-title"> Submit Now </span></button>
                </div>
            </div>
        </form>
    </div>
</div>
</div>
</div>
</div>
</section>
<!--End Contact Page Section -->

<!-- Map Section -->
<section class="map-section">
<div class="auto-container">
<div class="map-outer">
<!-- <div class="map-canvas"
data-zoom="12"
data-lat="23.7297177"
data-lng="90.3464757"
data-type="roadmap"
data-hue="#ffc400"
data-title="<?php echo $sirows['site_title']; ?>"
data-icon-path="<?php echo BASE_PATH; ?>/images/icons/map-marker.png"
data-content="<?php echo $sirows['site_address']; ?><br><a href='mailto:<?php echo $sirows['site_email']; ?>'><?php echo $sirows['site_email']; ?></a>">
</div> -->
<iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d82631.2949717164!2d90.38379753984611!3d23.753732767794016!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1scrystal%20insurance%20limited!5e0!3m2!1sen!2sbd!4v1598337900021!5m2!1sen!2sbd" width="100%" height="450" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
</div>
</div>
</section>
<!-- End Map Section -->
<?php } } } ?>
<!-- Main Footer -->
<?php include 'inc/footer.php'; ?>
<!--Google Map APi Key-->
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBgGwaFztvIfs3MKwLCvWBtRKt0qw8w0HA"></script>
<script src="js/map-script.js"></script> -->
<!--End Google Map APi-->
<script type="text/javascript">
$(document).ready(function(){
$('#contact-form').on('submit', function() {

var name    = $('#name').val();
var phone   = $('#phone').val();
var email   = $('#email').val();
var subject = $('#subject').val();
var message = $('#message').val();
var related_into = $('#related_into').val();

//alert(message);
if (name == '' || phone == '' || email == '' || subject == '' || message == '' || related_into == '') {
alert('Field must not be Empty');
return false;
} else {

$.ajax({
type: "post",
url: "ajax/contact_ajax.php",
data: {name:name,phone:phone,email:email,subject:subject,message:message,related_into:related_into},
success: function(con_msg) {
$('#contact_msg').html(con_msg);
}
});
return false;

}
});
});
</script>