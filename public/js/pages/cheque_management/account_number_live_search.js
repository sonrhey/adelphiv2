var account_number = $(function(){
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "POST",
        url: "/chequemanagement/account_numbers",
        success: function(response){
            var length = response.length;
            $('[name="account_number"]').append('<option selected disabled>--Select One--</option>');
            for(var a=0; a<length; a++){
                $('[name="account_number"]').append('<option data-tokens="'+response[a].id+'" value="'+response[a].id+'">'+response[a].account_number+'</option>');
            }
            $('[name="account_number"]').selectpicker('refresh');
        },
        error: function(error){
            console.log(error);
        }
    });
});