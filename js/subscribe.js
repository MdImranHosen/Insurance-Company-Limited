 $(document).ready(function(){
       $('#subscriber-form').on('submit', function() {

           var sb_email = $('#sb_email').val();

           if (sb_email == '') {
            alert('Field must not be Empty');
            return false;
           } else {

             $.ajax({
                  type: "post",
                  url: "ajax/subscriber_ajax.php",
                  data: {sb_email:sb_email},
                  success: function(sub_msg) {
                    $('#subscriper_msg').html(sub_msg);
                  }
             });
             return false;

           }
       });
    });