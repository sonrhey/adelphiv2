var client_lsit = $(function(){
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "post",
        url: "/clients/client_list",
        success: function(response){
            var length = response.length;
            $('[name="client_id"]').append('<option selected disabled>--Select One--</option>');
            for(var a=0; a<length; a++){
                var name = [response[a].first_name,response[a].middle_name,response[a].last_name];
                var full_name = name.join(" ");
                $('[name="client_id"]').append('<option data-tokens="'+response[a].id+'" value="'+response[a].id+'">'+full_name+'</option>');
            }
            $('[name="client_id"]').selectpicker('refresh');
        },
        error: function(error){
            console.log(error);
        }
    });
});