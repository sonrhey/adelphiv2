$(document).ready(function(){
	var ar = $('#tbl-clients').DataTable({
	    processing: true,
	    serverSide: true,
	    ajax: 'clients/get',
	    columns: [
	    	{data: 'first_name', name: 'first_name'},
	        {data: 'middle_name', name: 'Middle_name'},
	        {data: 'last_name', name: 'last_name'},
	        {data: 'action', name: 'action', orderable: false, searchable: false},
	    ]
	});
});