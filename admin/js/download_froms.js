$(document).ready(function(){

$(document).on('click', '.onclic_del_cat', (function() {
     var cat_id   = $(this).data('cat_id');

     if(confirm("Are you sure you want to Delete this?")){
      $.ajax({
            type: "post",
            url: "ajax/download_ajax.php",
            data: {cat_id:cat_id,cat_del_data:99},
            success: function(cat_del) {
              $('#cat_message_data').html(cat_del);
            },
            error: function(err){
              alert(err);
            }
      });
    } else{
      return false;
    }

 }));


$(document).on('click', '.onclick_cat_status', (function() {

     var cat_status_id = $(this).data('cat_status_id');
     var cat_status    = $(this).data('cat_status');

    if(confirm("Are you sure you want to Status Change?")){

      $.ajax({
            type: "post",
            url: "ajax/download_ajax.php",
            data: {cat_status_id:cat_status_id,cat_status:cat_status,cat_status_data:99},
            success: function(cat_status) {
              $('#cat_message_data').html(cat_status);
            },
            error: function(err){
              alert(err);
            }
      });
      
  } else{
      return false;
  }
      

 }));

$('#download_cat_form').on('submit', function(e) {

  var category_title = $('#category_title').val();
  
  if (category_title == "") {

    $('#err_category_title').addClass('has-error');
    $('#err_category_title_msg').html("<div class='text-red'> Title must not be Empty!</div>");
      return false;
    } else{

      var form_data = new FormData();

      form_data.append('category_title', category_title);
      form_data.append('cat_data', 99);

        e.preventDefault();
        $.ajax({
           type: "post",
           url: "ajax/download_ajax.php",
           data: form_data,
           processData: false,
           cache: false,
           contentType: false,
           success: function(download_cat_data){
             $('#cat_message').html(download_cat_data);
           }
        });
        return false;
   }

});

$('#dwf_data_form').on('submit', function(e) {

  var dwf_title = $('#dwf_title').val();
  var dwf_date  = $('#dwf_date').val();
  var dwf_cat_title = $('#dwf_cat_title').val();
  var dwf_file = $('#dwf_file').prop('files')[0];
  
  if (dwf_title == "" && dwf_cat_title == "" && (document.getElementById("dwf_file").files.length ==0)) {

    $('#err_dwf_title').addClass('has-error');
    $('#err_dwf_cat_title').addClass('has-error');
    $('#err_dwf_file').addClass('has-error');
    $('#err_dwf_title_msg').html("<div class='text-red'> Title is Required! </div>");
    $('#err_dwf_file_msg').html("<div class='text-red'> File must not be Empty! </div>");
    $('#err_dwf_cat_title_msg').html("<div class='text-red'> Category is Required! </div>");
      return false;
    } else if(dwf_title == "") {

    $('#err_dwf_title').addClass('has-error');
    $('#err_dwf_title_msg').html("<div class='text-red'> Title is Required! </div>");
      return false;
    }  else if(dwf_cat_title == "") {

    $('#err_dwf_cat_title').addClass('has-error');
    $('#err_dwf_cat_title_msg').html("<div class='text-red'> Category is Required !</div>");
      return false;
    } else if(document.getElementById("dwf_file").files.length ==0) {

     $('#err_dwf_file').addClass('has-error');
     $('#err_dwf_file_msg').html("<div class='text-red'> File must not be Empty! </div>");
     return false;
   } else{

      var form_data = new FormData();

      form_data.append('dwf_title', dwf_title);
      form_data.append('dwf_date', dwf_date);
      form_data.append('dwf_cat_title', dwf_cat_title);
      form_data.append('dwf_file', dwf_file);
      form_data.append('dwf_check_data', 99);

        e.preventDefault();
        $.ajax({
           type: "post",
           url: "ajax/download_ajax.php",
           data: form_data,
           processData: false,
           cache: false,
           contentType: false,
           success: function(dwf_data){
             $('#dwf_message').html(dwf_data);
           }
        });
        return false;
   }

});

$(document).on('click', '.onclic_del_dwf', (function() {
     var dwf_id = $(this).data('dwf_id');

     if(confirm("Are you sure you want to Delete this?")){
      $.ajax({
            type: "post",
            url: "ajax/download_ajax.php",
            data: {dwf_id:dwf_id,dwf_del_data:99},
            success: function(dwf_del) {
              $('#message_data').html(dwf_del);
            },
            error: function(err){
              alert(err);
            }
      });
    } else{
      return false;
    }

 }));

$(document).on('click', '.onclick_dwf_status', (function() {

     var dwf_status_id = $(this).data('dwf_status_id');
     var dwf_status    = $(this).data('dwf_status');

    if(confirm("Are you sure you want to Status Change?")){

      $.ajax({
            type: "post",
            url: "ajax/download_ajax.php",
            data: {dwf_status_id:dwf_status_id,dwf_status:dwf_status,dwf_status_check:99},
            success: function(dwf_status_data) {
              $('#message_data').html(dwf_status_data);
            },
            error: function(err){
              alert(err);
            }
      });
      
  } else{
      return false;
  }
      

 }));

});