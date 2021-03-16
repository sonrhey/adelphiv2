var banks = $(function(){
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "POST",
        url: "/banks/getlist",
        success: function(response){
            var length = response.length;
            $('[name="bank_id"]').append('<option selected disabled>--Select One--</option>');
            for(var a=0; a<length; a++){
                $('[name="bank_id"]').append('<option data-tokens="'+response[a].id+'" value="'+response[a].id+'">'+response[a].name+'</option>');
            }
            $('[name="bank_id"]').selectpicker('refresh');
        }
    });
});