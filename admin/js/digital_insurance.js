$(document).ready(function() {
   $(document).on('click', '.onclick_data', (function() {
       var dgitalinid = $(this).data('dgitalinid');

        $.ajax({
              type: "post",
              url: "ajax/digital_insurance_ajax.php",
              data: {dgitalinid:dgitalinid,digital_status:99},
              success: function(deta) {
                $('#detail_digital_info').html(deta);
              },
              error: function(err){
                alert(err);
              }
        });

   }));

   $(document).on('click', '.onclic_del_digitalin', (function() {

       var digidelin = $(this).data('digidelin');
        $.ajax({
              type: "post",
              url: "ajax/digital_insurance_ajax.php",
              data: {digidelin:digidelin,digital_del:99},
              success: function(data){
                $('#digital_info_del').html(data);
              },
              error: function(err){
                alert(err);
              }
        });

   }));
});

