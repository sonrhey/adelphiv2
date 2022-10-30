$(document).ready(function(){
	var ar = $('#tbl-accounts').DataTable({
	    processing: true,
	    serverSide: false,
	    order: [[ 3, "DESC" ]],
	    ajax: 'accounts/get',
	    columns: [
	    	{data: 'client.first_name',
            render: function ( data, type, row ) {
              return `${row.client.first_name} ${row.client.last_name}`
            }},
	        {data: 'account_number', name: 'account_number'},
	        {data: 'loan_type.name', name: 'loan_type.name'},
	        {data: 'branch.name', name: 'branch.name'},
	        {data: 'status.name', name: 'status.name'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ]
	});
});
