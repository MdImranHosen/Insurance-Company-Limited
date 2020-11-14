$(document).ready(function(){
   $(document).on('click', '.onclic_del_fi', (function() {
       var fi_id   = $(this).data('fi_id');
       var fi_type = $(this).data('fid_type');
        $.ajax({
              type: "post",
              url: "ajax/fi_del_ajax.php",
              data: {fi_id:fi_id,fi_type:fi_type,fi_data:99},
              success: function(del) {
                $('#message_data').html(del);
              },
              error: function(err){
                alert(err);
              }
        });

   }));

   $(document).on('click', '.onclick_pagetext', (function() {

       var pagetid   = $(this).data('pagetid');

        $.ajax({
              type: "post",
              url: "ajax/page_title_ajax.php",
              data: {pagetid:pagetid,page_data:99},
              success: function(pageData) {
                $('#page_title_data').html(pageData);

                $('#pagetitled_form').on('submit', function(e){

                  var menut_id    = $('#menut_id').val();
                  var paged_title = $('#paged_title').val();

                  if (menut_id == "" || paged_title == "") {
                    $('#page_message').html("<div class='text-red'> Title must not be Empty!</div>");
                    return false;
                  } else{

                    var form_data = new FormData();

                    form_data.append('menut_id', menut_id);
                    form_data.append('paged_title', paged_title);
                    form_data.append('page_datas', 99);                     

                      e.preventDefault();
                      $.ajax({
                         type: "post",
                         url: "ajax/page_title_update_ajax.php",
                         data: form_data,
                         processData: false,
                         cache: false,
                         contentType: false,
                         success: function(page_data_up){
                           $('#page_message').html(page_data_up);
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



$(document).ready(function(){

  $('#fi_data_form').on('submit', function(e) {

    var fi_title = $('#fi_title').val();
    var fi_date  = $('#fi_date').val();
    var fir_type = $('#fir_type').val();
    var fi_doc   = $('#fi_doc').prop('files')[0];
    
    if (fi_title == "" && (document.getElementById("fi_doc").files.length ==0)) {

      $('#err_content_title').addClass('has-error');
      $('#err_fi_doc').addClass('has-error');
      $('#err_content_title_msg').html("<div class='text-red'> Title must not be Empty!</div>");
      $('#err_fi_doc_msg').html("<div class='text-red'> File must not be Empty! </div>");
        return false;
      } else if(fi_title == "") {

      $('#err_content_title').addClass('has-error');
      $('#err_content_title_msg').html("<div class='text-red'> Content Title must not be Empty!</div>");
        return false;
      } else if(document.getElementById("fi_doc").files.length ==0) {

       $('#err_fi_doc').addClass('has-error');
       $('#err_fi_doc_msg').html("<div class='text-red'> File must not be Empty! </div>");
       return false;
     } else{

        var form_data = new FormData();

        form_data.append('fi_title', fi_title);
        form_data.append('fi_date', fi_date);
        form_data.append('fir_type', fir_type);
        form_data.append('fi_doc', fi_doc);

          e.preventDefault();
          $.ajax({
             type: "post",
             url: "ajax/fi_add_ajax.php",
             data: form_data,
             processData: false,
             cache: false,
             contentType: false,
             success: function(financiali_data){
               $('#fi_message').html(financiali_data);
             }
          });
          return false;
     }

  });
});
