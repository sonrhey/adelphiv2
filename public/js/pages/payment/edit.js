var length = 0;
$(document).on('keyup', '[name="payment_amount"]', function(e){
    e.preventDefault();
    // var partial_payment = this.value;
    // // if(partial_payment.length != length){
    // //     $('#tbl-payments').DataTable().ajax.reload();
    // // }
    //     length = partial_payment.length;
    // if(e.keyCode == 13){
    //     $('[name="payment_amount"]').val('');
    //     length = partial_payment.length;
    //     var final_payment = partial_payment;
    //     var totalamount = 0;
    //     $('#tbl-payments tbody tr').each(function(){
    //         var parent = $(this).find('td');
    //         var balance = parent.eq(2).text();
    //         if(balance > 0){    
    //             totalamount += Number(parent.eq(2).text());
    //             if(final_payment > 0){
    //                 var loan_id = parent.eq(7).find('input').attr('data-loan-schedule-id');
    //                 var remaining_amount = Number(final_payment) - Number(balance);
    //                 if(remaining_amount >= 0){
    //                     final_payment = remaining_amount;
    //                     parent.eq(2).html(0);
    //                     $('#payment'+loan_id+'').val(balance);
    //                 }else{
    //                     $('#payment'+loan_id+'').val(final_payment.toFixed(2));
    //                     remaining_amount = Number(final_payment) - Number(balance);
    //                     remaining_amount = remaining_amount * (-1);
    //                     final_payment = 0;
    //                     parent.eq(2).html(remaining_amount.toFixed(2));
    //                 }
    //             }
    //         }
            
    //     });

    //     var change = Number(partial_payment) - Number(totalamount.toFixed(2));
    //     var upmodal = (change > 0) ? ($('#change').html('&#8369; '+change.toFixed(2)).digits(), $('#changeresponsemodal').modal("show")) : '' ;
    // }
});

$(document).on('click', '#paynow' ,function(){
    var paymentarray = [];
    $('#tbl-payments tbody tr').each(function(){
        var parent = $(this).find('td');
        var prev_balance = parent.eq(3).text();
        if(prev_balance != 0){
            var balance = parent.eq(2).text();
            var payment = parent.eq(7).find('input').val();
            var due_amount = parent.eq(1).text();
            var payment_id = parent.eq(7).find('input').attr('data-loan-schedule-id');
            
            paymentarray.push({
                'payment_id' : payment_id,
                'balance' : balance,
                'payment' : payment,
                'due_amount' : due_amount
            });
        }
    });

    save_payment(paymentarray);
});

function balance_computation(due_ammount, payment_value){
    var balance = payment_value - due_ammount;
    var balance = (balance < 0) ? "Payment must be greater than balance amount!" : balance ;
    return balance;
}

$.fn.digits = function(){ 
    return this.each(function(){ 
        $(this).text( $(this).text().replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,") ); 
    })
}

function save_payment(paymentarray){
    var account_id = $('[name="account_id"]').val();
    $.ajax({
        type: "post",
        headers:
        {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: '/payment/'+account_id+'/pay-loan',
        data: 'payment_details='+JSON.stringify(paymentarray),
        success: function(response){
            alert(response);
            $('#changeresponsemodal').modal('hide');
            $('#tbl-payments').DataTable().ajax.reload();
        }
    });
}