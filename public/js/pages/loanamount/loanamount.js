$(document).ready(function(){
    var ar = $('#tbl-loanamount').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/loan_amount/getloanamount',
        columns: [
            {data: 'location_name', name: 'dl.location_name'},
            {data: 'amount', name: 'loan_amounts.amount',
                render: function(data, type, row) {
                    return `${useConvertMoney(row.amount)}`;
                }
            },
            {data: 'total_handling_fee', name: 'cd.total_handling_fee',
                render: function(data, type, row) {
                    return `${useConvertMoney(row.total_handling_fee)}`;
                }
            },
            {data: 'total_notarial', name: 'cd.total_notarial',
                render: function(data, type, row) {
                    return `${useConvertMoney(row.total_notarial)}`;
                }
            },
            {data: 'total_annotation', name: 'cd.total_annotation',
                render: function(data, type, row) {
                    return `${useConvertMoney(row.total_annotation)}`;
                }
            },
            {data: 'total_deductions', name: 'cd.total_deductions',
                render: function(data, type, row) {
                    return `${useConvertMoney(row.total_deductions)}`;
                }
            },
            {data: 'net_proceeds', name: 'cd.net_proceeds',
                render: function(data, type, row) {
                    return `${useConvertMoney(row.net_proceeds)}`;
                }
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
