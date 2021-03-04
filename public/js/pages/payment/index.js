$(document).ready(function(){
	var ar = $('#tbl-accounts').DataTable({
	    processing: true,
	    serverSide: true,
	    order: [[ 3, "DESC" ]],
	    ajax: 'accounts/approved-loan',
	    columns: [
	    	{data: 'fullname', name: 'fullname'},
	        {data: 'account_number', name: 'account_number'},
	        {data: 'type', name: 'type'},
	        {data: 'name', name: 'name'},
	        {data: 'status', name: 'status',orderable: false, searchable: false},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ]
	});
});