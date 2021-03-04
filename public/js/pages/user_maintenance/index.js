$(document).ready(function(){
	var ar = $('#tbl-users').DataTable({
	    processing: true,
	    serverSide: true,
	    order: [[ 3, "DESC" ]],
	    ajax: 'usermaintenance/get',
	    columns: [
	    	{data: 'last_name', name: 'last_name'},
	        {data: 'first_name', name: 'first_name'},
	        {data: 'username', name: 'username'},
	        {data: 'user_type.name', name: 'user_type.name'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ]
	});
});