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
    <div class="blog-single wow fadeInUp" data-wow-delay="500ms">      
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
      <div id="online_claim_data"></div>
      <form id="online_claim_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data" class="needs-validation" novalidate>

  <div class="form-row">
    <div class="col-md-6 mb-6">
      <label for="name_insured"> <strong> Name of the Insured <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong> </label>
      <input type="text" class="form-control" name="name_insured" id="name_insured"  required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
    <div class="col-md-6 mb-6">
      <label for="pcn_cnn"> <strong> Policy/Certificate No./Cover Note No <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong> </label>
      <input type="text" class="form-control" id="pcn_cnn" name="pcn_cnn" required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
  </div>
<br>

   <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="dateol"> <strong> Date of Loss <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong> </label>
      <input type="text" data-provide="datepicker" class="form-control" name="dateol" id="dateol"  required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="placeol"> <strong> Place of Loss </strong> </label>
      <input type="text" class="form-control" id="placeol" name="placeol">
    </div>
    <div class="col-md-4 mb-3">
      <label for="natureol"><strong> Nature of Loss <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong> </label>
      <input type="text" class="form-control" id="natureol" name="natureol" required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
  </div>


   <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="causeol"> <strong> Cause of Loss <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong></label>
      <input type="text" class="form-control" name="causeol" id="causeol"  required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="vehicleno"> <strong> Vehicle No. (If Motor Claim) <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong> </label>
      <input type="text" class="form-control" id="vehicleno" name="vehicleno" required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="estol_ia"> <strong> Estimated of Loss, if any <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong> </label>
      <input type="text" class="form-control" id="estol_ia" name="estol_ia" required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
  </div>

 
   <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="contact_p"> <strong> Contact Person Name <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong> </label>
      <input type="text" class="form-control" name="contact_p" id="contact_p"  required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="address"> <strong> Address <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong> </label>
      <input type="text" class="form-control" id="address" name="address" required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="phone_n"> <strong> Phone No <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong> </label>
      <input type="text" class="form-control" id="phone_n" name="phone_n" required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
  </div>


   <div class="form-row">
    <div class="col-md-4 mb-3">
      <label for="mobile_n"> <strong> Mobile No <span style="font-size: 22px;vertical-align: bottom;" class="text-red"> *</span> </strong> </label>
      <input type="text" class="form-control" name="mobile_n" id="mobile_n"  required>
      <div class="valid-feedback"> Looks good! </div>
      <div class="invalid-feedback"> This field is Required. </div>
    </div>
    <div class="col-md-4 mb-3">
      <label for="fax_n"> <strong> Fax No </strong> </label>
      <input type="text" class="form-control" id="fax_n" name="fax_n">
    </div>
    <div class="col-md-4 mb-3">
      <label for="email"> <strong> Email </strong> </label>
      <input type="text" class="form-control" id="email" name="email">
    </div>
  </div>

  <div class="form-row">
    <div class="col-md-4 mb-4">
      <label for="email"> <strong> Documents </strong> </label>
      <div class="custom-file">
      <input type="file" class="custom-file-input" name="doc_one" id="doc_one">
      <label class="custom-file-label" for="doc_one"> Choose file. <span class="text-red">(pdf,doc,docx,jpg,jpeg,png)</span></label>
    </div>
    </div>
    <div class="col-md-4 mb-4">
      <label for="email"> <strong> Documents </strong> </label>
      <div class="custom-file">
      <input type="file" class="custom-file-input" name="doc_two" id="doc_two">
      <label class="custom-file-label" for="doc_two">Choose file. <span class="text-red">(pdf,doc,docx,jpg,jpeg,png)</span></label>
    </div>
    </div>
    <div class="col-md-4 mb-4">
      <label for="email"> <strong> Documents </strong> </label>
      <div class="custom-file">
      <input type="file" class="custom-file-input" name="doc_three" id="doc_three">
      <label class="custom-file-label" for="doc_three">Choose file. <span class="text-red">(pdf,doc,docx,jpg,jpeg,png)</span></label>
    </div>
    </div>
  </div>
  <div class="form-group">
    <div class="form-check">
      <input class="form-check-input" type="checkbox" value="" id="invalidCheck">
      <label class="form-check-label" for="invalidCheck">
        Agree to terms and conditions
      </label>
      <div class="invalid-feedback">
        You must agree before submitting.
      </div>
    </div>
  </div>
  <button class="btn btn-primary btn-sm" type="submit"> Submit </button>
  </form>
  </div> 
    </div>
    </div>

<script type="text/javascript">
(function() {
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
      if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
      }
      form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

    </div>
</div>
</div>
<!-- End Services Details Container -->
<!-- Main Footer -->
<?php include 'inc/footer.php'; ?>

<script type="text/javascript">
$(document).ready(function() {

$('#online_claim_form').on('submit', function(e) {

  var name_insured = $('#name_insured').val();
  var pcn_cnn      = $('#pcn_cnn').val();
  var dateol       = $('#dateol').val();
  var placeol      = $('#placeol').val();
  var natureol     = $('#natureol').val();
  var causeol      = $('#causeol').val();
  var vehicleno    = $('#vehicleno').val();
  var estol_ia     = $('#estol_ia').val();
  var contact_p    = $('#contact_p').val();
  var address      = $('#address').val();
  var phone_n      = $('#phone_n').val();
  var mobile_n     = $('#mobile_n').val();
  var fax_n        = $('#fax_n').val();
  var email        = $('#email').val();
  var doc_one      = $('#doc_one').prop('files')[0];
  var doc_two      = $('#doc_two').prop('files')[0];
  var doc_three    = $('#doc_three').prop('files')[0];

if (name_insured == '' || pcn_cnn == '' || dateol == '' || natureol == '' || causeol == '' || vehicleno == '' || estol_ia == '' || contact_p == '' || address == '' || phone_n == '' || mobile_n == '') {
  $('#online_claim_data').html('<div class="alert alert-danger"> * is Required! </div>');
  return false;
} else {

  var form_data = new FormData();

  form_data.append('name_insured', name_insured);
  form_data.append('pcn_cnn', pcn_cnn);
  form_data.append('dateol', dateol);
  form_data.append('placeol', placeol);
  form_data.append('natureol', natureol);
  form_data.append('causeol', causeol);
  form_data.append('vehicleno', vehicleno);
  form_data.append('estol_ia', estol_ia);
  form_data.append('contact_p', contact_p);
  form_data.append('address', address);
  form_data.append('phone_n', phone_n);
  form_data.append('mobile_n', mobile_n);
  form_data.append('fax_n', fax_n);
  form_data.append('email', email);
  form_data.append('doc_one', doc_one);
  form_data.append('doc_two', doc_two);
  form_data.append('doc_three', doc_three);
  form_data.append('online_claim_data',98);

   e.preventDefault();
    $.ajax({
        type: "post",
        url: "ajax/online_claim_ajax.php",
        data: form_data,
        processData: false,
        cache: false,
        contentType: false,
        success: function(online_claim_msg) {
        $('#online_claim_data').html(online_claim_msg);
        }
    });
    return false;
  }
 });
});
</script>
<script type="text/javascript">
  $('#dateol').datepicker({
    todayBtn: true,
    clearBtn: true,
    calendarWeeks: true,
    todayHighlight: true
   });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>