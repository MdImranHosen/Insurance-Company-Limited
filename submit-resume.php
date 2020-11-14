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
<!--Sidebar Page Container-->
<div class="sidebar-page-container services_page">
<div class="auto-container">
    <div class="row clearfix">    
    <!--Content Side / Blog Sidebar-->
    <div class="content-side col-lg-8 col-md-12 col-sm-12">
    <div class="blog-single wow slideInLeft" data-wow-delay="500ms">      
<!--Comment Form-->
  <div class="comment-form">
      <div class="group-title">
          <p><?php 
           if (class_exists('SettingsClass')) {
             $settings = new SettingsClass();
             if (method_exists($settings, 'getPageTitleByPageName')) {
               $pageTitleData = $settings->getPageTitleByPageName($currentpage);
               if ($pageTitleData) {
                  while ($prows = $pageTitleData->fetch_assoc()) {
                    echo htmlspecialchars_decode(stripcslashes($prows['page_title']));
                    
           } } } } ?></p>
      </div>
      <div id="resume_data_msg"></div>
      <form id="resume_submit_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
          <div class="row clearfix">
              <div class="col-lg-6 col-md-12 col-sm-12 form-group">                 
                  <input type="text" name="first_name" id="first_name" placeholder="First Name" required="">
              </div>
              
              <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                  <input type="text" name="last_name" id="last_name" placeholder="Last Name" required="">
              </div>

              <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                  <input type="email" name="re_email" id="re_email" placeholder="Email Address" required="">
              </div>
              
              <div class="col-lg-6 col-md-12 col-sm-12 form-group">
                  <input type="text" name="phone_num" id="phone_num" placeholder="Phone Number" required="">
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                  <textarea name="re_address" id="re_address" placeholder="Your Address"></textarea>
              </div>
              <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                  <input type="file" name="rem_file" id="rem_file">
                  <p><small><span class="text-red"> File Should be (.pdf,.doc,docx,.txt,.ppt ) (Maximum size: 5 MB )</span></small></p>
              </div>
              
              <div class="col-lg-12 col-md-12 col-sm-12 form-group">
                  <button class="theme-btn btn-style-one" type="submit" name="submit-form"><span class="btn-title"> Submit </span></button>
              </div>
          </div>
      </form>
  </div> 
    </div>
    </div>
    </div>
</div>
</div>
<!-- End Services Details Container -->
<!-- Main Footer -->
<?php include 'inc/footer.php'; ?>

<script type="text/javascript">
$(document).ready(function(){

$('#resume_submit_form').on('submit', function(e) {

var first_name = $('#first_name').val();
var last_name  = $('#last_name').val();
var re_email   = $('#re_email').val();
var phone_num  = $('#phone_num').val();
var re_address = $('#re_address').val();
var rem_file   = $('#rem_file').prop('files')[0];

if (first_name == '' || last_name == '' || re_email == '' || phone_num == '' || re_address == '' || (document.getElementById("rem_file").files.length ==0)) {
  $('#resume_data_msg').html('<div class="alert alert-danger">Field Should not be Empty! </div>');
  return false;
} else {

  var form_data = new FormData();

  form_data.append('first_name', first_name);
  form_data.append('last_name', last_name);
  form_data.append('re_email', re_email);
  form_data.append('phone_num', phone_num);
  form_data.append('re_address', re_address);
  form_data.append('rem_file', rem_file);
  form_data.append('resume_data',98);

   e.preventDefault();
    $.ajax({
        type: "post",
        url: "ajax/resume_submit_ajax.php",
        data: form_data,
        processData: false,
        cache: false,
        contentType: false,
        success: function(resume_msg) {
        $('#resume_data_msg').html(resume_msg);
        }
    });
    return false;
  }
 });
});
</script>