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
    <div class="content-side col-lg-12 col-md-12 col-sm-12">
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
                    $octitle = htmlspecialchars_decode(stripcslashes($prows['page_title']));
                    echo '<center><h2>'.$octitle.'</h2></center>';   
           } } } } ?></p>
      </div>
      <div id="resume_data_msg"></div>
      <form id="online_claim_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">

          <div class="form-group row">
          <label for="name_insured" class="col-sm-3 col-form-label text-right"><strong> Name of the Insured <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="name_insured" id="name_insured">
          </div>
        </div>

        <div class="form-group row">
          <label for="pcn_cnn" class="col-sm-3 col-form-label text-right"><strong> Policy/Certificate No./Cover Note No <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="pcn_cnn" id="pcn_cnn">
          </div>
        </div>
        <div class="form-group row">
          <label for="dateol" class="col-sm-3 col-form-label text-right"><strong> Date of Loss <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="dateol" id="dateol">
          </div>
        </div>
        <div class="form-group row">
          <label for="placeol" class="col-sm-3 col-form-label text-right"><strong> Place of Loss </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="placeol" id="placeol">
          </div>
        </div>
        <div class="form-group row">
          <label for="natureol" class="col-sm-3 col-form-label text-right"><strong> Nature of Loss <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="natureol" id="natureol">
          </div>
        </div>
        <div class="form-group row">
          <label for="causeol" class="col-sm-3 col-form-label text-right"><strong> Cause of Loss <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="causeol" id="causeol">
          </div>
        </div>
        <div class="form-group row">
          <label for="vehicleno" class="col-sm-3 col-form-label text-right"><strong> Vehicle No. (If Motor Claim) <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="vehicleno" id="vehicleno">
          </div>
        </div>
        <div class="form-group row">
          <label for="estol_ia" class="col-sm-3 col-form-label text-right"><strong> Estimated of Loss, if any <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="estol_ia" id="estol_ia">
          </div>
        </div>
        <div class="form-group row">
          <label for="contact_p" class="col-sm-3 col-form-label text-right"><strong> Contact Person Name <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="contact_p" id="contact_p">
          </div>
        </div>
        <div class="form-group row">
          <label for="address" class="col-sm-3 col-form-label text-right"><strong> Address <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="address" id="address">
          </div>
        </div>
        <div class="form-group row">
          <label for="phone_n" class="col-sm-3 col-form-label text-right"><strong> Phone No <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="phone_n" id="phone_n">
          </div>
        </div>
        <div class="form-group row">
          <label for="mobile_n" class="col-sm-3 col-form-label text-right"><strong> Mobile No <span class="text-red"> *</span> </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="mobile_n" id="mobile_n">
          </div>
        </div>
        <div class="form-group row">
          <label for="fax_n" class="col-sm-3 col-form-label text-right"><strong> Fax No </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="fax_n" id="fax_n">
          </div>
        </div>
        <div class="form-group row">
          <label for="email" class="col-sm-3 col-form-label text-right"><strong> Email </strong></label>
          <div class="col-sm-9">
            <input type="text" class="form-control-plaintext" name="email" id="email">
          </div>
        </div>
        <div class="form-group row">
          <label for="name_insured" class="col-sm-3 col-form-label text-right"><strong> Documents </strong></label>
            <div class="col-sm-9">
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Documents</span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="doc_one" id="doc_one"
                  aria-describedby="doc_one">
                <label class="custom-file-label" for="doc_one">Choose file <span class="text-red">(pdf,doc,docx,jpg,png,jpeg)</span></label>
              </div>
            </div>
            </div>
        </div>
        <div class="form-group row">
          <label for="name_insured" class="col-sm-3 col-form-label text-right"><strong> Documents </strong></label>
            <div class="col-sm-9">
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Documents</span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="doc_two" id="doc_two"
                  aria-describedby="doc_two">
                <label class="custom-file-label" for="doc_two">Choose file <span class="text-red">(pdf,doc,docx,jpg,png,jpeg)</span></label>
              </div>
            </div>
            </div>
        </div>
        <div class="form-group row">
          <label for="name_insured" class="col-sm-3 col-form-label text-right"><strong> Documents </strong></label>
            <div class="col-sm-9">
              <div class="input-group">
              <div class="input-group-prepend">
                <span class="input-group-text">Documents</span>
              </div>
              <div class="custom-file">
                <input type="file" class="custom-file-input" name="doc_three" id="doc_three"
                  aria-describedby="doc_three">
                <label class="custom-file-label" for="doc_three">Choose file <span class="text-red">(pdf,doc,docx,jpg,png,jpeg)</span></label>
              </div>
            </div>
            </div>
        </div>

     <div class="form-group row">
      <div class="col-sm-3">
      </div>
      <div class="col-sm-9">
        <button type="submit" class="btn btn-primary">Submit</button>
        <button type="submit" class="btn btn-default">Reset</button>
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

$('#online_claim_form').on('submit', function(e) {

var first_name = $('#first_name').val();
var last_name  = $('#last_name').val();
var re_email   = $('#re_email').val();
var phone_num  = $('#phone_num').val();
var re_address = $('#re_address').val();
var rem_file   = $('#rem_file').prop('files')[0];

if (first_name == '' || last_name == '' || re_email == '' || phone_num == '' || re_address == '') {
  $('#resume_data_msg').html('<div class="alert alert-danger"> Field Should not be Empty! </div>');
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
