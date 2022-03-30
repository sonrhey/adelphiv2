var length = 0;
var chequeId = 0;
var cashId = 0;
var paymentType;

var check_loan_cycle = function(){
    var loan_cycle = localStorage.getItem("loan_cycle");
    if(loan_cycle == 1 || loan_cycle == 2){
        $(".cycle-count").html(loan_cycle);
        $("#nextCycle").modal("show");
    }
}();

$(document).on('submit', '#renew', function(e){
    e.preventDefault();
    $('#preloader').fadeIn();
    $.ajax({
        url: $(this).attr("action"),
        method: $(this).attr("method"),
        success: function(response){
            $('#preloader').fadeOut();
            localStorage.removeItem("loan_cycle");
            location.reload();
        }
    });
});

$(document).on('submit', '.payloannow',function(e){
    e.preventDefault();
    var flag = false;
    
    switch(paymentType){
        case "CHQ":
            if(chequeId == 0){
                $('#errorPayment').modal("show");
            }else{
                flag = true;
            }
            break;
        case "CSH":
            flag = true;
            break;
    }

    if(flag == true){
        $('#preloader').fadeIn();
        var paymentValue = $(this).find('input.payment-input').val();
        var loanScheduleId = $(this).find('input').data('loan-schedule-id');
        cashId = ($(this).find('input').data('cash-id') != "") ? $(this).find('input').data('cash-id') : 0 ;
        $.ajax({
            type: "POST",
            url: "pay-loan",
            data: {cashId: cashId, paymentValue: paymentValue, chequeId:chequeId, loanScheduleId: loanScheduleId, paymentType: paymentType},
            success: function(response){
                console.log(response.loan_cycle);
                localStorage.setItem("loan_cycle", response.loan_cycle);
                $('#preloader').fadeOut();
                if(response.loan_cycle == 0){
                    $('#succesPayment').modal("show");
                }
                else if(response.loan_cycle == 1 || response.loan_cycle == 2){
                    $(".cycle-count").html(response.loan_cycle);
                    $("#nextCycle").modal("show");
                }else if(response.loan_cycle == 3){
                    $("#fullypaid").modal("show");
                }

                $("#succesPayment, #fullypaid, #renewal-fee").on("hidden.bs.modal", function () {
                    location.reload();
                });
            },
            error: function(error){
                console.log(error.responseText);
                $('#preloader').fadeOut();
                $('#errorPayment').modal("show");
            }
        });
    }
});


$(document).on('change','[name="bank_id"]',function() {
    var paymentId = $(this).find(' option:selected').data('payment-id');
    chequeId = $(this).find(' option:selected').data('cheque-id');
    $('[data-loan-schedule-id="'+paymentId+'"]').val($(this).val());
});

$(document).on('change', '[name="payment_type"]', function(){
    paymentType = this.value;
    var ammortizationId = $(this).find(' option:selected').data('ammortization-id');
    switch(paymentType){
        case 'CSH':
            $(this).hide();
            $('.cash-display'+ammortizationId+'').fadeIn();
            $('.cheque-display'+ammortizationId+'').hide();
            break;
        case 'CHQ':
            $('.cash-display'+ammortizationId+'').hide();
            $('.cheque-display'+ammortizationId+'').fadeIn();
            break;
    }
    $('.payment-input').trigger('focus');
});