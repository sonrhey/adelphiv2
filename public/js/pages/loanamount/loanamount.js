$(document).ready(function(){
    var ar = $('#tbl-loanamount').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/loan_amount/getloanamount',
        columns: [
            {data: 'location_name', name: 'location_name'},
            {data: 'amount', name: 'amount'},
            {data: 'total_handling_fee', name: 'total_handling_fee'},
            {data: 'total_notarial', name: 'total_notarial'},
            {data: 'total_annotation', name: 'total_annotation'},
            {data: 'total_deductions', name: 'total_deductions'},
            {data: 'net_proceeds', name: 'net_proceeds'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});