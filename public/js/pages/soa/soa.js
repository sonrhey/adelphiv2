var loadClient = $(function(){
    $.ajax({
        type: "GET",
        url: 'soa/getclient',
        success: function(response){
            var length = response.length;
            $('[name="client_id"]').append('<option selected disabled>--Select One--</option>');
            for(var a=0; a<length; a++){
                $('[name="client_id"]').append('<option data-tokens="'+response[a].id+'" value="'+response[a].id+'">'+response[a].first_name+' '+response[a].last_name+'</option>');
            }
            $('[name="client_id"]').selectpicker('refresh');
        }
    });
});

$('[name="client_id"]').on('change', function(){
    var client_id = this.value;
    getAccounts(client_id);
});

function getAccounts(client_id){
    $.ajax({
        type: "GET",
        url: 'soa/getaccounts',
        data: {client_id: client_id},
        success: function(response){
            var length = response.length;
            for(var a=0; a<length; a++){
                $('[name="account_number"]').append('<option data-tokens="'+response[a].id+'" value="'+response[a].id+'">'+response[a].account_number+'</option>');
            }
            $('[name="account_number"]').selectpicker('refresh');
        }
    });
}

$('#generatesoa').on('submit', function(e){
    e.preventDefault();
    $.ajax({
        type: $(this).attr("method"),
        url: $(this).attr("action"),
        data: $(this).serialize(),
        success: function(response){
            $('#modal-soa').modal("show");
            $('.soa').html(response);
        },
        error: function(err){
            console.log(err);
            $('#errorPayment').modal("show");
        }
    });
});

function saveSOA(){
    $(".soa").table2excel({
        // exclude CSS class
        // exclude:".noExl",
        name:"SOA",
        filename:'Statement of Account',//do not include extension
        fileext:".xls" // file extension
    });
}