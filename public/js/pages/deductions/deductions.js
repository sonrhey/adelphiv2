// //variables
var thf = 0, tn = 0, ta = 0, td = 0, tdoldval = 0;

//for total deductions
$('[name="commission_amount"], [name="service_fee_amount"],[name="promi_note"], [name="spa"], [name="rem"],[name="chart_fee"], [name="formulated_fee"], [name="fixed_amount"], [name="legal_fee"],[name="appraisal"], [name="document_stamp"], [name="relocation_fee"], [name="insurance"], [name="taxes"]').on('keyup', function(){
    if ($(this).val() == '') {
        $(this).val('');
    } else if ($(this).val() == 0) {
        $(this).val(null);
        return;
    }
	var total = Number($('[name="commission_amount"]').val()) + Number($('[name="service_fee_amount"]').val()) + Number($('[name="promi_note"]').val()) + Number($('[name="spa"]').val()) + Number($('[name="rem"]').val()) + Number($('[name="chart_fee"]').val()) + Number($('[name="formulated_fee"]').val()) + Number($('[name="fixed_amount"]').val()) + Number($('[name="legal_fee"]').val()) + Number($('[name="appraisal"]').val()) + Number($('[name="document_stamp"]').val()) + Number($('[name="relocation_fee"]').val()) + Number($('[name="insurance"]').val()) + Number($('[name="taxes"]').val());
	$('[name="total_deductions"]').val(total);
	compute_np_and_td();
});

//handling
$('[name="commission_amount"], [name="service_fee_amount"]').on('keyup', function(){
    if ($(this).val() == '') {
        $(this).val('');
    } else if ($(this).val() == 0) {
        $(this).val(null);
        return;
    }
thf = Number($('[name="commission_amount"]').val()) + Number($('[name="service_fee_amount"]').val());
$('[name="total_handling_fee"]').val(thf);
});

//notarial
$('[name="promi_note"], [name="spa"], [name="rem"]').on('keyup', function(){
    if ($(this).val() == '') {
        $(this).val('');
    } else if ($(this).val() == 0) {
        $(this).val(null);
        return;
    }
total_deductions = Number($('#total_deductions').val());
tn = Number($('[name="promi_note"]').val()) + Number($('[name="spa"]').val()) + Number($('[name="rem"]').val());
$('[name="total_notarial"]').val(tn);
});

//annotation
$('[name="chart_fee"], [name="formulated_fee"], [name="fixed_amount"], [name="legal_fee"]').on('keyup', function(){
if ($(this).val() == '') {
    $(this).val('');
} else if ($(this).val() == 0) {
    $(this).val(null);
    return;
}
ta = Number($('[name="chart_fee"]').val()) + Number($('[name="formulated_fee"]').val()) + Number($('[name="fixed_amount"]').val()) + Number($('[name="legal_fee"]').val());
$('[name="total_annotation"]').val(ta);
});

// //appraisal, doc stamp, relocation fee, insurance, taxes
// $('[name="appraisal"], [name="document_stamp"], [name="relocation_fee"], [name="insurance"], [name="taxes"]').on('keyup', function(){
// td = Number($('[name="appraisal"]').val()) + Number($('[name="document_stamp"]').val()) + Number($('[name="relocation_fee"]').val()) + Number($('[name="insurance"]').val()) + Number($('[name="taxes"]').val()) + Number(thf) + Number(tn) + Number(ta);
// });

function compute_np_and_td(){
	var total_deductions = $('[name="total_deductions"]').val();
	var loanamount = $('#_loanamount').text();
	loanamount=loanamount.replace(/\,/g,'');
	loanamount=Number(loanamount);
	var netproceeds = Number(loanamount) - Number(total_deductions);
	$('[name="total_deductions"]').val(total_deductions);
	$('[name="net_proceeds"]').val(netproceeds);
}
