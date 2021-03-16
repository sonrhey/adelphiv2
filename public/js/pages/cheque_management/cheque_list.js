var cheque_list = $('#tbl-cheque').DataTable({
    processing: true,
    serverSide: true,
    ajax: '/chequemanagement/get',
    columns: [
        {data: 'client_name', name: 'client_name'},
        {data: 'bank_name', name: 'bank_name'},
        {data: 'cheque_name', name: 'cheque_name'},
        {data: 'cheque_value', name: 'cheque_value'},
        {data: 'action', name: 'action', orderable: false, searchable: false},
    ],
    "columnDefs":[
        {"width":"30%", "targets":2}
    ]
});

$(document).on('click', '.btn-edit' ,function(){
    var parent = $(this);
    var client_name = parent.closest('tr').find('td').eq(0).text();
    var bank_name = parent.closest('tr').find('td').eq(1).text();
    var cheque_name = parent.closest('tr').find('td').eq(2).text();
    var cheque_amt_text = parent.closest('tr').find('td').eq(3).text();
    var cheque_amt = parseFloat(cheque_amt_text.replace(/,/g, ''));
    var cheque_id = parent.data("cheque-id");
    $('[name="cheque_id"]').val(cheque_id);
    $('[name="selected_cheque_name"]').val(cheque_name);
    $('[name="selected_cheque_value"]').val(cheque_amt);
    compare_bank_name(bank_name);
    compare_client_name(client_name);
    $('#editcheque').modal("show");
});

function compare_bank_name(bank_name){
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "POST",
        url: "/banks/getlist",
        success: function(response){
            var length = response.length;
            $('[name="selected_bank_id"]').append('<option selected disabled>--Select One--</option>');

            for(var a=0; a<length; a++){
                if(bank_name === response[a].name){
                    $('[name="selected_bank_id"]').append('<option data-tokens="'+response[a].id+'" value="'+response[a].id+'" selected>'+response[a].name+'</option>');
                    $('.selectpicker').selectpicker('refresh')
                }else{
                    $('[name="selected_bank_id"]').append('<option data-tokens="'+response[a].id+'" value="'+response[a].id+'">'+response[a].name+'</option>');
                }
            }
            $('[name="selected_bank_id"]').selectpicker('refresh');
        }
    });
}

function compare_client_name(client_name){
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "post",
        url: "/clients/client_list",
        success: function(response){
            var length = response.length;
            $('[name="selected_client_id"]').append('<option selected disabled>--Select One--</option>');
            for(var a=0; a<length; a++){
                var name = [response[a].first_name,response[a].middle_name,response[a].last_name];
                var full_name = name.join(" ");
                if(client_name === full_name){
                    $('[name="selected_client_id"]').append('<option data-tokens="'+response[a].id+'" value="'+response[a].id+'" selected>'+full_name+'</option>');
                    $('.selectpicker').selectpicker('refresh')
                }else{
                    $('[name="selected_client_id"]').append('<option data-tokens="'+response[a].id+'" value="'+response[a].id+'">'+full_name+'</option>');
                }
            }
            $('[name="selected_client_id"]').selectpicker('refresh');
        },
        error: function(error){
            console.log(error);
        }
    });
}