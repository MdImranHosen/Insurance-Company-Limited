$(document).ready(function(){

$(document).on('click', '.onclic_del_faq', (function() {
     var faq_id   = $(this).data('faq_id');

     if(confirm("Are you sure you want to Delete this?")){
      $.ajax({
            type: "post",
            url: "ajax/faq_ajax.php",
            data: {faq_id:faq_id,faq_del_data:99},
            success: function(del) {
              $('#faq_message_data').html(del);
            },
            error: function(err){
              alert(err);
            }
      });
    } else{
      return false;
    }

 }));


$(document).on('click', '.onclick_faq_status', (function() {

     var faq_status_id = $(this).data('faq_status_id');
     var faq_status    = $(this).data('faq_status');

    if(confirm("Are you sure you want to Status Change?")){

      $.ajax({
            type: "post",
            url: "ajax/faq_ajax.php",
            data: {faq_status_id:faq_status_id,faq_status:faq_status,faq_status_data:99},
            success: function(status) {
              $('#faq_message_data').html(status);
            },
            error: function(err){
              alert(err);
            }
      });
      
  } else{
      return false;
  }
      

 }));

$('#faq_form').on('submit', function(e) {

  var faq_ask = $('#faq_ask').val();
  var faq_solution = $('#faq_solution').val();
  var faq_ps_id = $('#faq_ps_id').val();
  
  if (faq_ask == "" && (faq_ps_id == "" || faq_ps_id == 0)) {

    $('#err_faq_ask').addClass('has-error');
    $('#err_faq_ask_msg').html("<div class='text-red'> Ask Question is Required! </div>");
    $('#err_faq_solution').addClass('has-error');
    $('#err_faq_solution_msg').html("<div class='text-red'> Answer is Required! </div>");
    $('#err_faq_ps_id').addClass('has-error');
    $('#err_faq_ps_id_msg').html("<div class='text-red'> Services is Required! </div>");
      return false;
    } else if (faq_ps_id == "" || faq_ps_id == 0) {

    $('#err_faq_ps_id').addClass('has-error');
    $('#err_faq_ps_id_msg').html("<div class='text-red'> Services is Required! </div>");
      return false;
    } else if (faq_ask == "") {

    $('#err_faq_ask').addClass('has-error');
    $('#err_faq_ask_msg').html("<div class='text-red'> Ask Question is Required! </div>");
      return false;
    } else if (faq_solution == "") {

    $('#err_faq_solution').addClass('has-error');
    $('#err_faq_solution_msg').html("<div class='text-red'> Answer is Required! </div>");
      return false;
    } else{

      var form_data = new FormData();

      form_data.append('faq_ask', faq_ask);
      form_data.append('faq_solution', faq_solution);
      form_data.append('faq_ps_id', faq_ps_id);
      form_data.append('faq_ad_data', 99);

        e.preventDefault();
        $.ajax({
           type: "post",
           url: "ajax/faq_ajax.php",
           data: form_data,
           processData: false,
           cache: false,
           contentType: false,
           success: function(faq_add_data){
             $('#faq_message').html(faq_add_data);
           }
        });
        return false;
   }

});

});