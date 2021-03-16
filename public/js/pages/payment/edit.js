var length = 0;
var chequeId = 0;

$(document).on('submit', '#payloannow',function(e){
    e.preventDefault();
    if(chequeId == 0){
        $('#errorPayment').modal("show");
    }else{
        $('#preloader').fadeIn();
        var paymentValue = $(this).find('input.payment-input').val();
        var loanScheduleId = $(this).find('input').data('loan-schedule-id');
        $.ajax({
            type: "POST",
            url: "pay-loan",
            data: {paymentValue: paymentValue, chequeId:chequeId, loanScheduleId: loanScheduleId},
            success: function(response){
                console.log(response);
                $('#preloader').fadeOut();
                $('#succesPayment').modal("show");
                $("#succesPayment").on("hidden.bs.modal", function () {
                    location.reload();
                });
            },
            error: function(error){
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