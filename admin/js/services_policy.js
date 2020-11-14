$(document).ready(function(){
 $(document).on('click', '.onclick_policy_data', (function() {

    var policy_id    = $(this).data('pspolicyid');
    var services_url = $(this).data('ps_plicy_url');
    $.ajax({
          type: "post",
          url: "ajax/policy_ajax.php",
          data: {policy_id:policy_id,services_url:services_url,policy_data_view:99},
          success: function(policy_view) {
            $('#policy_data_view').html(policy_view);
          },
          error: function(err){
            alert(err);
          }
    });

 }));

 $(document).on('click', '.onclic_policy_status', (function() {

    var policy_id     = $(this).data('policyid');
    var policy_status = $(this).data('policy_status');
    $.ajax({
          type: "post",
          url: "ajax/policy_ajax.php",
          data: {policy_id:policy_id,policy_status:policy_status,policy_data_status:99},
          success: function(policy_status_data) {
            $('#policy_data_status').html(policy_status_data);
          },
          error: function(err){
            alert(err);
          }
    });

 }));

  $(document).on('click', '.onclic_del_policy', (function() {

    var policy_id    = $(this).data('policydelid');
    var services_url = $(this).data('pscurrentp');
    $.ajax({
          type: "post",
          url: "ajax/policy_ajax.php",
          data: {policy_id:policy_id,services_url:services_url,policy_data_del:99},
          success: function(policy_data_del) {
            $('#policy_data_status').html(policy_data_del);
          },
          error: function(err){
            alert(err);
          }
    });

 }));

});

  $(document).ready(function(){
     $(document).on('click', '.onclic_del_services', (function() {
         var servicesid = $(this).data('servicesid');
         var status     = $(this).data('status');

          $.ajax({
                type: "post",
                url: "ajax/services_status_ajax.php",
                data: {servicesid:servicesid,status:status,services_status:99},
                success: function(del) {
                  $('#message_data').html(del);
                },
                error: function(err){
                  alert(err);
                }
          });

     }));

     $(document).on('click', '.onclick_data', (function() {

         var psid = $(this).data('psid');
          $.ajax({
                type: "post",
                url: "ajax/services_details_ajax.php",
                data: {psid:psid},
                success: function(data){
                  $('#products_services_content').html(data);
                },
                error: function(err){
                  alert(err);
                }
          });

     }));
  });
  
  $(document).ready(function(){

    $('#policy_des').summernote();

    $('#ps_policy_form').on('submit', function(e) {
      
      var services_url = $('#services_url').val();
      var policy_name  = $('#policy_name').val();
      var policy_des   = $('#policy_des').val();
      var highlights   = $('#highlights').val();
      var covered      = $('#covered').val();
      var exclusions   = $('#exclusions').val();
      var policy_img   = $('#policy_img').prop('files')[0];
      
      
     if (policy_name == "" && (document.getElementById("policy_img").files.length ==0)) {

        $('#err_policy_name').addClass('has-error');
        $('#err_policy_img_img').addClass('has-error');

        $('#err_policy_name_msg').html("<div class='text-red'> Policy Name is Required!</div>");
        $('#err_policy_img_msg').html("<div class='text-red'> Image is Required!</div>");
          return false;
        } else if(policy_name == "") {

        $('#err_policy_name').addClass('has-error');
        $('#err_policy_name_msg').html("<div class='text-red'> Policy Name is Required!</div>");
          return false;
        } else if(document.getElementById("policy_img").files.length ==0) {

         $('#err_policy_img').addClass('has-error');
         $('#err_policy_img_msg').html("<div class='text-red'> Image is Required! </div>");         
         return false;
       } else{

            var form_data = new FormData();
            
            form_data.append('services_url', services_url);
            form_data.append('policy_name', policy_name);
            form_data.append('policy_img', policy_img);
            form_data.append('policy_des', policy_des);
            form_data.append('highlights', highlights);
            form_data.append('covered', covered);
            form_data.append('exclusions', exclusions);
            form_data.append('policy_data', 99);


            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/policy_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(ps_policy_data){
                 $('#ps_policy_message').html(ps_policy_data);
               }
            });
            return false;
       }

    });
  });