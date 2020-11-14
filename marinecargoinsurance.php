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
<section class="page_title_new" style="background-image:url(<?php echo BASE_PATH; ?>/img/title-background.jpg);">
<div class="auto-container">
 <div class="sec-title">
    <h1> Digital Marine Cargo Insurance </h1>
    <p><a href="<?php echo BASE_PATH; ?>"><i class="fa fa-home"></i></a> <span class="sep sep-1"> » </span> Digital Marine Cargo Insurance </p>
 </div>
</div>
</section>
<!--End Page Title-->
<!--Sidebar Page Container-->
<div class="sidebar-page-container services_page">
<div class="auto-container">
    <div class="row clearfix">    
    <!--Content Side / Blog Sidebar-->
    <div class="col-lg-12">
      <center><h2> Marine Cargo Insurance
 </h2></center>
    </div>
    <div class="content-side col-lg-10 col-md-12 col-sm-12">
   <div id="product_data_msg"></div>

  <form id="product_buy_form" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" class="needs-validation" novalidate>
    <input type="hidden" name="services_name" id="services_name" 
    value="marinecargoinsurance">
    <div class="form-group row">
      <label for="name" class="col-sm-4 col-form-label text-right font-weight-bold"> Name <span class="text-red">*</span></label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="name" id="name" required="">
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> This field is Required. </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="address" class="col-sm-4 col-form-label text-right font-weight-bold">Address <span class="text-red">*</span></label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="address" id="address" required="">
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> This field is Required. </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="telephone_number" class="col-sm-4 col-form-label text-right font-weight-bold">Telephone Number <span class="text-red">*</span></label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="telephone_number" id="telephone_number" required="">
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> This field is Required. </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="cell_number" class="col-sm-4 col-form-label text-right font-weight-bold">Cell Number <span class="text-red">*</span></label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="cell_number" id="cell_number" required="">
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> This field is Required. </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="fax_number" class="col-sm-4 col-form-label text-right font-weight-bold">Fax Number </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="fax_number" id="fax_number">
      </div>
    </div>
    <div class="form-group row">
      <label for="email_address" class="col-sm-4 col-form-label text-right font-weight-bold">Email Address <span class="text-red">*</span></label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="email_address" id="email_address" required="">
        <div class="valid-feedback"> Looks good! </div>
        <div class="invalid-feedback"> This field is Required. </div>
      </div>
    </div>
    <div class="form-group row">
      <label for="insert_to_be_covered" class="col-sm-4 col-form-label text-right font-weight-bold"> Interest to be Covered </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="insert_to_be_covered" id="insert_to_be_covered">
      </div>
    </div>
    <div class="form-group row">
      <label for="abiwb" class="col-sm-4 col-form-label text-right font-weight-bold">Amount to be Insured with breakup </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="abiwb" id="abiwb">
      </div>
    </div>
    <div class="form-group row">
      <label for="watrywtc" class="col-sm-4 col-form-label text-right font-weight-bold">What are the Risks you want to cover? </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="watrywtc" id="watrywtc">
      </div>
    </div>
    <div class="form-group row">
      <label for="conoftbuil" class="col-sm-4 col-form-label text-right font-weight-bold">Construction of the building </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="conoftbuil" id="conoftbuil">
      </div>
    </div>
    <div class="form-group row">
      <label for="occupation" class="col-sm-4 col-form-label text-right font-weight-bold"> Occupation </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="occupation" id="occupation">

      </div>
    </div>
    <div class="form-group row">
      <label for="locationotp" class="col-sm-4 col-form-label text-right font-weight-bold"> Location of the Project </label>
      <div class="col-sm-8">
        <input type="text" class="form-control" name="locationotp" id="locationotp">
      </div>
    </div>
    <div class="form-group row">
      <div class="col-sm-4"></div>
      <div class="col-sm-8">
        <button type="submit" class="btn btn-primary"> Submit Form </button>
        <button type="reset" class="btn btn-default"> Reset </button>
      </div>
    </div>
  </form>
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
<!-- Main Footer -->
<?php include 'inc/footer.php'; ?>
<script type="text/javascript">
$(document).ready(function() {

$('#product_buy_form').on('submit', function(e) {

  var services_name    = $('#services_name').val();
  var name             = $('#name').val();
  var address          = $('#address').val();
  var telephone_number = $('#telephone_number').val();
  var cell_number      = $('#cell_number').val();
  var fax_number       = $('#fax_number').val();
  var email_address    = $('#email_address').val();
  var insert_to_be_covered = $('#insert_to_be_covered').val();
  var abiwb           = $('#abiwb').val();
  var watrywtc        = $('#watrywtc').val();
  var conoftbuil      = $('#conoftbuil').val();
  var occupation      = $('#occupation').val();
  var locationotp     = $('#locationotp').val();

if (name == '' || address == '' || telephone_number == '' || cell_number == '' || email_address == '') {
  $('#product_data_msg').html('<div class="alert alert-danger"> * is Required! </div>');
  return false;
} else {

  var form_data = new FormData();
  
  form_data.append('services_name', services_name);
  form_data.append('name', name);
  form_data.append('address', address);
  form_data.append('telephone_number', telephone_number);
  form_data.append('cell_number', cell_number);
  form_data.append('fax_number', fax_number);
  form_data.append('email_address', email_address);
  form_data.append('insert_to_be_covered', insert_to_be_covered);
  form_data.append('abiwb', abiwb);
  form_data.append('watrywtc', watrywtc);
  form_data.append('conoftbuil', conoftbuil);
  form_data.append('occupation', occupation);
  form_data.append('locationotp', locationotp);
  form_data.append('product_buy_data',98);

   e.preventDefault();
    $.ajax({
        type: "post",
        url: "ajax/product_buy_ajax.php",
        data: form_data,
        processData: false,
        cache: false,
        contentType: false,
        success: function(poduct_buydata) {
        $('#product_data_msg').html(poduct_buydata);
        }
    });
    return false;
  }
 });
});
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>