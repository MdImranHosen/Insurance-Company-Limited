
$(document).ready(function() {

  //DataTable All Data show
  $('#sharehtable').DataTable({
      aLengthMenu: [
      [10, 25, 50, 100, 200, -1],
      [10, 25, 50, 100, 200, "All"]
  ],
  iDisplayLength: -1
  });

  // Share Holders Title and text edit data show
  $(document).on('click', '.onclick_shtext', (function() {
   var shtid = $(this).data('shtid');
    $.ajax({
          type: "post",
          url: "ajax/share_text_edit_ajax.php",
          data: {shtid:shtid,share_text_data:99},
          success: function(shtextdata){
            $('#share_text_des').html(shtextdata);

            // Update branches by branches id

    $('#shtext_form').on('submit', function(e) {
      
      var sht_id    = $('#sht_id').val();
      var sht_title = $('#sht_title').val();
      var sht_text  = $('#sht_text').val();
      
    if (sht_id == "" || sht_title == "" || sht_text == "") {                  
        $('#err_text_edit_msg').html("<div class='text-red'> Name Field must not be Empty!</div>");
      return false;
     } else{

            var form_data = new FormData();
            form_data.append('sht_id', sht_id);
            form_data.append('sht_title', sht_title);
            form_data.append('sht_text', sht_text);
            form_data.append('share_text_data', 99);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/share_text_update_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(sharehol_text_update){
                 $('#err_text_edit_msg').html(sharehol_text_update);
               }
            });
            return false;
            }

            });
          },
          error: function(err){
            alert(err);
          }
    });

}));

});

// Share Holders By Id Delete
  $(document).ready(function(){
     $(document).on('click', '.onclick_del', (function() {
         var sharehol_delid = $(this).data('sharehol_delid');

          $.ajax({
                type: "post",
                url: "ajax/share_holders_del_ajax.php",
                data: {sharehol_delid:sharehol_delid,share_data:99},
                success: function(del){
                  $('#message_data').html(del);
                },
                error: function(err){
                  alert(err);
                }
          });

     }));

//Get share holders data by Id with edit
$(document).on('click', '.onclick_data', (function() {
   var sharehol_id = $(this).data('sharehol_id');
    $.ajax({
          type: "post",
          url: "ajax/share_edit_ajax.php",
          data: {sharehol_id:sharehol_id,share_data:99},
          success: function(data){
            $('#share_des').html(data);

            // Update share holders by id

    $('#share_form_update').on('submit', function(e) {
      
      var sh_id            = $('#sh_id').val();
      var name_edit        = $('#name_edit').val();
      var position_edit    = $('#position_edit').val();
      var no_of_share_edit = $('#no_of_share_edit').val();
      var amount_edit      = $('#amount_edit').val();
      var percentage_edit       = $('#percentage_edit').val();
      
    if (name_edit == "" && position_edit == "" && no_of_share_edit == "" && amount_edit == "") {

        $('#err_name_edit').addClass('has-error');
        $('#err_position_edit').addClass('has-error');
        $('#err_no_of_share_edit').addClass('has-error');
        $('#err_amount_edit').addClass('has-error');
                  
        $('#err_name_edit_msg').html("<div class='text-red'> Name Field must not be Empty!</div>");
        $('#err_position_edit_msg').html("<div class='text-red'> Position must not be Empty!</div>");
        $('#err_no_of_share_edit_msg').html("<div class='text-red'> No of Share must not be Empty!</div>");
        $('#err_amount_edit_msg').html("<div class='text-red'> Amount Field must not be Empty!</div>");
      return false;
    } else if(name_edit == "") {
        $('#err_name_edit').addClass('has-error');
        $('#err_name_edit_msg').html("<div class='text-red'>Name Field must not be Empty!</div>");
          return false;
     } else if(position_edit == "") {
         $('#err_position_edit').addClass('has-error');
         $('#err_position_edit_msg').html("<div class='text-red'> Position Field must not be Empty! </div>");
         return false;
    } else if(no_of_share_edit == "") {
         $('#err_no_of_share_edit').addClass('has-error');
         $('#err_no_of_share_edit_msg').html("<div class='text-red'> No of Share must not be Empty!</div>");
         return false;
    } else if(amount_edit == "") {
         $('#err_amount_edit').addClass('has-error');
         $('#err_amount_edit_msg').html("<div class='text-red'> Amount Field must not be Empty!</div>");
         return false;
    } else{

            var form_data = new FormData();

            form_data.append('sh_id', sh_id);
            form_data.append('name_edit', name_edit);
            form_data.append('position_edit', position_edit);
            form_data.append('no_of_share_edit', no_of_share_edit);
            form_data.append('amount_edit', amount_edit);
            form_data.append('percentage_edit', percentage_edit);
            form_data.append('share_data', 99);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/share_update_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(sharehol_update){
                 $('#upmsg_message').html(sharehol_update);
               }
            });
            return false;
            }

            });
          },
          error: function(err){
            alert(err);
          }
    });

}));

});

// add share holders data ...
  $(document).ready(function(){

    $('#shareholders_form').on('submit', function(e) {

      var name        = $('#name').val();
      var position    = $('#position').val();
      var no_of_share = $('#no_of_share').val();
      var amount      = $('#amount').val();
      var percentage  = $('#percentage').val();
      
    if (name == "" && position == "" && no_of_share == "" && amount == "") {

        $('#err_name').addClass('has-error');
        $('#err_position').addClass('has-error');
        $('#err_no_of_share').addClass('has-error');
        $('#err_amount').addClass('has-error');
                  
        $('#err_name_msg').html("<div class='text-red'> Name Field must not be Empty!</div>");
        $('#err_position_msg').html("<div class='text-red'> Position must not be Empty!</div>");
        $('#err_no_of_share_msg').html("<div class='text-red'> No of Share must not be Empty!</div>");
        $('#err_amount_msg').html("<div class='text-red'> Amount Field must not be Empty!</div>");
      return false;
    } else if(name == "") {
        $('#err_name').addClass('has-error');
        $('#err_name_msg').html("<div class='text-red'>Name Field must not be Empty!</div>");
          return false;
     } else if(position == "") {
         $('#err_position').addClass('has-error');
         $('#err_position_msg').html("<div class='text-red'> Position Field must not be Empty! </div>");
         return false;
    } else if(no_of_share == "") {
         $('#err_no_of_share').addClass('has-error');
         $('#err_no_of_share_msg').html("<div class='text-red'> No of Share must not be Empty!</div>");
         return false;
    } else if(amount == "") {
         $('#err_amount').addClass('has-error');
         $('#err_amount_msg').html("<div class='text-red'> Amount Field must not be Empty!</div>");
         return false;
    } else{

          var form_data = new FormData();

            form_data.append('name', name);
            form_data.append('position', position);
            form_data.append('no_of_share', no_of_share);
            form_data.append('amount', amount);
            form_data.append('percentage', percentage);
            form_data.append('share_data', 99);

            e.preventDefault();
            $.ajax({
               type: "post",
               url: "ajax/share_add_ajax.php",
               data: form_data,
               processData: false,
               cache: false,
               contentType: false,
               success: function(share_data){
                 $('#msg_message').html(share_data);
               }
            });
            return false;
       }

    });
  });